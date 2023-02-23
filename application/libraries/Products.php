<?php
class Products
{
    protected $ci;
    private $get_product;

    function __construct()
    {
        $this->ci = &get_instance();

        $this->get_product = $this->ci->db->limit(6)->get("products")->result();
    }
    function get_product()
    {
        return $this->get_product;
    }
    function get_product_id()
    {
        return $this->get_product->id;
    }
    function get_product_name()
    {
        return $this->get_product->name;
    }
    function get_product_photo()
    {
        return $this->get_product->photo;
    }
    function get_product_price()
    {
        return $this->get_product->price;
    }
    function get_product_stock()
    {
        return $this->get_product->stock;
    }
    function get_count_products()
    {
        return count($this->get_product);
    }
}
