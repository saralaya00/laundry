<?php
class ItemService_Controller extends CI_Controller {  
    public function __construct()
    {
        parent::__construct();
            $this->load->model("Item_service_model");  
    }

    function index()
    {  
        $data["title"] = "Item and Service details";  
        $this->load->view('common/footbar.php');
        $this->load->view('item_service/Item_service_details.php',$data);
        $this->load->view('common/end_wrapper.php');
    }

    public function getItemServiceDetails()
    {
    
        $item_service= $this->Item_service_model->getItemServiceDetails();  
        $i = 0;
        foreach($item_service as $key => $value)  
            {  
                $sub_array = array();
                // $sub_array[] = $i+1;
                $sub_array[]='<input type="checkbox" name="check">';
                $sub_array[] = $value['item_name'];
                // $sub_array[] = $value['service_name'];
                $sub_array[] = $value['price'];  
                $sub_array[] = '<button type="button" name="edit" data-id="'.$value['id'].'" class="btn btn-secondary btn-sm edit" data-toggle="modal" data-target="#modal-template" width="150%">
                    <span class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></span>
                    </button> &nbsp;'  
                             .'<button type="button" name="delete" data-id="'. $value['id'].'" class="btn btn-danger btn-sm delete" width="150%">
                                <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
                                </button>';
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
}
?>