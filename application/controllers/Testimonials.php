<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonials extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("testimonial_model");
        $this->load->model("datatables");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function index()
	{

        $push = [
            "pageTitle" => "Data Testimonials",
            "dataAdmin" => $this->dataAdmin 
        ];

		$this->load->view('administrator/header',$push);
		$this->load->view('administrator/testimonials',$push);
		$this->load->view('administrator/footer',$push);
    }

    public function json() {
        $this->load->model("datatables");
        $this->datatables->setTable("testimonials");
        $this->datatables->setColumn([
            '<index>',
            '<get-name>',
            '<get-description>',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>" data-description="<get-description>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" data-description="<get-description>"><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id","name","description",NULL]);
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    function insert() {
        $this->process();
    }

    function update($id) {
        $this->process("edit",$id);
    }

    private function process($action = "add",$id = 0) {
        $name = $this->input->post("name");
        $description = $this->input->post("description");

        if(!$name OR !$description) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {
            $insertData = [
                "id" => NULL,
                "name" => $name,
                "description" => $description
            ];

            $response['status'] = TRUE;

            if($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->testimonial_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->testimonial_model->put($id,$insertData);
            }

        }

        echo json_encode($response);
    }

    function delete($id) {
        $response = [
            'status' => FALSE,
            'msg' => "Data gagal dihapus"
        ];

        if($this->testimonial_model->delete($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        }

        echo json_encode($response);
    }

}
?>