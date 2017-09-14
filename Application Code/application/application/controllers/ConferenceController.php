<?php
/*
 * This file is part of the App package developed by,
*
* (c) Virgil Dima
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

require_once 'RoleController.php';

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	class ConferenceController extends RoleController
	{
		function __construct() {
			parent::__construct ();
			

			$this->load->library('form_validation');
			$this->load->model('user');
			$this->load->model('conferences');
			$this->load->library('pagination');
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->helper('security');

		}

		/**
		 * User Dashboard Page
		 */
		function index() {

			//$this->output->enable_profiler(TRUE);
			
// 				//check login && roles
// 				$this->checkLogin();
// 				if(!($this->checkRole("ROLE_ADMIN") || $this->checkRole("ROLE_CHAIR"))) {
// 						//only editor area
// 						redirect("/home");
// 				}
				
				$user = $this->session->userdata ( 'logged_in' )['user'];
					
				$data ['title'] = ucfirst ( "ECM Conferences" ); // Capitalize the first letter


				$config['base_url'] = base_url() . 'conference/';
				$config['total_rows'] = $this->conferences->getCount();
				$config['per_page'] = 1;
				$this->pagination->initialize($config);

				$conferences = $this->conferences->getAll( $this->input->get('page') ,$this->pagination->per_page,$user);

				$data['conferences'] = $conferences;

				// Loading header
				$this->load->view ( 'includes/header', $data );
				// Loading Page
				$this->load->view ( 'conference/conference_view', $data );
				// Finishing up footer
				$this->load->view ( 'includes/footer' );
		}

		/**
		 * User Edit Page
		 */
		function edit($id = null) {

			// check if user is already logged in && is ADMIN
			//$this->output->enable_profiler(TRUE);

			$data ['title'] = ucfirst ( "Edit User" ); // Capitalize the first letter
			$usr = $this->userhelper->getUserObject($id);
			if($usr == null) {
				//no User found
				$this->session->set_userdata('edit_status', 'No User Found');
				$this->session->mark_as_flash('edit_status');
				$this->session->set_userdata('edit_status_code', 'warning');
				$this->session->mark_as_flash('edit_status_code');
				redirect("/user");
			}
			$data['user'] = $usr;


			$this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean|max_length[55]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|max_length[55]');
			$this->form_validation->set_rules('user_status', 'User Status', 'required|xss_clean|max_length[1]');
			$this->form_validation->set_rules('admin', 'Admin', 'xss_clean|max_length[1]');
			$this->form_validation->set_rules('chair', 'Chair', 'xss_clean');
			$this->form_validation->set_rules('author', 'Author', 'xss_clean');

			$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

			if ($this->form_validation->run() == FALSE) // validation hasn't been passed
			{
				$form_data = array(
						'name' => $usr->getRealName(),
						'email' =>$usr->getEmail(),
						'user_status' => $usr->getEnabled(),
						'admin' => in_array('ROLE_ADMIN', $usr->getRoles()),
						'chair' => in_array('ROLE_CHAIR', $usr->getRoles()),
						'author' => in_array('ROLE_AUTHOR', $usr->getRoles())
				);

				$data['form'] = $form_data;

				// Loading header
				$this->load->view ( 'includes/header', $data );
				// Loading Page
				$this->load->view ( 'admin/user_edit', $data );
				// Finishing up footer
				$this->load->view ( 'includes/footer' );
			}
			else // passed validation proceed to post success logic
			{
				// build array for the model

				$form_data = array(
						'name' => set_value('name'),
						'email' => set_value('email'),
						'user_status' => set_value('user_status'),
						'admin' => set_value('admin'),
						'chair' => set_value('chair'),
						'author' => set_value('author'),
				);

				// run insert model to write data to db

				if ($this->userhelper->editUser($form_data,$usr) == TRUE) // the information has therefore been successfully saved in the db
				{
					$this->session->set_userdata('edit_status', 'User Edited Succesfully');
					$this->session->mark_as_flash('edit_status');
					$this->session->set_userdata('edit_status_code', 'success');
					$this->session->mark_as_flash('edit_status_code');
					redirect('/user');

				}
				else
				{
					//DB Error
					$this->session->set_userdata('edit_status', 'Somthiung went Wrong, Try again');
					$this->session->mark_as_flash('edit_status');
					$this->session->set_userdata('edit_status_code', 'danger');
					$this->session->mark_as_flash('edit_status_code');
					// Loading header
					$this->load->view ( 'includes/header', $data );
					// Loading Page
					$this->load->view ( 'admin/user_edit', $data );
					// Finishing up footer
					$this->load->view ( 'includes/footer' );
				}
			}
		}
		
		function addConference() {
			$this->checkLogin();
			// $this->output->enable_profiler(TRUE);
			$session_data = $this->session->userdata ( 'logged_in' );
			$data ['username'] = $session_data ['user'];
		
			$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'conference/create_conference', $data );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		function addMembers()
		{
			
				// Loading header
				$this->load->view ( 'includes/header');
				// Loading Page
				$this->load->view ( 'conference/add_members');
				// Finishing up footer
				$this->load->view ( 'includes/footer' );
		}
		
		function assignReviewers() {
			$this->checkLogin();
			// $this->output->enable_profiler(TRUE);
			$session_data = $this->session->userdata ( 'logged_in' );
			$data ['username'] = $session_data ['user'];
		
			$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'conference/assign_reviewers', $data );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		function showConflicts() {
			$this->checkLogin();
			// $this->output->enable_profiler(TRUE);
			$session_data = $this->session->userdata ( 'logged_in' );
			$data ['username'] = $session_data ['user'];
		
			$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'conference/show_conflicts', $data );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		function showConflict($conflictId) {
			$this->checkLogin();
			// $this->output->enable_profiler(TRUE);
			$session_data = $this->session->userdata ( 'logged_in' );
			$data ['username'] = $session_data ['user'];
		
			$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'conference/show_conflict_detail', $data );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		function createConflict() {
			$this->checkLogin();
			// $this->output->enable_profiler(TRUE);
			$session_data = $this->session->userdata ( 'logged_in' );
			$data ['username'] = $session_data ['user'];
		
			$data ['title'] = ucfirst ( "Electronic Conference Management" ); // Capitalize the first letter
			// Loading header
			$this->load->view ( 'includes/header', $data );
			// Loading Page
			$this->load->view ( 'conference/create_conflicts', $data );
			// Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		
		
}
	?>