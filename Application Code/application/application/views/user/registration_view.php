<div class="register form">
	<div>ECM Registration form</div>
	<br>
<?php

$attributes = array (
		'class' => '',
		'id' => ''
);
echo form_open ( '/register', $attributes );
?>
<div class="form-group">
		<label for="Name">Name <span class="required">*</span></label>
        <?php echo form_error('Name'); ?>
		<input id="Email" type="text" name="Name" maxlength="55"
			value="<?php echo set_value('Name'); ?>" class="form-control" />
</div>


<p>
		<label for="Email">Email <span class="required">*</span></label>
        <?php echo form_error('Email'); ?>
        <br />
		<input id="Email" type="text" name="Email" maxlength="32"
			value="<?php echo set_value('Email'); ?>" class="form-control" />
	</p>

<p>
		<label for="Username">Username <span class="required">*</span></label>
        <?php echo form_error('Username'); ?>
        <br />
		<input id="Username" type="text" name="Username" maxlength="32"
			value="<?php echo set_value('Username'); ?>" class="form-control" />
	</p>



	<p>
		<label for="Password">Password <span class="required">*</span></label>
        <?php echo form_error('Password'); ?>
        <br />
		<input id="Password" type="password" name="Password" maxlength="32"
			value="<?php echo set_value('Password'); ?>" class="form-control" />
	</p>

	<p>
		<label for="Passwordc">Confirm Password<span class="required">*</span></label>
        <?php echo form_error('Passwordc'); ?>
        <br />
		<input id="Passwordc" type="password" name="Passwordc" maxlength="32"
			value="<?php echo set_value('Passwordc'); ?>" class="form-control" />
	</p>

	<p>
        <?php echo form_submit( 'submit', 'Submit',array('class'=>'btn btn-default')); ?>
</p>

<?php echo form_close(); ?>

</div>