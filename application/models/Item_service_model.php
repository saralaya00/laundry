<?php
class Item_service_model extends CI_Model  
{  
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
    }

    public function getItemServiceDetails()
    {

        $i_id_result = $this->getItemId();
        $item_id = array();
        foreach ($i_id_result->result_array() as $row)
        {
            $item_id[] = $row['item_id'];
        }

        $s_id_result = $this->getServiceId();
        $service_id = array();
        foreach ($s_id_result->result_array() as $row)
        {
            $service_id[] = $row['service_id'];
        }

        $this->db->select('is.id,it.item_name,s.service_name,is.price');
        $this->db->join('items as it','is.item_id=it.item_id');
        $this->db->join('services as s','s.service_id=is.service_id');
        $this->db->where_in('is.item_id',$item_id)->where_in('is.service_id',$service_id);
        $this->db->from('item_service as is');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getItemId()
    {
        $this->db->select('item_id');
        $this->db->from('item_service');
        $query = $this->db->get();
        return $query;
    }

    function getServiceId()
    {
        $this->db->select('service_id');
        $this->db->from('item_service');
        $query = $this->db->get();
        return $query;
    }
}
?>