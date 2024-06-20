<?php

require_once APPPATH . 'controllers/api/Api_auth.php';

use \Firebase\JWT\ExpiredException;
use chriskacerguis\RestServer\RestController;

class Api_mahasiswa extends Api_auth{

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

        if($id === null ){
            $mahasiswa = $this->api->get_mahasiswa();
        }else{
            $mahasiswa = $this->api->get_mahasiswa($id);
        }

        if($mahasiswa){
            $this->response([
                'status' => 'success',
                'message' => 'data ditemukan',
                'data' => $mahasiswa
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
            'nim' => $this->post('nim'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jenis_kelamin' => $this->post('jenis_kelamin'),
            'alamat' => $this->post('alamat'),
            'no_hp' => $this->post('no_hp'),
            'created_by' => 'API'
        );

        if($this->api->post_mahasiswa($data) > 0){
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
            'nim' => $this->put('nim'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jenis_kelamin' => $this->put('jenis_kelamin'),
            'alamat' => $this->put('alamat'),
            'no_hp' => $this->put('no_hp'),
            'update_by' => 'API UPDATE'
        );


        if($this->api->update_mahasiswa($id, $data) > 0){
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

    public function delete_mahasiswa_post(){

        $id = $this->post('id');
        
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'tidak ada id yang di input',
                'data' => null
            ], RestController::HTTP_BAD_REQUEST);
        }else{
            if($this->api->delete_mahasiswa($id) > 0){
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