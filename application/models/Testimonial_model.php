<?php

class Testimonial_model extends CI_Model {
    function post($data) {
        $this->db->insert("testimonials",$data);
    }

    function delete($id) {
        $this->db->delete("testimonials",['id' => $id]);
        return $this->db->affected_rows();
    }

    function put($id,$data) {
        $this->db->where("id",$id);
        $this->db->update("testimonials",$data);
    }
}