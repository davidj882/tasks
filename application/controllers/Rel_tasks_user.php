<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_tasks_user extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rel_tasks_user_model');
    } 

    /*
     * Listing of rel_tasks_users
     */
    function index()
    {
        $data['rel_tasks_users'] = $this->Rel_tasks_user_model->get_all_rel_tasks_users();
        
        $data['_view'] = 'rel_tasks_user/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new rel_tasks_user
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('task_id','Task Id','required|integer');
		$this->form_validation->set_rules('user_id','User Id','required|integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'task_id' => $this->input->post('task_id'),
				'user_id' => $this->input->post('user_id'),
            );
            
            $rel_tasks_user_id = $this->Rel_tasks_user_model->add_rel_tasks_user($params);
            redirect('rel_tasks_user/index');
        }
        else
        {
			$this->load->model('Task_model');
			$data['all_tasks'] = $this->Task_model->get_all_tasks();

			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();
            
            $data['_view'] = 'rel_tasks_user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a rel_tasks_user
     */
    function edit($id)
    {   
        // check if the rel_tasks_user exists before trying to edit it
        $data['rel_tasks_user'] = $this->Rel_tasks_user_model->get_rel_tasks_user($id);
        
        if(isset($data['rel_tasks_user']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('task_id','Task Id','required|integer');
			$this->form_validation->set_rules('user_id','User Id','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'task_id' => $this->input->post('task_id'),
					'user_id' => $this->input->post('user_id'),
                );

                $this->Rel_tasks_user_model->update_rel_tasks_user($id,$params);            
                redirect('rel_tasks_user/index');
            }
            else
            {
				$this->load->model('Task_model');
				$data['all_tasks'] = $this->Task_model->get_all_tasks();

				$this->load->model('User_model');
				$data['all_users'] = $this->User_model->get_all_users();

                $data['_view'] = 'rel_tasks_user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The rel_tasks_user you are trying to edit does not exist.');
    } 

    /*
     * Deleting rel_tasks_user
     */
    function remove($id)
    {
        $rel_tasks_user = $this->Rel_tasks_user_model->get_rel_tasks_user($id);

        // check if the rel_tasks_user exists before trying to delete it
        if(isset($rel_tasks_user['id']))
        {
            $this->Rel_tasks_user_model->delete_rel_tasks_user($id);
            redirect('rel_tasks_user/index');
        }
        else
            show_error('The rel_tasks_user you are trying to delete does not exist.');
    }
    
}
