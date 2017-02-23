
from gurobipy import *
import math		    



paperType, review = multidict({
    "Java": 1,
   "Visual Basic": 1 })
   
reveiwers, expertise = multidict({
	"Joe Bloggs":  1,
	"Richard Roe":  2,
	"Mister Johnson":  3,
	"John Doe":  1,
	"Jane Doe":  2,
	"Joe Bloggs":  3})    
	
	
specialise = tuplelist([
	('Joe Bloggs' ,'Java'),
	('Richard_Roe' , 'Java'),
	('Mister Johnson','Java'),
	('John Doe', 'Visual Basic'),
	('Jane Doe', 'Visual Basic'),
	('Joe Bloggs','Visual Basic'),
	])
	
	
m = Model("mark")
x = m.addVars(specialise, ub=1 , name="x")
m.setObjective(quicksum(review[w]*x[w,s] for w,s in specialise), GRB.MINIMIZE)


reqCts = m.addConstrs((x.sum('*', s) == review[s]
                      for s in paperType), "_")
					  
# do IIS
print('The model is infeasible; computing IIS')
removed = []					  
					  
					  

m.update
m.optimize()
status = m.status
if status == GRB.Status.UNBOUNDED:
    print('The model cannot be solved because it is unbounded')
    exit(0)
if status == GRB.Status.OPTIMAL:
    print('The optimal objective is %g' % m.objVal)
    exit(0)
if status != GRB.Status.INF_OR_UNBD and status != GRB.Status.INFEASIBLE:
    print('Optimization was stopped with status %d' % status)
    exit(0)

	
while True:

    m.computeIIS()
    print('\nThe following constraint cannot be satisfied:')
    for c in m.getConstrs():
        if c.IISConstr:
            print('%s' % c.constrName)
            # Remove a single constraint from the model
            removed.append(str(c.constrName))
            m.remove(c)
            break
    print('')

m.optimize()
status = m.status
if status == GRB.Status.UNBOUNDED:
    print('The model cannot be solved because it is unbounded')
    exit(0)
if status == GRB.Status.OPTIMAL:
    exit(0)
if status != GRB.Status.INF_OR_UNBD and status != GRB.Status.INFEASIBLE:
    print('Optimization was stopped with status %d' % status)
    exit(0)
	
print('\nThe following constraints were removed to get a feasible LP:')
print(removed)
