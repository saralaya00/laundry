<?php
class View_orders_controller extends CI_Controller {  
      public function __construct()
	{
            parent::__construct();
            //load view_orders_model
            $this->load->model("view_orders_model");  
      }
      
      function index(){  
           $data["title"] = "Orders";  
           $this->load->view('common/footbar.php');
           $this->load->view('orders/view_orders.php',$data);
           $this->load->view('common/end_wrapper.php');
      }  

      function fetch_orders()
      {  
            //to fetch all orders
            $fetch_data = $this->view_orders_model->fetchOrders();  
            $data = array();

            //fill data table with all orders
            foreach($fetch_data as $row)  
            {  
                  $sub_array = array();
                  $sub_array[] = $row->order_id;
                  $sub_array[] = $row->full_name;
                  $sub_array[] = $row->order_date;  
                  $sub_array[] = $row->delivery_date;  
                  $sub_array[] = $row->status;
                  //button to view order
                  $sub_array[] = '<button type="button" name="view" data-id="'.$row->order_id.'" class="btn btn-success btn-xs viewOrder" data-toggle="modal" data-target="#modal-template">View Order</button>';  
                  
                  //cannot change employee or assign order if order has been delivered
                  if($row->status=="delivered")
                  {
                        $sub_array[]='<div class="text-center"><span class="fa fa-check-square fa-lg"></span></div>';
                  }
                  //assign order to employee
                  else if($row->status == "not assigned")
                  {
                        $sub_array[] = 
                        '<div class="text-center">
                              <button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-warning btn-xs assign" data-toggle="modal" data-target="#modal-template">Assign order</button>
                        </div>';  
                  }
                  //change employee to handle order
                  else
                  {
                        $sub_array[] = 
                        '<div class="text-center">
                              <button type="button" name="assign" data-id="'.$row->order_id.'" class="btn btn-primary btn-xs changeEmployee" data-toggle="modal" data-target="#modal-template">Change Employee</button>
                        </div>';  
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

      //to display modal to assign order to employee
      public function md_assignOrder(){
            return $this->load->view('orders/md_assignOrder.php');
      }

      //to display modal to chnage employee to handle order
      public function md_changeEmployee(){
            return $this->load->view('orders/md_changeEmployee.php');
      }

      //get all employees to fill dropdown
      function get_employee()
      {
            $output = array();  
            $i=0;
            $this->load->model("view_orders_model");  
            $data = $this->view_orders_model->getEmployeeRows();  
            print_r($data);
            foreach($data as $row)  
            {  
                 $output[$i] = $row->employee_id;  
                 $i++;
            } 
          
            echo json_encode($output);
      }

      //get employee name to fill label
      public function getEmployeeName()
      {
            $order_id = $this->input->post('order_id');
            $this->load->model("view_orders_model");  
            $data = $this->view_orders_model->getEmployeeName($order_id);  
            //echo json_encode($data); 
            echo json_encode($data['full_name'] . ' (' . $data['contact_no'] . ')');
      }

      //when assign button in assign order modal is clicked
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

      //when change employee button in change employee modal is clicked
      public function updateEmployeeID(){
            $employee_id=$this->input->post('employee_id');
            $order_id=$this->input->post('order_id');

            $result = $this->view_orders_model->updateEmployeeId($employee_id,$order_id);
            echo json_encode("Employee Id updated");
      }

      //when view order button is clicked to view order details
      public function viewOrderDetailsPage()
      {
            //fill basic details of order such as custome name,order_id,order_date,delivery_date
            $data = array('order_id' => $this->input->post('order_id'),
                        'full_name' => $this->input->post('full_name'),
                        'order_date' => $this->input->post('order_date'),
                        'delivery_date' => $this->input->post('delivery_date')
                  );

            //load page to modal
            $output_page = $this->load->view('orders/view_order_details', $data,TRUE);
            echo json_encode($output_page);
            die();
      }

      //to retrive order details such as item name,service name,quantity,price,total
      public function fetchOrderDetails(){
            $order_id = $this->input->post('order_id');

            //to retrive item and service id
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
           
            //retrive item name from items table
            $item_name = $this->data['data'] = $this->view_orders_model->getItemName($item_id);

            //retrieve service name from services table
            $service_name = $this->data['data'] = $this->view_orders_model->getServiceName($service_id);

            //retrive quantity from order_details table
            $quantity = $this->data['data'] = $this->view_orders_model->getQuantity($id,$order_id);

            //get price from item_service table
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
            foreach( $single_data as $key => $value) 
            {
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