<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
	<div class="row" style="margin-bottom:30px;">
		<div class="col-md-push-1 col-md-10">
			<h3 style="margin-left: 15px">Create Conflict</h3>
			<p class="text-center"><b><ul>
				<li>If you have any conflict with any author's paper, please raise conflict here.</li>
				<li>Conflicts will be resolved by Chair committee.</li>
				<li>Committee will try to resolve conflicts and take arguments of both parties in account.</li>
				<li>Committee has full right to retain final vote on conflict resolution.</li>
				</ul>
			</b>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-push-1 col-md-10">
			<form action="" method="POST">
				<div class="box-content">
					<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label">Conference</label> <select
							name="accused" id="accused" class="form-control"
							data-rel="chosen" required="required">
							<option value="Jeo Fair">Mathematical Calculation for Fluid Dynamics</option>
							<option value="Tim Crew">Material Strength and Stress Testing</option>
							<option value="Anka Pot">Computational Dynamics</option>
							<option value="Amalia Penn">Load Blanacing in Cloud Computing</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label class="control-label">Accused Member</label> <select
							name="accused" id="accused" class="form-control"
							data-rel="chosen" required="required">
							<option value="Jeo Fair">Jeo Fair</option>
							<option value="Tim Crew">Tim Crew</option>
							<option value="Anka Pot">Anka Pot</option>
							<option value="Amalia Penn">Amalia Penn</option>
						</select>
					</div>
					</div>
					<div class="row">
					<div class="form-group col-md-12">
						<label class="control-label" for="inputSuccess1">Reason Subject</label>
						<textarea name="reason" id="reason"  class="form-control" placeholder="Enter Subject" rows="8"></textarea>
					</div>
					<div class="text-center">
					<?php echo anchor("conference/conflicts","<i class=\"glyphicon glyphicon-exclamation-sign glyphicon-white\"></i>&nbsp;Create Conflict", array('class' => "btn btn-warning"))?>
					</div>
					</div>
				</div>
			</form>
		</div>
	</div>

<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>