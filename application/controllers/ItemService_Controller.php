<?php
class ItemService_Controller extends CI_Controller {  
    public function __construct()
    {
        parent::__construct();
        //load item_service_model
        $this->load->model("Item_service_model");  
    }

    function index()
    {  
        //title of page
        $data["title"] = "Items and Services Configuration";  

        //retrieve service to fill dropdown
        $_POST['services'] = $this->getServices();

        //load view_item_service page
        $this->load->view('common/footbar.php');
        $this->load->view('item_service/view_item_service.php',$data);
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

    //get item and service details which is alredy added in item_service table for selected service
    public function getItemServiceDetails()
    {
        $service_id = $this->input->post('id');

        //get item and service details which is alredy added in item_service table for selected service
        $item_service= $this->Item_service_model->getItemServiceDetails($service_id);  
       
        //get item details which is not added to item_service table
        $items = $this->Item_service_model->getItems();

        //change items to associative array
        foreach ($items as $key=>$value)
        {
            $items[$key] = array("item_id" => $value['item_id'],
                                "item_name" => $value['item_name'],
                                "price" => ' '
                            );
        } 
        
        $data_items = array();
        $i = 0;

        if(count($item_service)>0 && count($items)>0)//items already there in item_service table for selected service
        {
            foreach ($item_service as $key=>$value) {
                $data_items[$i] = array("id" => $value['id'], //id from item_service table
                           "item_name" => $value['item_name'],
                           "price" => $value['price'] 
                        );
                $i++;
            } 
            foreach ($items as $key=>$value) {
                $data_items[$i] = array("id" => $value['item_id'],//item_id from items table
                           "item_name" => $value['item_name'],
                            //create text box to enter price
                            "price" => '<input class="form-control" type="text" maxlength="4" placeholder="Enter Price" name="price-'. $value['item_id'].'">'
                        );
                $i++;
            }  
        }
        else//add only items from items table
        {
            foreach ($items as $key=>$value) {
                $data_items[$i] = array("id" => $value['item_id'],//item_id from items table
                           "item_name" => $value['item_name'],
                           //create text box to enter price
                           "price" => '<input class="form-control" type="text" maxlength="4" placeholder="Enter Price" name="price-'. $value['item_id'].'">'
                        );
                $i++;
            } 
        }
     
       
        $j=0;
        foreach($data_items as $key => $value)  
        {  
            $j++;
            $sub_array = array();
            $sub_array[]= $j;
            $sub_array[] = $value['item_name'];
            $sub_array[] = $value['price'];  

            if(intval($value['price']) && $value['price'] != 0){
                //button for edit and delete for items which is already added
                $sub_array[] = 
                '<div class="text-center">
                    <button type="button" name="edit" data-id="'.$value['id'].'" class="btn btn-secondary btn-sm edit" data-toggle="modal" data-target="#modal-template">
                    <span class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></span>
                    </button>  
                    <button type="button" name="delete" data-id="'. $value['id'].'" class="btn btn-danger btn-sm delete">
                    <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
                    </button>
                </div>';
            }
            else
            {
                //button for adding for item service details
                $sub_array[] = 
                '<div class="text-center">
                    <button type="button" name="add" data-id="'. $value['id'].'" class="btn_add btn btn-success btn-sm">
                    <span class="fa fa-plus"></span>&nbsp;&nbsp;&nbsp;ADD
                    </button>
                </div>';
            }
            $data[] = $sub_array;  
        } 

        $output = array(  
            "draw"              =>    intval($_POST["draw"]),  
            "recordsTotal"      =>    $j,
            "recordsFiltered"   =>    $j,  
            "data"              =>    $data  
        );  
        echo json_encode($output);  
    }

    //to display edit modal to edit price
    public function md_edit()
    {
        return $this->load->view('item_service/md_editDetails.php');

    }

    //to update price when update button of edit modal is clicked
    public function updateItem_service()
    {
        $input = array('id' => $this->input->post('id'),
                        'price' => $this->input->post('price')
                );
    
        $result = $this->Item_service_model->updateItem_service($input);
        if($result == true)
        {    
        echo json_encode("Updated");
        }
    }

    //to delete item and service details
    public function deleteItem_service()
    {
        $id = $this->input->post('id');
        $result = $this->Item_service_model->deleteItem_service($id);
        if($result == true)
        {    
            echo json_encode("deleted");
        }
    }

    //to add item and service details to item service table
    public function addItemService(){


        //Not used anymore


        $data = array('service_id' => $this->input->post('service_id'),
                    'id' => $this->input->post('id'),
                    'item_name' => $this->input->post('item_name'),
                    'price' => $this->input->post('item_name')
                );
        $result = $this->Item_service_model->addItemService($data);
        if($result == true)
        {    
            echo json_encode("Inserted");
        }        
    }

    //Add item_service directly >>>> final
    public function add_item_service()
    {
        $data = array(
            'item_id' => $this->input->post('item_id'),
            'service_id' => $this->input->post('service_id'),
            'price' => $this->input->post('price')
        );

        $result = $this->Item_service_model->add_item_service($data);
        return $result;
    }
}
?>