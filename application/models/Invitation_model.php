<?php

class Invitation_model extends CI_Model
{

    function post($data)
    {
        $this->db->insert("invitation", $data);
    }

    function post_batch($data)
    {
        $this->db->insert_batch('invitation', $data);
    }

    function get($where = array())
    {
        if ($where) {
            return $this->db->get_where("invitation", $where);
        } else {
            return $this->db->get("invitation");
        }
    }

    function get_total()
    {
        $query = $this->db->get('invitation');
        return $query->num_rows();
    }


    function get_all()
    {
        $query = $this->db->get('invitation');
        return $query->result();
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('invitation');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function getTitle($id)
    {
        $res = $this->db->where('id', $id)->limit(1)->get('invitation');

        if ($res->num_rows() == 1) {
            return $res->row()->title;
        } else {
            return 'No data';
        }
    }

    function set_invitation($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("invitation", $data);
    }

    function put($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("invitation", $data);
    }

    function delete($id)
    {
        $this->db->delete("invitation", ["id" => $id]);
    }
}
