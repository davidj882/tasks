<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Role_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get role by id_role
     */
    function get_role($id_role)
    {
        return $this->db->get_where('roles',array('id_role'=>$id_role))->row_array();
    }
        
    /*
     * Get all roles
     */
    function get_all_roles()
    {
        $this->db->order_by('id_role', 'desc');
        return $this->db->get('roles')->result_array();
    }
        
    /*
     * function to add new role
     */
    function add_role($params)
    {
        $this->db->insert('roles',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update role
     */
    function update_role($id_role,$params)
    {
        $this->db->where('id_role',$id_role);
        return $this->db->update('roles',$params);
    }
    
    /*
     * function to delete role
     */
    function delete_role($id_role)
    {
        return $this->db->delete('roles',array('id_role'=>$id_role));
    }
}
