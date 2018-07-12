<?php
class Item_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_item($item_data)
    {
        $this->db->insert('items',$item_data);
        return $this->db->affected_rows();
    }
}
?>