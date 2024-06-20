<?php

class Fungsi {

    protected $ci;

    function __construct(){
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('akunModel');
        $user_id = $this->ci->session->userdata('id');
        $user_data = $this->ci->akunModel->get_by_id($user_id);

        return $user_data;
    }
}