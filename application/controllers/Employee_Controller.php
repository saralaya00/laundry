<?php
    class Employee_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            $data['title'] = "Employee Records";
            $this->load->view('common/footbar.php');
            $this->load->view('employee/view_employee.php', $data);
            $this->load->view('common/end_wrapper.php');
            //$this->load->view('dashboard/view_cards.php');
        }
    }
?>