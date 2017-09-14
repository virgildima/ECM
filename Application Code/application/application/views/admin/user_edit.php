<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/..') . '/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/..') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
<?php if($this->session->has_userdata('edit_status')):?>
	<div class="alert alert-<?php echo $this->session->flashdata('edit_status_code'); ?> text-center" role="alert">
  		<?php echo $this->session->flashdata('edit_status'); ?>
	</div>
<?php endif;?>

<?php
echo form_open('user/edit/'.$user->getId());?>
 <div class="form-group">
        <label for="name">Username</label>
        <br /><input id="name" type="text" class="form-control diabled" disabled name="name" maxlength="55" value="<?php echo $user->getUsername(); ?>"  />
  </div>

 <div class="form-group">
        <label for="name">Name <span class="required">*</span></label>
        <?php echo form_error('name'); ?>
        <br /><input id="name" type="text" class="form-control" name="name" maxlength="55" value="<?php echo $form['name']; ?>"  />
  </div>

 <div class="form-group">
        <label for="email">Email <span class="required">*</span></label>
        <?php echo form_error('email'); ?>
        <br /><input id="email" type="text" class="form-control" name="email" maxlength="55" value="<?php echo $form['email']; ?>"  />
  </div>
  <?php echo form_error('user_status'); ?>
   <div class="form-group">
    <span class="button-checkbox">

        <button type="button" class="btn" data-color="primary">Accuont Status [Locked/Unlocked]*</button>
        <input type="checkbox" id="user_status" class="hidden" name="user_status" value="1" class="" <?php if($form['user_status']) echo "checked"; ?>>
    </span>
</div>
<?php echo form_error('admin'); ?>
<?php echo form_error('chair'); ?>
<?php echo form_error('author'); ?>
<?php echo form_error('reviewer'); ?>
<div class="form-group">

    <span class="button-checkbox">
        <button type="button" class="btn" data-color="primary">Admin</button>
   		<input type="checkbox" id="admin" class="hidden" name="admin" value="1"   <?php if($form['admin']) echo "checked"; ?>>
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn" data-color="primary">Chair</button>
        <input type="checkbox" id="chair"  class="hidden" name="chair" value="1" <?php if($form['chair']) echo "checked"; ?>>
 	</span>
    <span class="button-checkbox">
        <button type="button" class="btn" data-color="primary">Author</button>
        <input type="checkbox"  class="hidden" id="author" name="author" value="1" <?php if($form['author']) echo "checked"; ?>>
    </span>
    <span class="button-checkbox">
        <button type="button" class="btn" data-color="primary">Reviewer</button>
        <input type="checkbox"  class="hidden" id="reviewer" name="reviewer" value="1" <?php if($form['reviewer']) echo "checked"; ?>>
    </span>
    </div>
<p><br>
        <?php echo form_submit( 'submit', 'Submit',array('class'=> "btn btn-default")); ?>
</p>
<?php echo form_close(); ?>
</div>