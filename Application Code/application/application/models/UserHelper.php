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


class UserHelper extends CI_Model {

	//User Object
	private $user;


	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
		return $this;
	}

	/**
	 * Fetches Users from DB
	 *
	 * @param integer $page Page Number
	 * @param integer $limit No of Users to display
	 * @return array of User Objects
	 */
	public function getAll($page,$limit) {
		if($page < 0) { $page =0; }
		$query =$this->db->get('user',$limit,$page*$limit);

		if($query->num_rows() > 0) {
			return $query->result('object');
		}
		return array();
	}

	/**
	 * Fetches Users from DB
	 *
	 * @param integer $page Page Number
	 * @param integer $limit No of Users to display
	 * @return array of User Objects
	 */
	public function getUserObject($id) {
		if($id < 0 ) {
			return NULL;
		}

		$this->db->where('id',$id);
		$query = $this->db->get('user',1);

		if($query->num_rows() == 1) {
			$user = $query->first_row('user');
			$roles =unserialize($user->getRoles());
			$user->setRoles($roles);
			return $user;
		}

		return NULL;
	}

	/**
	 * Fetches Users Count from DB for pagination
	 *
	 * @return int Count of User Objects
	 */
	public function getCount() {

		$count =$this->db->count_all('user');

		if($count > 0) {
			return $count;
		}
		return 0;
	}

	/**
	 * Takes Form inputs and updates user in database along with User Object
	 * @param array $data
	 * @param User $user
	 * @return boolean
	 */
	public function editUser($data,User $user) {

		$roles = [];
		$enabled = $user->getEnabled();
		if (is_cli ()) {
			$roles = $data['roles'];
		} else {
			if (null !== $this->input->post ( 'chair' ) && ! in_array ( 'ROLE_CHAIR', $roles )) {
				$roles [] = "ROLE_CHAIR";
			}
			if (null !== $this->input->post ( 'author' ) && ! in_array ( 'ROLE_AUTHOR', $roles )) {
				$roles [] = "ROLE_AUTHOR";
			}
			if (null !== $this->input->post ( 'admin' ) && ! in_array ( 'ROLE_ADMIN', $roles )) {
				$roles [] = "ROLE_ADMIN";
			}
			if (null !== $this->input->post ( 'reviewer' ) && ! in_array ( 'ROLE_REVIEWER', $roles )) {
				$roles [] = "ROLE_REVIEWER";
			}
			if (null !== $this->input->post ( 'set_enabled' ) && ! in_array ( 'ROLE_ADMIN', $roles )) {
				$enabled = true;
			}
		}

		$this->db->trans_start ();

		$db_data = array (
				'email' => isset($data ['email' ])?$data ['email' ]:$user->getEmail(),
				'enabled' => $enabled,
				'roles' => serialize ($roles), //DEFAULT_ROLE
				'real_name' =>isset($data ['name' ])?$data ['name' ]:$user->getRealName(),
		);

		$this->db->update( 'user', $db_data, array('id' => $user->getId() ) ); // inserting data in the table

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