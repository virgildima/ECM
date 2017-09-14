<?php
/*
 * This file is part of the App package developed by,
*
* (c) Virgil Dima
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class AdminController extends CI_Controller
	{
		function __construct() {
			parent::__construct ();
			$this->checkAdmin();
		}

		/**
		 * Index Default Page
		 */
		function index() {

			// check if user is already logged in && is ADMIN
				

			$data ['title'] = ucfirst ( "ECM Login" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'home_view' );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		private function checkAdmin() {
			$login = $this->session->userdata ( 'logged_in' );
			if (isset($login) && !in_array('ROLE_ADMIN', $login['user']['roles']))
				redirect ( "/home" );
		}
	}
	?>