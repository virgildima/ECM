<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once("RoleController.php");

class HomeController extends RoleController {
 
 function __construct()
 {
   parent::__construct();
   $this->load->library('pagination');
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
   	
   	 //$this->output->enable_profiler(TRUE);
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['user'];
     
     $data['title'] = ucfirst("Electronic Conference Management"); // Capitalize the first letter
     //Loading header
     $this->load->view ( 'includes/header', $data );
     //Loading Page
     $this->load->view ( 'home_view', $data );
     //Finishing up footer
     $this->load->view ( 'includes/footer' );
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 
 function searchPage($search = '') {
 	$this->checkLogin();
 	//$this->output->enable_profiler(TRUE);
 	$session_data = $this->session->userdata ( 'logged_in' );
 	$data ['username'] = $session_data ['user'];
 	
 	$search = $this->input->get('s');
 	
 	$data ['searchkey'] = null;
 	if($search != '') {
 		$data ['searchkey'] = $search;
 	}
 
 	$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
 	// Loading header
 	$this->load->view ( 'includes/header', $data );
 	// Loading Page
 	$this->load->view ( 'search_view', $data );
 	// Finishing up footer
 	$this->load->view ( 'includes/footer' );
 }

 
}
 
?>