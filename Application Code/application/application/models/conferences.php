<?php
/*
 * This file is part of the App package developed by,
 *
 * (c) Virgil Dima
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );


class Conferences extends CI_Model {

	/**
	 * Fetches Conferences from DB
	 *
	 * @param integer $page Page Number
	 * @param integer $limit No of Conferences to display
	 * @return array of Conferences Objects
	 */
	public function getAll($page,$limit,$user) {
		if($page < 0) { $page =0; }
				
// 		if(!in_array('ROLE_ADMIN',$user['roles'])) {
// 			//user is not admin so fetch conferences with member id or chair id only
// 			//Extra Logic
// 		}
		
// 		if(!in_array('ROLE_CHAIR',$user['roles'])) {
// 			//user is not admin so fetch conferences with member id or chair id only
// 			$this->db->where('creator', $user['id']);			
// 		}
		$this->db->join('user', 'user.id = conferences.creator', 'left');
		//prepare all conferences
		$query =$this->db->get('conferences',$limit,$page*$limit);

		if($query->num_rows() > 0) {
			return $query->result('object');
		}
		return array();
	}

	/**
	 * Fetches Conferences from DB
	 *
	 * @param integer $page Page Number
	 * @param integer $limit No of Conferences to display
	 * @return array of Conference Objects
	 */
	public function getConferenceObject($id) {
		if($id < 0 ) {
			return NULL;
		}

		$this->db->where('id',$id);
		$query = $this->db->get('conferences',1);

		if($query->num_rows() == 1) {
			$conference = $query->first_row('object');
			return $conference;
		}
		return NULL;
	}

	/**
	 * Fetches Conferences Count from DB for pagination
	 *
	 * @return int Count of Conference Objects
	 */
	public function getCount() {

		$count =$this->db->count_all('conferences');

		if($count > 0) {
			return $count;
		}
		return 0;
	}

	/**
	 * Takes Form inputs and updates conference in database along with Conference Object
	 * @param array $data
	 * @param Conference $conference
	 * @return boolean
	 */
	public function editConference($data) {

		$roles = $conference->getRoles();
		$enabled = $conference->getEnabled();

		if(null !==$this->input->post('chair') && !in_array('ROLE_CHAIR', $roles)) {
			$roles[] = "ROLE_CHAIR";
		}
		if(null !== $this->input->post('author') && !in_array('ROLE_AUTHOR', $roles)) {
			$roles[] = "ROLE_AUTHOR";
		}
		if(null!==  $this->input->post('admin') && !in_array('ROLE_ADMIN', $roles)) {
			$roles[] = "ROLE_ADMIN";
		}
		if(null !== $this->input->post('set_enabled') && !in_array('ROLE_ADMIN', $roles)) {
			$enabled = true;
		}

		$this->db->trans_start ();

		$db_data = array (
				'email' => $data ['email' ],
				'enabled' => $enabled,
				'roles' => serialize ($roles), //DEFAULT_ROLE
				'real_name' => $data['name'],
		);

		$this->db->update( 'conferences', $db_data, array('id' => $conference->getId() ) ); // inserting data in the table

		$this->db->trans_complete ();

		if ($this->db->trans_status () === FALSE) {
			// Something went wrong.
			$this->db->trans_rollback ();
			return FALSE;
		} else {
			// Everything is Perfect.
			// Committing data to the database.
			$this->db->trans_commit ();
			return TRUE;
		}
	}

}