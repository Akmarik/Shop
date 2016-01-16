<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller{

    public function get($id){
        $this->load->model('Products_model');
        $this->load->model('Mark_products_model');
        $marksOfCategory = $this->Mark_products_model->getAll();
        $product = $this->Products_model->getAll(array('id' => $id),1);
        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');

        $this->setData('is_logged_in', $is_logged_in);
        $this->setData('username', $username);
        $this->setData('title', 'Смартфоны');
        $this->setData('marksOfCategory', $marksOfCategory);
        $this->setData('product', $product);
        $this->display('frontend/main/products');
    }

    public function smartfone($item){
        $this->load->model('Products_model');
        $this->load->model('Mark_products_model');
        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');


        $m = $this->Mark_products_model->getAll(array('mark' => $item), 1);
        $product = $this->Products_model->getAll(array('id_mark' => $m[0]['id']));
        $marksOfCategory = $this->Mark_products_model->getAll();

        $this->setData('marksOfCategory', $marksOfCategory);
        $this->setData('title', "$item");
        $this->setData('product', $product);
        $this->setData('is_logged_in', $is_logged_in);
        $this->setData('username', $username);

        $this->display("frontend/main/Smartfone");
    }
}