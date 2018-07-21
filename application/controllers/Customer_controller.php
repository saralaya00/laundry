<?php
//  defined('BASEPATH')OR exit('No direct script access allowed');

 class Customer_Controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
       $this->load->model("Customer_model"); 
    //    $this->load->model("Customer_model"); 
    } 


     function index(){
      $data["title"]="Orders";
    //   $this->load->model("Customer_model");
      $data["fetch_data"]=$this->Customer_model->getServices(); 
      $this->load->view('customer_view', $data);
    }

   
  
 public function getItemServiceDetails()
    {
        $service_id =  $this->input->post('service_id');

        $CheckedDetails= $this->Customer_model->getCheckedDetails($service_id);  

        $unCheckedDetails= $this->Customer_model->getUnCheckedDetails($service_id);  
      
        $data_items = array();
        $data =array();
        $i = 0;

        if(count($CheckedDetails)>0)//items already there in item_service table for selected service
        {

            foreach ($CheckedDetails as $key=>$value) {
                $data_items[$i] = array("slno" => $i+1, //id from item_service table
                                        "item_name" => $value['item_name'],
                                        "Rate" => '<label name="lbl-rate-'. ($i+1) . '">'.$value['price'].'  </label>',
                                        "Quantity" => '<div class="quantity-'.$value['id'].'"><label name="lbl-qty-'. ($i+1) . '">'.$value['quantity'].'</label></div>',
                                        "price" => '<div class="price-'.$value['id'].'">'.($value['price']* $value['quantity']).'</div>',
                                        "select" => '<input type="checkbox" class="checkbox check_order" name="check_order" data-slno="'.($i+1).'" data-service_id="'.$service_id.'" data-id = "'.$value['id'].'" checked>'
                                    );
                $i++;
            } 
        }

        if (count($unCheckedDetails)>0)
        {
            foreach ($unCheckedDetails as $key=>$value) {
                $data_items[$i] = array("slno" => $i+1, //id from item_service table
                                        "item_name" => $value['item_name'],
                                        "Rate" => '<label name="lbl-rate-'. ($i+1) . '">'.$value['price'].'  </label>',
                                        "Quantity" =>'<input type="text" name="quantity-'.$value['id'].'" maxlength=2 class="text_qty form-control" data-slno="' . ($i+1) .'" size="3">',
                                        "price" => '<input type="text" class="form-control" name="txt-total-' . ($i+1) .'" size="3" readonly>',
                                        "select" => '<input type="checkbox" class="checkbox check_order" name="check_order" data-slno="'.($i+1).'" data-service_id="'.$service_id.'" data-id = "'.$value['id'].'">'
                                    );
                $i++;
            }  
        }
        $j = 0;
        
        foreach($data_items as $key => $value)  
        {  
            $j++;
            $sub_array = array();
            $sub_array[]= $value['slno'];
            $sub_array[] = $value['item_name'];
            $sub_array[] = $value['Rate'];  
            $sub_array[] = $value['Quantity'];
            $sub_array[] = $value['price'];
            $sub_array[] = $value['select'];

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

    function place_order_details()
    {
        $data = array("id" => $this->input->post('id'),
                    "customer_id" => $this->input->post('customer_id'),
                    "service_id" => $this->input->post('service_id'),
                    'item_name' => $this->input->post('item_name'),
                    "quantity" => $this->input->post('quantity'),
                );
        $order_id = array();
        $order_id = $this->Customer_model->place_order_details($data);
        echo json_encode($order_id);
    }

    function remove_order_details()
    {
        $data = array("customer_id" => $this->input->post('customer_id'),
                    "service_id" => $this->input->post('service_id'),
                    'item_name' => $this->input->post('item_name')
                );

        $result = $this->Customer_model->remove_order_details($data);

       
    }

    // function update_status()
    // {
    //     $order_id = $this->input->post('order_id');
    //     $result = $this->Customer_model->update_status($order_id);

    //     if($result)
    //     {
    //         echo json_encode("updated");
    //     }
    // }

    public function fetchOrderDetails(){
        $order_id = $this->input->post('order_id');
        $result = $this->Customer_model->fetchOrderDetails($order_id);
        
        $i = 0;
        $data = array();
        foreach($result[] as $key => $value)  
        {  
            $i++;
              $sub_array = array();
              $sub_array[] = $i;
              $sub_array[] = $value['item_name'];
              $sub_array[] = $value['service_name'];  
              $sub_array[] = $value['price'];  
              $sub_array[] = $value['quantity'];
              $sub_array[] = (($value['quantity']) *($value['price']));

              $data[] = $sub_array;  
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