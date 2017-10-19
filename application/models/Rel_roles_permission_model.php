<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_roles_permission_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get rel_roles_permission by id
     */
    function get_rel_roles_permission($id)
    {
        return $this->db->get_where('rel_roles_permissions',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all rel_roles_permissions
     */
    function get_all_rel_roles_permissions()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('rel_roles_permissions')->result_array();
    }
        
    /*
     * function to add new rel_roles_permission
     */
    function add_rel_roles_permission($params)
    {
        $this->db->insert('rel_roles_permissions',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update rel_roles_permission
     */
    function update_rel_roles_permission($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('rel_roles_permissions',$params);
    }
    
    /*
     * function to delete rel_roles_permission
     */
    function delete_rel_roles_permission($id)
    {
        return $this->db->delete('rel_roles_permissions',array('id'=>$id));
    }
}
