<?php

class Product_model extends CI_Model
{
    function post($data)
    {
        $this->db->insert("products", $data);
    }

    function delete($id)
    {
        $this->db->delete("products", ['id' => $id]);
        return $this->db->affected_rows();
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("products", $data);
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('products');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    public function get_stock($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('products');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }
}
