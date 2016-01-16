<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_list_model extends MY_Model{

    protected $table = 'order_list';

    public function getAllWithProduct($condition = array(), $limit = 0){

        $this->db->select('products.*, order_list.id_product, order_list.price as order_price, order_list.count as order_count');
        $this->db->from($this->table);
        $this->db->join('products', "products.id = {$this->table}.id_product");

        if($limit){
            $this->db->limit($limit);
        }
        if(count($condition) > 0){
            $this->db->where($condition);
        }
        $result = $this->db->get();
        return $result->result_array();
    }

}