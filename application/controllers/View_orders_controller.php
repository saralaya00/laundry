<?php
class View_orders_controller extends CI_Controller {  
      public function __construct()
	{
		parent::__construct();
            $this->load->model("view_orders_model");  
      }
      
      function index(){  
           $data["title"] = "Orders";  
           $this->load->view('common/footbar.php');
           $this->load->view('orders/view_orders.php',$data);
           $this->load->view('common/end_wrapper.php');
           //$this->load->view('view_orders', $data);  
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
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-warning btn-xs assign" data-toggle="modal" data-target="#modal-template">Assign order</button>';  
                  }
                  else{
                         $sub_array[] = '<button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-primary btn-xs changeEmployee" data-toggle="modal" data-target="#modal-template">Change Employee</button>';  
                  }
                  
                  $data[] = $sub_array;  
                 
           }  
          
           $output = array(  
                "draw"              =>    intval($_POST["draw"]),  
                "recordsTotal"      =>    $this->view_orders_model->get_all_data(),  
                "recordsFiltered"   =>    $this->view_orders_model->get_filtered_data(),  
                "data"              =>    $data  
           );  

           echo json_encode($output);  
          
      }  

      public function md_assignOrder(){
            return $this->load->view('orders/md_assignOrder.php');
      }

      public function md_changeEmployee(){
            return $this->load->view('orders/md_changeEmployee.php');
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
            $this->load->view('common/footbar.php');
            $output_page = $this->load->view('orders/view_order_details', $data,TRUE);
            $this->load->view('common/end_wrapper.php');
          
            echo json_encode($output_page);
            die();
      }

      public function fetchOrderDetails(){
            $order_id = $this->input->post('order_id');
            $data = $this->view_orders_model->getItemServiceId($order_id);  
            $item_id = array();  
            $service_id = array();
            $id = array();
            foreach ($data as $row)
            {    
                  $item_id[] = $row['item_id'];  
                  $service_id[] = $row['service_id']; 
                  $id[] = $row['id'];        
            }
           
            $item_name = $this->data['data'] = $this->view_orders_model->getItemName($item_id);
            $service_name = $this->data['data'] = $this->view_orders_model->getServiceName($service_id);
            $quantity = $this->data['data'] = $this->view_orders_model->getQuantity($id,$order_id);
            $price = $this->data['data'] = $this->view_orders_model->getPrice($id,$order_id);

            $count = 0;
            $i = 0;
            foreach ($item_name as $key=>$value) {
                  $count++;
            }
         
            while($i != $count)
            {
                  $data_values[$i] = array(array_merge($item_name[$i], $service_name[$i], $quantity[$i],$price[$i])); 
                  $i++;
            }
            $single_data = call_user_func_array('array_merge', $data_values);
      
            $data_details = array();
            $j = 0;
            $total = 0;
            foreach( $single_data as $key => $value) {
            $sub_array = array();
                  $sub_array[] = $j+1;
                  $sub_array[] = $value['item_name']; 
                  $sub_array[] = $value['service_name']; 
                  $sub_array[] = $value['quantity']; 
                  $sub_array[] = $value['price']; 
                  $total = (($value['quantity'])*($value['price']));
                  $sub_array[] = $total;
                  $j++;
                  $data_details[] = $sub_array; 
            }
            
           $output = array(  
                "draw"              =>     intval($_POST["draw"]),  
                "recordsTotal"      =>     $j,  
                "recordsFiltered"   =>     $j,  
                "data"              =>     $data_details
           );  

            echo json_encode($output);  
      }
}
 ?>  