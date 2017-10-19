<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Project_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get project by id_project
     */
    function get_project($id_project)
    {
        return $this->db->get_where('projects',array('id_project'=>$id_project))->row_array();
    }
        
    /*
     * Get all projects
     */
    function get_all_projects($user_id = null)
    {
        if (is_null($user_id)) {
            $this->db->order_by('id_project', 'desc');
            return $this->db->get('projects')->result_array();
        }else{
            $this->db->order_by('id_project', 'desc');
            $this->db->join('rel_project_user pu', 'p.id_project = pu.project_id');
            $this->db->where('pu.user_id', $user_id);
            return $this->db->get('projects p')->result_array();
        }
    }
        
    /*
     * function to add new project
     */
    function add_project($params)
    {
        $this->db->insert('projects',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update project
     */
    function update_project($id_project,$params)
    {
        $this->db->where('id_project',$id_project);
        return $this->db->update('projects',$params);
    }
    
    /*
     * function to delete project
     */
    function delete_project($id_project)
    {
        $this->db->delete('rel_tasks_project',array('project_id'=>$id_project));
        $this->db->delete('rel_project_user',array('project_id'=>$id_project));
        return $this->db->delete('projects',array('id_project'=>$id_project));
    }

    /*
     * Get project by enterprise_id
     */
    function get_projects_enterprise($enterprise_id)
    {
        return $this->db->get_where('projects',array('enterprise_id'=>$enterprise_id))->result_array();
    }


    function get_project_by_task($task_id)
    {
        $this->db->select('p.*');
        $this->db->join('projects p', 'p.id_project = tp.project_id', 'inner');
        $this->db->where('tp.task_id',$task_id);
        $query = $this->db->get('rel_tasks_project tp')->row_array();
        
        return $query;
    }
}
