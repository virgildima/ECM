<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
?>
<?php include_once (realpath(dirname(__FILE__) . '/') .'/includes/page_header.php'); ?>
<?php include_once (realpath(dirname(__FILE__) . '/') .'/includes/sidebar.php'); ?>
<div class="container-fluid col-md-10">
<?php //form_open('/search'); ?>
	<form action="<?php echo base_url("/search/"); ?>" method="GET">
				<div class="col-md-push-2 col-md-8">
						
						<div class="row">
							
							<div class="col-lg-12">
								<div class="input-group">
								<form action="" method="GET">
								  <input type="text" class="form-control" <?php if(!empty($searchkey)) echo "value=\"".$searchkey."\""?>placeholder="Search for..." name="s" />
								  <span class="input-group-btn">
									<button class="btn btn-secondary" type="submit" />Go!</button>
								  </span>
								 </form>
								</div>
							</div>
							
							
						</div>
						<br>
						<?php
						if(!empty($searchkey)) :
						?>
						<div class="row">
							<div class="col-lg-12">
								<div class="bs-example" data-example-id="striped-table">
									<table class="table table-striped table-bordered"> 
										<thead> 
											<tr> 
												<th>#</th>
												<th>First Name</th> 
												<th>Last Name</th> 
												<th>Username</th> 
											</tr> 
										</thead> 
										<tbody> 
											<tr> 
												<th scope="row">1</th> 
												<td>Mark</td> 
												<td>Otto</td> 
												<td>@mdo</td> 
											</tr> 
											<tr> 
												<th scope="row">2</th> 
												<td>Jacob</td> 
												<td>Thornton</td> 
												<td>@fat</td> 
												</tr> 
											<tr> 
												<th scope="row">3</th> 
												<td>Larry</td> 
												<td>the Bird</td> 
												<td>@twitter</td> 
											</tr> 
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<?php
						endif;
						?>
				</div>
			
			
	
		
	</form>
<div class="text-center">
<?php echo $this->pagination->create_links();  ?>
</div>
</div>