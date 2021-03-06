<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Message_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get message by id_message
     */
    function get_message($id_message)
    {
        $this->db->select('m.*, u.*, CONCAT_WS(" ", name, lastname) AS fullname');
        $this->db->join('users u', 'u.id_user = m.to');
        return $this->db->get_where('messages m',array('id_message'=>$id_message))->row_array();
    }
        
    /*
     * Get all messages
     */
    function get_all_messages()
    {
        $this->db->order_by('id_message', 'desc');
        return $this->db->get('messages')->result_array();
    }
        
    /*
     * function to add new message
     */
    function add_message($params)
    {
        $this->db->insert('messages',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update message
     */
    function update_message($id_message,$params)
    {
        $this->db->where('id_message',$id_message);
        return $this->db->update('messages',$params);
    }
    
    /*
     * function to delete message
     */
    function delete_message($id_message)
    {
        return $this->db->delete('messages',array('id_message'=>$id_message));
    }

    function get_messages_sent($user_id)
    {
        $this->db->select('m.*, u.*, CONCAT_WS(" ", name, lastname) AS fullname');
        $this->db->join('users u', 'u.id_user = m.to');
        return $this->db->get_where('messages m',array('from'=>$user_id))->result_array();
    }

    function get_messages_inbox($user_id)
    {
        $this->db->select('m.*, u.*, CONCAT_WS(" ", name, lastname) AS fullname');
        $this->db->join('users u', 'u.id_user = m.to');
        return $this->db->get_where('messages m',array('to'=>$user_id))->result_array();
    }

    function get_messages_not_read($user_id)
    {
        return $this->db->get_where('messages',array('to'=>$user_id, 'status' => 0))->num_rows();
    }

    function messages_not_read($user_id)
    {
        return $this->db->get_where('messages',array('to'=>$user_id, 'status' => 0))->result_array();
    }

    function image_from($id_message)
    {
        $this->db->select("picture, CONCAT_WS(' ', u.name, u.lastname) AS fullname");
        $this->db->join('users u', 'm.`from` = u.id_user');
        $this->db->where('m.id_message', $id_message);
        return $this->db->get('messages m')->row_array();
    }

    function times_diff($date)
    {
        $today      = date('Y-m-d H:i:s');
        $datetime1  = date_create($today);
        $datetime2  = date_create($date);
        $interval   = date_diff($datetime1, $datetime2);

        $minutes    = $interval->format('%M');
        //$diff = $interval->format('%R%a días');
        return $minutes;
    }
}
