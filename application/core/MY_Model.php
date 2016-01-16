<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends  CI_Model{

    protected $table = '';

    //Выбираем все записи из таблицы
    public function getAll($condition = array(), $limit = 0){
        $this->db->where($condition);
        if($limit){
            $records = $this->db->get($this->table, $limit);
        }else{
            $records = $this->db->get($this->table);
        }
        return $records->result_array();
    }



    //получение одной записи
    public function get($condition){
        $this->db->where($condition);
        $result = $this->db->get($this->table);
        return $result->row_array();
    }

    //вставка данных в таблицу
    public function insert($data){
        $created_at = new DateTime();

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // метод обновления данных в таблице
    public function update($condition, $data){
        //$updated_at = new DateTime();
        //$data['updated_at'] = $updated_at->format('Y-m-d H:i:s');
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }

    // удаление записи из таблицы
    public function delete($condition){
        $this->db->delete($this->table, $condition);
        return $this->db->affected_rows();
    }

    // кинуть запись в корзину
    public function trowInBasket($condition){
        $data['deleted'] = 1;
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }

    // достать из корзины
    public function getOutBasket($condition){
        $data['deleted'] = 0;
        $this->db->update($this->table, $data, $condition);
        return $this->db->affected_rows();
    }



}