<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
<div class="row" style="margin-bottom:5px;">
		<div class="col-md-push-1 col-md-10" style="padding-left:30px;">
			<h3 >Add Members</h3>
			<h4><b>Conference:</b> Computers Today | <b>Creator:</b> Jane Decosta</h4>
			<hr>
		</div>
			<div class="col-md-push-1 col-md-10">
	<form action="" method="POST">
			<div class="row">
				<div class="col-md-12">
					
						<div class="box-content">
							<div class="form-group col-md-6">
								<label class="control-label" for="inputSuccess1">Topic Name</label>
								<input type="text" class="form-control" name="topic" id="" placeholder="Enter Topic Name">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="inputSuccess1">Submission Deadline</label>
								<input type="text" class="form-control" name="deadline" id="datepicker" placeholder="Enter Deadline">
							</div>
							
							<div class="form-group col-md-6">
								<label class="control-label">Select Authors</label>
								<select name="authors" id="authors" multiple class="form-control" data-rel="chosen" required="required">
										<option value="Jeo Faiv">Jeo Faiv</option>
										<option value="Dio Crew">Dio Crew</option>
										<option value="Anrik Pot">Anrik Pot</option>
										<option value="Amali Pennal">Amali Pennal</option>
								</select>
							</div>
							
							<div class="form-group col-md-6">
								<label class="control-label">Select Reviewers</label>
								<select name="authors" id="authors" multiple class="form-control" data-rel="chosen" required="required">
										<option value="Jeo Faiv">Jeo Faiv</option>
										<option value="Dio Crew">Dio Crew</option>
										<option value="Anrik Pot">Anrik Pot</option>
										<option value="Amali Pennal">Amali Pennal</option>
								</select>
							</div>
							
							<div class="form-group col-md-6">
								<label class="control-label">Select Chair Committee Members</label>
								<select name="authors" id="authors" multiple class="form-control" data-rel="chosen" required="required">
										<option value="Jeo Faiv">Jeo Faiv</option>
										<option value="Dio Crew">Dio Crew</option>
										<option value="Anrik Pot">Anrik Pot</option>
										<option value="Amali Pennal">Amali Pennal</option>
								</select>
							</div>
							
							
						</div>
						<div class="clearfix"></div>
					<?php echo anchor("conference/reviewers","Assign Reviewer <i class=\"glyphicon glyphicon-chevron-right glyphicon-white\"></i>", array('class' => "btn btn-success pull-right","style"=>"margin-right:15px;"))?>
				</div>
				
			</div>
	
		
	</form>
	<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
	</div>

</div>