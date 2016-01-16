<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MY_Controller{

    public function __constract(){
        parent::__constract();
        $this->is_logged_in();
    }

    public function member_area(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');
        $this->setData('is_logged_in', $is_logged_in);
        $this->setData('username', $username);
        $this->display('frontend/main/members_area');

    }

    public function is_logged_in(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true){
            echo "Вы не авторизированы. Выполните <a href='/login'>вход</a>";
            die();
        }
    }
}