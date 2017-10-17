<?php
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        (!isset($_SESSION)) ? session_start() : '';

        $this->load->model('login_model');
        if ($this->session->userdata('username')) {
            redirect('dashboard');
        }
    }
    
    function index() {
        $this->load->view('login');
    }

    function process() {
        $this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        }else {
            echo $this->input->post('username');
            echo $this->input->post('password');
            $username = trim($this->input->post('username'));
            $password = md5(trim($this->input->post('password')));
            $getLogin = $this->login_model->getLogin($username, $password);

            if ($getLogin->num_rows() > 0) {
                //login is true, create session
                foreach ($getLogin->result() as $user) {

                    $sess_data['id_user']       = $user->id_user;
                    $sess_data['name']          = $user->name;
                    $sess_data['lastname']      = $user->lastname;
                    $sess_data['username']      = $user->username;
                    $sess_data['email']         = $user->email;
                    $sess_data['profile']       = $user->profile_id;
                    $sess_data['picture']       = $user->picture;

                    $query = $this->db->get_where('profiles', array('id_profile ' => $sess_data['profile']))->row_array();

                    $sess_data['profile_name']  = $query['name'];

                    $sess_data['fullname']      = $user->name.' '.$user->lastname;
                    $this->session->set_userdata($sess_data);
                }
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('result_login', '<br>El usuario o contraseña son incorrectas.');
                redirect('login');
            }
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
