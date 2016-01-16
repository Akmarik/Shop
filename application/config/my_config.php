<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// ��������� ��� ����� ���������
$config['registration'] = array(
    array(
    'field'   => 'firstname',
    'label'   => '���',
    'rules'   => 'trim|required|max_length[50]'
),
    array(
        'field'   => 'email',
        'label'   => 'email',
        'rules'   => 'required|valid_email|max_length[50]'
    ),
    array(
        'field'   => 'password',
        'label'   => '������',
        'rules'   => 'trim|required|max_length[50]'
    ),
    array(
        'field'   => 'repeatPassword',
        'label'   => '������������� ������',
        'rules'   => 'trim|required|matches[password]'
    ),
    array(
        'field'   => 'surname',
        'label'   => '�������',
        'rules'   => 'trim|required|max_length[50]'
    ),
    array(
        'field'   => 'phone',
        'label'   => '�������',
        'rules'   => 'max_length[25]|numeric'

    )
);