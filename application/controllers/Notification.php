<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Notification extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Notification_model');
    } 

    /*
     * Listing of notifications
     */
    function index()
    {
        $data['notifications'] = $this->Notification_model->get_all_notifications();
        
        $data['_view'] = 'notification/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new notification
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('user_id','User Id','required|integer');
		$this->form_validation->set_rules('type','Type','required|integer');
		$this->form_validation->set_rules('status','Status','integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'user_id' => $this->input->post('user_id'),
				'type' => $this->input->post('type'),
				'status' => $this->input->post('status'),
            );
            
            $notification_id = $this->Notification_model->add_notification($params);
            redirect('notification/index');
        }
        else
        {
			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();
            
            $data['_view'] = 'notification/add';
            $this->load->view('layouts/main',$data);
        }
    } 

    /*
     * Deleting notification
     */
    function remove($id_notification)
    {
        $notification = $this->Notification_model->get_notification($id_notification);

        // check if the notification exists before trying to delete it
        if(isset($notification['id_notification']))
        {
            $this->Notification_model->delete_notification($id_notification);
            redirect('notification/index');
        }
        else
            show_error('The notification you are trying to delete does not exist.');
    }
    
}
