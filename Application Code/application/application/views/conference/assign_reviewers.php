<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
<div class="row" style="margin-bottom:5px;">
		<div class="col-md-push-1 col-md-10" style="padding-left:30px;">
			<h3 >Assign Documents</h3>
			<h4><b>Conference:</b> Computers Today | <b>Creator:</b> Jane Decosta</h4>
			<hr>
		</div>
<div class="col-md-push-1 col-md-10">
	<form action="" method="POST">
				<div class="col-md-12">
						<?php
							for($i=0;$i<5;$i++):
						?>
						<div class="row">
							
							<div class="form-group col-md-6">
								<label class="control-label">Select Reviewers</label>
								<select name="reviewers['<?php echo $i; ?>']" id="reviewers"  class="form-control" data-rel="chosen" required="required">
										<option value="Jeo Fair">Jeo Fair</option>
										<option value="Tim Crew">Tim Crew</option>
										<option value="Ana Pot">Ana Pot</option>
										<option value="Amalia Penn">Amalia Penn</option>
								</select>
							</div>
							
							<div class="form-group col-md-6">
								<label class="control-label">Select Documents</label>
								<select name="documents['<?php echo $i; ?>']" id="documents"  class="form-control" data-rel="chosen" required="required">
										<option value="Cloud">Paper On Cloud</option>
										<option value="Meth">Paper On Methmetic</option>
										<option value="CS">Paper On Computer Science</option>
										<option value="CN">Paper On Computer Networks</option>
								</select>
							</div>
							
							
						</div>
						<?php
						endfor;
						?>
						
						
						<div class="row">
							<div class="col-md-push-2 col-md-2">
							</div>
							<div class="col-md-push-2 col-md-5">
							<?php echo anchor("conference/","Finish Setup <i class=\"glyphicon glyphicon-chevron-right glyphicon-white\"></i>", array('class' => "btn btn-success",'style'=>"margin-top:15px"))?>
							</div>
							<div class="col-md-push-2 col-md-4">
							</div>
						</div>
				</div>
			
			
	
		
	</form>
<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>
</div>
</div>