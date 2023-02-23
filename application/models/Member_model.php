<?php

class Member_model extends CI_Model {

	function simpan_register($nmlgkp,$almtlgkp,$nohp,$email,$pass,$tmplhr,$tgllhr,$id_session){
		$hsl=$this->db->query("INSERT INTO member (register_nmlgkp,register_almtlgkp,register_nohp,register_email,register_password,register_tmplhr,register_tgllhr,id_session) VALUES ('$nmlgkp','$almtlgkp','$nohp','$email','$pass','$tmplhr','$tgllhr','$id_session')");
		return $hsl;
	}

	function cek_user($email) {
        return $this->db->query("SELECT * FROM member where register_email='$email'");
    }

	function edit($table, $data){
        return $this->db->get_where($table, $data);
    }
 
    function update($table, $data, $where){
        return $this->db->update($table, $data, $where); 
    }

    function get_profile($id) {
        return $this->db->query("SELECT * FROM member where register_id='$id'");
    }

    function update_register($kode,$nmlgkp,$almtlgkp,$nohp,$pass,$tmplhr,$tgllhr){
		$hsl=$this->db->query("UPDATE member SET register_nmlgkp='$nmlgkp',register_almtlgkp='$almtlgkp',register_nohp='$nohp',register_password='$pass',register_tmplhr='$tmplhr',register_tgllhr='$tgllhr' WHERE register_id='$kode'");
		return $hsl;
	}

}