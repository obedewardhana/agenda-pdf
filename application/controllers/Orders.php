<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("cart_model");
        $this->load->model("product_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Data Orders",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/orders', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("orders");
        $this->datatables->setColumn([
            '<index>',
            '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-paymentphoto>"><div class="table-img"><img src="././img/[default_pic=<get-paymentphoto>]"></div></button>',
            '[reformat_date=<get-date>]',
            '<get-customername>',
            '[rupiah=<get-total>]',
            '<div class="text-center">
            <button type="button" class="btn btn-sm btn-warning btn-view" data-id="<get-id>" data-paymentdate="[reformat_date=<get-paymentdate>]"><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-status="<get-status>"><i class="fa fa-edit"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["id", "customername", "date", "total", NULL]);
        $this->datatables->setSearchField("customername","date");
        $this->datatables->generate();
    }

    public function detail($id = 0)
    {
        $query = $this->cart_model->get($id);
        if ($query->num_rows() > 0) {
            $response = $query->row_array();
            $response["items"] = $this->cart_model->get_details($id)->result_array();
            echo json_encode($response);
        }
    }

    public function update($id = 0)
    {
        $status = $this->input->post("status");

        if (!$status) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {

            $insertData = [
                "id" => NULL,
                "status" => $status
            ];

            unset($insertData['id']);
            $response['status'] = TRUE;
            $response['msg'] = "Data berhasil diedit";
            $this->cart_model->update_status($id, $insertData);
        }

        echo json_encode($response);
    }

    function delete($id)
    {
        $response = [
            'status' => FALSE,
            'msg' => "Data gagal dihapus"
        ];

        if ($this->product_model->delete($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        }

        echo json_encode($response);
    }
}
