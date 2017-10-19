<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_enterprise_user_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get rel_enterprise_user by id
     */
    function get_rel_enterprise_user($id)
    {
        return $this->db->get_where('rel_enterprise_user',array('id'=>$id))->row_array();
    }
        
    /*
     * Get all rel_enterprise_user
     */
    function get_all_rel_enterprise_user()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('rel_enterprise_user')->result_array();
    }
        
    /*
     * function to add new rel_enterprise_user
     */
    function add_rel_enterprise_user($params)
    {
        $this->db->insert('rel_enterprise_user',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update rel_enterprise_user
     */
    function update_rel_enterprise_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('rel_enterprise_user',$params);
    }
    
    /*
     * function to delete rel_enterprise_user
     */
    function delete_rel_enterprise_user($id)
    {
        return $this->db->delete('rel_enterprise_user',array('id'=>$id));
    }

    /*
     * Get rel_enterprise_user by id
     */
    function get_rel_enterprise_user_id($user_id)
    {
        return $this->db->get_where('rel_enterprise_user',array('user_id'=>$user_id))->row_array();
    }
}
