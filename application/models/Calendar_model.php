<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {

	public function get_events($profile, $user_id)
	{
		// OLD data
		/// $start, $end
		// CORE
	    //return $this->db->where("date_start >=", $start)->where("date_end <=", $end)->get("tasks");
	    //return $this->db->where("date_start >=", $start)->get("tasks");

	    /// ESTE ES EL BUENO
	    if ($profile == 1) {
	    	
	    	return $this->db->get("tasks")->result();

	    }elseif ($profile == 2) {
	    	
			/*$query_tasks_user 		= $this->get_tasks_user($user_id);
	    	$query_projects_task 	= $this->get_tasks_project($user_id);

			$result = array_merge($query_projects_task, $query_tasks_user);

			$result = array_unique($result);*/

			$result = $this->get_task_user($user_id);

	    	return $result;

	    }elseif ($profile > 2) {

	    	$this->db->select('t.*');    
			$this->db->from('rel_tasks_users tu');
			$this->db->join('tasks t', 't.id_task = tu.task_id');
			$this->db->where('user_id', $user_id);
			//$this->db->where('date_delivered IS NULL', null, false);
			$query_tasks_user = $this->db->get()->result();

			return $query_tasks_user;
	    }
	}

	public function add_event($data)
	{
	    $this->db->insert("tasks", $data);
	}

	public function get_event($id)
	{
	    return $this->db->where("id_task", $id)->get("tasks");
	}

	public function update_event($id, $data)
	{
	    $this->db->where("id_task", $id)->update("tasks", $data);
	}

	public function delete_event($id)
	{
	    $this->db->where("id_task", $id)->delete("tasks");
	}

	public function get_tasks_user($user_id)
	{
		$this->db->select('t.*');    
		$this->db->from('rel_tasks_users tu');
		$this->db->join('tasks t', 't.id_task = tu.task_id');
		$this->db->where('user_id', $user_id);
		//$this->db->where('date_delivered IS NULL', null, false);
		$query_tasks_user = $this->db->get()->result();

		return $query_tasks_user;
	}

	public function get_tasks_project($user_id)
	{
		$this->db->select('t.*');    
		$this->db->from('rel_project_user pu');
		$this->db->join('rel_tasks_project tp', 'pu.project_id = pu.project_id');
		$this->db->join('tasks t', 't.id_task = tp.task_id');
		$this->db->where('user_id', $user_id);
		//$this->db->where('date_delivered IS NULL', null, false);
		$query_projects_task = $this->db->get()->result();

		return $query_projects_task;
	}

	public function get_task_user($user_id)
	{
		$this->db->select('t.*, tu.user_id AS id_compare');    
		$this->db->from('tasks t');
		$this->db->join('rel_tasks_project tp', 'tp.task_id = t.id_task','left');
		$this->db->join('rel_tasks_users tu', 'tu.task_id = t.id_task','left');
		$this->db->join('rel_project_user pu', 'pu.project_id = tp.project_id','left');
		$this->db->where('pu.user_id', $user_id)->or_where('tu.user_id', $user_id);
		//$this->db->where('date_delivered IS NULL', null, false);
		$query_projects_task = $this->db->get()->result();

		return $query_projects_task;
	}

}

/* End of file Calendar_model.php */
/* Location: ./application/models/Calendar_model.php */