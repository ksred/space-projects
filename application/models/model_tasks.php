<?php
class Model_tasks extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database("default", TRUE);
    }
    
    function add ($data) {
        $this->db->insert("tasks", $data);
        return $this->db->insert_id();
    }
    
    function add_task ($data) {
        $result = $this->db->insert("tasks", $data);
        return $this->db->insert_id();
    }

    function fetch_all_by_project($project) {
    	$this->db->select('*');
    	$this->db->from('tasks');
    	$this->db->where('project_id', $project);
		$result = $this->db->get();
		return $result;
    }

    function update_task ($id, $status) {
        $this->db->where("id", $id);
        $result = $this->db->update("tasks", array("status" => $status));
        return $result;
    }

    function delete_task($id) {
        $data = array("id" => $id);
        $result = $this->db->delete("tasks", $data);
		return $result;
    }
}
?>
