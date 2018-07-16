<?php
 defined('BASEPATH')OR exit('No direct script access allowed');

 class Customer_controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
       $this->load->model("Customer_model"); 
    } 


     function index(){
      $data["title"]="Codeigniter Ajax CRUD with Data Tables and Bootstrap Modals";
      $this->load->model("Customer_model");
      $data["fetch_data"]=$this->Customer_model->getServices(); 
      $this->load->view('customer_view', $data);
    }

   
      

    /*function fetch_user()
    {
     $this->load->model("customer_model");
     $fetch_data=$this->customer_model->make_datatables();
     $data=array();
     foreach($fetch_data as $row)
     {
       $sub_array=array();
       $sub_array[]=$row->id;
          $sub_array[]=$row->item_name;  
          $sub_array[]=$row->service_name;
          $sub_array[]=$row->price;
          $sub_array[]='<input type="text" name="check2" size="3">';
          $sub_array[]='<input type="text" name="check3" size="3">';
          $sub_array[]='<button type="button" name="update" id="'.$row->id.'"
                        class="btn btn-warning btn-xs">Update</button>';
          $sub_array[]='<button type="button" name="delete" id="'.$row->id.'"
                        class="btn btn-danger btn-xs">Delete</button>';
          $sub_array[]='<input type="checkbox" name="check">';
          $data[]=$sub_array;

        }
        $output=array(
          "draw"            => intval($_POST["draw"]),
          "recordsTotal"    => $this->customer_model->get_all_data(),
          "recordsFiltered" => $this->customer_model->get_filtered_data(),
          "data"            => $data
        );
        echo json_encode($output);
    }
 }*/
 public function getItemServiceDetails()
    {
    
        $item_service= $this->Customer_model->getItemServiceDetails();  
       // print_r($item_service);
        $i = 0;
        foreach($item_service as $key => $value)  
            {  
                $sub_array = array();
                $sub_array[] = $i+1;
                $sub_array[] = $value['item_name'];
                $sub_array[] = $value['service_name'];
                $sub_array[] = $value['price'];
                $sub_array[]='<input type="text" name="check2" size="3">';
                $sub_array[]='<input type="text" name="check3" size="3">';  
                $sub_array[] = '<button type="button" name="edit" data-id="'.$value['id'].'" class="btn btn-success btn-xs edit" data-toggle="modal" data-target="#modal-template" width="150%">Edit</button>';  
                $sub_array[] = '<button type="button" name="delete" data-id="'. $value['id'].'" class="btn btn-warning btn-xs delete" width="150%">Delete</button>';  
                $sub_array[]='<input type="checkbox" name="check">';

                $data[] = $sub_array;  
                $i++;
           }  
          
           $output = array(  
                "draw"              =>    intval($_POST["draw"]),  
                "recordsTotal"      =>    $i,
                "recordsFiltered"   =>    $i,  
                "data"              =>    $data  
           );  

           echo json_encode($output);  
    }


   
    // public function getItem()
    // {
    //     $output = array();  
    //     $i=0;
    //     $data = $this->Customer_model->getItem();  
    //     foreach($data as $row)  
    //     {  
    //          $output[$i] = $row;  
    //          $i++;
    //     }  
    //     echo json_encode($output);
    // }

    // public function getService()
    // {
    //     $output = array();  
    //     $i=0;
    //     $data = $this->Customer_model->getService();  
    //     foreach($data as $row)  
    //     {  
    //          $output[$i] = $row;  
    //          $i++;
    //     }  
    //     echo json_encode($output);
    // }

    // public function updateItem_service()
    // {
    //     $input = array('id' => $this->input->post('id'),
    //                     'service_name' => $this->input->post('service_name'),
    //                     'item_name' => $this->input->post('item_name'),
    //                     'price' => $this->input->post('price')
    //             );
    
    //    $result = $this->customer_model->updateItem_service($input);
    //    if($result == true)
    //    {    
    //     echo json_encode("Updated");
    //    }
    // }

    // public function deleteItem_service()
    // {
    //     $id = $this->input->post('id');
    //     $result = $this->customer_model->deleteItem_service($id);
    //     if($result == true)
    //     {    
    //         echo json_encode("deleted");
    //     }
    // }
}
?>