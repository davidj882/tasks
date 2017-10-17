<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {

    private $table = "users";

    function getLogin($username, $password) {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        return $this->db->get("users");
    }

    function allUsers() {
        return $this->db->get("users");
    }

    function byUsername($kode) {
        $this->db->where("username", $kode);
        return $this->db->get("users");
    }

    function byId($kode) {
        $this->db->where("id_user", $kode);
        return $this->db->get("users");
    }
    
    function getLoginData($username, $password) {
        $username = mysql_real_escape_string($username);
        $password = md5(mysql_real_escape_string($password));
        $getLogin = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        
        if (count($getLogin->result()) > 0) {
            foreach ($getLogin->result() as $qck) {
                foreach ($getLogin->result() as $qad) {
                    $sess_data['logged_in'] = 'aingLoginWebYeuh';
                    $sess_data['id_user']   = $qad->id_user;
                    $sess_data['username']  = $qad->username;
                    $sess_data['name']      = $qad->name;
                    $sess_data['profile']   = $qad->profile;
                    $this->session->set_userdata($sess_data);
                }
                redirect('dashboard');
            }
        } else {
            $this->session->set_flashdata('result_login', '<br>Nombre de usuario o contraseña incorrecta.');
            header('location:' . base_url() . 'login');
        }
    }

    function updateUser($id, $info) {
        $this->db->where("id_user", $id);
        $this->db->update("users", $info);
    }

    function insertUser($info) {
        $this->db->insert("users", $info);
    }

    function deleteUser($kode) {
        $this->db->where("id_user", $kode);
        $this->db->delete("users");
    }

    /*
     * function to get roles
     */
    function roleUserName($role_id)
    {
        return $this->db->get_where('roles',array('id'=>$role_id))->row()->role_name;
    }
}
