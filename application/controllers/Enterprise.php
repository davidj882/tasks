<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Enterprise extends CI_Controller{

    function __construct()
    {
        parent::__construct();

        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        
        $this->load->model('Enterprise_model');

        // BREADCRUMS
        $this->load->library('breadcrumbs');
        $this->breadHead = $this->breadcrumbs->push('Clientes', 'enterprise', 'fa-building');

        $data['home'] = strtolower(__CLASS__).'/';
        $this->load->vars($data);
    } 

    /*
     * Listing of enterprises
     */
    function index()
    {
        $data['title']          = "Listado de Clientes";
        $data['page_title']     = "Listado de Clientes";
        $data['enterprises']    = $this->Enterprise_model->get_all_enterprises();

        // BREADCRUMS
        $this->breadcrumbs->push('Listado', 'enterprise/');
        $data['breadcrumb']     = $this->breadcrumbs->show();

        $data['_view'] = 'enterprise/index';
        $this->load->view('layouts/main',$data);

    }

    /*
     * Adding a new enterprise
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Nombre','max_length[255]|required');
		$this->form_validation->set_rules('url','URL','max_length[255]|required');
		//$this->form_validation->set_rules('picture','Logo','max_length[255]|required');
        if (empty($_FILES['picture']['name'])){
            
            $this->form_validation->set_rules('picture', 'Logo', 'required');
        }else{

            $config['upload_path']          = './uploads/enterprises/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

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
				'name' => $this->input->post('name'),
				'url' => $this->input->post('url'),
				'picture' => $file_name,
            );
            
            $enterprise_id = $this->Enterprise_model->add_enterprise($params);
            redirect('enterprise/index');
        }
        else
        {
            $data['title']          = "Nuevo Cliente";
            $data['page_title']     = "Nuevo Cliente";
            // BREADCRUMS
            $this->breadcrumbs->push('Nuevo Cliente', 'enterprise/add');
            $data['breadcrumb']     = $this->breadcrumbs->show();

            $data['_view'] = 'enterprise/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a enterprise
     */
    function edit($id_enterprise)
    {   
        // check if the enterprise exists before trying to edit it
        $data['enterprise'] = $this->Enterprise_model->get_enterprise($id_enterprise);
        
        if(isset($data['enterprise']['id_enterprise']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Nombre','max_length[255]|required');
			$this->form_validation->set_rules('url','URL','max_length[255]|required');

            $old_file = $this->input->post('pic_old');

            if (empty($_FILES['picture']['name'])){
                $file_name = $old_file;
            }else{

                $config['upload_path']          = './uploads/enterprises/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

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
                        unlink('uploads/enterprises/'.$old_file);
                    }
                }
            }
		
			if($this->form_validation->run()){                
                $params = array(
					'name' => $this->input->post('name'),
					'url' => $this->input->post('url'),
					'picture' => $file_name,
                );

                $this->Enterprise_model->update_enterprise($id_enterprise,$params);            
                redirect('enterprise/index');
            }
            else{

                $data['title']          = "Editar Cliente";
                $data['page_title']     = "Editar Cliente";
                // BREADCRUMS
                $this->breadcrumbs->push('Nuevo Cliente', 'enterprise/add');
                $data['breadcrumb']     = $this->breadcrumbs->show();

                $data['_view'] = 'enterprise/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('La empresa que intenta editar no existe.');
    } 

    /*
     * Deleting enterprise
     */
    function remove($id_enterprise)
    {
        $enterprise = $this->Enterprise_model->get_enterprise($id_enterprise);

        // check if the enterprise exists before trying to delete it
        if(isset($enterprise['id_enterprise']))
        {
            $this->Enterprise_model->delete_enterprise($id_enterprise);
            redirect('enterprise/index');
        }
        else
            show_error('The enterprise you are trying to delete does not exist.');
    }

    public function do_upload()
    {
        $config['upload_path']          = './uploads/enter';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('upload_form', $error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());

                $this->load->view('upload_success', $data);
        }
    }
    
}
