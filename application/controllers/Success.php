<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Success extends MY_Controller{

    public function index(){
    $this->display('frontend/main/success');
    }
}