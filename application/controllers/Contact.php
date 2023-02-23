<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {    
    
    function __construct() {
        parent::__construct();

        $this->load->model('cart_model');
    }

	public function index(){    
        $push = [
            "pageTitle" => "Contact"
        ];  

        $id = $this->session->userdata('id_member');
        $push["count"] = $this->cart_model->count_qty($id)->row();

		$this->template->load(template().'/template',template().'/contact',$push); 
	}
}
