<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );?>
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
<?php echo form_open('search_form/execute_search');?>

<?php echo form_input(array('name'=>'search_form'));?>

<?php echo form_submit('search_submit','Search');?>
</div>
</body>
</html>
