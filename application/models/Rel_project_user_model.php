<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_project_user_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get rel_project_user by id
     */
    function get_rel_project_user($id)
    {
        return $this->db->get_where('rel_project_user',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all rel_project_user
     */
    function get_all_rel_project_user()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('rel_project_user')->result_array();
    }
        
    /*
     * function to add new rel_project_user
     */
    function add_rel_project_user($params)
    {
        $this->db->insert('rel_project_user',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update rel_project_user
     */
    function update_rel_project_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('rel_project_user',$params);
    }
    
    /*
     * function to delete rel_project_user
     */
    function delete_rel_project_user($id)
    {
        return $this->db->delete('rel_project_user',array('id'=>$id));
    }
}
