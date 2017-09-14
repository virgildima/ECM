<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

require_once("RoleController.php");

class AuthorController extends RoleController {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		//check login
		$this->checkLogin();
		// $this->output->enable_profiler(TRUE);
		$session_data = $this->session->userdata ( 'logged_in' );
		$data ['username'] = $session_data ['user'];
		
		$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
		                                                              // Loading header
		$this->load->view ( 'includes/header', $data );
		// Loading Page
		$this->load->view ( 'author/docuemnts', $data );
		// Finishing up footer
		$this->load->view ( 'includes/footer' );
	}
	function addDocuemnt() {
		$this->checkLogin();
		// $this->output->enable_profiler(TRUE);
		$session_data = $this->session->userdata ( 'logged_in' );
		$data ['username'] = $session_data ['user'];
		
		$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
		                                                              // Loading header
		$this->load->view ( 'includes/header', $data );
		// Loading Page
		$this->load->view ( 'author/add_doc', $data );
		// Finishing up footer
		$this->load->view ( 'includes/footer' );
	}
 
}
 
?>