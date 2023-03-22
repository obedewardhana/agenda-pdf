<?php

class Minutes_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("minutes", $data);
    }

    function post_batch($data)
    {
        $this->db->insert_batch('minutes', $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("minutes", $where);
        } else {
            return $this->db->get("minutes");
        }
    }

    function get_total()
    {
        $query = $this->db->get('minutes');
        return $query->num_rows();
    }


    function get_all()
    {
        $query = $this->db->get('minutes');
        return $query->result();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('minutes');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function getTitle($id)
    {
        $res = $this->db->where('id', $id)->limit(1)->get('minutes');

        if ($res->num_rows() == 1) {
            return $res->row()->title;
        } else {
            return 'No data';
        }
    }

    function set_minutes($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("minutes", $data);
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("minutes", $data);
    }

    function delete($id)
    {
        $this->db->delete("minutes", ["id" => $id]);
    }
}
