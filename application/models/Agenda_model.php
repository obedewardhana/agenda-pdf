<?php

class Agenda_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("agenda", $data);
    }

    function post_batch($data)
    {
        $this->db->insert_batch('agenda', $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("agenda", $where);
        } else {
            return $this->db->get("agenda");
        }
    }

    function get_total()
    {
        $query = $this->db->get('agenda');
        return $query->num_rows();
    }


    function get_all()
    {
        $query = $this->db->get('agenda');
        return $query->result();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('agenda');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function getTitle($id)
    {
        $res = $this->db->where('id', $id)->limit(1)->get('agenda');

        if ($res->num_rows() == 1) {
            return $res->row()->title;
        } else {
            return 'No data';
        }
    }

    function set_agenda($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("agenda", $data);
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("agenda", $data);
    }

    function delete($id)
    {
        $this->db->delete("agenda", ["id" => $id]);
    }
}
