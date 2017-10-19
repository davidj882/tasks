<?php
/* 
 * Developed by David Jonatán Tirado Reyes
 * https://tasks.cencade.mx
 */
 
class Dashboard extends CI_Controller{

    private $profile;

    function __construct()
    {
        parent::__construct();
        
        (!isset($_SESSION)) ? session_start() : '';
        
        if (!$this->session->userdata('username')) {
            redirect('login');
        }

        $this->profile = $this->session->userdata('profile');

        // BREADCRUMS
        $this->load->library('breadcrumbs');
        $this->breadHead = $this->breadcrumbs->push('Escritorio', 'dashboard', 'fa-dashboard');

        $data['home'] = strtolower(__CLASS__).'/';
        $this->load->vars($data);
    }

    function index()
    {
        $data['profile']        = $this->profile;
        $data['title']          = "Escritorio";
        $data['page_title']     = "Escritorio";
        $data['_view']          = 'dashboard';
        
        // BREADCRUMS
        //$this->breadcrumbs->push('Nueva Pregunta', 'admin/questions/add');
        $data['breadcrumb']     = $this->breadcrumbs->show();

        $this->load->view('layouts/main',$data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
