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
<table class="table table-striped">
	<tr>
		<th width="25" class="text-center">ID</th>
		<th >Name</th>
		<th >Email</th>
		<th width="300">Last Login</th>
		<th width="55" class="text-center">#</th>
	</tr>
	<?php foreach($users as $position=>$user) :?>
	<tr>
		<th><?php echo ($this->input->get('page') * $this->pagination->per_page) + $position+1; ?></th>
		<th><?php echo $user->real_name ?></th>
		<th><?php echo $user->email ?></th>
		<th><?php if($user->last_login != null ) : echo $user->last_login; else : echo "Never"; endif;?></th>
		<th><?php echo anchor("/user/edit/" . $user->id , "Edit" , array( 'class' => "btn btn-default btn-sm") ); ?></th>
	</tr>
	<?php endforeach; ?>
</table>
<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>