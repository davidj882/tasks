<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Enterprise_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get enterprise by id_enterprise
     */
    function get_enterprise($id_enterprise)
    {
        return $this->db->get_where('enterprises',array('id_enterprise'=>$id_enterprise))->row_array();
    }
        
    /*
     * Get all enterprises
     */
    function get_all_enterprises()
    {
        $this->db->order_by('id_enterprise', 'desc');
        return $this->db->get('enterprises')->result_array();
    }
        
    /*
     * function to add new enterprise
     */
    function add_enterprise($params)
    {
        $this->db->insert('enterprises',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update enterprise
     */
    function update_enterprise($id_enterprise,$params)
    {
        $this->db->where('id_enterprise',$id_enterprise);
        return $this->db->update('enterprises',$params);
    }
    
    /*
     * function to delete enterprise
     */
    function delete_enterprise($id_enterprise)
    {
        return $this->db->delete('enterprises',array('id_enterprise'=>$id_enterprise));
    }
}
