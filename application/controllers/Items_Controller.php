<?php 
class Items_Controller extends CI_Controller
{
    function index()
    {
        $data['title'] = 'View Items';
        $this->load->view('view_items', $data);
    }

    function fetch_items()
    {
        $this->load->model('Items_model');
    }
}
?>