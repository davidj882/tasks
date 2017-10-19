<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Rel_roles_permission extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rel_roles_permission_model');
    } 

    /*
     * Listing of rel_roles_permissions
     */
    function index()
    {
        $data['rel_roles_permissions'] = $this->Rel_roles_permission_model->get_all_rel_roles_permissions();
        
        $data['_view'] = 'rel_roles_permission/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new rel_roles_permission
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('role_id','Role Id','required|integer');
		$this->form_validation->set_rules('permission_id','Permission Id','required|integer');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'role_id' => $this->input->post('role_id'),
				'permission_id' => $this->input->post('permission_id'),
            );
            
            $rel_roles_permission_id = $this->Rel_roles_permission_model->add_rel_roles_permission($params);
            redirect('rel_roles_permission/index');
        }
        else
        {
			$this->load->model('Role_model');
			$data['all_roles'] = $this->Role_model->get_all_roles();

			$this->load->model('Permission_model');
			$data['all_permissions'] = $this->Permission_model->get_all_permissions();
            
            $data['_view'] = 'rel_roles_permission/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a rel_roles_permission
     */
    function edit($id)
    {   
        // check if the rel_roles_permission exists before trying to edit it
        $data['rel_roles_permission'] = $this->Rel_roles_permission_model->get_rel_roles_permission($id);
        
        if(isset($data['rel_roles_permission']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('role_id','Role Id','required|integer');
			$this->form_validation->set_rules('permission_id','Permission Id','required|integer');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'role_id' => $this->input->post('role_id'),
					'permission_id' => $this->input->post('permission_id'),
                );

                $this->Rel_roles_permission_model->update_rel_roles_permission($id,$params);            
                redirect('rel_roles_permission/index');
            }
            else
            {
				$this->load->model('Role_model');
				$data['all_roles'] = $this->Role_model->get_all_roles();

				$this->load->model('Permission_model');
				$data['all_permissions'] = $this->Permission_model->get_all_permissions();

                $data['_view'] = 'rel_roles_permission/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The rel_roles_permission you are trying to edit does not exist.');
    } 

    /*
     * Deleting rel_roles_permission
     */
    function remove($id)
    {
        $rel_roles_permission = $this->Rel_roles_permission_model->get_rel_roles_permission($id);

        // check if the rel_roles_permission exists before trying to delete it
        if(isset($rel_roles_permission['id']))
        {
            $this->Rel_roles_permission_model->delete_rel_roles_permission($id);
            redirect('rel_roles_permission/index');
        }
        else
            show_error('The rel_roles_permission you are trying to delete does not exist.');
    }
    
}
