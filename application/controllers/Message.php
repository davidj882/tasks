<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Message extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        (!isset($_SESSION)) ? session_start() : '';
            
        if (!$this->session->userdata('username')) {
            redirect('login');
        }
        $this->load->model('Message_model');
    } 

    /*
     * Listing of messages
     */
    function index()
    {
        $user_id = $this->session->userdata('id_user');

        $data['folder']     = 'inbox';
        $data['total_nr']   = $this->Message_model->get_messages_not_read($user_id);
        $data['inbox']      = $this->Message_model->get_messages_inbox($user_id);

        $data['_view'] = 'message/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new message
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('message','Mensaje','required');
        $this->form_validation->set_rules('to','Destinatario','required');
		$this->form_validation->set_rules('subject','Asunto','required');

        $user_id = $this->session->userdata('id_user');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'to' => $this->input->post('to'),
				'from' => $user_id,
				'status' => 0,
				'date_send' => date('Y-m-d H:i:s'),
                'subject' => $this->input->post('subject'),
				'message' => $this->input->post('message')
            );
            
            $message_id = $this->Message_model->add_message($params);

            if ($message_id) {
                
                $fullname   = $this->session->userdata('fullname');
                $email_from = $this->session->userdata('email');

                $this->load->model('User_model');
                $user_data = $this->User_model->get_user($this->input->post('to'));
                $email_to   = $user_data['email'];

                $config = Array(
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1'
                );
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");

                $this->email->from('no-reply@cencade.mx', 'CENCADE - TASKS');
                $this->email->to($email_to);
                $this->email->bcc($email_from);

                $this->email->set_mailtype("html");

                $this->email->subject($this->input->post('subject').' - CENCADE TASKS');
                
                $path = anchor(site_url('message/view/'.$message_id), 'NUEVO MENSAJE', array('target' => '_blank'));

                $body = '<p>Has recibido un nuevo mensaje de <b>"'.$fullname.'"</b></p>'.'<p>Para ver el mensaje inicia sesión en </p>'.'<h3>'.$path.'</h3>';

                $this->email->message($body);

                $this->email->send();
            }
            redirect('message/index');
        }
        else
        {
			$this->load->model('User_model');
			$data['all_users'] = $this->User_model->get_all_users();

            $data['total_nr'] = $this->Message_model->get_messages_not_read($user_id);
            
            $data['_view'] = 'message/add';
            $this->load->view('layouts/main',$data);
        }
    } 

    /*
     * Deleting message
     */
    function remove($id_message)
    {
        $message = $this->Message_model->get_message($id_message);

        // check if the message exists before trying to delete it
        if(isset($message['id_message']))
        {
            $this->Message_model->delete_message($id_message);
            redirect('message/index');
        }
        else
            show_error('The message you are trying to delete does not exist.');
    }

    function sent()
    {
        $user_id = $this->session->userdata('id_user');

        $data['folder']   = 'sent';
        $data['inbox'] = $this->Message_model->get_messages_sent($user_id);
        $data['total_nr'] = $this->Message_model->get_messages_not_read($user_id);
        
        $data['_view'] = 'message/index';
        $this->load->view('layouts/main',$data);
    }

    function view($id_message)
    {
        $data['message_data'] = $this->Message_model->get_message($id_message);

        $from_user  = $data['message_data']['to'];
        $user_id    = $this->session->userdata('id_user');

        if ($from_user == $user_id) {
            if (empty($data['message_data']['date_view'])) {
                $params = array(
                    'date_view' => date('Y-m-d H:i:s'),
                    'status' => 1
                );

                $this->Message_model->update_message($id_message,$params);
            }
        }else{

            $data['error'] = true;
        }
        
        $data['_view'] = 'message/view';

        $this->load->view('layouts/main',$data);
    }

    function message_push()
    {
        $timestamp = $this->input->post('timestamp');

        set_time_limit(0); //Establece el número de segundos que se permite la ejecución de un script.
        $fecha_ac = isset($timestamp) ? $timestamp : 0;

        $fecha_bd = $row['timestamp'];

        while( $fecha_bd <= $fecha_ac ){
            $query      = $this->db->query("SELECT `date` FROM messages ORDER BY date DESC LIMIT 1");
            $ro         = $query->row_array();
            
            usleep(100000);//anteriormente 10000
            clearstatcache();
            $fecha_bd  = strtotime($ro['timestamp']);
        }

        $query          = $this->db->query("SELECT * FROM messages ORDER BY date DESC LIMIT 1")->result_array();

        while($row = mysql_fetch_array($query)){
            $ar["date"]         = strtotime($row['date']);   
            $ar["message"]      = $row['message'];    
            $ar["id_message"]   = $row['id_message']; 
            $ar["status"]       = $row['status'];   
        }

        $dato_json   = json_encode($ar);
        echo $dato_json;
    }

    function messages($value='')
    {
        # code...
    }
}
