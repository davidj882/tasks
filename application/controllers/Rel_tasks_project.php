<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_tasks_project extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rel_tasks_project_model');
    } 

    /*
     * Listing of rel_tasks_project
     */
    function index()
    {
        $data['rel_tasks_project'] = $this->Rel_tasks_project_model->get_all_rel_tasks_project();
        
        $data['_view'] = 'rel_tasks_project/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new rel_tasks_project
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('task_id','Task Id','required');
		$this->form_validation->set_rules('project_id','Project Id','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'task_id' => $this->input->post('task_id'),
				'project_id' => $this->input->post('project_id'),
            );
            
            $rel_tasks_project_id = $this->Rel_tasks_project_model->add_rel_tasks_project($params);
            redirect('rel_tasks_project/index');
        }
        else
        {
			$this->load->model('Task_model');
			$data['all_tasks'] = $this->Task_model->get_all_tasks();

			$this->load->model('Project_model');
			$data['all_projects'] = $this->Project_model->get_all_projects();
            
            $data['_view'] = 'rel_tasks_project/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a rel_tasks_project
     */
    function edit($id)
    {   
        // check if the rel_tasks_project exists before trying to edit it
        $data['rel_tasks_project'] = $this->Rel_tasks_project_model->get_rel_tasks_project($id);
        
        if(isset($data['rel_tasks_project']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('task_id','Task Id','required');
			$this->form_validation->set_rules('project_id','Project Id','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'task_id' => $this->input->post('task_id'),
					'project_id' => $this->input->post('project_id'),
                );

                $this->Rel_tasks_project_model->update_rel_tasks_project($id,$params);            
                redirect('rel_tasks_project/index');
            }
            else
            {
				$this->load->model('Task_model');
				$data['all_tasks'] = $this->Task_model->get_all_tasks();

				$this->load->model('Project_model');
				$data['all_projects'] = $this->Project_model->get_all_projects();

                $data['_view'] = 'rel_tasks_project/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The rel_tasks_project you are trying to edit does not exist.');
    } 

    /*
     * Deleting rel_tasks_project
     */
    function remove($id)
    {
        $rel_tasks_project = $this->Rel_tasks_project_model->get_rel_tasks_project($id);

        // check if the rel_tasks_project exists before trying to delete it
        if(isset($rel_tasks_project['id']))
        {
            $this->Rel_tasks_project_model->delete_rel_tasks_project($id);
            redirect('rel_tasks_project/index');
        }
        else
            show_error('The rel_tasks_project you are trying to delete does not exist.');
    }
    
}
