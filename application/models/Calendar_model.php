<?php

class Calendar_model extends CI_Model
{
 function fetch_all_event(){
  $this->db->order_by('id');
  return $this->db->get('agenda');
 }

 function insert_event($data)
 {
  $this->db->insert('agenda', $data);
 }

 function update_event($data, $id)
 {
  $this->db->where('id', $id);
  $this->db->update('agenda', $data);
 }

 function delete_event($id)
 {
  $this->db->where('id', $id);
  $this->db->delete('agenda');
 }
}

?>