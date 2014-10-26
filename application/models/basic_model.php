<?php

class Basic_Model extends CI_Model {

    public function __construct($table_name = '') {
        $this->table_name = $table_name;
    }

    public function delete_where($data) {
        $this->db->where($data);
        $this->db->delete($this->table_name);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function gets($ids) {
        if (empty($ids)) {
            return array();
        }

        $this->db->from($this->table_name);
        $this->db->where_in('id', $ids);
        return $this->db->get()->result();
    }

    public function get($id) {
        return $this->_get($this->table_name, $id);
    }

    protected function _get($table, $id) {
        return $this->where_one(array('id'=>$id));
    }


    public function count() {
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    public function where_count($data) {
        $query = $this->db->get_where($this->table_name, $data);
        return $query->num_rows();
    }

    public function save($data) {
        return $this->_save($this->table_name, $data);
    }

    protected function _save($table, $data) {
        if (array_key_exists('id', $data)) {
            $id = $data['id'];
            $this->db->update($table, $data, array('id' => $id));
        } else {
            $this->db->insert($table, $data);
            $id = $this->db->insert_id();
        }
        return $this->_get($table, $id);
    }

    public function where($data,$order_by=NULL, $limit=0,  $offset=0) {
        $this->db->from($this->table_name);
        $this->db->where($data);

        if ($limit > 0) {
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }

        if ($order_by) {
            $this->db->order_by($order_by);
        }

        return $this->db->get()->result();
    }

    public function where_one($data) {
        $objs = $this->where($data);
        if (count($objs) > 0) {
            return $objs[0];
        } else {
            return NULL;
        }
    }



}
