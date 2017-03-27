from gurobipy import *


papers, mark = multidict({
    "Java1":	0,
	"Java2":	1,
	"Java3":	1,
   "Visual Basic1":		0,		
   "Visual Basic2":		1,
   "Visual Basic3":		1, })
   
   
reviewers, expertise = multidict({
	"Joe_Bloggs":  1,
	"Richard_Roe":  2,
	"Mister_Johnson":  3,
	"John_Doe":  1,
	"Jane_Doe":  2,
	"Joe_Bloggs":  3 })    
	
	
specialise = tuplelist([
	('Joe_Bloggs' ,'Java1'), ('Joe_Bloggs','Visual Basic2'),
	('Richard_Roe' , 'Java2'),
	('Mister_Johnson','Java3'), ('Mister_Johnson','Java2'),
	('John_Doe', 'Visual Basic1'),
	('Jane_Doe', 'Visual Basic2')
	])
	
	
m = Model("mark")
x = m.addVars(specialise, vtype=GRB.BINARY , name="x")

slacks = m.addVars(papers, name="Slack")

totSlack = m.addVar(name="totSlack")

totPapers = m.addVars(reviewers, name="TotPapers")

reqCts = m.addConstrs((slacks[p] + x.sum('*', p) == mark[p]
                      for p in papers), "_")
					  
m.addConstr(totSlack == slacks.sum(), "totSlack")	

m.addConstrs((totPapers[r] == x.sum(r) for r in reviewers), "totPapers")
m.setObjective(totSlack)				  
# do IIS
	  

def solveAndPrint():
	m.optimize()
	status = m.status
	if status == GRB.Status.INF_OR_UNBD or status == GRB.Status.INFEASIBLE \
      or status == GRB.Status.UNBOUNDED:
         print('The model cannot be solved because it is infeasible or \
               unbounded')
        exit(1)

	if status != GRB.Status.OPTIMAL:
		print('Optimization was stopped with status %d' % status)
        exit(0)
		
		
	print('')
	print('Total slack required: %g' % totSlack.x)
	for r in reviewers:
		print('%s marked %g papers' % (r, totPapers[r].x))
	print('')

solveAndPrint()	
		
# Constrain the slack by setting its upper and lower bounds
totSlack.ub = totSlack.x
totSlack.lb = totSlack.x		


avgPapers = m.addVar(name="avgPapers")
# Variables to count the difference from average for each worker;
# note that these variables can take negative values.
diffPapers = m.addVars(reviewers, lb=-GRB.INFINITY, name="Diff")

# Constraint: compute the average number of shifts worked
m.addConstr(len(reviewers) * avgPapers == totPapers.sum(), "avgPapers")

# Constraint: compute the difference from the average number of shifts
m.addConstrs((diffPapers[r] == totPapers[r] - avgPapers for r in reviewers),
             "Diff")

# Objective: minimize the sum of the square of the difference from the
# average number of shifts worked
m.setObjective(quicksum(diffPapers[r]*diffPapers[r] for r in reviewers))

# Optimize
solveAndPrint()		
