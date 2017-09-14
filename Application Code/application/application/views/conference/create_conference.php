<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
	<div class="row" style="margin-bottom:30px;">
		<div class="col-md-push-1 col-md-10">
			<h3 style="margin-left: 15px">Create Conference</h3>
			<p class="text-center"><b><ul>
				<li>Submit conference name and deadline. </li>
				<li>Name should be relevant to papers.</li>
				</ul></b>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-push-1 col-md-10">
			<form action="" method="POST">
				<div class="box-content">
					<div class="form-group col-md-6">
						<label class="control-label" for="inputSuccess1">Conference Name</label>
						<input type="text" class="form-control" name="conference" id="" placeholder="Enter Conference Name">
					</div>
					<div class="form-group col-md-6">
						<label class="control-label" for="inputSuccess1">Conference Deadline</label>
						<input type="text" class="form-control" name="deadline" id="datepicker" placeholder="Enter Deadline">
						
					</div>
					
					<?php echo anchor("conference/members/add","Add Members <i class=\"glyphicon glyphicon-chevron-right glyphicon-white\"></i>", array('class' => "btn btn-success pull-right","style"=>"margin-right:15px;"))?>
				</div>
			</form>
		</div>
	</div>

<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>