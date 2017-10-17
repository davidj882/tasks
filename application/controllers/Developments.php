<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Developments extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->profile = $this->session->userdata('profile');

        $this->load->model('Development_model');
    }

    public function view($task_id)
    {
        $data['profile']    = $this->profile;
        $data['task_id']    = $task_id;
        $data['page_title'] = "Desarrollos";
        $data['page_desc']  = "Muestra los desarrollos de la tarea realizada";
        $data['title']      = "Desarrollos";
        $data['_view']      = 'development/view';

        $data['developments']  = $this->Development_model->get_all_task_developments($task_id);

        $this->load->model('Task_model');

        $data['task_data']  = $this->Task_model->get_task($task_id);

        $this->load->model('Project_model');

        $project_data           = $this->Project_model->get_project_by_task($task_id);

        if (count($project_data) > 0) {
            $data['project_data']   = $project_data;
        }


        $this->load->view('layouts/main',$data);
    }

    public function upload($task_id)
    {
        $data['task_id']    = $task_id;
        $data['profile']    = $this->profile;
        $data['page_title'] = "Subir Desarrollos";
        $data['page_desc']  = "Adjunta pantallas como evidenia de la tarea";
        $data['title']      = "Sube tus desarrollos";
        $data['_view']      = 'development/upload';


        $this->form_validation->set_rules("path", "Ruta del desarrollo", "required|valid_url_format|url_exists|valid_url");

        if (empty($_FILES['development']['name'])) {
            $this->form_validation->set_rules('development', 'Desarrollo', 'required');
        }

        if ($this->form_validation->run() == TRUE) {

            $path          = './uploads/developments/task_'.$task_id;
            $date          = date('Y-m-d H:i:s');

            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }

            $config['upload_path']          = $path;
            $config['allowed_types']        = 'zip|rar';
            /*$config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;*/
        
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('development')){

                $data['error'] = array('error' => $this->upload->display_errors());
            } else{

                $data['data_file'] = array('upload_data' => $this->upload->data());

                $file_date = $this->upload->data();

                $file_name = $file_date['file_name'];

                $params = array(
                                'task_id' => $task_id,
                                'file' => $file_name,
                                'path' => $this->input->post('path'),
                                'date' => $date
                            );

                $development_id = $this->Development_model->add_development($params);
            }
        }

        $this->load->view('layouts/main',$data);
    }

    private function upload_files($path, $title, $files, $types)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $types,
            'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

        $images = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = $title .'_'. $image;

            /*$images[] = $fileName;*/

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                
                $upload_data = $this->upload->data();
                $images[] = $upload_data['file_name'];

            } else {
                return false;
            }
        }

        return $images;
    }
}

/* End of file Developments.php */
/* Location: ./application/controllers/Developments.php */