<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Users",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/users', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        if ($this->dataAdmin->role == 'admin') {
            $this->load->model("datatables");
            $this->datatables->setTable("users");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<get-name>',
                '<get-username>',
                '<get-email>',
                '<get-role>',
                '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-name="<get-name>" data-email="<get-email>" data-photo="<get-photo>" data-username="<get-username>" data-role="<get-role>" data-password="<get-password>"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" data-photo="<get-photo>"><i class="fa fa-trash"></i></button></div>'
            ]);
            $this->datatables->setOrdering(["id", "username", "name", "email", NULL]);
            $this->datatables->setSearchField(["username","name","email","role"]);
            $this->datatables->generate();
        } else if ($this->dataAdmin->role == 'user') { 
            $this->load->model("datatables");
            $this->datatables->setTable("users");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<get-name>',
                '<get-username>',
                '<get-email>',
                '<get-role>'
            ]);
            $this->datatables->setOrdering(["id", "username", "name", "email", NULL]);
            $this->datatables->setSearchField(["username","name","email","role"]);
            $this->datatables->generate();
        }
    }

    function insert()
    {
        $this->process();
    }

    function update($id)
    {
        $this->process("edit", $id);
    }

    private function process($action = "add", $id = 0)
    {
        $username = $this->input->post("username");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $role = $this->input->post("role");
        $password = $this->input->post("password");

        if (!$username or !$name or !$email or !$role) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {

            $config['upload_path']          = '././img/';
            $config['allowed_types']        = 'jpeg|jpg|png|JPEG|JPG|PNG';
            $config['max_size']             = 2048;
            $config['overwrite']            = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('userfile')) {
                $gbr = $this->upload->data();
                $gambar = $gbr['file_name'];

                $insertData = [
                    "id" => NULL,
                    "username" => $username,
                    "name" => $name,
                    "email" => $email,
                    "photo" => $gambar,
                    "role" => $role,
                    "password" => md5($password)
                ];
            } else {
                $insertData = [
                    "id" => NULL,
                    "username" => $username,
                    "name" => $name,
                    "email" => $email,
                    "role" => $role,
                    "password" => md5($password)
                ];
            }

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->user_model->post($insertData);
            } else {
                unset($insertData['id']);
                unset($insertData['password']);

                $response['msg'] = "Data berhasil diedit";
                $this->user_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    function delete($id)
    {
        $response = '';
        $this->user_model->delete($id);
        if (!$this->user_model->find($id)) {
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
