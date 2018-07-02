<?php 
    class Dashboard_Model extends CI_Model
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
    }
    
?>