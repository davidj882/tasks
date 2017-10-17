<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Development_model extends CI_Model {

	/*
     * function to add new development
     */
	function add_development($params)
	{
	    $this->db->insert('developments',$params);
        return $this->db->insert_id();
	}

	/*
     * Get all developments
     */
    function get_all_developments()
    {
        $this->db->order_by('id_development', 'desc');
        return $this->db->get('developments')->result_array();
    }

    /*
     * Get all developments by task_id
     */
    function get_all_task_developments($task_id)
    {
        $this->db->order_by('id_development', 'desc');
        $this->db->where('task_id', $task_id);
        $this->db->join('tasks t', 't.id_task = d.task_id');
        return $this->db->get('developments d')->result_array();
    }

	/*
     * Get development by task_id
     */
    function get_development($task_id)
    {
        return $this->db->get_where('developments',array('task_id'=>$task_id))->row_array();
    }

    function delete_development_by_task($task_id)
    {
        return $this->db->delete('developments',array('task_id'=>$task_id));
    }
}

/* End of file Development_model.php */
/* Location: ./application/models/Development_model.php */