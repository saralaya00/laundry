<?php
class Customer_model extends CI_Model
{
    public function __construct() 
    {
        parent::__construct(); 
        $this->load->database();
    }

    public function getUnCheckedDetails($service_id)
    {
        $order_id = $this->check_existence();
        if(count($order_id)>0)
        {
            $id_result = $this->getItemServiceId();
            $id = array();

           

            foreach ($id_result->result_array() as $row)
            {
                $id[] = $row['id'];
            }
            // print_r($id);
            if(count($id)>0)
            {
                    $this->db->select('is.id,it.item_name,s.service_name,is.price');
                    $this->db->join('items as it','is.item_id=it.item_id');
                    $this->db->join('services as s','s.service_id=is.service_id');
                    $this->db->where('s.service_id',$service_id)->where('flag',1)->where_not_in('id',$id);
                    $this->db->from('item_service as is');
                    $query = $this->db->get();
                    return $query->result_array();
            }
            else
            {
                return $this->getItemService($service_id)->result_array();
            }
        }
        else
        {
            return $this->getItemService($service_id)->result_array();
        }
        
       
    }

    function getCheckedDetails($service_id)
    {
        $order_id = $this->check_existence();
        if(count($order_id)>0)
        {
            $id_result = $this->getItemServiceId();
            $id = array();

            foreach ($id_result->result_array() as $row)
            {
                $id[] = $row['id'];
            }
        
            if(count($id)>0)
            {
                    $this->db->select('is.id,it.item_name,s.service_name,is.price,od.quantity');
                    $this->db->join('items as it','is.item_id=it.item_id');
                    $this->db->join('services as s','s.service_id=is.service_id');
                    $this->db->join('order_details as od','is.id=od.id');
                    $this->db->join('orders as o','o.order_id=od.order_id');
                    $this->db->where('s.service_id',$service_id)->where('flag',1)->where_in('is.id',$id)->where('o.status',1);
                    $this->db->from('item_service as is');
                    $query = $this->db->get();
                    return $query->result_array();
            }
        }
        

    }

    function getItemService($service_id)
    {
       
            $this->db->select('is.id,it.item_name,s.service_name,is.price');
            $this->db->join('items as it','is.item_id=it.item_id');
            $this->db->join('services as s','s.service_id=is.service_id');
            $this->db->where('s.service_id',$service_id)->where('flag',1);
            $this->db->from('item_service as is');
            return $this->db->get();
        
    }

    function getItemServiceId()
    {
        $this->db->select('od.id');
        $this->db->join('item_service as is','od.id = is.id');
        $this->db->join('orders as o','o.order_id=od.order_id');
        $this->db->from('order_details as od');
        $this->db->where('o.status',1);
        return $this->db->get();
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

    function place_order_details($data)
    {
        $order_date = date('Y-m-d H:i:s');

        //checking for existence
        $order_id = $this->check_existence();
        if(count($order_id)>0)
        {
            $return_id = $this->insert_to_order_details($data);
            return  $return_id;

        }
        else
        {
            $record = array("customer_id" => $data['customer_id'],
                            "order_date" => $order_date,
                            "delivery_date" => "",
                            "status" => 1//status changes to "not assigned" when place order is clicked
                        );
            $this->db->insert('orders',$record);
            $return_id = $this->insert_to_order_details($data);
            return  $return_id;
        }
    }

    function insert_to_order_details($data)
    {
        $id = $this->getId($data);//id from item_service required to insert into order-details

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
 
        return ($order_id[0]['order_id']);
    }
    
    //check_existence of order_id in orders table
    function check_existence()
    {
        $this->db->select('o.order_id');
        $this->db->join('order_details as od','o.order_id = od.order_id');
        $this->db->from('orders as o');
        $this->db->where('status',1);//status changes to "not assigned" when place order is clicked
        return $this->db->get()->result_array();
    }      

    function getId($data){
        $item_id = $this->getItemId($data['item_name']);

        $this->db->select('id');
        $this->db->from('item_service');
        $this->db->where('item_id',$item_id[0]['item_id'])->where('service_id',$data['service_id']);
        return $this->db->get()->result_array();
    }

    function getItemId($item_name)
    {
        $this->db->select('item_id');
        $this->db->from('items');
        $this->db->where('item_name',$item_name);
        return $this->db->get()->result_array();
    }

    function remove_order_details($data)
    {
        $id = $this->getId($data);
        //checking for existence
        $order_id = $this->check_existence();
        
        $this->db->select('*');
        $this->db->from('order_details');
        $this->db->where('order_id',$order_id[0]['order_id']);
        $num_rows = $this->db->get()->num_rows();
        
        if($num_rows == 1)
        {
            $this->db->where('order_id',$order_id[0]['order_id']);
            $this->db->delete('orders');
           
        }
        else if($num_rows > 1)
        {
            $this->db->where('order_id',$order_id[0]['order_id'])->where('id',$id[0]['id']);
            $this->db->delete('order_details');     
        }
        
    }

    function update_status($order_id)
    {
        $status = array('status' => 'not assigned');
        $this->db->set($status);
        $this->db->where('order_id',$order_id);
        $this->db->update('orders');
    }

    public function fetchOrderDetails($order_id)
    {
        $this->db->select('it.item_name,s.service_name,is.price,od.quantity');
        $this->db->join('items as it','is.item_id=it.item_id');
        $this->db->join('services as s','s.service_id=is.service_id');
        $this->db->join('order_details as od','is.id=od.id');
        $this->db->join('orders as o','o.order_id=od.order_id');
        $this->db->where('o.order_id',$order_id);
        $this->db->from('item_service as is');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>