<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evidence extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->profile = $this->session->userdata('profile');

        $this->load->model('Evidence_model');
    }

	public function view($task_id)
	{
		$data['profile']    = $this->profile;
        $data['task_id']    = $task_id;
        $data['page_title'] = "Evidencias";
        $data['page_desc'] 	= "Muestra las evidencias de la tarea realizada";
        $data['title']		= "Evidencias";
        $data['_view']      = 'evidence/view';

        $data['evidences']	= $this->Evidence_model->get_all_task_evidences($task_id);

        $this->load->model('Task_model');

        $data['task_data'] 	= $this->Task_model->get_task($task_id);

        $this->load->model('Project_model');

        $project_data 			= $this->Project_model->get_project_by_task($task_id);

        if (count($project_data) > 0) {
        	$data['project_data'] 	= $project_data;
        }


        $this->load->view('layouts/main',$data);
	}

	public function upload($task_id)
	{
        $data['task_id']	= $task_id;
		$data['profile']    = $this->profile;
        $data['page_title'] = "Subir Evidencias";
        $data['page_desc'] 	= "Adjunta pantallas como evidenia de la tarea";
        $data['title']		= "Sube tus evidencias";
        $data['_view']      = 'evidence/upload';

        /*print_r($_FILES['evidence']['name'][0]);*/

        if (isset($_FILES['evidence'])) {
            
            $name_file = $_FILES['evidence']['name'][0];
            
            if ($name_file == "") {

                $this->form_validation->set_rules('evidence', 'Evidencias', 'required');

                $data['error'] = "Es necesario seleccionar archivos para subir";

            }else{

                $data['add']   = true;
                $path          = './uploads/evidences/task_'.$task_id;
                $date          = date('Y-m-d H:i:s');

                if (!is_dir($path)) {
                    mkdir($path, 0755, true);
                }

                $prefix        = 'task_'.$task_id;
                $types         = 'jpg|gif|png';
                $images        = $this->upload_files($path, $prefix, $_FILES['evidence'], $types);

                foreach ($images as $image) {
                    $params = array('filename' => $image, 'task_id' => $task_id, 'date' => $date);
                    
                    $evidence_id = $this->Evidence_model->add_evidence($params);

                    if ($evidence_id > 0) {
                        $evidence[] = $params;
                    }
                }

                $data['added'] = $evidence;
                
                if (count($evidence) > 0) {
                    $this->load->model('Task_model');

                    $params = array('date_delivered' => $date, 'status_id' => '4');
                    $this->Task_model->update_task($task_id, $params);
                }
            }
        }

        $this->load->view('layouts/main', $data);
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
            $_FILES['images[]']['name']     = $files['name'][$key];
            $_FILES['images[]']['type']     = $files['type'][$key];
            $_FILES['images[]']['size']     = $files['size'][$key];
            $_FILES['images[]']['error']    = $files['error'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];

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

/* End of file Evidence.php */
/* Location: ./application/controllers/Evidence.php */