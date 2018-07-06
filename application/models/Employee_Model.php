<?php
    class Employee_Model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function get_employees()
        {
            return $this->db->get('employee');
        }
    }
?>