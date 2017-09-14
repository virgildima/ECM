<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
<?php if($this->session->has_userdata('edit_status')):?>
	<div class="alert alert-<?php echo $this->session->flashdata('edit_status_code'); ?> text-center" role="alert">
  		<?php echo $this->session->flashdata('edit_status'); ?>
	</div>
<?php endif;?>
<div class="text-center">
<?php echo anchor("/conference/conflicts/create","Resolve Conflict", array('class' => "btn btn-warning"))?>&nbsp;&nbsp;&nbsp;
<?php echo anchor("/conference/conflicts/","Show Conflicts", array('class' => "btn btn-info"))?><br/>
</div>
<br>
<?php 
	$conflicts = array(
			array('1','Fluid Dynamics','Jon Doe'),
			array('2','Solid Dynamics','Harvy Spector'),
			array('3','Networking','Ralph Ross'),
			array('4','Cloud Computing','Jane Doe'),
			array('5','Mathematics','Rachel Zane'),
	);
?>
<table class="table table-striped">
	<tr>
		<th width="45" align="center">ID</th>
		<th>Conference</th>
		<th>Declared By</th>
		<th width="55" class="text-center">#</th>
	</tr>
	<?php foreach($conflicts as $position=>$conflict) :?>
	<tr>
		<th><?php echo $conflict[0];//echo ($this->input->get('page') * $this->pagination->per_page) + $position+1; ?></th>
		<th><?php echo $conflict[1]; ?></th>
		<th><?php echo $conflict[2]; ?></th>
		<th><?php echo anchor("/conference/conflicts/show/" . $conflict[0] , "Show" , array( 'class' => "btn btn-default btn-sm") ); ?></th>
	</tr>
	<?php endforeach; ?>
</table>
<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>