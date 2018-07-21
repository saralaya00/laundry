<?php if (!defined('BASEPATH')) exit('Direct Access Forbidden!');

    class Homepage_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Homepage_Model');
        }

        public function index()
        {
            //Auto Logout
            unset($_SESSION['slug']);

            $data['title'] = 'Homepage';
            $this->load->view('homepage/view_homepage.php');
        }

        public function verify_login()
        {
            $usernameSHA = hash('sha256', $this->input->post('username'));
            $passwordSHA = hash('sha256', $this->input->post('password'));

            $login_details = $this->Homepage_Model->verify_login($usernameSHA, $passwordSHA);

            // print_r($login_details);
            if ($login_details['is_verified'] == 1)
            {
                if ($login_details['role'] == 'Admin')
                {
                    $redir['link'] = base_url('dashboard');
                    $redir['slug'] = hash('sha256', $usernameSHA);

                    echo json_encode($redir);
                }
    
                if ($login_details['role'] == 'Employee')
                {
                    // optional

                    //if password == hash('sha256','no-password'),
                    // show change password.php

                    //Default page >> should be changed if used
                    $redir['link'] = base_url('dashboard');
                    $redir['slug'] = hash('sha256', $usernameSHA);
                    echo json_encode($redir);
                }
    
                if($login_details['role'] == 'Customer')
                {
                    $redir['link'] = base_url('customer');
                    $redir['slug'] = hash('sha256', $usernameSHA);
                    $redir['customer_id'] = $login_details['customer_id'];
                    echo json_encode($redir);
                }
            }

            else 
            {
                // todo: Invalid Credentials Validation
            }
        }
    }
?>