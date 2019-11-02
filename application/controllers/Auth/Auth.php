<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public $data	=	[];

	public $csrf	=	[];

	public function __construct()
	{
		parent::__construct();

		$this->csrf	=	array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
	}

	public function signin()
	{
		$this->_redirect();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p><i class="ion-alert-circled"></i> ', '</p>');

		if ($this->form_validation->run('signin') == FALSE)
		{

			$this->data['title']	=	'Signin Page!';
			$this->data['csrf']		=	$this->csrf;
			$this->data['message']	=	(validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->load->view('auth/signin', $this->data);
			$this->load->view('inc/footer');
		}
		else
		{
			$remember	=	(bool)$this->security->xss_clean($this->security->xss_clean($this->input->post('remember')));

			if ($this->ion_auth->login($this->security->xss_clean($this->input->post('identity')), $this->security->xss_clean($this->input->post('password')), $remember)) {

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');

			} else {

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('signin', 'refresh');

			}
			
		}

	}

	public function signup()
	{
		$this->_redirect();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p><i class="ion-alert-circled"></i> ', '</p>');

		if ($this->form_validation->run('signup') == FALSE)
		{
			$this->data['title']	=	'Signup Page!';
			$this->data['csrf']		=	$this->csrf;
			$this->data['message']	=	$this->session->flashdata('message');

			$this->load->view('auth/signup', $this->data);
			$this->load->view('inc/footer');
		}
		else
		{
			$username	=	$this->security->xss_clean($this->input->post('email'));
			$password	=	$this->security->xss_clean($this->input->post('password'));
			$email	=	$this->security->xss_clean($this->input->post('email'));
			$additional_data = array(
				'first_name'	=>	$this->security->xss_clean($this->input->post('first-name')),
				'last_name'	=>	$this->security->xss_clean($this->input->post('last-name')),
				'gender'	=>	$this->security->xss_clean($this->input->post('gender')),
				'dob'	=>	strtotime($this->security->xss_clean($this->input->post('email'))),
			);


			$user_created	=	$this->ion_auth->register($username, $password, $email, $additional_data);


			if ($user_created) {
				$this->data['title']	=	'Check Your Email. For varifacation code';

				$this->load->view('auth/messages/check_email', $this->data);
				$this->load->view('inc/footer');
			}	else {
				$this->data['title']	=	'Wait for account acctivation.';

				$this->load->view('auth/messages/wait', $this->data);
				$this->load->view('inc/footer');
			}
		}
	}

	public function varify($id = NULL, $code = NULL)
	{
		$activation	=	FALSE;

		if ($id == NULL) {
			show_404();
		}

		if ($code !== NULL)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{

			$this->load->model('Users_updated', 'updated');

			$this->updated->create_default($id);
			
			$this->data['title']	=	'Account Acctivation Succesfull!';

			$this->load->view('auth/messages/activation_success');
			$this->load->view('inc/footer');
		}
		else
		{
			$this->data['title']	=	'Account Acctivation Failed!';

			$this->load->view('auth/messages/activation_failed');
			$this->load->view('inc/footer');
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('signin', 'refresh');
	}

	public function recover()
	{

		$this->_redirect();
		
		$this->data['title']	=	'Recover Password.';

		$this->load->view('auth/recover', $this->data);
		$this->load->view('inc/footer');
	}

	private function _redirect()
	{
		if ($this->ion_auth->logged_in()) {
			redirect('/', 'refresh');
		}

	}
}
