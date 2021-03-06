<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Profile extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model');
    } 

    /*
     * Listing of profiles
     */
    function index()
    {
        $data['profiles'] = $this->Profile_model->get_all_profiles();
        
        $data['_view'] = 'profile/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new profile
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
            
            $profile_id = $this->Profile_model->add_profile($params);
            redirect('profile/index');
        }
        else
        {            
            $data['_view'] = 'profile/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a profile
     */
    function edit($id_profile)
    {   
        // check if the profile exists before trying to edit it
        $data['profile'] = $this->Profile_model->get_profile($id_profile);
        
        if(isset($data['profile']['id_profile']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','max_length[255]|required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
                );

                $this->Profile_model->update_profile($id_profile,$params);            
                redirect('profile/index');
            }
            else
            {
                $data['_view'] = 'profile/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The profile you are trying to edit does not exist.');
    } 

    /*
     * Deleting profile
     */
    function remove($id_profile)
    {
        $profile = $this->Profile_model->get_profile($id_profile);

        // check if the profile exists before trying to delete it
        if(isset($profile['id_profile']))
        {
            $this->Profile_model->delete_profile($id_profile);
            redirect('profile/index');
        }
        else
            show_error('The profile you are trying to delete does not exist.');
    }
    
}
