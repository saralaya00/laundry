<?php
class Items_Model extends CI_Model
{
    var $table="items";

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_all_data()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
?>