<?php
class Customer_model extends CI_Model
{
    /* var $table = "users";
    var $select_column=array("id","first_name","last_name","image");
     var $order_column=array(null,"first_name","last_name",null,null);*/
    

    public function getItemServiceDetails($service_id)
    {

        // $i_id_result = $this->getItemId();
        // $item_id = array();
        // foreach ($i_id_result->result_array() as $row)
        // {
        //     $item_id[] = $row['item_id'];
        // }

        // $s_id_result = $this->getServiceId();
        // $service_id = array();
        // foreach ($s_id_result->result_array() as $row)
        // {
        //     $service_id[] = $row['service_id'];
        // }
        

        $this->db->select('is.id,it.item_name,s.service_name,is.price');
        $this->db->join('items as it','is.item_id=it.item_id');
        $this->db->join('services as s','s.service_id=is.service_id');
        $this->db->where('s.service_id',$service_id)->where('flag',1);
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

    function getServices()
    {
        $this->db->distinct();
        $this->db->select('s.service_id,s.service_name');
        $this->db->join('item_service as is','is.service_id = s.service_id');
        $this->db->from('services as s');
        $this->db->where('is.flag >',0);
        $result = $this->db->get()->result_array();
        return $result;
    }

    function place_order_details($data){
        $order_date = date('Y-m-d H:i:s');

        $id = $this->getId($data);//id from item_service required to insert into order-details
        $record = array("customer_id" => $data['customer_id'],
                        "order_date" => $order_date,
                        "delivery_date" => "",
                        "status" => ""
                    );

        $this->db->select('order_id'); 
        $this->db->from('orders');   
        $this->db->where('customer_id',$data['customer_id']);
        $this->db->order_by('order_id', 'DESC');
        $order_id = $this->db->get()->result_array();
        
        //check whether row present in order table
        $is_exist = $this->check_order_exist($order_id[0]['order_id']);

        print_r($is_exist);
        if(count($is_exist) > 0){
            $order_details = array('order_id' => $order_id[0]['order_id'],
                                'id' => $id[0]['id'],
                                'quantity' => $data['quantity']
                        );

            $this->db->insert('order_details',$order_details);
        }
        else{
            $this->db->insert('orders',$record);

            $this->db->select('order_id'); 
            $this->db->from('orders');   
            $this->db->where('customer_id',$data['customer_id']);
            $this->db->order_by('order_id', 'DESC');
            $order_id = $this->db->get()->result_array();

            $order_details = array('order_id' => $order_id[0]['order_id'],
                                'id' => $id[0]['id'],
                                'quantity' => $data['quantity']
                        );

            $this->db->insert('order_details',$order_details);
        }
    }

    function check_order_exist($order_id){
        $this->db->select('od.order_id'); 
        $this->db->join('orders as o','o.order_id = od.order_id');
        $this->db->from('order_details as od');   
        $this->db->where('o.order_id',$order_id);

        return $this->db->get()->result_array();
    }

    function getId($data){
        $item_id = $this->getItemId_forInsert($data['item_name']);

        $this->db->select('id');
        $this->db->from('item_service');
        $this->db->where('item_id',$item_id[0]['item_id'])->where('service_id',$data['service_id']);
        return $this->db->get()->result_array();
    }

    function getItemId_forInsert($item_name)
    {
        $this->db->select('item_id');
        $this->db->from('items');
        $this->db->where('item_name',$item_name);
        return $this->db->get()->result_array();
    }

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

    // public function deleteItem_service($id)
    // {
    //     $this->db->where('id', $id);
    //     $this->db->delete('item_service'); 
    // }

}
?>