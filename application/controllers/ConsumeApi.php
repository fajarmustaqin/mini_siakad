<?php

class ConsumeApi extends CI_Controller{

    var $api="";

    public function __construct(){
        parent::__construct();

        $this->api="https://jsonplaceholder.typicode.com";
        $this->load->library('curl');
        $this->load->library('session');
        $this->load->helper('form');
    }

    public function index(){
        $data['number'] = json_decode($this->curl->simple_get($this->api.'/posts'));
        $data['title'] = 'Consuming Public Api';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('list_api', $data);
        $this->load->view('templates/footer');
    }


    // function getItemFor($orderid){
    //     if(! $items = $this->awesomeorders->returnItems($orderid)){
    //         $this->_showNoItemsForOrder($orderid);
    //     }else{
    //         $this->_showApiOrderItems($items);
    //     }
    // }
}