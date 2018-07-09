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
            //Multiple Rows
            return $this->db->get('employee');
        }

        public function get_employee($id)
        {
            //Single Row Result
            return $this->db->get_where('employee', array('employee_id' => $id))->result();
        }
    }
?>