<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );?>
<?php include_once ('header.php'); ?>
<?php include_once ('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>

#container2 {
	position: fixed;
	top: 120px;
	left: 300px;
	width: 220px;
	height: 40px;
	background-color: white;
}
</style>
</head>
<body>
	<div id="container2">
	
		<?php echo form_open_multipart('uploadFileC/upload2');?>	
		<b><h3>Upload Paper</h3></b><br>
		<?php echo form_label('Paper Title :'); ?>
		<?php echo form_input(array('id' => 'dtitle', 'title' => 'dtitle')); ?><br>
		<?php echo form_label('Paper Tag 1 :'); ?>
		<?php echo form_input(array('id' => 'dtag1', 'tag1' => 'dtag1')); ?><br>
		<?php echo form_label('Paper Tag 2 :'); ?>
		<?php echo form_input(array('id' => 'dtag2', 'tag2' => 'dtag2')); ?><br>
		<?php echo form_label('Paper Tag 3 :'); ?>
		<?php echo form_input(array('id' => 'dtag3', 'tag3' => 'dtag3')); ?><br>
		<?php echo form_label('Paper abstract :'); ?>
		<textarea  name="paper_abstract" rows="5" cols="40"> 
      	<?php echo set_value('paper_abstract'); ?> 
		</textarea><br>	
		<?php echo "<input type='file' name='userfile' size='20' />"; ?>
		<?php echo "<input type='submit' name='submit' value='upload' /> ";?>	
		<?php echo form_close(); ?>
	</div>
</body>
</html>
