<?php
class View_orders_controller extends CI_Controller {  
      //functions  
      function index(){  
           $data["title"] = "Orders";  
           $this->load->view('view_orders', $data);  
      }  
      function fetch_orders(){  
           $this->load->model("view_orders_model");  
           $fetch_data = $this->view_orders_model->make_orders_datatables();  
           $data = array();

           foreach($fetch_data as $row)  
           {  
                  $sub_array = array();  
                  $sub_array[] = $row->order_id;
                  $sub_array[] = $row->full_name;
                  $sub_array[] = $row->order_date;  
                  $sub_array[] = $row->delivery_date;  
                  $sub_array[] = $row->status;
                  $sub_array[] = '<button type="button" name="view" data-id="'.$row->order_id.'" class="btn btn-success btn-xs">View Order</button>';  
                  
                  if($row->status=="delivered"){
                        $sub_array[]="--";
                  }
                  else if($row->status == "not assigned"){
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-warning btn-xs">Assign order</button>';  
                  }
                  else{
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-primary btn-xs">Change Employee</button>';  
                  }
                  $data[] = $sub_array;  
                
           }  
           $output = array(  
                "draw"                    =>     intval($_POST["draw"]),  
                "recordsTotal"          =>      $this->view_orders_model->get_all_data(),  
                "recordsFiltered"     =>     $this->view_orders_model->get_filtered_data(),  
                "data"                    =>     $data  
           );  

           echo json_encode($output);  
          
      }  
 }
 ?>  