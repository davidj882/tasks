<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Role extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model');
    } 

    /*
     * Listing of roles
     */
    function index()
    {
        $data['roles'] = $this->Role_model->get_all_roles();
        
        $data['_view'] = 'role/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new role
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
            
            $role_id = $this->Role_model->add_role($params);
            redirect('role/index');
        }
        else
        {            
            $data['_view'] = 'role/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a role
     */
    function edit($id_role)
    {   
        // check if the role exists before trying to edit it
        $data['role'] = $this->Role_model->get_role($id_role);
        
        if(isset($data['role']['id_role']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','max_length[255]|required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Role_model->update_role($id_role,$params);            
                redirect('role/index');
            }
            else
            {
                $data['_view'] = 'role/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The role you are trying to edit does not exist.');
    } 

    /*
     * Deleting role
     */
    function remove($id_role)
    {
        $role = $this->Role_model->get_role($id_role);

        // check if the role exists before trying to delete it
        if(isset($role['id_role']))
        {
            $this->Role_model->delete_role($id_role);
            redirect('role/index');
        }
        else
            show_error('The role you are trying to delete does not exist.');
    }
    
}
