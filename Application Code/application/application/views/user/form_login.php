<div id="formL">
	<?php echo validation_errors(); ?>
   	<?php if(isset($error)) { echo $error; } ?>
	<h2>Electronic Conference Management - Login</h2>
	<br>
	<?php echo form_open('/login/check', array('class'=>"form-horizontal"))?>
  <div class="form-group clearfix">
    <label for="inputUsername" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username">
    </div>
  </div>
  <div class="form-group clearfix">
    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
    </div>
  </div>
  <div class="form-group clearfix">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Login</button>
      <div style='float: center;'>
      	<br>
		<a href="<?php echo base_url("/register"); ?>">Register new account</a>
	</div>
    </div>
  </div>
</div>
