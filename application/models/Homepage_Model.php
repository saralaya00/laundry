<?php
    class Homepage_Model extends CI_Model
    {
        public function __constuct()
        {
            parent::__constuct();
            $this->load->database();
        }

        public function verify_login($usernameSHA, $passwordSHA)
        {
            $this->db->from('users');
            $this->db->where('username',$usernameSHA);
            $result = $this->db->get()->result_array();
            $result = $result[0];

            // print_r($result);
            if ($result['password'] == $passwordSHA)
            {
                $login_details['is_verified'] = 1;
                $login_details['role'] = $result['role']; 
            }

            else 
            {
                $login_details['result'] = $result;
                $login_details['is_verified'] = 0;
                $login_details['role'] = 'none';
            }

            return $login_details;
        }
    }
?>