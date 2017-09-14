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
	class RoleController extends CI_Controller
	{
		function __construct() {
			parent::__construct ();
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
		
		protected function checkRole($role) {
			$login = $this->session->userdata ( 'logged_in' );
			if (isset($login) && in_array($role, $login['user']['roles']))
				return TRUE;
			return FALSE;
		}
		
		protected function checkLogin() {
			$login = $this->session->userdata ( 'logged_in' );
			if (!isset($login))
				redirect("/login");
			return TRUE;
		}
	}
	?>