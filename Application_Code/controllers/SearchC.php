<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchC extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('search_form');
	
	}
	public function execute_search()
	{
	    $this->load->model('search_model');
		$search_term = $this->input->post('search');		
		$data['results'] = $this->search_model->get_results($search_term);				
		$this->load->view('search_results',$data);
	}
}
