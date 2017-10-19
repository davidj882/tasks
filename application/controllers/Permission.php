<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Permission extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permission_model');
    } 

    /*
     * Listing of permissions
     */
    function index()
    {
        $data['permissions'] = $this->Permission_model->get_all_permissions();
        
        $data['_view'] = 'permission/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new permission
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Name','max_length[255]|required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'name' => $this->input->post('name'),
            );
            
            $permission_id = $this->Permission_model->add_permission($params);
            redirect('permission/index');
        }
        else
        {            
            $data['_view'] = 'permission/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a permission
     */
    function edit($id_permission)
    {   
        // check if the permission exists before trying to edit it
        $data['permission'] = $this->Permission_model->get_permission($id_permission);
        
        if(isset($data['permission']['id_permission']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','max_length[255]|required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Permission_model->update_permission($id_permission,$params);            
                redirect('permission/index');
            }
            else
            {
                $data['_view'] = 'permission/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The permission you are trying to edit does not exist.');
    } 

    /*
     * Deleting permission
     */
    function remove($id_permission)
    {
        $permission = $this->Permission_model->get_permission($id_permission);

        // check if the permission exists before trying to delete it
        if(isset($permission['id_permission']))
        {
            $this->Permission_model->delete_permission($id_permission);
            redirect('permission/index');
        }
        else
            show_error('The permission you are trying to delete does not exist.');
    }
    
}
