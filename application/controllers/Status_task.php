<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Status_task extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Status_task_model');
    } 

    /*
     * Listing of status_task
     */
    function index()
    {
        $data['status_task'] = $this->Status_task_model->get_all_status_task();
        
        $data['_view'] = 'status_task/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new status_task
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','required|max_length[255]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'name' => $this->input->post('name'),
            );
            
            $status_task_id = $this->Status_task_model->add_status_task($params);
            redirect('status_task/index');
        }
        else
        {            
            $data['_view'] = 'status_task/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a status_task
     */
    function edit($id_status)
    {   
        // check if the status_task exists before trying to edit it
        $data['status_task'] = $this->Status_task_model->get_status_task($id_status);
        
        if(isset($data['status_task']['id_status']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','required|max_length[255]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Status_task_model->update_status_task($id_status,$params);            
                redirect('status_task/index');
            }
            else
            {
                $data['_view'] = 'status_task/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The status_task you are trying to edit does not exist.');
    } 

    /*
     * Deleting status_task
     */
    function remove($id_status)
    {
        $status_task = $this->Status_task_model->get_status_task($id_status);

        // check if the status_task exists before trying to delete it
        if(isset($status_task['id_status']))
        {
            $this->Status_task_model->delete_status_task($id_status);
            redirect('status_task/index');
        }
        else
            show_error('The status_task you are trying to delete does not exist.');
    }
    
}
