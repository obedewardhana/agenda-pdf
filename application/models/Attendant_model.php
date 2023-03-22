<?php

class Attendant_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("attendant", $data);
    }

    function post_batch($data)
    {
        $this->db->insert_batch('attendant', $data); 
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("attendant", $where);
        } else {
            return $this->db->get("attendant");
        }
    }

    function get_total()
    {
        $query = $this->db->get('attendant');
        return $query->num_rows();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('attendant');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function set_attendant($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("attendant", $data);
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("attendant", $data);
    }

    function delete($id)
    {
        $this->db->delete("attendant", ["id" => $id]);
    }
}
