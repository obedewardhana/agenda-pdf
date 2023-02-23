<?php
class Company_info {
    protected $ci;
    private $get_info;

    function __construct() {
        $this->ci =& get_instance();

        $this->get_info = $this->ci->db->get_where("company_info",["id" => 1])->row();
    }
    function get_company_logo() {
        return $this->get_info->logo;
    }
    function get_company_name() {
        return $this->get_info->name;
    }
    function get_company_address() {
        return $this->get_info->address;
    }
    function get_company_email() {
        return $this->get_info->email;
    }
    function get_company_whatsapp() {
        return $this->get_info->whatsapp;
    }
    function get_company_facebook() {
        return $this->get_info->facebook;
    }
    function get_company_instagram() {
        return $this->get_info->instagram;
    }
    function get_company_youtube() {
        return $this->get_info->youtube;
    }
    function get_company_bank() {
        return $this->get_info->bank_name;
    }
    function get_company_bankno() {
        return $this->get_info->bank_no;
    }
    function get_company_bankaccount() {
        return $this->get_info->bank_account;
    }
}