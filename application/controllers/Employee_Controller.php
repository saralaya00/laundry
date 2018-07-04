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
            $this->load->view('dashboard/view_cards.php');
        }
    }
?>