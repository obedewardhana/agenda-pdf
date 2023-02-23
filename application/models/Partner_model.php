<?php

class Partner_model extends CI_Model {
    function post($data) {
        $this->db->insert("partners",$data);
    }

    function delete($id) {
        $this->db->delete("partners",['id' => $id]);
        return $this->db->affected_rows();
    }

    function put($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("partners",$data);
    }

    function get_items() {
        return $this->db->get("partners");
    }
}