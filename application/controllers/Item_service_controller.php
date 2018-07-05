<?php
class Item_service_controller extends CI_Controller {  
    public function __construct()
    {
        parent::__construct();
            $this->load->model("Item_service_model");  
    }

    function index()
    {  
        $data["title"] = "Item and Service details";  
        $this->load->view('common/footbar.php');
        $this->load->view('item_service/item_service_details.php',$data);
        $this->load->view('common/end_wrapper.php');
    }

    public function getItemServiceDetails()
    {
    
        $data= $this->Item_service_model->getItemServiceDetails();  
       print_r($data);
        // $item_id = array();  
        // $service_id = array();
        // $id = array();
        // $price = array();
        // foreach ($data as $row)
        // {    
        //       $item_id[] = $row['item_id'];  
        //       $service_id[] = $row['service_id']; 
        //       $id[] = $row['id']; 
        //       $price[] = $row['price'];       
        // }

        // print_r($item_id);

        // $item_name = $this->data['data'] = $this->Item_service_model->getItemName($item_id);
        // $service_name = $this->data['data'] = $this->Item_service_model->getServiceName($service_id);
        
        // print_r($item_name);
        // $count = 0;
        // $i = 0;
        // foreach ($item_name as $key=>$value) {
        //       $count++;
        // }

     
        // while($i != $count)
        // {
        //       $data_values[$i] = array(array_merge($id[$i],$item_name[$i], $service_name[$i], $price[$i])); 
        //       $i++;
        // }
        // $single_data = call_user_func_array('array_merge', $data_values);
        // print_r($single_data);
        // foreach($item_service as $row)  
        //     {  
        //           $sub_array = array();
        //           $sub_array[] = $row->id;
        //           $sub_array[] = $row->item_name;
        //           $sub_array[] = $row->service_name;
        //           $sub_array[] = $row->price;  
        //           $sub_array[] = '<button type="button" name="edit" data-id="'.$row->id.'" class="btn btn-success btn-xs edit" data-toggle="modal" data-target="#modal-template">Edit</button>';  
        //           $sub_array[] = '<button type="button" name="delete" data-id="'.$row->id.'" class="btn btn-warning btn-xs delete" data-toggle="modal" data-target="#modal-template">Delete</button>';  
        //           $data[] = $sub_array;  
                 
        //    }  
          
        //    $output = array(  
        //         "draw"              =>    intval($_POST["draw"]),  
        //         // "recordsTotal"      =>    $this->view_orders_model->get_all_data(),  
        //         // "recordsFiltered"   =>    $this->view_orders_model->get_filtered_data(),  
        //         "data"              =>    $data  
        //    );  

        //    echo json_encode($output);  
    }
}
?>