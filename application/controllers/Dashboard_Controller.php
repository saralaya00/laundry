<?php
    class Dashboard_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Dashboard_Model');
            $this->load->model('Employee_Model');
            $this -> form_validation -> set_error_delimiters('<span>', '</span>');
        }

        public function index()
        {
            $data['title'] = "Dashboard";
            $this->load->view('common/footbar.php');
            $this->load->view('dashboard/view_cards.php');
            $this->load->view('common/end_wrapper.php');
        }

        public function md_employee()
        {
            //Called by Modal
            return $this->load->view('employee/md_employee.php');
        }

        public function add_employee()
        {
            // $this -> form_validation -> set_rules('contact_no', 'Contact No', 'required|numeric');

            if ($this->form_validation->run('employee') == FALSE)
            {
                return $this->load->view('employee/md_employee.php');
            }
            else {
                $empdata = array(
                    'user_id' => '', //UserID is the generated autonum from users table
                    'full_name' => $this -> input -> post('full_name'),
                    'address' => $this -> input -> post('address'),
                    'email' => $this -> input -> post('email'),
                    'contact_no' => $this -> input -> post('contact_no')
                );

                if ($this->Employee_Model->add_employee($empdata))
                {
                    $_POST['message'] = 'Employee Added!';
                    return $this->load->view('employee/rdonly_employee.php');
                }

                else return $this->load->view('employee/md_employee.php');                
            }
        }
    }
?>