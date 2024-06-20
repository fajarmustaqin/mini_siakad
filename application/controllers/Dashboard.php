<?php

class Dashboard extends CI_Controller{

    public function __construct(){
        parent::__construct();

        checkNotLogin();
    }

    public function index(){

        $data['title'] = "dashboard";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }

    public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_group');
        $this->session->unset_userdata('id');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">anda telah logout</div>');
		redirect('auth');
	}
}