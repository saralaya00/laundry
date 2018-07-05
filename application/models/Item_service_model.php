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
        // $item_names = array();
        // $item_names[] = $this->getItemNames();

        // $service_names = array();
        // $service_names[] = $this->getServiceNames();
        $result = $this->getId();

        $ids = array();
        foreach ($result->result_array() as $id)
            {
                $ids[] = $id['item_id'];
            }
        
            print_r($ids);
       

    //     $this->db->distinct();
    //     $this->db->select('item_service.id,items.item_name,item_service.price');
    //     $this->db->join('items as it','it.item_id=item_service.item_id');
    //    // $this->db->join('item_service as is','is.service_id=services.service_id');
    //     $this->db->from('items,item_service');
    //     $this->db->where_in('items.item_id',$ids);
    //     $query = $this->db->get();
    //     return $query->result_array();

    $name = $this->getItemName($ids);
    print_r($name);
    }
    function getId(){
        $this->db->select('item_id');
    $this->db->from('item_service');
    $query = $this->db->get();
    return $query;
    }
    
    //     $this->db->select('id,item_id,service_id,price');
    //     $this->db->from('item_service');
    //     $query = $this->db->get();
    //     $id = $query->result_array();
    //     return $id;
    //     // $count = 0;
    //     // $i = 0;
    //     // foreach ($item_names as $key=>$value) {
    //     //       $count++;
    //     // }

    //     // $data_values = array();
    //     // while($i != $count)
    //     // {
    //     //       $data_values[$i] = array(array_merge($item_names[$i], $service_names[$i], $id_price[$i])); 
    //     //       $i++;
    //     // }

    //     // $result = call_user_func_array('array_merge', $data_values);
    //     // return $result;
        

       
    //     // $query = $this->db->get();
    //     // return $query->result_array();
    // }

    public function getItemName($item_id = array())
    {
                print_r($item_id);
          $this->db->select('i.item_name');
        // $this->db->join('item_service as its','i.item_id = its.item_id');
          $this->db->where_in('i.item_id',$item_id);  
          $this->db->from('items as i');
          $query = $this->db->get();
          return $query->result_array();

    }

    // public function getServiceName($service_id = array())
    // {
    //       $this->db->select('services.service_name');
    //       $this->db->join('item_service', 'services.service_id=item_service.service_id','left');
    //       $this->db->where_in('item_service.service_id',$service_id);  
    //       $this->db->from('services');
    //       $query = $this->db->get();
    //       return $query->result_array();
    // }
}
?>