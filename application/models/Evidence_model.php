<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evidence_model extends CI_Model {

	/*
     * function to add new evidence
     */
	function add_evidence($params)
	{
	    $this->db->insert('evidence',$params);
        return $this->db->insert_id();
	}

	/*
     * Get all evidences
     */
    function get_all_evidences()
    {
        $this->db->order_by('id_evidence', 'desc');
        return $this->db->get('evidence')->result_array();
    }

    /*
     * Get all evidences by task_id
     */
    function get_all_task_evidences($task_id)
    {
        $this->db->order_by('id_evidence', 'desc');
        $this->db->where('task_id', $task_id);
        return $this->db->get('evidence')->result_array();
    }

	/*
     * Get evidence by task_id
     */
    function get_evidence($task_id)
    {
        return $this->db->get_where('evidence',array('task_id'=>$task_id))->row_array();
    }


    function delete_evidence_by_task($task_id)
    {
        return $this->db->delete('evidence',array('task_id'=>$task_id));
    }

}

/* End of file Evidence_model.php */
/* Location: ./application/models/Evidence_model.php */