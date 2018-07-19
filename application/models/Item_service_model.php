<?php
class Item_service_model extends CI_Model  
{  
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
    }

    public function getItemServiceDetails($service_id)
    {

        $i_id_result = $this->getItemId($service_id);
        $item_id = array();

        foreach ($i_id_result->result_array() as $row)
        {
            $item_id[] = $row['item_id'];
        }
       
        
        if(count($item_id)>0){

            $this->db->select('is.id,it.item_name,s.service_name,is.price');
            $this->db->join('items as it','is.item_id=it.item_id');
            $this->db->join('services as s','s.service_id=is.service_id');
            $this->db->where_in('is.item_id',$item_id)->where('is.service_id',$service_id)->where('is.flag',1);
            $this->db->from('item_service as is');
            $query = $this->db->get()->result_array();

           
            return $query;
        }
        else{
            $this->getItems($service_id);
        }
    }

    function getItemId($service_id)
    {
        $this->db->select('item_id');
        $this->db->from('item_service');
        $this->db->where('service_id',$service_id)->where('flag',1);
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

    function getServices()
    {
        $this->db->from('services');
        return $this->db->get()->result_array();
    }

    function getItems($service_id)
    {
        $i_id_result = $this->getItemId($service_id);
        $item_id = array();

        foreach ($i_id_result->result_array() as $row)
        {
            $item_id[] = $row['item_id'];
        }

        if(count($item_id)>0)
        {
            $this->db->from('items');
            $this->db->where_not_in('item_id', $item_id);
            $query = $this->db->get()->result_array();
            return $query;
        }
        else
        {
            $this->db->from('items');
            $query = $this->db->get()->result_array();
            return $query;
        }
       
    }

    public function updateItem_service($input = array())
    {
        $id = $input['id'];
        $price = $input['price'];

        $this->db->set('price',$price);
        $this->db->where('id',$id);  
        $query2 = $this->db->update("item_service");   
    }

    public function deleteItem_service($id)
    {
        $this->db->set('flag',0);
        $this->db->where('id',$id);  
        $query2 = $this->db->update("item_service");   
    }

    public function add_item_service($data)
    {
        $this->db->select('item_id');
        $this->db->from("item_service");
        $this->db->where('item_id',$data['item_id'])->where('service_id',$data['service_id']);
        $result = $this->db->get()->result_array();

        if(count($result) > 0){
            $this->db->set('flag',1);
            $this->db->where('item_id',$data['item_id'])->where('service_id',$data['service_id']);
            $query2 = $this->db->update("item_service");
        }
        else{
            return $this->db->insert('item_service', $data);
        }
    }
}
?>