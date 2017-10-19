<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Permission_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get permission by id_permission
     */
    function get_permission($id_permission)
    {
        return $this->db->get_where('permissions',array('id_permission'=>$id_permission))->row_array();
    }
        
    /*
     * Get all permissions
     */
    function get_all_permissions()
    {
        $this->db->order_by('id_permission', 'desc');
        return $this->db->get('permissions')->result_array();
    }
        
    /*
     * function to add new permission
     */
    function add_permission($params)
    {
        $this->db->insert('permissions',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update permission
     */
    function update_permission($id_permission,$params)
    {
        $this->db->where('id_permission',$id_permission);
        return $this->db->update('permissions',$params);
    }
    
    /*
     * function to delete permission
     */
    function delete_permission($id_permission)
    {
        return $this->db->delete('permissions',array('id_permission'=>$id_permission));
    }
}
