<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
	<div class="row" style="margin-bottom:5px;">
		<div class="col-md-push-1 col-md-10">
			<h3 >Conflict Resolution</h3>
			<h4><b>Conference:</b> Material Strength and Stress Testing</h4>
			<h4><b>Accusor:</b> Jane Decosta</h4>
			<hr>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-push-1 col-md-10">
			<h4>Reason:</h4>
			<p>We have worked together on papers before and it always ends in a conflict.</p>
					<div class="text-center"><br>
						<?php echo anchor("conference/conflicts/comment/1","Discuss & Resolve <i class=\"glyphicon glyphicon-chevron-right glyphicon-white\"></i>", array('class' => "btn btn-info"))?>
					</div>
		</div>
	</div>

<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>