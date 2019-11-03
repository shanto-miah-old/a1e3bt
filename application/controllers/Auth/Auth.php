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

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p><i class="ion-alert-circled"></i> ', '</p>');

		if ($this->config->item('identity', 'ion_auth') != 'email')
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}

		if ($this->form_validation->run() === FALSE)
		{
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
			];

			if ($this->config->item('identity', 'ion_auth') != 'email')
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['title']	=	'Recover Password.';
			$this->data['csrf']	=	$this->csrf;

			$this->load->view('auth/recover', $this->data);
			$this->load->view('inc/footer');
		}
		else
		{
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity))
			{

				if ($this->config->item('identity', 'ion_auth') != 'email')
				{
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				}
				else
				{
					$this->ion_auth->set_error('Account not found!');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("recover", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("recover", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("recover", 'refresh');
			}
		}
		
		
	}

	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p><i class="ion-alert-circled"></i> ', '</p>');

		$this->data['title'] = $this->lang->line('reset_password_heading');
		
		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');
			$this->form_validation->set_rules('user_id', 'user_id', 'required|integer');

			if ($this->form_validation->run() === FALSE)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['user_id']	=	$user->id;
				$this->data['csrf'] = $this->csrf;
				$this->data['code'] = $code;

				// render
				$this->load->view('auth/reset_password', $this->data);
			}
			else
			{
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				// do we have a valid request?
				if ($user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($identity);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			// $this->session->set_flashdata('message', $this->ion_auth->errors());
			// redirect("auth/forgot_password", 'refresh');

			show_error($this->ion_auth->errors());
		}
	}

	private function _redirect()
	{
		if ($this->ion_auth->logged_in()) {
			redirect('/', 'refresh');
		}

	}
}
