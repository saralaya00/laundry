<?php 
class Services_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load item_service_model
        $this->load->model("Service_model");  
    }

    function index()
    {
        $data['title'] = 'View Items';
        $this->load->view('service/view_services', $data);
    }

    public function md_edit()
    {
        return $this->load->view('service/md_edit');

    }
    function fetch_services()
    {
      
        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));

        $serviceList = $this->Service_model->fetch_services();
        $data = array();

        foreach ($serviceList->result() as $row) {
            $data[] = array(
                $row->service_id,
                $row->service_name,
                // '<div class="text-center">
                //     <button class="btn_delete btn btn-danger btn-sm text-center" data-service_id="'.$row->service_id.'" data-target="#modal-template">
                //         <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
                //     </button>
                // </div>'
            );
        }

        $serviceDT = array(
            "draw" => $draw,
            "recordsTotal" => $serviceList->num_rows(),
            "recordsFiltered" => $serviceList->num_rows(),
            "data" => $data
        );
        echo json_encode($serviceDT);
    }

    // public function delete_service(){
    //     $service_id =  $this->input->post('service_id');
              
    //     $result = $this->Service_model->delete_service($service_id);

    //     if($result == true)
    //     {    
    //     echo json_encode("Deleted");
    //     }
    // }
}
?>