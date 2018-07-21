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
            $data['title'] = 'Homepage';
            unset($_SESSION['salt']);
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
                    $redir['salt'] = hash('sha256', $usernameSHA);

                    echo json_encode($redir);
                    // print_r($redir);
                }
    
                if ($login_details['role'] == 'Employee')
                {
                    // optional
                }
    
                if($login_details['role'] == 'Customer')
                {
                    $redir['link'] = base_url('customer');
                    $redir['salt'] = hash('sha256', $usernameSHA);

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