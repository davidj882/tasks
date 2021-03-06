<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
*/
 
class Project extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        (!isset($_SESSION)) ? session_start() : '';
            
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        // BREADCRUMS
        $this->load->library('breadcrumbs');
        $this->breadHead = $this->breadcrumbs->push('Escritorio', 'admin/dashboard', 'fa-dashboard');

        $data['home'] = strtolower(__CLASS__).'/';
        $this->load->vars($data);
        
        //$this->breadcrumbs->push('Nueva Pregunta', 'admin/questions/add');
        $data['breadcrumb']     = $this->breadcrumbs->show();

        $this->load->model('Project_model');
    } 

    /*
     * Listing of projects
    */
    function index()
    {
        $profile            = $this->session->userdata('profile');
        $data['title']      = "Listado de Proyectos";

        if ($profile != 1) {
            $user_id = $this->session->userdata('id_user');
            $data['projects']   = $this->Project_model->get_all_projects($user_id);
        }else{
            $data['projects']   = $this->Project_model->get_all_projects();
        }

        $this->load->model('Enterprise_model');
        
        $data['_view'] = 'project/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new project
    */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('name','Nombre','required');
		$this->form_validation->set_rules('ranges','Alcance','required');
		$this->form_validation->set_rules('description','Descripción','required');
		$this->form_validation->set_rules('specifications','Especificaciones','required');
		$this->form_validation->set_rules('date_start','Fecha Inicial','required');
        $this->form_validation->set_rules('date_end','Fecha Inicial','required');
		$this->form_validation->set_rules('user_id','Usuario','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'date_start'        => $this->input->post('date_start'),
				'date_end'          => $this->input->post('date_end'),
				'enterprise_id'     => $this->input->post('enterprise_id'),
				'name'              => $this->input->post('name'),
				'description'       => $this->input->post('description'),
				'ranges'            => $this->input->post('ranges'),
                'specifications'    => $this->input->post('specifications'),
				'date_created'      => date('Y-m-d H:i:s'),
            );
            
            $project_id = $this->Project_model->add_project($params);


            $this->load->model('Rel_project_user_model');

            $params = array(
                'user_id' => $this->input->post('user_id'),
                'project_id' => $project_id
            );

            $rel_project_user_id = $this->Rel_project_user_model->add_rel_project_user($params);

            // ADD NOTIFICATION
            $this->load->model('Notification_model');

            $params = array(
                'user_id' =>  $this->input->post('user_id'),
                'type' =>  'project',
                'id_item' =>  $project_id,
                'date_send' => date('Y-m-d H:i:s')
            );

            $notification_id = $this->Notification_model->add_notification($params);

            // SEND MAIL
            $this->load->model('User_model');
            $user_data = $this->User_model->get_user($this->input->post('user_id'));
            $email_to   = $user_data['email'];

            if (!empty($email_to)) {
                $config = Array(
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1'
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('no-reply@cencade.mx', 'CENCADE - TASKS');
                $this->email->to($email_to);
                $this->email->subject('Nuevo Proyecto');
                
                $this->email->set_mailtype("html");
                
                $path = anchor(site_url('project/view/'.$project_id), 'Ver Proyecto', array('target' => '_blank'));

                $body = '<p>Has sido asignado a un nuevo proyecto (<b>"'.$this->input->post('name').'"</b>)</p>'.'<p>Para ver los detalles da clic en el enlace de abajo.</p>'.'<h3>'.$path.'</h3>';

                $this->email->message($body);

                $this->email->send();
            }

            redirect('project/index');
        }
        else
        {
            // ALL ENTERPRISES
			$this->load->model('Enterprise_model');
			$data['all_enterprises'] = $this->Enterprise_model->get_all_enterprises();

            // ALL USERS
            $this->load->model('User_model');
            $data['all_users'] = $this->User_model->get_all_users();
            
            $data['_view'] = 'project/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a project
    */
    function edit($id_project)
    {   
        // check if the project exists before trying to edit it
        $data['project'] = $this->Project_model->get_project($id_project);
        
        if(isset($data['project']['id_project']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('enterprise_id','Enterprise Id','required');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('ranges','Ranges','required');
			$this->form_validation->set_rules('description','Description','required');
			$this->form_validation->set_rules('specifications','Specifications','required');
			$this->form_validation->set_rules('date_start','Date Start','required');
			$this->form_validation->set_rules('date_end','Date End','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'date_start' => $this->input->post('date_start'),
					'date_end' => $this->input->post('date_end'),
					'enterprise_id' => $this->input->post('enterprise_id'),
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'ranges' => $this->input->post('ranges'),
					'specifications' => $this->input->post('specifications'),
                );

                $this->Project_model->update_project($id_project,$params);            
                redirect('project/index');
            }
            else
            {
				$this->load->model('Enterprise_model');
				$data['all_enterprises'] = $this->Enterprise_model->get_all_enterprises();

                $data['_view'] = 'project/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The project you are trying to edit does not exist.');
    } 

    /*
     * Deleting project
    */
    function remove($id_project)
    {
        $project = $this->Project_model->get_project($id_project);

        // check if the project exists before trying to delete it
        if(isset($project['id_project']))
        {
            $this->Project_model->delete_project($id_project);

            $this->load->model('Task_model');
            $this->load->model('Rel_tasks_project_model');

            $task_by_project = $this->Rel_tasks_project_model->get_all_rel_tasks_project($id_project);

            foreach ($task_by_project as $task) {
                $this->Task_model->delete_task($task['task_id']);

                // DELETE EVIDENCE
                $folder_evidence = './uploads/evidences/task_'.$id_task;
                if (is_dir($folder_evidence)) {
                    $this->del_all_folder($folder_evidence);
                }
                // DELETE DEVELOPMETS
                $folder_development = './uploads/developments/task_'.$id_task;
                if (is_dir($folder_development)) {
                    $this->del_all_folder($folder_development);
                }
            }

            redirect('project/index');
        }
        else
            show_error('The project you are trying to delete does not exist.');
    }

    function view($project_id)
    {
        $this->load->model('Enterprise_model');
        $this->load->model('Status_task_model');
        $this->load->model('Rel_tasks_user_model');

        $data['project_data'] = $this->Project_model->get_project($project_id);

        $project_name = $data['project_data']['name'];

        $data['page_title'] = 'Proyecto '.$project_name;

        $this->breadcrumbs->push($project_name, 'algo/algo');
        
        $data['breadcrumb'] = $this->breadcrumbs->show();

        $data['_view'] = 'project/view';

        $type = 'project';

        $notification = $this->Notification_model->get_notification_by_item($project_id, $type);

        if (empty($notification['date_view'])) {
            
            $params = array(
                'date_view' => date('Y-m-d H:i:s'), 
                'status' => 1, 
            );

            $this->Notification_model->update_notification($project_id, $type, $params);
        }

        $this->load->view('layouts/main',$data);
        
    }

    public function del_all_folder($folder)
    {
        foreach(glob($folder . "/*") as $folder_files){
     
            if (is_dir($folder_files)) {
                $this->del_all_folder($folder_files);
            } else {
                unlink($folder_files);
            }
        }
     
        rmdir($folder);
    }
    
    public function tasks()
    {
        $id_project = $this->input->post('id_project');
        
        $this->load->model('Task_model');
        $query = $this->Task_model->get_tasks_project($id_project);

        $this->load->library('table');
        $this->table->set_heading('Nombre', 'Visto', 'Inicio', 'Completado');
        $template = array('table_open' => '<table class="table table-hover">');

        $this->table->set_template($template);
        echo $this->table->generate($query);
    }

    public function timeline($project_id)
    {
        $project_data = $this->Project_model->get_project($project_id);

        $this->load->model('Evidence_model');

        $projects = array(
                        array(
                            'id'            => $project_data['id_project'],
                            'title'         => 'Proyecto Creado',
                            'date'          => $project_data['date_created'],
                            'type'          => 'created_project',
                            'description'   => $project_data['description'],
                        ),
                        array(
                            'id'            => $project_data['id_project'],
                            'title'         => 'Inicio de Proyecto',
                            'date'          => $project_data['date_start'],
                            'type'          => 'start_project',
                            'description'   => $project_data['description'],
                        ),
                        array(
                            'id'            => $project_data['id_project'],
                            'title'         => 'Fin de Proyecto',
                            'date'          => $project_data['date_end'],
                            'type'          => 'end_project',
                            'desc'          => $project_data['description'],
                        )
                    );

        $this->load->model('Task_model');
        $tasks = $this->Task_model->get_all_tasks_project($project_id)->result_array();

        foreach ($tasks as $t) {

            $id_task    = $t['id_task'];
            $name_task  = $t['name'];

            $task_array[] = array(
                                array(
                                    'id'    => $id_task,
                                    'title' => $t['name'], 
                                    'date'  => (empty($t['date_start']))? '' : $t['date_start'], 
                                    'type'  => 'start_task',
                                    'desc'  => $t['description'],
                                ),
                                array(
                                    'id'    => $id_task,
                                    'title' => $name_task, 
                                    'date'  => (empty($t['date_end']))? '' : $t['date_end'], 
                                    'type'  => 'end_task',
                                    'desc'  => $t['description'],
                                ),
                                array(
                                    'id'    => $id_task,
                                    'title' => $name_task, 
                                    'date'  => (empty($t['date_view']))? '' : $t['date_view'], 
                                    'type'  => 'view_task',
                                    'desc'  => $t['description'],
                                ),
                                array(
                                    'id'    => $id_task,
                                    'title' => $name_task, 
                                    'date'  => (empty($t['date_process']))? '' : $t['date_process'], 
                                    'type'  => 'process_task',
                                    'desc'  => $t['description'],
                                ),
                                array(
                                    'id'    => $id_task,
                                    'title' => $name_task, 
                                    'date'  => (empty($t['date_delivered']))? '' : $t['date_delivered'], 
                                    'type'  => 'delivered_task',
                                    'desc'  => $t['description'],
                                )
                            );
        }

        foreach ($task_array as $key => $value) {

            foreach ($value as $k => $v) {
                $task_array2[] = $v;
            }
        }

        $data_timeline          = array_merge($projects, $task_array2);
        $data['data_timeline']  = $this->array_sort($data_timeline, 'date'); // Sort by oldest first

        $this->load->view('project/timeline', $data, FALSE);
    }

    public function array_sort($array, $on, $order = SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                break;
                case SORT_DESC:
                    arsort($sortable_array);
                break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}
