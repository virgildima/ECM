<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search_model extends CI_Model {

    public function get_results($search_term='default')
    {
    
        $this->db->select('*');
        $this->db->from('userlist');
        $this->db->like('username',$search_term);

        $query = $this->db->get('');

        return $query->result_array();
    }

}