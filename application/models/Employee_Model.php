<?php
    class Employee_Model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        function add_employee($empdata)
        {
            //Insert into Users
            $userinfo = array(
                'username' => $empdata['contact_no'],
                'password' => '',
                'role' => 'Employee'
            );

            $this->db->insert('users',$userinfo);
            $empdata['user_id'] = $this->db->insert_id();

            //Insert into Employee
            $this->db->insert('employee',$empdata);
            return $this->db->affected_rows();
        }

        public function update_employee($empID, $empData)
        {
            $this->db->where('employee_id', $empID);
            return $this->db->update('employee', $empData);
        }

        public function get_employees()
        {
            //Multiple Rows
            return $this->db->get('employee');
        }

        public function get_employee($empID)
        {
            //Single Row Result
            return $this->db->get_where('employee', array('employee_id' => $empID))->result();
        }

        public function delete_employee($userID)
        {
            //Single Record Delete
            //Employee Table / User Table
            $this->db->delete('employee', array('user_id' => $userID));
            $this->db->delete('users', array('user_id' => $userID));
        }
    }
?>