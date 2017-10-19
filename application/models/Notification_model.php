<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Notification_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get notification by id_notification
     */
    function get_notification($id_notification)
    {
        return $this->db->get_where('notifications',array('id_notification'=>$id_notification))->row_array();
    }


    /*
     * Get notification by id_notification
     */
    function get_notification_by_item($id_item, $type)
    {
        return $this->db->get_where('notifications',array('id_item'=>$id_item, 'type'=>$type))->row_array();
    }
        
    /*
     * Get all notifications
     */
    function get_all_notifications()
    {
        $this->db->order_by('id_notification', 'desc');
        return $this->db->get('notifications')->result_array();
    }
        
    /*
     * function to add new notification
     */
    function add_notification($params)
    {
        $this->db->insert('notifications',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update notification
     */
    function update_notification($id_item,$type,$params)
    {
        $this->db->where('id_item',$id_item);
        $this->db->where('type',$type);
        return $this->db->update('notifications',$params);
    }
    
    /*
     * function to delete notification
     */
    function delete_notification($id_notification)
    {
        return $this->db->delete('notifications',array('id_notification'=>$id_notification));
    }


    function task_progress($user_id)
    {
        # code...
    }

    /*
     * Get notification by id_notification
     */
    function get_notification_users($user_id)
    {
        $this->db->select('n.*, t.name AS task_name, p.name AS project_name');
        $this->db->join('tasks t', 't.id_task = n.id_item', 'left');
        $this->db->join('projects p', 'p.id_project = n.id_item', 'left');
        return $this->db->get_where('notifications n',array('user_id' => $user_id, 'status' => 0))->result_array();
    }
}
