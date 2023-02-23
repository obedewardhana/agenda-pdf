<?php

class Cart_model extends CI_Model
{
    function post($data)
    {
        $this->db->insert("carts", $data);
    }

    function delete($id)
    {
        $this->db->delete("carts", ['id_register' => $id]);
        return $this->db->affected_rows();
    }

    function delete_item($id)
    {
        $this->db->delete("carts", ['id' => $id]);
        return $this->db->affected_rows();
    }

    function put($updateData, $idregister, $idproduct)
    {
        $this->db->where("id_register", $idregister);
        $this->db->where("id_product", $idproduct);
        $this->db->update("carts", $updateData);
    }

    public function check($idregister, $idproduct)
    {
        $result = $this->db->where('id_register', $idregister)
            ->where('id_product', $idproduct)
            ->limit(1)
            ->get('carts');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    public function check2($idregister)
    {
        $result = $this->db->where('id_register', $idregister)
            ->limit(1)
            ->get('carts');

        if ($result->num_rows() > 0) return $result->row();
        else return array();
    }

    function get_items($id)
    {
        $this->db->where("id_register", $id);
        return $this->db->get("carts");
    }

    function count_qty($id)
    {
        return $this->db->query("SELECT SUM(qty) as total FROM carts WHERE id_register='$id'");
    }

    function count_total($id)
    {
        return $this->db->query("SELECT SUM(subtotal) as subtotal FROM carts WHERE id_register='$id'");
    }

    function post_order($data)
    {
        $this->db->insert("orders", $data);
        return $this->db->insert_id();
    }

    function post_details($data)
    {
        $this->db->insert_batch("order_details", $data);
    }

    function update_stock($data)
    {
        $this->db->update_batch("products", $data, "id");
    }

    function get_orders($id)
    {
        return $this->db->query("SELECT orders.*, DATE_FORMAT(date,'%d/%m/%Y') as order_date, status, total FROM orders WHERE customerid='$id' ");
    }

    function get_detail($id){
        return $this->db->query("SELECT order_details.*, name,qty,subtotal FROM order_details WHERE id_order='$id' ");
    }

    function update_confirm($status, $tanggal, $gambar, $kode)
	{
		$hsl=$this->db->query("UPDATE orders SET status='$status', paymentdate='$tanggal', paymentphoto='$gambar' WHERE id='$kode'");
		return $hsl;
	}

    function get($id = 0) {
        if($id) {
            return $this->db->get_where("orders",["orders.id" => $id]);
        } else {
            return $this->db->get("orders");
        }
    }

    function get_details($id) {
        $this->db->select("order_details.*,orders.customername,orders.customeraddress,orders.status, orders.paymentdate");
        $this->db->join("orders","orders.id = order_details.id_order","left");
        return $this->db->get_where("order_details",["id_order" => $id]);
    }

    function update_status($id, $data)
    {
        $this->db->where("id", $id);
        $this->db->update("orders", $data);
    }
}
