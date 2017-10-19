<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();

        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->load->model('User_model');

        // BREADCRUMS
        $this->load->library('breadcrumbs');
        $this->breadHead = $this->breadcrumbs->push('Usuarios', 'user', 'fa-users');

        $data['home'] = strtolower(__CLASS__).'/';
        $this->load->vars($data);
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $this->load->model('Profile_model');

        $data['users'] = $this->User_model->get_all_users();

        $data['title']          = "Usuarios";
        $data['page_title']     = "Usuarios";
        
        // BREADCRUMS
        $this->breadcrumbs->push('Listado de usuarios', 'user/index');
        $data['breadcrumb']     = $this->breadcrumbs->show();
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('password','Contraseña','max_length[255]|required');
		$this->form_validation->set_rules('name','Nombre','max_length[255]|required');
        $this->form_validation->set_rules('lastname','Apellido','max_length[255]|required');
        $this->form_validation->set_rules('username','Usuario','max_length[255]|required');
        $this->form_validation->set_rules('email','Email','max_length[255]|valid_email|required');
        $this->form_validation->set_rules('profile_id','Profile Id','integer|required');
		$this->form_validation->set_rules('color','Color','max_length[255]|required');

        if (empty($_FILES['picture']['name'])){
            
            $this->form_validation->set_rules('picture', 'Logo', 'required');
        }else{

            $config['upload_path']          = './uploads/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            /*$config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;*/

            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('picture'))
            {
                $errors = $this->upload->display_errors();
                $this->form_validation->set_rules('picture', $errors, 'required');
            }else{
                //Returns array of containing all of the data related to the file you uploaded.
                $upload_data = $this->upload->data(); 
                $file_name = $upload_data['file_name'];
            }
        }
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'profile_id' => $this->input->post('profile_id'),
				'name' => $this->input->post('name'),
				'lastname' => $this->input->post('lastname'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
                'picture' => $file_name,
				'color' => $this->input->post('color')
            );
            
            $user_id = $this->User_model->add_user($params);
            redirect('user/index');
        }
        else
        {
			$this->load->model('Profile_model');
			$data['all_profiles'] = $this->Profile_model->get_all_profiles();

            $data['title']          = "Nuevo Usuario";
            $data['page_title']     = "Nuevo Usuario";
            
            // BREADCRUMS
            $this->breadcrumbs->push('Nuevo Usuario', 'user/add');
            $data['breadcrumb']     = $this->breadcrumbs->show();
            
            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($id_user)
    {   
        // check if the user exists before trying to edit it
        $data['user'] = $this->User_model->get_user($id_user);
        
        if(isset($data['user']['id_user']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name','Nombre','max_length[255]|required');
            $this->form_validation->set_rules('lastname','Apellido','max_length[255]|required');
            $this->form_validation->set_rules('username','Usuario','max_length[255]|required');
            $this->form_validation->set_rules('email','Email','max_length[255]|valid_email|required');
            $this->form_validation->set_rules('profile_id','Profile Id','integer|required');
            $this->form_validation->set_rules('color','Color','max_length[255]|required');

            $old_file       = $this->input->post('pic_old');
            $password_old   = $this->input->post('password_old');
            $password_new   = $this->input->post('password');

            $password = (empty($password_new)) ? $password_old : md5($password_new) ;

            if (empty($_FILES['picture']['name'])){
                $file_name = $old_file;
            }else{

                $config['upload_path']          = './uploads/users/';
                $config['allowed_types']        = 'gif|jpg|png';
                /*$config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;*/

                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('picture'))
                {
                    $errors = $this->upload->display_errors();
                    $this->form_validation->set_rules('picture', $errors, 'required');

                    $data['errors'] = $errors;
                }else{
                    //Returns array of containing all of the data related to the file you uploaded.
                    $upload_data = $this->upload->data(); 
                    $file_name = $upload_data['file_name'];

                    if (empty($file_name)) {
                        $file_name = $old_file;
                    }else{
                        unlink('uploads/users/'.$old_file);
                    }
                }
            }
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'profile_id' => $this->input->post('profile_id'),
					'name' => $this->input->post('name'),
					'lastname' => $this->input->post('lastname'),
					'username' => $this->input->post('username'),
					'password' => $password,
					'email' => $this->input->post('email'),
                    'picture' => $file_name,#$this->input->post('picture'),
					'color' => $this->input->post('color'),
                );

                $this->User_model->update_user($id_user,$params);

                $this->load->model('Task_model');

                $this->Task_model->update_task_color_user($id_user, $this->input->post('color'));

                echo $this->db->last_query();

                redirect('user/index');
            }
            else
            {
				$this->load->model('Profile_model');
				$data['all_profiles'] = $this->Profile_model->get_all_profiles();

                $data['title']          = "Editar Usuario";
                $data['page_title']     = "Editar Usuario";
                
                // BREADCRUMS
                $this->breadcrumbs->push('Editar Usuario', 'user/edit/'.$id_user);
                $data['breadcrumb']     = $this->breadcrumbs->show();

                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('El usuario que está intentando editar no existe.');
    } 

    /*
     * Deleting user
     */
    function remove($id_user)
    {
        $user = $this->User_model->get_user($id_user);

        // check if the user exists before trying to delete it
        if(isset($user['id_user']))
        {
            $this->User_model->delete_user($id_user);
            redirect('user/index');
        }
        else
            show_error('El usuario que está intentando eliminar no existe.');
    }
 
    function change_password()
    {
        $this->form_validation->set_rules('old_pass', 'Contraseña Anterior', 'trim|required|callback_is_password');
        $this->form_validation->set_rules('new_pass', 'Contraseña Nueva', 'trim|required|matches[pass_con]');
        $this->form_validation->set_rules('pass_con', 'Confirmar contraseña', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            
            $user_id            = $this->session->userdata('id_user');
            $new_pass           = md5($this->input->post('new_pass'));
            $params             = array('password' => $new_pass);
            $update_password    = $this->User_model->update_user($user_id, $params);

            if ($update_password) {
                $data['update_password'] = $update_password;
            }
        } 

        $data['title']          = "Cambiar contraseña";
        $data['page_title']     = "Cambiar contraseña";

        // BREADCRUMS
        $this->breadcrumbs->push('Cambiar Contraseña', 'user/index');
        $data['breadcrumb']     = $this->breadcrumbs->show();
        
        $data['_view'] = 'user/change_password';
        $this->load->view('layouts/main',$data);
    }   

    public function is_password($password)
    {
        $user_id        = $this->session->userdata('id_user');
        $is_password    = $this->User_model->is_password($user_id, $password);

        if ($is_password > 0) {
            return TRUE;
        }
        $this->form_validation->set_message('is_password', 'La contraseña anterior no existe');
        
        return FALSE;
    }
}
