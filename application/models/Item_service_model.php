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

        $i_id_result = $this->getItemId();
        $item_id = array();
        foreach ($i_id_result->result_array() as $row)
        {
            $item_id[] = $row['item_id'];
        }
        
        if(count($item_id)>0){

            $this->db->select('is.id,it.item_name,s.service_name,is.price');
            $this->db->join('items as it','is.item_id=it.item_id');
            $this->db->join('services as s','s.service_id=is.service_id');
            $this->db->where_in('is.item_id',$item_id)->where('is.service_id',$service_id);
            $this->db->from('item_service as is');
            $query = $this->db->get()->result_array();
            return $query;
        }
        else{
            $this->getItems();
        }
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

    function getServices()
    {
        $this->db->from('services');
        return $this->db->get()->result_array();
    }

    function getItems()
    {
        $i_id_result = $this->getItemId();
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
        $this->db->where('id', $id);
        $this->db->delete('item_service'); 
    }

    public function addItemService($data = array())
    {
        $service_id = $data['service_id'];
        $price = $data['price'];

        $this->db->select('item_id');
        $this->db->from('items');
        $this->db->where('item_name',$data['item_name']);
        $item_id = $this->db->get()->result_array();

        $item_id = $item_id[0]['item_id'];
        $record = array('service_id' => $service_id,
                        'item_id' => $item_id,
                        'price' => $price);
                        
        $result = $this->db->insert('item_service', $record); 
        
    }
}
?>