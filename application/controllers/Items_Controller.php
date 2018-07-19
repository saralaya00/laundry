<?php 
class Items_Controller extends CI_Controller
{
    function index()
    {
        $data['title'] = 'View Items';
        $this->load->view('item/view_items', $data);
    }

    function fetch_items()
    {
        $this->load->model('Item_model');

        $draw = intval($this->input->get('draw'));
        $start = intval($this->input->get('start'));
        $length = intval($this->input->get('length'));

        $itemsList = $this->Item_model->fetch_items();
        $data = array();

        foreach ($itemsList->result() as $row) {
            $data[] = array(
                $row->item_id,
                $row->item_name,
            //     '<div class="text-center">
            //     <button class="btn_edit btn btn-secondary btn-sm text-center" data-employee_id="'.$row->item_id.'" data-toggle="modal" data-target="#modal-template">
            //         <span class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></span>
            //     </button>
            //     <button class="btn_delete btn btn-danger btn-sm text-center" data-employee_id="'.$row->item_id.'" data-toggle="modal" data-target="#modal-template">
            //         <span class="fa fa-times" data-toggle="tooltip" data-placement="top" title="Delete"></span>
            //     </button>
            // </div>'
            );
        }

        $itemsDT = array(
            "draw" => $draw,
            "recordsTotal" => $itemsList->num_rows(),
            "recordsFiltered" => $itemsList->num_rows(),
            "data" => $data
        );
        echo json_encode($itemsDT);
    }
}
?>