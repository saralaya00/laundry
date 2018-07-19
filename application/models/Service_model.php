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
            $this->db->select("*");
            $this->db->from('services');
            $this->db->where('service_name',$service_data['service_name']);
            $result = $this->db->get()->result_array();

            if($result > 0){
                $this->db->set('service_name',$service_data['service_name']);
                $this->db->set('flag',1);
                $this->db->where('service_name',$service_data['service_name']);
                $query2 = $this->db->update("Services");   
            }
            else{
                $this->db->insert('services',$service_data);
                return $this->db->affected_rows();
            }
           
        }

        public function fetch_services()
        {
            $this->db->select('*');
            $this->db->from('services');

            return $this->db->get();
           
        }

        // public function delete_service($service_id){
        //     $this->db->set('flag',0);
        //     $this->db->where('service_id',$service_id);  
        //     $query2 = $this->db->update("Services");   
        // }
    }
?>
