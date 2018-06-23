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
            $this->load->view('view_orders.php');
            $this->load->view('common/end_wrapper.php');
        }
    }
?>