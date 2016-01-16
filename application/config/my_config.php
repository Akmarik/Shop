<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// настройки для формы валидации
$config['registration'] = array(
    array(
    'field'   => 'firstname',
    'label'   => 'Имя',
    'rules'   => 'trim|required|max_length[50]'
),
    array(
        'field'   => 'email',
        'label'   => 'email',
        'rules'   => 'required|valid_email|max_length[50]'
    ),
    array(
        'field'   => 'password',
        'label'   => 'пароль',
        'rules'   => 'trim|required|max_length[50]'
    ),
    array(
        'field'   => 'repeatPassword',
        'label'   => 'Подтверждение пароля',
        'rules'   => 'trim|required|matches[password]'
    ),
    array(
        'field'   => 'surname',
        'label'   => 'фамилия',
        'rules'   => 'trim|required|max_length[50]'
    ),
    array(
        'field'   => 'phone',
        'label'   => 'телефон',
        'rules'   => 'max_length[25]|numeric'

    )
);