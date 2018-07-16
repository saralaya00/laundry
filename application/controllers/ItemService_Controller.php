<?php
class ItemService_Controller extends CI_Controller {  
    public function __construct()
    {
        parent::__construct();
            $this->load->model("Item_service_model");  
    }

    function index()
    {  
        $data["title"] = "Items and Services Configuration";  

        $_POST['services'] = $this->getServices();

        $this->load->view('common/footbar.php');
        $this->load->view('item_service/Item_service_details.php',$data);
        $this->load->view('common/end_wrapper.php');
    }

    public function getServices()
    {
        //Returns an array with service id as index and service name as value
        $services = $this->Item_service_model->getServices();
        $data[] = array();
        $data['placeholder'] = 'Select a Service';

        foreach ($services as $index => $service) {
            $data[$service['service_id']] = $service['service_name'];
        }

        return $data;
    }

    public function getItemServiceDetails()
    {
        $service_id = $this->input->post('id');
        $items = $this->Item_service_model->getItems();

        $item_service= $this->Item_service_model->getItemServiceDetails($service_id);  
        foreach ($items as $key=>$value) {
            $items[$key] = array("item_id" => $value['item_id'],
                        "item_name" => $value['item_name'],
                        "price" => $value['item_name'] );
        } 
        
        $data_items = array();
        $i = 0;

        if(count($item_service)>0 && count($items)>0)
        {
            foreach ($item_service as $key=>$value) {
                $data_items[$i] = array("id" => $value['id'],
                           "item_name" => $value['item_name'],
                           "price" => $value['price'] 
                        );
                $i++;
            } 
            foreach ($items as $key=>$value) {
                $data_items[$i] = array("id" => $value['item_id'],
                           "item_name" => $value['item_name'],
                           "price" => '<input class="form-control" type="text" name="price-'. $value['item_id'].'" id = "price" readonly>'
                        );
                $i++;
            }  
        }
        else{
            foreach ($items as $key=>$value) {
                $data_items[$i] = array("id" => $value['item_id'],
                           "item_name" => $value['item_name'],
                           "price" => '<input class="form-control" type="text" name="price-'. $value['item_id'].'" id = "price" readonly>'
                        );
                $i++;
            } 
        }
     
       
        $j=0;
        foreach($data_items as $key => $value)  
        {  
            $sub_array = array();
            $sub_array[]='<input type="checkbox" name="check" data-check_id ="'.$value['id'].'" >';
            $sub_array[] = $value['item_name'];

            $sub_array[] = $value['price'];  

            if(intval($value['price']) && $value['price'] != 0){
                $sub_array[] = 
                '<div class="text-center">
                    <button type="button" name="edit" data-id="'.$value['id'].'" class="btn btn-secondary btn-sm edit" data-toggle="modal" data-target="#modal-template" width="150%">
                    <span class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></span>
                    </button>  
                    <button type="button" name="delete" data-id="'. $value['id'].'" class="btn btn-danger btn-sm delete" width="150%">
                    <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
                    </button>
                </div>';
            }
            else
            {
                $sub_array[] = 
                '<div class="text-center">
                    <button type="button" name="add" data-id="'. $value['id'].'" class="btn btn-success btn-sm add" width="180%">
                    <span class="fa fa-plus"></span>&nbsp;&nbsp;&nbsp;ADD
                    </button>
                </div>';
            }
           
            $data[] = $sub_array;  
            $j++;
        } 

        $output = array(  
            "draw"              =>    intval($_POST["draw"]),  
            "recordsTotal"      =>    $j,
            "recordsFiltered"   =>    $j,  
            "data"              =>    $data  
        );  

        echo json_encode($output);  
    }

    public function md_edit()
    {
        return $this->load->view('item_service/md_editDetails.php');

    }

    public function updateItem_service()
    {
        $input = array('id' => $this->input->post('id'),
                        // 'service_id' => $this->input->post('service_id'),
                        // 'item_name' => $this->input->post('item_name'),
                        'price' => $this->input->post('price')
                );
    
        $result = $this->Item_service_model->updateItem_service($input);
        if($result == true)
        {    
        echo json_encode("Updated");
        }
    }

    public function deleteItem_service()
    {
        $id = $this->input->post('id');
        $result = $this->Item_service_model->deleteItem_service($id);
        if($result == true)
        {    
            echo json_encode("deleted");
        }
    }

    
}
?>