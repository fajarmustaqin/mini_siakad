<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Key.php';
require APPPATH . '/libraries/JWT.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/BeforeValidException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';

use \Firebase\JWT\Key;
use \Firebase\JWT\JWT;
use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\ExpiredException;

class Api_auth extends RestController{
    private $secretkey = '345274823478';

    public function __construct(){
        parent::__construct();
        $this->load->model('ApiModel', 'api');
        // $this->load->helper('verifyAuthToken');

        header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, OPTIONS, POST, GET, PUT");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    }

    public function login(){
        $jwt = new JWT();
        $JwtSecretKey = "myloginSecret";

        $username = $this->post('username');
        $password = $this->post('password');

        $result = $this->api->check_login($username, $password);

        if($result === false){
            echo 'User not found!';
        }else{
            $token = $jwt->encode($result, $JwtSecretKey, 'HS256');
            echo json_encode($token);
        }
    }

    
    function configToken(){
        $cnf['exp'] = 3600;
        $cnf['secretkey'] = '2212336221';
        return $cnf;
    }

    public function getToken_post(){

        $username = $this->post('username');
        $password = $this->post('password');
        $where = array(
            'username' => $username,
            'password' => hash('sha256', $password)
        );
        $cek = $this->api->cek_login($where);

        $data = $this->api->ambil_data($where);

        if($data->id_group == 1 || $data->id_group == 2){
            if($cek > 0){
                $exp = time() + 3600;
                $token = array(
                    "iss" => 'apprestservice',
                    "aud" => 'pengguna',
                    "iat" => time(),
                    "nbf" => time() + 10,
                    "exp" => $exp,
                    "data" => array(
                        "username" => $this->input->post('username'),
                        "password" => $this->input->post('password')
                    )
                );

                $jwt = JWT::encode($token, $this->configToken()['secretkey'], 'HS256');

                $output = [
                    'status' => 'success',
                    'message' => 'Berhasil Login',
                    "token" => $jwt,
                    "expireAt" => $token['exp']
                ];

                $data = array('kode' => '200', 'pesan' => 'token', 'data'=> array('token' => $jwt, 'exp' => $exp));

                $this->response($data, 200);
            }else{
                $this->response([
                    'message' => 'username atau password salah'
                ], 404);
            }
        }else{
            $this->response([
                'status' => 'failed',
                'message' => 'mahasiswa dan dosen tidak boleh akses!',
                'data' => $data->id_group
            ]);
        }
    }

    public function authtoken(){

        if(array_key_exists('Authorization', $this->input->request_headers()) == false){

            return $this->response([
                'message' => 'tidak ada token'
            ], 401);

            die();
        }
        
        $secret_key = $this->configToken()['secretkey'];
        $token = null;
        $authHeader = $this->input->request_headers()['Authorization'];
        $arr = explode(" ", $authHeader);
        $token = $arr[1];
        if($token){
            try{
                $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
                if($decoded){
                    return 'benar';
                }
            }catch(\Exception $e){
                $result = array('pesan' => 'Kode Signature Tidak Sesuai');
                return 'salah';
            }
        }
    }






    // public function viewtoken_post(){
    //     $date = new DateTime();

    //     $username = $this->post('username', true);
    //     $pass = hash('sha256', $this->post('password', true));

    //     $dataadmin = $this->api->is_valid($username);

    //     if($dataadmin){
    //         if($pass === $dataadmin->password){

    //             $payload['id'] = $dataadmin->id;
    //             $payload['username'] = $dataadmin->username;
    //             $payload['iat'] = $date->getTimestamp();
    //             $payload['exp'] = $date->getTimestamp() + 3600;

    //             $output['id_token'] = JWT::encode($payload, $this->secretkey, 'HS256');
    //             $this->response([
    //                 'status' => 'success',
    //                 'message' => 'token expire 1 jam',
    //                 'token' => $output
    //             ], RestController::HTTP_OK);
    //         }else{
    //             $this->viewtokenfail();
    //         }
    //     }else{
    //         $this->viewtokenfail();
    //     }
    // }

    // public function viewtokenfail(){
    //     $this->response([
    //         'status' => 'failed',
    //         'message' => 'Username dan Password yang anda masukan salah'
    //     ], RestController::HTTP_BAD_REQUEST);
    // }

    // public function cektoken(){
    //     $jwt = $this->input->get_request_header('Authorization');

    //     $decode = JWT::decode($jwt, $this->secretkey, 'HS256');

    //     var_dump($this->api->is_valid_num($decode->username));
    //     die();

    //     try{
    //         $decode = JWT::decode($jwt, $this->secretkey, 'HS256');


    //         die();

    //         if($this->api->is_valid_num($decode->password)>0){
    //             return true;
    //         }
    //     } catch(Exception $e){
    //         exit('Tokennya Expired');
    //     }
    // }
}