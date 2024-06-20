<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();

		checkAlreadyLogin();
		$this->load->library('form_validation');
	}
	public function index()
	{

		//validasi form
		$this->form_validation->set_rules('username','Username','Trim|required');
		$this->form_validation->set_rules('password','Password','Trim|required');
		$this->form_validation->set_rules('input_captcha','captcha','Trim|required');
		
		if($this->form_validation->run() == false){
			$path = './assets/captcha/';

			if(!file_exists($path)){
				$create = mkdir($path,0777);
				if(!$create)
					return;
			}

			$word = array_merge(range(0,9));
			$mix = shuffle($word);
			$str = substr(implode($word), 0,4);
			$data_ses = array('captcha_str' => $str);
			$this->session->set_userdata($data_ses);

			$val = array(
				'word'		=> $str,
				'img_path'	=> $path,
				'img_url'	=> base_url().'assets/captcha/',
				'img_width'	=> '150',
				'img_height'=> 40,
				'expiration'=> 7200
			);
			$cap = create_captcha($val);
			$data['captcha_image'] = $cap['image'];
			$data['title'] ='login siakad';
			$this->load->view('auth/login', $data);
		}else{
			$this->_login();
		}
	}

	private function _login(){
		$username		= $this->input->post('username');
		$password		= hash('sha256',$this->input->post('password'));
		$input_captcha	= $this->input->post('input_captcha');

		$user = $this->db->get_where('user',['username' => $username])->row_array();

		if($this->input->post('input_captcha') != $this->session->userdata('captcha_str')){

			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Captcha yang dimasukan salah</div>');
			redirect('auth');
		}else 
		
		if($user){

			if($user['is_active']==1) {
				
				if($password === $user['password']){

					$data = [
						'id'			=> $user['id'],
						'username'		=> $user['username'],
						'real_name'		=> $user['real_name'],
						'id_group'		=> $user['id_group']
					];

					$this->session->set_userdata($data);
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('auth');
				}

				
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username belum diaktifkan</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username belum terdaftar</div>');
			redirect('auth');
		}
	}
}
