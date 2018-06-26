<?php
    class Dashboard_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
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
            return $this->load->view('dashboard/md_employee.php');
        }

        public function add_employee()
        {
            //todo: Add Validation rules

            if ($this->form_validation->run() == FALSE)
            {
                return $this->load->view('dashboard/md_employee.php');
            }
            else return $this->load->view('dashboard/succ_employee.php');
        }
    }
?>