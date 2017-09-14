<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<div id="sidebar" class="col-md-2 no-padding">
	<div style="height: 5px; width: 100px;"></div>
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation"
			class="<?php if(current_url() == base_url("/home")) echo "active"; ?>">
			<?php echo anchor("/home","Home",['class' => 'btn btn-default', 'role'=>"button"]); ?>
		</li>
		<?php
		
if (isset ( $_SESSION ['logged_in'] )) :
			if (! empty ( $_SESSION ['logged_in'] ['user'] ['roles'] ) && in_array ( "ROLE_ADMIN", $_SESSION ['logged_in'] ['user'] ['roles'] )) :
				?>
		<li role="presentation"
			class="<?php if(strpos( current_url(), 'user' ) != false) echo "active"; ?>">
			<?php echo anchor("/user","User",['class' => 'btn btn-default', 'role'=>"button"]); ?>
		</li>
		
			<?php endif;
		
		endif;
		?>
		<li role="presentation"
			class="<?php if( strpos( current_url(), 'conference' ) != false ) echo "active"; ?>">
			<?php echo anchor("/conference","Conferences",['class' => 'btn btn-default', 'role'=>"button"]); ?>
		</li>
		<li role="presentation"
			class="<?php if(current_url() == base_url("/search")) echo "active"; ?>">
			<?php echo anchor("/search","Search",['class' => 'btn btn-default', 'role'=>"button"]); ?>
		</li>
	</ul>


</div>
