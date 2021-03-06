<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_tasks_project_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get rel_tasks_project by id
     */
    function get_rel_tasks_project($id)
    {
        return $this->db->get_where('rel_tasks_project',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all rel_tasks_project
     */
    function get_all_rel_tasks_project($project_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('project_id', $project_id);
        return $this->db->get('rel_tasks_project')->result_array();
    }
        
    /*
     * function to add new rel_tasks_project
     */
    function add_rel_tasks_project($params)
    {
        $this->db->insert('rel_tasks_project',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update rel_tasks_project
     */
    function update_rel_tasks_project($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('rel_tasks_project',$params);
    }
    
    /*
     * function to delete rel_tasks_project
     */
    function delete_by_task($task_id)
    {
        return $this->db->delete('rel_tasks_project',array('task_id'=>$task_id));
    }
}
