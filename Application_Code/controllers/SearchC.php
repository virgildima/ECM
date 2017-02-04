<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class SearchC extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'search_model' );
	}
	public function index() {
		$this->load->view ( 'header' );
		$this->load->view ( 'sidebar' );
		$this->load->view ( 'search_form' );
		
	}
	public function search_keyword() {
		$this->load->view ( 'header' );
		$this->load->view ( 'sidebar' );
		$this->load->view ( 'search_form' );
		$keyword = $this->input->post ( 'keyword' );
		$data ['results'] = $this->search_model->searchC ( $keyword );
		$this->load->view ( 'search_results', $data );
	}
}
