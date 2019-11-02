<?php
$config	=	array(
	'signup'	=> array(
		array(
			'field'	=> 'first-name',
			'label'	=> 'First name',
			'rules'	=> 'required|alpha|trim|htmlspecialchars'
		),
		array(
			'field'	=> 'last-name',
			'label'	=> 'Last name',
			'rules'	=> 'required|alpha|max_length[12]'
		),
		array(
			'field'	=> 'email',
			'label'	=> 'Email address',
			'rules'	=> 'required|is_unique[users.email]',
			 'errors' => array(
                    'is_unique' => 'The %s alrady registard.',
            ),
		),
		array(
			'field'	=> 'password',
			'label'	=> 'Password',
			'rules'	=> 'required|min_length[8]|max_length[20]'
		),
		array(
			'field'	=> 'dob',
			'label'	=> 'Date of barth',
			'rules'	=> array(
				'required',
				array(
					'check_age',
					function($dob)
					{
						$age = floor((time() - strtotime($dob)) / 31556926);	/*31556926 secend == 1 year*/

						if ($age >= 18) {
							return TRUE;
						} else {
							return False;
						}
						
					}
				)
			),
			'errors' => array(
                    'check_age' => 'Your age must 18+.',
            ),
		),array(
			'field'	=> 'gender',
			'label'	=> 'Gender',
			'rules'	=> 'required'
		)
	),
	'signin'	=>	array(
		array(
			'field' => 'identity',
            'label' => 'Email Address',
            'rules' => 'required|valid_email'
		),array(
			'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
		)
	)
);