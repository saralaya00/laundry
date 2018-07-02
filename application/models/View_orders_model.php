<?php
class View_orders_model extends CI_Model  
{  
      public function __construct() 
      {
            parent::__construct(); 
            $this->load->database();
      }

      var $table = "orders";  
      var $select_column = array("order_id", "full_name", "order_date", "delivery_date","status"); 
      var $order_column = array(null, "full_name", "status", null, null); 

      function make_query()  
      {  
            $this->db->select($this->select_column);  
            $this->db->from('orders');  
            $this->db->join('customer as c', 'c.customer_id = orders.customer_id','left');
            if(isset($_POST["search"]["value"]))  
            {  
                  $this->db->like("full_name", $_POST["search"]["value"]);  
                  $this->db->or_like("status", $_POST["search"]["value"]);  
            }  
            if(isset($_POST["order"]))  
            {  
                  $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
            }  
            else  
            {  
                  $this->db->order_by('order_id', 'DESC');  
            }  
      }  

      function make_orders_datatables()
      {  
            $this->make_query();  
            if($_POST["length"] != -1)  
            {  
                  $this->db->limit($_POST['length'], $_POST['start']);  
            }  
            $query = $this->db->get();  
            return $query->result();  
      }  

      function get_filtered_data()
      {  
            $this->make_query();  
            $query = $this->db->get();  
            return $query->num_rows();  
      }       

      function get_all_data()  
      {  
            $this->db->select("*");  
            $this->db->from($this->table);  
            return $this->db->count_all_results();  
      }  

      public function getEmployeeRows()
      {
            $query=$this->db->get('employee');  
            return $query->result();
      }

      public function assign_order()
      {    
            $data = array('order_id' => $this->input->post('order_id'),
                        'employee_id' => $this->input->post('employee_id'),
                        'status' => '');

            $result = $this->db->insert('order_tracking', $data); 
            
            $order_id = $this->input->post('order_id');

            $this->update_order_status($order_id);
            return $result;
      }

      public function update_order_status($order_id)
      {
            $data = array('status'=>"assigned");
            $this->db->set('status');
            $this->db->where("order_id",$order_id);  
            $this->db->update("orders",$data);
      }

      public function getEmployeeName($order_id)
      {
            $emp_id = $this->getEmployeeID($order_id);
            $this->db->select('full_name'); 
            $this->db->from('employee');   
            $this->db->where('employee_id', $emp_id);
           return $this->db->get()->row()->full_name;
      }

      public function getEmployeeID($order_id)
      {
            $this->db->select('employee_id'); 
            $this->db->from('order_tracking');   
            $this->db->where('order_id', $order_id);
            return $this->db->get()->row()->employee_id;
      }

      public function updateEmployeeId($employee_id,$order_id)
      {
            $data = array('employee_id' => $employee_id);
            $this->db->set('employee_id');
            $this->db->where("order_id",$order_id);  
            $this->db->update("order_tracking",$data);
      }

      public function getItemServiceId($order_id)
      {
            $this->db->distinct();
             $this->db->select('item_id,service_id,od.id');
             $this->db->from('item_service as is,order_details as o');
             $this->db->join('order_details as od', 'od.id=is.id');
             $this->db->where('od.order_id',$order_id);
             $query = $this->db->get();
             return $query->result_array();
      }

      public function getItemName($item_id = array())
      {
            $this->db->distinct();
            $this->db->select('items.item_name');
            $this->db->join('item_service','items.item_id = item_service.item_id');
            $this->db->where_in('items.item_id',$item_id);  
            $this->db->from('items');
            $query = $this->db->get();
            return $query->result_array();
      }

      public function getServiceName($service_id = array())
      {
            $this->db->distinct();
            $this->db->select('services.service_name');
            $this->db->join('item_service', 'services.service_id=item_service.service_id','left');
            $this->db->where_in('item_service.service_id',$service_id);  
            $this->db->from('services');
            $query = $this->db->get();
            return $query->result_array();
      }

      public function getQuantity($id = array(),$order_id)
      {
            $this->db->select('quantity');
            $this->db->from('order_details');
            $this->db->where_in('id',$id)->where('order_id',$order_id);
            $query = $this->db->get();
            return $query->result_array();
      }

      public function getPrice($id = array())
      {
            $this->db->select('price');
            $this->db->from('item_service');
            $this->db->where_in('id',$id);
            $query = $this->db->get();
            return $query->result_array();
      }
}  
?>