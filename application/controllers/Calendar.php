<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->profile = $this->session->userdata('profile');

        $this->load->model('calendar_model');
    }

	public function index()
	{
		$data['profile']    = $this->profile;
        $data['page_title'] = "Calendario";
        $data['page_desc'] 	= "Organizador de Actividades";
        $data['_view']      = 'calendar/index';

        $this->load->model('Task_model');
        $data['users_colors'] = $this->Task_model->task_users_colors();

        $this->load->view('layouts/main',$data);
	}

	public function get_events()
	{
		// Our Start and End Dates
		$end 	= $this->input->get("end");
		$start 	= $this->input->get("start");

		$startdt = new DateTime('now'); // setup a local datetime
		$startdt->setTimestamp($start); // Set the date based on timestamp
		$start_format = $startdt->format('Y-m-d H:i:s');

		$enddt = new DateTime('now'); // setup a local datetime
		$enddt->setTimestamp($end); // Set the date based on timestamp
		$end_format = $enddt->format('Y-m-d H:i:s');

		$profile 	= $this->session->userdata('profile');
		$id_user	= $this->session->userdata('id_user');
		$events 	= $this->calendar_model->get_events($profile, $id_user);

		foreach($events as $r) {

			$color = $r->color;
			if (empty($color)) {
				$color = ($color == "ffffff" || $color == "000000") ? "#".$this->make_color() : "#".$color;
			}

			$start_task 	= $r->date_start;
			$end_task  		= $r->date_end;
			$status  		= $r->status_id;

			// EVENTS PER DAY
			$begin 		= new DateTime($start_task);
			$end 		= new DateTime($end_task);
			$end 		= $end->modify( '+1 day' ); 
			
			$end_task 	= new DateTime($end_task);

			$interval 	= new DateInterval('P1D');
			$daterange 	= new DatePeriod($begin, $interval ,$end);

			foreach($daterange as $date){
			    $current_date 	= $date->format("Y-m-d H:i:s");
				$start_date 	= strtotime ('+8 hour', strtotime($current_date));
				$finish_date 	= strtotime ('+19 hour', strtotime($current_date));
				$start_date 	= date ('Y-m-d H:i:s', $start_date);
				$finish_date 	= date ('Y-m-d H:i:s', $finish_date);

				if ($profile == 2) {
					if ($r->id_compare != $id_user) {
						$type = 'project';
					}else{
						$type = 'own';
					}
				}else{
					$type = 'own';
				}

				$data_events[] = array(
					"id" 			=> $r->id_task,
					"title" 		=> $r->name,
					"description" 	=> $r->description,
					"start" 		=> $start_date,#$r->date_start,
					"end" 			=> $finish_date,#$r->date_end,
					"color"			=> $color,
					"dow"			=> [1,2,3,4,5],
					"end_task"		=> $end_task->format('d-m-Y'),
					"type_task"		=> $type,
					"status"		=> $status
				);
			}

			// EVENTS PER RANGE DAYS
			/*
				$start_date 	= strtotime ('+8 hour', strtotime($r->date_start));
				$finish_date 	= strtotime ('+19 hour', strtotime($r->date_end));
				
				$start_date 	= date ('Y-m-d H:i:s', $start_date);
				$finish_date 	= date ('Y-m-d H:i:s', $finish_date);

				$data_events[] = array(
					"id" 			=> $r->id_task,
					"title" 		=> $r->name,
					"description" 	=> $r->description,
					"end" 			=> $start_date,#$r->date_end,
					"start" 		=> $finish_date,#$r->date_start,
					"color"			=> $color,
					"dow"			=> [1,2,3,4,5]
				);
			*/
		}

		echo json_encode(array("events" => $data_events));

		exit();
	}

	public function make_color()
	{
		$color = dechex(rand(0x000000, 0xFFFFFF));
		
		return $color;
	}
}

/* End of file Calendar.php */
/* Location: ./application/controllers/Calendar.php */