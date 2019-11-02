<?php
/**
 * Updated Model
 */
class Users_updated extends CI_Model
{

	public function create_default($id)
	{

		$this->config->load('ion_auth', TRUE);

		$data = array(
    		'user_id' => $id,
	        'dob' => time(),
	        'name' => time()
		);

		$tables	=	$this->config->item('tables', 'ion_auth');

		return $this->db->insert($tables['users_updated'], $data);
	}
}