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
     function make_orders_datatables(){  
          $this->make_query();  
          if($_POST["length"] != -1)  
          {  
               $this->db->limit($_POST['length'], $_POST['start']);  
          }  
          $query = $this->db->get();  
          return $query->result();  
     }  
     function get_filtered_data(){  
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
     
}  
?>