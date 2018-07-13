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

    // function getItem()
    // {
    //     $query=$this->db->get('items');  
    //     return $query->result();
    // }

    // function getService()
    // {
    //     $query=$this->db->get('services');  
    //     return $query->result();
    // }

    // public function updateItem_service($input)
    // {
    //     $id = $input['id'];

    //     $item_name = $input['item_name'];
    //     $item_id = $this->getUpdateItemId($item_name);

    //     $service_name = $input['service_name'];
    //     $service_id = $this->getUpdateServiceId($service_name);

    //     $price = $input['price'];
    //     $data = array('item_id' => $item_id,
    //                 'service_id' => $service_id);

    //     $single_data = call_user_func_array('array_merge',call_user_func_array('array_merge', $data));
       
    //     $this->db->where('id',$id);  
    //     $query = $this->db->update("item_service",$single_data);
        
    //     $this->db->set('price',$price);
    //     $this->db->where('id',$id);  
    //     $query2 = $this->db->update("item_service");
        
    // }

    // public function getUpdateItemId($item_name)
    // {
    //     $this->db->select('item_id');
    //     $this->db->from('items');
    //     $this->db->where('item_name',$item_name,NULL, FALSE);
    //     return $this->db->get()->result_array();
    // }

    // public function getUpdateServiceId($service_name)
    // {
       
    //     $this->db->select('service_id');
    //     $this->db->from('services');
    //     $this->db->where('service_name',$service_name);
    //     return $this->db->get()->result_array();
    // }

    public function deleteItem_service($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('item_service'); 
    }

}
?>