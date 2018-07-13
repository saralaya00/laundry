<?php
// class Item_service_controller extends CI_Controller {  
//     public function __construct()
//     {
//         parent::__construct();
//             $this->load->model("Item_service_model");  
//     }

//     function index()
//     {  
//         $data["title"] = "Item and Service details";  
//         $this->load->view('common/footbar.php');
//         $this->load->view('item_service/item_service_details.php',$data);
//         $this->load->view('common/end_wrapper.php');
//     }

//     public function md_edit()
//     {
//         return $this->load->view('item_service/md_editDetails.php');

//     }

//     public function getItemServiceDetails()
//     {
    
//         $item_service= $this->Item_service_model->getItemServiceDetails();  
//        // print_r($item_service);
//         $i = 0;
//         foreach($item_service as $key => $value)  
//             {  
//                 $sub_array = array();
//                 $sub_array[] = $i+1;
//                 $sub_array[] = $value['item_name'];
//                 $sub_array[] = $value['service_name'];
//                 $sub_array[] = $value['price'];  
//                 $sub_array[] = '<button type="button" name="edit" data-id="'.$value['id'].'" class="btn btn-success btn-xs edit" data-toggle="modal" data-target="#modal-template" width="150%">Edit</button>';  
//                 $sub_array[] = '<button type="button" name="delete" data-id="'. $value['id'].'" class="btn btn-warning btn-xs delete" width="150%">Delete</button>';  
//                 $data[] = $sub_array;  
//                 $i++;
//            }  
          
//            $output = array(  
//                 "draw"              =>    intval($_POST["draw"]),  
//                 "recordsTotal"      =>    $i,
//                 "recordsFiltered"   =>    $i,  
//                 "data"              =>    $data  
//            );  

//            echo json_encode($output);  
//     }

//     public function getItem()
//     {
//         $output = array();  
//         $i=0;
//         $data = $this->Item_service_model->getItem();  
//         foreach($data as $row)  
//         {  
//              $output[$i] = $row;  
//              $i++;
//         }  
//         echo json_encode($output);
//     }

//     public function getService()
//     {
//         $output = array();  
//         $i=0;
//         $data = $this->Item_service_model->getService();  
//         foreach($data as $row)  
//         {  
//              $output[$i] = $row;  
//              $i++;
//         }  
//         echo json_encode($output);
//     }

//     public function updateItem_service()
//     {
//         $input = array('id' => $this->input->post('id'),
//                         'service_name' => $this->input->post('service_name'),
//                         'item_name' => $this->input->post('item_name'),
//                         'price' => $this->input->post('price')
//                 );
    
//        $result = $this->Item_service_model->updateItem_service($input);
//        if($result == true)
//        {    
//         echo json_encode("Updated");
//        }
//     }

//     public function deleteItem_service()
//     {
//         $id = $this->input->post('id');
//         $result = $this->Item_service_model->deleteItem_service($id);
//         if($result == true)
//         {    
//             echo json_encode("deleted");
//         }
//     }
// }

?> 