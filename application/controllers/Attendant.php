<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attendant extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("attendant_model");
        $this->load->model("invitation_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataInv = $this->invitation_model->get_all();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Attendant",
            "dataAdmin" => $this->dataAdmin,
            "dataInv"   => $this->dataInv
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/attendant', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        if ($this->dataAdmin->role == 'admin') {
            $this->load->model("datatables");
            $this->datatables->setTable("attendant");

            $this->datatables->setColumn(
                [
                    '<index>',
                    '<get-name>',
                    '<get-email>',
                    '<get-phone>',
                    '<get-invtitle>',
                    '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>" data-email="<get-email>" data-invitation="<get-invitation>" data-invtitle="<get-invtitle>" data-phone="<get-phone>" data-role="<get-role>" data-password="<get-password>"  data-invitation="<get-invitation> "><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" data-photo="<get-photo>"><i class="fa fa-trash"></i></button></div>'
                ]
            );

            $this->datatables->setOrdering(["id", "name", "email", "phone", NULL]);
            $this->datatables->setSearchField(["name", "email", "phone"]);
            $this->datatables->generate();
        } else if ($this->dataAdmin->role == 'user') {
            $this->load->model("datatables");
            $this->datatables->setTable("attendant");

            $this->datatables->setColumn([
                '<index>',
                '<get-name>',
                '<get-email>',
                '<get-phone>',
                '<get-invtitle>',
            ]);
            $this->datatables->setOrdering(["id", "name", "email", "phone", NULL]);
            $this->datatables->setSearchField(["name", "email", "phone"]);
            $this->datatables->generate();
        }
    }


    function insert()
    {
        $this->process();
    }

    function insert_bulk()
    {
        $this->process_bulk();
    }

    function update($id)
    {
        $this->process("edit", $id);
    }

    private function process($action = "add", $id = 0)
    {
        $phone = $this->input->post("phone");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $invitation = $this->input->post("invitation");
        $invitationtitle = $this->input->post("invitation_title");

        if (!$phone or !$name or !$email) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {


            $insertData = [
                "id" => NULL,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "invitation" => $invitation,
                "invtitle" => $invitationtitle
            ];

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->attendant_model->post($insertData);
            } else if ($action == "edit") {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->attendant_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    private function process_bulk()
    {
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $phone = $this->input->post("phone");
        $invitation = $this->input->post("invitation");
        $invtitle = $this->input->post("invitation_title");

        $temp = count($name);

        $insertData = array();

        for ($i = 0; $i < $temp; $i++) {
            $insertData[] = array(
                "id" => NULL,
                "name" => $name[$i],
                "email" => $email[$i],
                "phone" => $phone[$i],
                "invitation" => $invitation[$i],
                "invtitle" => $invtitle[$i]
            );
        }

        $this->attendant_model->post_batch($insertData);


        $response['status'] = TRUE;
        $response['msg'] = "Data berhasil ditambahkan";


        echo json_encode($response);
    }

    function delete($id)
    {
        $response = '';
        $this->attendant_model->delete($id);
        if (!$this->attendant_model->find($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        } else {
            $response = [
                'status' => FALSE,
                'msg' => "Data gagal dihapus"
            ];
        }

        echo json_encode($response);
    }
}
