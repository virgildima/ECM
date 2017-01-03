<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFileC extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('sidebar');		
		$this->load->view('upload_file');
	}
	public function upload2()
	{
		$config = array(
		'upload_path' => "../uploads/");
		$this->load->library('upload', $config);
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success',$data);
			
	}
}