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

    function update_task ($id, $status) {
        $this->db->where("id", $id);
        $result = $this->db->update("tasks", array("status" => $status));
        return $result;
    }

    function update_order_item_meta($user_id, $order_id, $item_meta_id) {
        $this->db->where("user_id", $user_id);
        $this->db->where("id", $order_id);
        $data = array("item_meta_id", $item_meta_id);
        $result = $this->db->update("orders_items", $data);
        return $result;
    }

    function delete_order($user_id, $order_id) {
        $data = array("user_id" => $user_id, "id" => $order_id);
        $result_o = $this->db->delete("orders", $data);
        $data = array("user_id" => $user_id, "order_id" => $order_id);
        $result_oi = $this->db->delete("orders_items", $data);
        $result_on = $this->db->delete("orders_notes", $data);
        //Make sure all were successful
        if (($result_o == 1) && ($result_oi == 1) && ($result_on == 1)) {
        	return 1;
        } else {
        	return 0;
        }
    }

    function delete_order_item($user_id, $order_id, $item_id, $order_item_id) {
        $data = array("user_id" => $user_id, "order_id" => $order_id, "item_id" => $item_id, "id" => $order_item_id);
        $result = $this->db->delete("orders_items", $data);
		return $result;
    }
}
?>
