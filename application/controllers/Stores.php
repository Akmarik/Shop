<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stores extends MY_Controller{

    public function index(){
        $this->load->model('Stores_model');
        $this->load->model('Mark_products_model');
        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');
        $stores = $this->Stores_model->getAll();
        $marksOfCategory = $this->Mark_products_model->getAll();
        $this->setData('marksOfCategory', $marksOfCategory);
        $this->setData('is_logged_in', $is_logged_in);
        $this->setData('username', $username);
        $this->setData('title', 'Магазины');
        $this->setData('stores', $stores);
        $this->display('frontend/main/stores');
    }
}