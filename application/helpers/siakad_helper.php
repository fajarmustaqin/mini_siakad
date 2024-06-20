<?php

function logged_in(){

    $ci = get_instance();

    if(!$ci->session->userdata('username')){

        redirect('auth');
    }
}

function checkAlreadyLogin(){
    $ci =& get_instance();

    $user_session = $ci->session->userdata('id');

    if($user_session){
        redirect('dashboard');
    }
}

function checkNotLogin(){
    $ci =& get_instance();

    $user_session = $ci->session->userdata('id');

    if(!$user_session){
        redirect('auth');
    }
}
