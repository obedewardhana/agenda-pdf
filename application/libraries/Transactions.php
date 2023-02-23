<?php
class Transactions {
    protected $ci;
    private $get_transaction;

    function __construct() {
        $this->ci =& get_instance();

        $this->get_transaction = $this->ci->db->get("transactions")->result();
    }
    function get_count_transaction() {
        return count($this->get_transaction);
    }
}