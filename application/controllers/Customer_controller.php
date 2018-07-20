<?php
 defined('BASEPATH')OR exit('No direct script access allowed');

 class Customer_controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
       $this->load->model("Customer_model"); 
    } 


     function index(){
      $data["title"]="Orders";
      $this->load->model("Customer_model");
      $data["fetch_data"]=$this->Customer_model->getServices(); 
      $this->load->view('customer_view', $data);
    }

   
  
 public function getItemServiceDetails()
    {
        $service_id =  $this->input->post('service_id');

        $item_service= $this->Customer_model->getItemServiceDetails($service_id);  

       // print_r($item_service);
        $i = 0;
        $data = array();
        foreach($item_service as $key => $value)  
            {  
                $sub_array = array();
                $sub_array[] = $i + 1;
                $sub_array[] = $value['item_name'];
                // $sub_array[] = $value['service_name'];
                $sub_array[] = '<label name="lbl-rate-'. ($i+1) . '">'.$value['price'].' </label>';
                $sub_array[]='<input type="text" name="quantity-'.$value['id'].'" maxlength=2 class="text_qty form-control" data-slno="' . ($i+1) .'" size="3">';
                $sub_array[]='<input type="text" class="form-control" name="txt-total-' . ($i+1) .'" size="3" readonly>';  
                $sub_array[]='<input type="checkbox" class="checkbox check_order" name="check_order" data-id = "'.$value['id'].'">';

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

    function place_order_details()
    {
        $data = array("customer_id" => $this->input->post('customer_id'),
                    "service_id" => $this->input->post('service_id'),
                    'item_name' => $this->input->post('item_name'),
                    "quantity" => $this->input->post('quantity'),
                );

        $result = $this->Customer_model->place_order_details($data);

        if($result)
        {
            echo "inserted";
        }
    }
   
   
}
?>