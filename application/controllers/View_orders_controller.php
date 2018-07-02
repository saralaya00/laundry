<?php
class View_orders_controller extends CI_Controller {  
      //functions  

      public function __construct()
	{
		parent::__construct();
            $this->load->model("view_orders_model");  
      }
      
      function index(){  
           $data["title"] = "Orders";  
           $this->load->view('view_orders', $data);  
      }  
      function fetch_orders(){  
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
                  $sub_array[] = '<button type="button" name="view" data-id="'.$row->order_id.'" class="btn btn-success btn-xs viewOrder">View Order</button>';  
                  
                  if($row->status=="delivered"){
                        $sub_array[]="-";
                  }
                  else if($row->status == "not assigned"){
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-warning btn-xs assign" data-toggle="modal" data-target="#userModal">Assign order</button>';  
                  }
                  else{
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-primary btn-xs changeEmployee" data-toggle="modal" data-target="#changeEmployeeModal">Change Employee</button>';  
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

      function get_employee()
      {
            $output = array();  
            $i=0;
            $this->load->model("view_orders_model");  
            $data = $this->view_orders_model->getEmployeeRows();  
            foreach($data as $row)  
            {  
                 $output[$i] = $row;  
                 $i++;
            }  
            echo json_encode($output);
      }

      public function getEmployeeName()
      {
            $order_id = $this->input->post('order_id');

            $this->load->model("view_orders_model");  
            $data = $this->view_orders_model->getEmployeeName($order_id);  

            echo json_encode($data);
      }
      public function assign_order()
      {
           
            $result = $this->view_orders_model->assign_order();
            if($result==true)
            {
                  $res='Order assigned sucessfully';  
              }
              else{
                  $res='Order not assigned';  
              }
             echo json_encode($res);
      }

      public function updateEmployeeID(){
            $employee_id=$this->input->post('employee_id');
            $order_id=$this->input->post('order_id');

            $result = $this->view_orders_model->updateEmployeeId($employee_id,$order_id);
            echo json_encode("Employee Id updated");
      }

      public function viewOrderDetailsPage(){
            $data = array('order_id' => $this->input->post('order_id'),
                        'full_name' => $this->input->post('full_name'),
                        'order_date' => $this->input->post('order_date'),
                        'delivery_date' => $this->input->post('delivery_date')
                  );
            $output_page = $this->load->view('view_order_details', $data,TRUE);
          //  $this->output->set_content_type('application/json');
            //$this->output->set_output($output_page);
            echo json_encode($output_page);
            die();
      }

      public function fetchOrderDetails(){
            $order_id = $this->input->post('order_id');
            //echo "<script>console.log( 'Debug Objects: " . $order_id . "' );</script>";
            $data = $this->view_orders_model->getItemServiceId($order_id);  
            // print_r($data);
            $item_id = array();  
            $service_id = array();
            $id = array();
            foreach ($data as $row)
            {    
                  $item_id[] = $row['item_id'];  
                  $service_id[] = $row['service_id']; 
                  $id[] = $row['id'];        
            }
            
            // print_r($item_id);
            // print_r($service_id);
            // print_r($id);
            $item_name = $this->data['data'] = $this->view_orders_model->getItemName($item_id);
            $service_name = $this->data['data'] = $this->view_orders_model->getServiceName($service_id);
            $quantity = $this->data['data'] = $this->view_orders_model->getQuantity($id,$order_id);
            $price = $this->data['data'] = $this->view_orders_model->getPrice($id,$order_id);

            $a_item_name = $item_name->result_array();
            $a_service_name = $service_name->result_array();
            $a_quantity = $quantity->result_array();
            $a_price = $price->result_array();
            // $merged =array_merge($a_item_name, $a_service_name,$a_quantity,$a_price);
            // print_r($merged);
            print_r(array(array_merge($a_item_name[0], $a_service_name[0], $a_quantity[0],$a_price[0]))); 
            foreach($a_item_name as $key => $value){
                  if(is_array($a_item_name[$key])){
                        $iname = (array_values($a_item_name[$key]));
                  }
            }
              
              
             // get_values($a_item_name);
            // $o_iname = call_user_func_array('array_merge', $a_item_name);
            // $o_sname = call_user_func_array('array_merge', $a_service_name);
            // $o_qnty = call_user_func_array('array_merge', $a_quantity);
            // $o_price = call_user_func_array('array_merge', $a_price);

            // $iname = $o_iname["name"];
            // $sname = $o_sname["name"];
            // $qnty = $o_qnty["quantity"];
            // $price = $o_price["price"];
            // if( $quantity->num_rows() > 0 )
            // {
            //       echo "<pre>";
            //         print_r( $quantity->result_array());
            //       echo "</pre>";
            // }
            // if( $item_name->num_rows() > 0 )
            // {
            //       echo "<pre>";
            //         print_r( $item_name->result_array());
            //       echo "</pre>";
            // }

            // if( $service_name->num_rows() > 0 )
            // {
            //       echo "<pre>";
            //         print_r( $service_name->result_array());
            //       echo "</pre>";
            // }
            // if( $price->num_rows() > 0 )
            // {
            //       echo "<pre>";
            //         print_r( $price->result_array());

            //       echo "</pre>";
            // }
      //       $sub_array = array();
      //       $sub_array[] = $iname;
      //       $sub_array[] = $sname;
      //       $sub_array[] = $qnty; 
      //       $sub_array[] = $price;
      //       $data_details[] = $sub_array;  

      //      $output = array(  
      //           "draw"                    =>     intval($_POST["draw"]),  
      //       //     "recordsTotal"          =>      $this->view_orders_model->get_all_data(),  
      //       //     "recordsFiltered"     =>     $this->view_orders_model->get_filtered_data(),  
      //           "data"                    =>     $data_details
      //      );  

      //      echo json_encode($output);  
          
            



            
            //echo json_encode($fetch_order_details);
            // $data = array();

            // foreach($fetch_data as $row)  
            // {  
            //       $sub_array = array();  
            //       $sub_array[] = $row->order_id;
            //       $sub_array[] = $row->full_name;
            //       $sub_array[] = $row->order_date;  
            //       $sub_array[] = $row->delivery_date;  
            //       $sub_array[] = $row->status;
            // }      

      }
}
 ?>  