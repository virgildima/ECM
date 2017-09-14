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
class User extends CI_Model {

	//User Id
	protected $id;

	//User username
	protected $username;

	//User email address
	protected $email;

	//User enabled
	protected $enabled;

	//User Last Login Time
	protected $last_login;

	//User ROLES
	protected $roles;

	//User Actual Name
	protected $real_name;


	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getUserName() {
		return $this->username;
	}
	public function setUserName($username) {
		$this->username = $username;
		return $this;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}
	public function getEnabled() {
		return $this->enabled;
	}
	public function setEnabled($enabled) {
		$this->enabled = $enabled;
		return $this;
	}
	public function getLastLogin() {
		return $this->last_login;
	}
	public function setLastLogin(DateTime $last_login = null) {
		if($last_login != null) {
			$this->last_login = $last_login;
		}
		return $this;
	}
	public function getRoles() {
		return $this->roles;
	}
	public function setRoles(array $roles) {
		$this->roles = $roles;
		return $this;
	}
	public function getRealName() {
		return $this->real_name;
	}
	public function setRealName($real_name) {
		$this->real_name = $real_name;
		return $this;
	}

	/*
	 * Login User to the system
	 *  @param string $username
	 *  @param string $password
	 *
	 */
	public function login($username, $password) {

		$this->db->where('username', $username, true);
		$this->db->where('password', MD5($password), true);
		$query = $this->db->get('user',1);

		if ($query->num_rows () == 1) {

			$result = $query->first_row('array');
			$this->setId($result['id']);
			$this->setEnabled($result['enabled']);
			$this->setEmail($result['email']);
			$this->setLastLogin($result['last_login']);
			$this->setRealName($result['real_name']);
			$roles = array(); 
			if(empty($result['roles'])) {
				$roles[] = "ROLE_USER";
			}
			else {
				$roles = unserialize($result['roles']);
			}
			$this->setRoles($roles);
			$this->setUsername($result['username']);
			return $this;
		} else {
			return NULL;
		}
	}

	public function changePassword($password) {

		//Prepare Updates Columns
		$data = array(
			'password' => MD5($password),
		);

		$this->db->trans_start();
		$this->db->where ( 'id', $this->id );
		$this->db->update ( 'user' , $data);
		$this->db->trans_complete();


		return $this->db->trans_status();
	}

	/**
	 * Takes Form inputs and crates user in database along with User Object
	 * @param array $data
	 * @return boolean
	 */
	public function crateUser($data) {

		$this->db->trans_start ();

		$db_data = array (
				'username' => $data['Username'],
				'email' => $data ['Email' ],
				'enabled' => true,
				'password' => MD5($data['Password' ]),
				'roles' => serialize (array("ROLE_USER")), //DEFAULT_ROLE
				'real_name' => $data['Name'],
		);

		$this->db->insert ( 'user', $db_data ); // inserting data in the table

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
?>