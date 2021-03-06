<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Status_task_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get status_task by id_status
     */
    function get_status_task($id_status)
    {
        return $this->db->get_where('status_task',array('id_status'=>$id_status))->row_array();
    }
        
    /*
     * Get all status_task
     */
    function get_all_status_task()
    {
        $this->db->order_by('id_status', 'desc');
        return $this->db->get('status_task')->result_array();
    }
        
    /*
     * function to add new status_task
     */
    function add_status_task($params)
    {
        $this->db->insert('status_task',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update status_task
     */
    function update_status_task($id_status,$params)
    {
        $this->db->where('id_status',$id_status);
        return $this->db->update('status_task',$params);
    }
    
    /*
     * function to delete status_task
     */
    function delete_status_task($id_status)
    {
        return $this->db->delete('status_task',array('id_status'=>$id_status));
    }
}
