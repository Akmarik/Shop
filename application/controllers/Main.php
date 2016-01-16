<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller{

    public function index(){
        $this->load->model('Products_model');
        $this->load->model('Mark_products_model');

        $products = $this->Products_model->getAll(array('population  >= '=>'4'), 9);
        $marksOfCategory = $this->Mark_products_model->getAll();

        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');


        $this->setData('is_logged_in', $is_logged_in);
        $this->setData('username', $username);

        $this->setData('title', 'Главная страница');
        $this->setData('products', $products);
        $this->setData('marksOfCategory', $marksOfCategory);

        $this->display('frontend/main/index');
    }

    public function exitFormLogin(){
        $this->session->sess_destroy('username');
        redirect('/');
    }


}