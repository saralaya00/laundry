<?php
 defined('BASEPATH')OR exit('No direct script access allowed');

 class Customer extends CI_Controller{

     function index(){
      $data["title"]="Codeigniter Ajax CRUD with Data Tables and Bootstrap Modals";
      $this->load->view('customer_view',$data);
    }

    function fetch_user()
    {
     $this->load->model("customer_model");
     $fetch_data=$this->customer_model->make_datatables();
     $data=array();
     foreach($fetch_data as $row)
     {
       $sub_array=array();
       $sub_array[]='<img src="'.base_url().'upload/'.$row->image.'"
          class="img-thumbnail" width="50" height="35" />';
          $sub_array[]=$row->first_name;  
          $sub_array[]=$row->last_name;
          $sub_array[]='<input type="text" name="check" size="3">';
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
 }