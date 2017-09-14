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
<?php echo anchor("/conference/create","Create Conference", array('class' => "btn btn-success"))?>&nbsp;&nbsp;&nbsp;
<?php echo anchor("/conference/conflicts/create","Resolve Conflict", array('class' => "btn btn-warning"))?>&nbsp;&nbsp;&nbsp;
<?php echo anchor("/conference/conflicts/","Show Conflicts", array('class' => "btn btn-info"))?><br/>
</div>
<br>
<table class="table table-striped">
	<tr>
		<th width="25" class="text-center">ID</th>
		<th >Topic</th>
		<th >Author</th>
		<th width="300">End Date</th>
		<th width="55" class="text-center">#</th>
	</tr>
	<?php foreach($conferences as $position=>$conference) :?>
	<tr>
		<th><?php echo ($this->input->get('page') * $this->pagination->per_page) + $position+1; ?></th>
		<th><?php echo $conference->Tag ?></th>
		<th><?php //var_dump($conference); 
echo $conference->real_name ?></th>
		<th><?php if($conference->end_date != null ) : echo $conference->end_date; else : echo "Never"; endif;?></th>
		<th><?php echo anchor("/conference/edit/" . $conference->id , "Edit" , array( 'class' => "btn btn-default btn-sm") ); ?></th>
	</tr>
	<?php endforeach; ?>
</table>
<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>