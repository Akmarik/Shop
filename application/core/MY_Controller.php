<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{

    protected $data = array(); // Данные которые буду передавать каждый раз в код шаблона

    public function __construct(){
        parent::__construct();
        $this->load->library('Templater', array('view_folder_path' => VIEWS_FOLDER_PATH)); //Таким способом подключаем библиотеку Templater, котору написали в папке libraries
        $this->setData('base_url', base_url());
        $this->setData('cart_total', $this->get_total_cart());
    }

    protected function setData($key, $value){
        $this->data[$key] = $value;
    }

    //название шаблона для вывода
    //Методдля отображения страниц
    public function display($template){
        echo $this->templater->render($template, $this->data);
    }

    // метод который генерит шаблон нативного CI и возвращает разметку
    protected function renderHTML($template, $data = array(), $return = false){
        return $this->load->view($template, $data, $return);
    }

    protected function get_total_cart(){
        $this->load->model('Order_list_model');
        $this->load->model('Membership_model');

        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');

        if(isset($is_logged_in)){
            $user = $this->Membership_model->getAll(array('username' => $username), 1);
            $this->db->like('id_order', $user[0]['id']);
            $this->db->from('order_list');
            return $this->db->count_all_results();
        }else{
            return false;
        }


    }

}