<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Task extends CI_Controller{

    function __construct()
    {
        parent::__construct();

        (!isset($_SESSION)) ? session_start() : '';
            
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model('Task_model');

        // BREADCRUMS
        $this->load->library('breadcrumbs');
        $this->breadHead = $this->breadcrumbs->push('Tareas', 'task', 'tasks');

        $data['home'] = strtolower(__CLASS__).'/';
        $this->load->vars($data);
    } 

    /*
     * Listing of tasks
     */
    function index()
    {
        $this->load->model('Enterprise_model');
        $this->load->model('Status_task_model');
        $this->load->model('Rel_tasks_user_model');

        $data['tasks'] = $this->Task_model->get_all_tasks();
        
        $data['_view'] = 'task/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new task
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Nombre','required|max_length[255]');
		$this->form_validation->set_rules('user_id','Usuario','required');
		$this->form_validation->set_rules('date_start','Fecha Compromiso','required');
		$this->form_validation->set_rules('date_end','Fecha Inicio','required');
		$this->form_validation->set_rules('enterpriser_id','Empresa','required|integer');
		
		if($this->form_validation->run())     
        {   

            $this->load->model('User_model');
            $user_data = $this->User_model->get_user($this->input->post('user_id'));

            // SAVE TASKS
            $params = array(
				'status_id' => 1,
				'enterpriser_id' => $this->input->post('enterpriser_id'),
				'name' => $this->input->post('name'),
				'date_start' => $this->input->post('date_start'),
				'date_end' => $this->input->post('date_end'),
				'date_delivered' => $this->input->post('date_delivered'),
                'description' => $this->input->post('description'),
                'color' => $user_data['color'],
            );

            $task_id = $this->Task_model->add_task($params);

            // SAVE REL USER TASKS
            $this->load->model('Rel_tasks_user_model');

            $params = array(
                'task_id' => $task_id,
                'user_id' => $this->input->post('user_id')
            );
            
            $project_user_id = $this->Rel_tasks_user_model->add_rel_tasks_user($params);

            // SAVE REL PROJECT TASKS
            if ($this->input->post('project_id') > 0) {
                
                $this->load->model('Rel_tasks_project_model');
                
                $params = array(
                    'task_id' => $task_id,
                    'project_id' => $this->input->post('project_id')
                );
                
                $tasks_project_id = $this->Rel_tasks_project_model->add_rel_tasks_project($params);
            }

            // ADD NOTIFICATION
            $this->load->model('Notification_model');

            $params = array(
                'user_id' =>  $this->input->post('user_id'),
                'type' =>  'task',
                'id_item' =>  $task_id,
                'date_send' => date('Y-m-d H:i:s')
            );

            $notification_id = $this->Notification_model->add_notification($params);

            // SEND MAIL
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
                $this->email->subject('Nueva Tarea');

                $this->email->set_mailtype("html");
                
                $path = anchor(site_url('task/view/'.$task_id), 'Ver Tarea', array('target' => '_blank'));

                $body = '<p>Has sido asignado a una nueva tarea (<b>"'.$this->input->post('name').'"</b>)</p>'.'<p>Para ver los detalles da clic en el enlace de abajo.</p>'.'<h3>'.$path.'</h3>';

                $this->email->message($body);

                $this->email->send();
            }
            
            redirect('task/index');
        }
        else
        {
            // ALL USERS
            $this->load->model('User_model');
            $data['all_users'] = $this->User_model->get_all_users();

            // ALL ENTERPRISES
			$this->load->model('Enterprise_model');
			$data['all_enterprises'] = $this->Enterprise_model->get_all_enterprises();

            // ALL TASK's STATUS
            $this->load->model('Status_task_model');
            $data['status'] = $this->Status_task_model->get_all_status_task();
            
            $data['_view'] = 'task/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a task
     */
    function edit($id_task)
    {   
        // check if the task exists before trying to edit it
        $data['task'] = $this->Task_model->get_task($id_task);
        
        if(isset($data['task']['id_task']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Nombre','required|max_length[255]');
			$this->form_validation->set_rules('date_start','Fecha Inicio','required');
			$this->form_validation->set_rules('date_end','Fecha Compromiso','required');
            $this->form_validation->set_rules('status_id','Estado','required');
			$this->form_validation->set_rules('color','Color','required');
		
			if($this->form_validation->run())     
            {   
                // UPDATE TASK DATA
                $params = array(
					'status_id' => $this->input->post('status_id'),
					'name' => $this->input->post('name'),
					'date_start' => $this->input->post('date_start'),
					'date_end' => $this->input->post('date_end'),
					'description' => $this->input->post('description'),
                    'color' => $this->input->post('color')
                );

                $this->Task_model->update_task($id_task, $params);

                // UPDATE TASK DATA
                $this->load->model('Rel_tasks_user_model');

                $params = array(
                    'task_id' => $id_task,
                    'user_id' => $this->input->post('user_id')
                );
                
                $project_user_id = $this->Rel_tasks_user_model->update_rel_task_user_by_user_task($id_task, $params);

                redirect('task/index');
            }
            else
            {
                // ALL USERS
                $this->load->model('User_model');
                $data['all_users'] = $this->User_model->get_all_users();

                // ALL ENTERPRISES
				$this->load->model('Enterprise_model');
				$data['all_enterprises'] = $this->Enterprise_model->get_all_enterprises();

                // ALL TASK's STATUS
                $this->load->model('Status_task_model');
                $data['status'] = $this->Status_task_model->get_all_status_task();

                // GET TASK USER
                $this->load->model('Rel_tasks_user_model');

                $data['_view'] = 'task/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The task you are trying to edit does not exist.');
    } 

    /*
     * Deleting task
     */
    function remove($id_task)
    {
        $task = $this->Task_model->get_task($id_task);

        // check if the task exists before trying to delete it
        if(isset($task['id_task']))
        {
            $this->Task_model->delete_task($id_task);

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

            redirect('task/index');
        }
        else
            show_error('The task you are trying to delete does not exist.');
    }

    /**
        View Task
    */
    function view($task_id)
    {
        $this->load->model('Enterprise_model');
        $this->load->model('Status_task_model');
        $this->load->model('Rel_tasks_user_model');

        $data['task_data'] = $this->Task_model->get_task($task_id);

        $task_name = $data['task_data']['name'];

        $data['page_title'] = 'Tarea '.$task_name;

        $this->breadcrumbs->push($task_name, 'algo/algo');
        
        $data['breadcrumb']     = $this->breadcrumbs->show();

        $data['_view'] = 'task/view';

        $this->load->model('Notification_model');

        $type = 'task';

        $notification = $this->Notification_model->get_notification_by_item($task_id, $type);

        $user_id = $this->session->userdata('id_user');

        if (empty($notification['date_view']) && $user_id == $notification['user_id']) {
            $params = array(
                'date_view' => date('Y-m-d H:i:s'), 
                'status' => 1, 
            );

            $this->Notification_model->update_notification($task_id, $type, $params);
        }

        $this->load->view('layouts/main',$data);
    }
    
    function projects()
    {
        $enterpriser_id = $this->input->post('enterpriser_id');
        if (isset($enterpriser_id)) {
            $this->load->model('Project_model');

            $projects = $this->Project_model->get_projects_enterprise($enterpriser_id);

            $data = '<option value="0">Sin Proyecto</options>';

            foreach ($projects as $p) {

                $data .= '<option value="'.$p['id_project'].'">'.$p['name'].'</option>'."\n";
            }

            echo $data;
        }
    }

    /*
     * Change Status Task
     */
    function change_status()
    {
        $task_id    = $this->input->post('task_id');
        $status_id  = $this->input->post('status_id');

        if (isset($task_id)) {

            $date = date('Y-m-d H:i:s');

            switch ($status_id) {
                case '1':
                    $status_id  = 2;
                    $date_field = 'date_view';
                    break;
                case '2':
                    $status_id  = 3;
                    $date_field = 'date_process';
                    break;
                case '3':
                    $status_id  = 4;
                    $date_field = 'date_delivered';
                    break;
            }

            $params = array(
                'status_id' => $status_id,
                $date_field => $date
            );

            $this->Task_model->update_task($task_id, $params);
        }
    }

    /*
     * Delete all files on task's folder
     */
    function del_all_folder($folder)
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

    /**
    *   
    */
    function task_by_user($id_user)
    {
        $this->load->model('User_model');
        $this->load->model('Profile_model');

        $user_data      = $this->User_model->get_user($id_user);
        $profile_u      = $user_data['profile_id'];
        $profile_data   = $this->Profile_model->get_profile($profile_u);

        $data['profile']    = $profile_data['name'];
        $data['fullname']   = $user_data['name'].' '.$user_data['lastname'];
        $data['tasks_user'] = $this->Task_model->tasks_by_user($id_user);
        $data['picture']    = (empty($user_data['picture']))? '' : $user_data['picture'];
        
        $this->load->view('task/tasks_user', $data);
    }
}
