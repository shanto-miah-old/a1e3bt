<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Home Controller
 */
class Home extends CI_Controller
{
	public $data = [];
	
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->ion_auth->logged_in()) {
			redirect('signin', 'refresh');
		}
	}

	public function index()
	{
		$this->data = array(
			'title'	=>	'Welcome',
			'user'	=> $this->ion_auth->user()->row()
		);
		$this->load->view('index', $this->data);
	}
}