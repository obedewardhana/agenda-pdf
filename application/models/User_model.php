<?php

class User_model extends CI_Model {

    function post($data) {
        $this->db->insert("users",$data);
    }

    function get($where = array()) {
        if($where) {
            return $this->db->get_where("users",$where);
        } else {
            return $this->db->get("users");
        }
    }

    public function find($id)
    {
        $result = $this->db->where('id', $id)
            ->limit(1)
            ->get('users');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function set_company($data) {
        $this->db->where("id",1);
        $this->db->update("company_info",$data);
    }

    function set_user($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("users",$data);
    }

    function put($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("users",$data);
    }

    function delete($id) {
        $this->db->delete("users",["id" => $id]);
    }
}