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
class LoginController extends CI_Controller
{
	function __construct() {
		parent::__construct ();

		$this->load->library('form_validation');
		$this->load->model('user');
		$this->load->helper ( array ('form') );
	}

	/**
	 * Login Page
	 */
	function index() {

		// check if user is already logged in
		if ($this->session->userdata ( 'logged_in' ))
			redirect ( "/home" );

		$data ['title'] = ucfirst ( "ECM Login" ); // Capitalize the first letter
		$this->load->helper ( array (
				'form'
		) );
		// Loading header
		$this->load->view ( 'includes/header', $data );
		// Loading Page
		$this->load->view ( 'user/form_login' );
		// Finishing up footer
		$this->load->view ( 'includes/footer' );
	}

	/**
	 * Login Check URI Endpoint
	 */
	function check()
	{
		//This method will have the credentials validation

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE)
		{

			//Field validation failed.  User redirected to login page
			$data['title'] = ucfirst("ECM Login"); // Capitalize the first letter

			//Loading header
			$this->load->view ( 'includes/header', $data );
			//Loading Page
			$this->load->view ( 'user/form_login' );
			//Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		else
		{
			//Validation Successfull Let's Login
			//Field validation succeeded.  Validate against database
			$username = $this->input->post('username');
			$password = $this->input->post('password');


			//query the database
			$result = $this->user->login($username, $password);

			if(isset($result))
			{
				log_message("debug", "Got User" );
				$sess_array = array();
				$sess_array = array(
					'user' => array(
							'name' => $result->getRealName(),
							'id' => $result->getId(),
							'email' => $result->getEmail(),
							'username' => $result->getUserName(),
							'roles' => $result->getRoles(),
					)
				);
				$this->session->set_userdata('logged_in', $sess_array);
				//Go to private area
				redirect('/home', 'refresh');
			}
			else
			{
				// Relog
				//Field validation failed.  User redirected to login page
				$data['title'] = ucfirst("ECM Login"); // Capitalize the first letter

				$data["error"]="Invalid username or password";

				//Loading header
				$this->load->view ( 'includes/header', $data );
				//Loading Page
				$this->load->view ( 'user/form_login' , $data );
				//Finishing up footer
				$this->load->view ( 'includes/footer' );
			}


		}

	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/home', 'refresh');
	}

	function register()
	{
		$this->form_validation->set_rules('Username', 'Username', 'required|trim|max_length[32]');
		$this->form_validation->set_rules('Name', 'Name', 'required|trim|max_length[55]');
		$this->form_validation->set_rules('Email', 'Email', 'required|trim|valid_email|max_length[32]');
		$this->form_validation->set_rules('Password', 'Password', 'required|trim|max_length[32]');
		$this->form_validation->set_rules('Passwordc', 'Confirm Password', 'required|trim|max_length[32]|matches[Password]');
		//$this->form_validation->set_rules('Admin', 'Admin', 'required|trim|max_length[1]');

		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');

		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$data['title'] = ucfirst("Registration"); // Capitalize the first letter
			//Loading header
			$this->load->view ( 'includes/header', $data );
			//Loading Page
			$this->load->view('user/registration_view');
			//Finishing up footer
			$this->load->view ( 'includes/footer' );
		}
		else // passed validation proceed to post success logic
		{
			// build array for the model
			$form_data = array(
					'Name' => $this->input->post('Name'),
					'Username' => $this->input->post('Username'),
					'Email' => $this->input->post('Email'),
					'Password' => $this->input->post('Password'),
					'Passwordc' => $this->input->post('Passwordc'),
			);

			// run insert model to write data to db

			if ($this->user->crateUser($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('register/success');
			}
			else
			{
				$data['title'] = ucfirst("Registration"); // Capitalize the first letter
				//Loading header
				$this->load->view ( 'includes/header', $data );
				//Loading Page
				$this->load->view('user/registration_view', $form_data);
				//Finishing up footer
				$this->load->view ( 'includes/footer' );
				//echo 'An error occurred saving your information. Please try again later';

			}
		}
	}

	function registerSuccess()
	{
		$data['title'] = ucfirst("Registration Successfull"); // Capitalize the first letter
		//Loading header
		$this->load->view ( 'includes/header', $data );
		//Loading Page
		$this->load->view('user/form_login');
		echo "<p align='center'> <font color=blue font face='arial' size='2pt'>Registration Successful, Please Login.</font> </p>";
		//Finishing up footer
		$this->load->view ( 'includes/footer' );
	}
}
?>