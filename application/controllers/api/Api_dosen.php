<?php

require_once APPPATH . 'controllers/api/Api_auth.php';

use \Firebase\JWT\ExpiredException;
use chriskacerguis\RestServer\RestController;

class Api_dosen extends Api_auth{

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
            $dosen = $this->api->get_dosen();
        }else{
            $dosen = $this->api->get_dosen($id);
        }

        if($dosen){
            $this->response([
                'status' => 'success',
                'message' => 'data ditemukan',
                'data' => $dosen
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
            'nidn' => $this->post('nidn'),
            'nama_dsn' => $this->post('nama_dsn'),
            'jenis_kelamin_dsn' => $this->post('jenis_kelamin_dsn'),
            'no_hp_dsn' => $this->post('no_hp_dsn'),
            'no_hp_dsn' => $this->post('no_hp_dsn'),
            'email_dsn' => $this->post('email_dsn'),
            'alamat_dsn' => $this->post('alamat_dsn'),
            'created_by' => 'API'
        );

        if($this->api->post_dosen($data) > 0){
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
            'nidn' => $this->put('nidn'),
            'nama_dsn' => $this->put('nama_dsn'),
            'jenis_kelamin_dsn' => $this->put('jenis_kelamin_dsn'),
            'no_hp_dsn' => $this->put('no_hp_dsn'),
            'no_hp_dsn' => $this->put('no_hp_dsn'),
            'email_dsn' => $this->put('email_dsn'),
            'alamat_dsn' => $this->put('alamat_dsn'),
            'update_by' => 'API UPDATE'
        );


        if($this->api->update_dosen($id, $data) > 0){
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

    public function delete_dosen_post(){

        $id = $this->post('id');
        
        if($id === null){
            $this->response([
                'status' => false,
                'message' => 'tidak ada id yang di input',
                'data' => null
            ], RestController::HTTP_BAD_REQUEST);
        }else{
            if($this->api->delete_dosen($id) > 0){
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