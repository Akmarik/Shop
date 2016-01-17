<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller{

    public function index(){
        $this->load->model('Order_list_model');
        $this->load->model('Membership_model');
        $this->load->model('Products_model');
        $this->load->model('Mark_products_model');

        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');

        if($username){
            $user = $this->Membership_model->getAll(array('username' => $username), 1);

            $marksOfCategory = $this->Mark_products_model->getAll();
            $list_products = $this->Order_list_model->getAllWithProduct(array('id_order' => $user[0]['id'])); //тут id_product

            $this->setData('list_products', $list_products);

            $this->setData('username', $username);
            $this->setData('is_logged_in', $is_logged_in);
            $this->setData('marksOfCategory', $marksOfCategory);
            $this->setData('title', 'Корзина покупок');
            $this->display('frontend/main/cart');
        }else{
            $marksOfCategory = $this->Mark_products_model->getAll();
            $this->setData('marksOfCategory', $marksOfCategory);
            $this->setData('title', 'Корзина покупок');
            $this->display('frontend/main/cart');
        }
    }


    protected function order(){
        $this->load->model('Membership_model');
        $username = $this->session->userdata('username');
        if(isset($username)){

            $user = $this->Membership_model->getAll(array('username' => $username), 1);
            $reg_date = new DateTime();

            $user_order = array(
                'id_user'=> $user[0]['id'],
                'status'=> '0',
                'date_order' => $reg_date->format('Y-m-d')
            );
            $this->Orders_model->insert($user_order);
        }
    }

    public function add(){
        header('Content-type: application/json');
        $id = $_POST['id'];
        $response = array('info' => '1');

        $this->load->model('Products_model');
        $this->load->model('Order_list_model');
        $this->load->model('Orders_model');
        $this->load->model('Membership_model');
        $username = $this->session->userdata('username');


        if($username){
            $user = $this->Membership_model->getAll(array('username' => $username), 1);
            $order_id_user = $this->Orders_model->getAll(array('id_user' => $user[0]['id']));

            if(empty($order_id_user)){
                $this->order();
            }elseif(!empty($order_id_user)){
                $productCart = $this->Products_model->getAll(array('id' => $id));

                $data = array(
                    'id_product' => $productCart[0]['id'],
                    'price' => $productCart[0]['price'],
                    'count' => 1,
                    'id_order' => $order_id_user[0]['id_user']
                );

                $list_product = $this->Order_list_model->getAll(array('id_order' => $data['id_order']));

                $a=array(); //закидываем все id_product какогото юзера

                foreach($list_product as $k=>$v){
                    $a[] = $list_product[$k]['id_product'];
                }

                if(!in_array($id, $a)){
                    $this->Order_list_model->insert($data);
                    $this->db->like('id_order', $user[0]['id']);
                    $this->db->from('order_list');
                    $total = $this->db->count_all_results();

                    $response['total'] = $total;
                }else{
                    $response['info'] = '3';
                }
            }
        }else{
            $response['info'] = '2';
        }
    echo json_encode($response);
    }

    public function count_test(){
        header('Content-type: application/json');
        $this->load->model('Order_list_model');
        $this->load->model('Membership_model');
        $username = $this->session->userdata('username');
        $user = $this->Membership_model->getAll(array('username' => $username), 1);

        if(isset($_POST['arrow_previous'])){
            $arrow = $_POST['arrow_previous'];
            $choose_product = $this->Order_list_model->getAll(array('id_product' => $arrow, 'id_order' => $user[0]['id']),1);
            $priceTotal = $this->Order_list_model->getAll(array('id_order' => $user[0]['id']));

            if($choose_product[0]['count'] > 1){
                $new_count = $choose_product[0]['count'] - 1;
                $new_price = $new_count * $choose_product[0]['price'];

            }else{
                return false;
            }
        }elseif(isset($_POST['arr_next'])){
            $arrow = $_POST['arr_next'];
            $choose_product = $this->Order_list_model->getAll(array('id_product' => $arrow, 'id_order' => $user[0]['id']),1);
            $new_count = $choose_product[0]['count'] + 1;
            $new_price = $new_count * $choose_product[0]['price'];
        }

        $update_count = array(
            'count' => $new_count
        );

        $this->db->where('id_product', $arrow, 'id_order', $user[0]['id']);
        $this->db->update('order_list', $update_count);

        $data = array(
            'total_count' => $new_count,
            'total_price' => $new_price
        );

        echo json_encode($data);
    }


    public function deleteProduct(){
        header('Content-type: application/json');
        $deleteProduct = $_POST['deleteProduct'];

        $this->load->model('Order_list_model');
        $this->load->model('Membership_model');
        $username = $this->session->userdata('username');
        $user = $this->Membership_model->getAll(array('username' => $username), 1);
        $response = array(
            'success' => false
        );
        if($this->db->delete('order_list', array('id_product' => $deleteProduct, 'id_order' => $user[0]['id']))){

            $this->db->like('id_order', $user[0]['id']);
            $this->db->from('order_list');
            $total = $this->db->count_all_results();

            $response['success'] = true;
            $response['total'] = $total;
        }
        echo json_encode($response);
    }


    public function ordercomplete(){
            $form_html = $this->renderHTML('order_form', array(), true);
            $is_logged_in = $this->session->userdata('is_logged_in');
            $username = $this->session->userdata('username');
            $this->setData('title', 'Оформить заказ');
            $this->setData('order_form', $form_html);
            $this->setData('username', $username);
            $this->setData('is_logged_in', $is_logged_in);
            $this->display('frontend/main/order_form');
    }

    public function order_success(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        $username = $this->session->userdata('username');
        $this->setData('title', 'Заказ');

        $this->setData('username', $username);
        $this->setData('is_logged_in', $is_logged_in);
        $this->display('frontend/main/order_success');
    }


    public function order_complete(){
        $this->load->model('Orders_model');
        // если был пост запрос
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // подключение библиотеки для валидации форм
            $this->load->library('form_validation');
            // подкулючение хелпера для обработки элементов форм
            $this->load->helper(array('form'));

            $config = array(
                array(
                    'field'   => 'country',
                    'label'   => 'город',
                    'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                    'field'   => 'street',
                    'label'   => 'улица',
                    'rules'   => 'trim|required|max_length[50]'
                ),
                array(
                    'field'   => 'build',
                    'label'   => 'номер дома',
                    'rules'   => 'trim|required|max_length[4]'
                ),

                array(
                    'field'   => 'flat_office',
                    'label'   => 'Квартира Офис',
                    'rules'   => 'trim|max_length[25]|numeric'

                ),
                array(
                    'field'   => 'orderTextarea',
                    'label'   => 'Дополнительно',
                    'rules'   => 'trim|max_length[50]'
                )

            );

            $this->form_validation->set_rules($config);
            $order_delivery_type = $this->input->post('order_delivery_type');

            if($order_delivery_type == '2'){
                if($this->form_validation->run() == TRUE){
                    // получаем данные из формы

                    $country = $this->input->post('country');
                    $street = $this->input->post('street');
                    $build = $this->input->post('build');
                    $flat_office = $this->input->post('flat_office');
                    $orderTextarea = $this->input->post('orderTextarea');

                    $username = $this->session->userdata('username');
                    $user = $this->Membership_model->getAll(array('username' => $username), 1);
                    $this->load->library('email');

                    $this->email->from('http://shop.loc/', "Заказ юзера ".$user[0]['username']);
                    $this->email->to('dm_martych@mail.ru');
                    $this->email->subject('Заказ shop.loc');
                    $this->email->message("ТИП ДОСТАВКИ: КУРЬЕР; Город: $country, улица: $street, дом: $build, кваритира-офис: $flat_office, дополнительно: $orderTextarea ");
                    $this->email->send();
                    // подключаем модель для работы с юзерами
                    $this->load->model('Membership_model');

                    $data = array(
                        'status' => '1'
                    );

                    $this->db->where('id_user', $user[0]['id']);
                    $this->db->update('orders', $data);

                    $this->order_success();
                }else{
                    $this->ordercomplete();
                }
            }else{
                $username = $this->session->userdata('username');
                $user = $this->Membership_model->getAll(array('username' => $username), 1);
                $this->load->model('Membership_model');

                $data = array(
                    'status' => '1'
                );

                $this->db->where('id_user', $user[0]['id']);
                $this->db->update('orders', $data);
                $this->load->library('email');

                $this->email->from('http://shop.loc/', "Заказ юзера ".$user[0]['username']);
                $this->email->to('dm_martych@mail.ru');
                $this->email->subject('Заказ shop.loc');
                $this->email->message("Самовывоз");
                $this->email->send();
                $this->order_success();
            }
        }
    }

}