<?php

require_once APPPATH . 'controllers/api/Api_auth.php';

use chriskacerguis\RestServer\RestController;

class Api_user extends Api_auth{

    public function __construct(){
        parent::__construct();

        $this->load->model('ApiModel', 'api');

        if($this->authtoken() == 'salah'){
            return $this->response(array('kode' => 401, 'message' => 'signature tidak sesuai', 'data' =>[]), '401');
            die();
        }

        if(array_key_exists('Authorization', $this->input->request_headers()) == false){

            return $this->response([
                'message' => 'tidak ada token'
            ], 401);

            die();
        }
    }

    public function index_get(){
        $id = $this->get('id');

        if($id === null){
            $user = $this->api->get_user();
        }else{
            $user = $this->api->get_user($id);
        }

        if($user){
            $this->response([
                'status' => 'success',
                'message' => 'data ditemukan',
                'data' => $user
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => 'failed',
                'message' => 'data tidak ditemukan',
                'data' => null
            ], RestController::HTTP_NOT_FOUND);
        }
    }

    public function index_post(){
        $data = array(
            'username' => $this->post('username'),
            'real_name' => $this->post('real_name'),
            'email' => $this->post('email'),
            'password' => hash('sha256', $this->post('password')),
            'id_group' => $this->post('id_group')
        );

        if($this->api->post_user($data) > 0){
            $this->response([
                'status' => 'success',
                'message' => 'data berhasil di inputkan',
                'data' => $data
            ], RestController::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'failed input',
                'data' => null
            ], 502);
        }
    }

    public function index_put(){
        $id = $this->put('id');

        $data = array(
            'username' => $this->put('username'),
            'real_name' => $this->put('real_name'),
            'email' => $this->put('email'),
            'password' => hash('sha256', $this->put('password')),
            'id_group' => $this->put('id_group')
        );


        if($this->api->update_user($id, $data) > 0){
            $this->response([
                'status' => true,
                'message' => 'data berhasil di edit',
                'data' => $data
            ]);
        }else{
            $this->response([
                'status' => false,
                'message' => 'update data gagal',
                'data' => null
            ]);
        }
    }

    public function delete_user_post(){

        $id = $this->post('id');
        
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'tidak ada id yang di input',
                'data' => null
            ], RestController::HTTP_BAD_REQUEST);
        }else{
            if($this->api->delete_user($id) > 0){
                $this->response([
                    'status' => true,
                    'message' => 'data berhasil di hapus',
                    'data' => $id
                ], RestController::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'id tidak ditemukan',
                    'data' => null
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }

}