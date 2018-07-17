<?php 
class Services_Controller extends CI_Controller
{
    function index()
    {
        $data['title'] = 'View Items';
        $this->load->view('service/view_services', $data);
    }

    function fetch_services()
    {
        $this->load->model('Service_model');

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));

        $serviceList = $this->Service_model->fetch_services();
        $data = array();

        foreach ($serviceList->result() as $row) {
            $data[] = array(
                $row->service_id,
                $row->service_name,
                '<div class="text-center">
                    <button class="btn_edit btn btn-secondary btn-sm text-center" data-employee_id="'.$row->service_id.'" data-toggle="modal" data-target="#modal-template">
                        <span class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></span>
                    </button>
                    <button class="btn_delete btn btn-danger btn-sm text-center" data-employee_id="'.$row->service_id.'" data-toggle="modal" data-target="#modal-template">
                        <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
                    </button>
                </div>'
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
}
?>