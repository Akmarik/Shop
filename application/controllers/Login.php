<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller{

    public function index(){

        $form_html = $this->renderHTML('login_form', array(), true);
        $this->setData('login_form', $form_html);
        $this->setData('title', 'Войти');
        $this->display('frontend/main/login_form');
    }

    public function validate_credentials(){
        // если username и пароль совпадают в БД
        $query = $this->validate();
        if($query){
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
            );

            $this->session->set_userdata($data);
            redirect('/');
        }else{
            $this->index();
        }
    }

    public function validate(){
        // совпадает ли пароль и логин с БД
        $this->load->model('Membership_model');
        $query = $this->Membership_model->getAll(array('username' => $this->input->post('username'), 'password' => md5($this->input->post('password'))), 1);
        if(!empty($query)){
            return true;
        }
    }

    public function signup(){
        $form_html = $this->renderHTML('signup_form', array(), true);
        $this->setData('title', 'Создать аккаунт');
        $this->setData('form_signup', $form_html);
        $this->load->model('Mark_products_model');
        $marksOfCategory = $this->Mark_products_model->getAll();
        $this->setData('marksOfCategory', $marksOfCategory);
        $this->display('frontend/main/signup_form');
    }

    public function create_member(){
        // если был пост запрос
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // подключение библиотеки для валидации форм
            $this->load->library('form_validation');
            // подкулючение хелпера для обработки элементов форм
            $this->load->helper(array('form'));

            $config = array(
                array(
                    'field'   => 'firstname',
                    'label'   => 'Имя',
                    'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                    'field'   => 'lastname',
                    'label'   => 'фамилия',
                    'rules'   => 'trim|max_length[50]'
                ),
                array(
                    'field'   => 'email_address',
                    'label'   => 'email',
                    'rules'   => 'trim|required|valid_email|max_length[50]'
                ),
                array(
                    'field'   => 'password',
                    'label'   => 'пароль',
                    'rules'   => 'trim|required|max_length[32]'
                ),
                array(
                    'field'   => 'repeatPassword',
                    'label'   => 'Подтверждение пароля',
                    'rules'   => 'trim|required|matches[password]'
                ),

                array(
                    'field'   => 'phone',
                    'label'   => 'телефон',
                    'rules'   => 'trim|max_length[25]|numeric'

                ),
                array(
                    'field'   => 'username',
                    'label'   => 'username',
                    'rules'   => 'trim|required|max_length[50]'
                )

            );

            $this->form_validation->set_rules($config);

            // если данные прошли проверку
            if($this->form_validation->run() == TRUE){
                // получаем данные из формы
                $firstname = $this->input->post('firstname');
                $last_name = $this->input->post('lastname');
                $email_address = $this->input->post('email_address');
                $password = $this->input->post('password');
                $phone = $this->input->post('phone');
                $username = $this->input->post('username');
                $reg_date = new DateTime();

                // подключаем модель для работы с юзерами
                $this->load->model('Membership_model');

                // отправка юзера в БД
                $result = $this->Membership_model->insert(array(
                    'first_name' => $firstname,
                    'last_name' => $last_name,
                    'username' => $username,
                    'password' => md5($password),
                    'email_address' => $email_address,
                    'phone' => $phone,
                    'reg_date' => $reg_date->format('Y-m-d')
                ));

                redirect('/success');
            }else{
                $this->signup();
            }

        }
    }
}