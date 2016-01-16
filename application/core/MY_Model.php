<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends  CI_Model{

    protected $table = '';

    //�������� ��� ������ �� �������
    public function getAll($condition = array(), $limit = 0){
        $this->db->where($condition);
        if($limit){
            $records = $this->db->get($this->table, $limit);
        }else{
            $records = $this->db->get($this->table);
        }
        return $records->result_array();
    }



    //��������� ����� ������
    public function get($condition){
        $this->db->where($condition);
        $result = $this->db->get($this->table);
        return $result->row_array();
    }

    //������� ������ � �������
    public function insert($data){
        $created_at = new DateTime();

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // ����� ���������� ������ � �������
    public function update($condition, $data){
        //$updated_at = new DateTime();
        //$data['updated_at'] = $updated_at->format('Y-m-d H:i:s');
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }

    // �������� ������ �� �������
    public function delete($condition){
        $this->db->delete($this->table, $condition);
        return $this->db->affected_rows();
    }

    // ������ ������ � �������
    public function trowInBasket($condition){
        $data['deleted'] = 1;
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }

    // ������� �� �������
    public function getOutBasket($condition){
        $data['deleted'] = 0;
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }



}