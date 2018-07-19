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

      function fetchOrders()
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
            return $query->result_array();
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

      // public function getEmployeeName($order_id)
      // {
      //       $emp_id = $this->getEmployeeID($order_id);
      //       $this->db->select('full_name'); 
      //       $this->db->from('employee');   
      //       $this->db->where('employee_id', $emp_id);
      //      return $this->db->get()->row()->full_name;
      // }
      public function getEmployeeName($order_id)
      {
            // todo: Fixes
            //Sends Emp name and Contact no
            //If errors use the above and make required changes in view_orders_controller
            $emp_id = $this->getEmployeeID($order_id);
           
            $this->db->select('full_name,contact_no'); 
            $this->db->from('employee');   
            $this->db->where('employee_id', $emp_id[0]['employee_id']);
            $empDetails = $this->db->get()->row();
            return array('full_name' => $empDetails->full_name, 'contact_no' => $empDetails->contact_no);
      }

      public function getEmployeeID($order_id)
      {
            $this->db->select('employee_id'); 
            $this->db->from('order_tracking');   
            $this->db->where('order_id', $order_id);
            $this->db->order_by('tracking_id', 'DESC');
            $result = $this->db->get()->result_array();
            return $result;
      }

      public function updateEmployeeId($employee_id,$order_id)
      {
            $this->db->select('status');
            $this->db->from('orders');
            $this->db->where('order_id',$order_id);
            $status = $this->db->get()->result_array();

            
            $data = array('employee_id' => $employee_id,
                        'order_id' => $order_id,
                        'status' => $status[0]['status']);

            // $this->db->set('employee_id');
            // $this->db->where("order_id",$order_id);  
            // $this->db->update("order_tracking",$data);
            $this->db->insert('order_tracking',$data);
      }

      public function getItemServiceId($order_id)
      {
            $this->db->distinct();
             $this->db->select('is.item_id,is.service_id,od.id');
             $this->db->from('item_service as is');
             $this->db->join('order_details as od', 'od.id=is.id');
             $this->db->where('od.order_id',$order_id);
             $query = $this->db->get();
             return $query->result_array();
      }

      public function getItemName($item_id = array())
      {
            $this->db->select('i.item_name');
            $this->db->join('item_service as is','i.item_id = is.item_id');
            $this->db->where_in('is.item_id',$item_id);  
            $this->db->from('items as i');
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