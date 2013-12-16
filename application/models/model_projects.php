<?php
class Model_projects extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
    function add ($data) {
        $this->db->insert("projects", $data);
        return $this->db->insert_id();
    }
    
    function add_task ($data) {
        $result = $this->db->insert("tasks", $data);
        return $this->db->insert_id();
    }

    function fetch() {
    	$this->db->select('*');
    	$this->db->from('projects');
    	$this->db->order_by('id desc');
		$result = $this->db->get();
		return $result;
    }

    function fetch_one($id) {
    	$this->db->select('*');
    	$this->db->from('projects');
    	$this->db->where('id', $id);
		$result = $this->db->get();
		return $result;
    }

}
?>
