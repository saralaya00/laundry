<?php
    class Service_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        function add_service($service_data)
        {
            $this->db->insert('services',$service_data);
            return $this->db->affected_rows();
        }
    }
?>
