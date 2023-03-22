<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Minutes extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("minutes_model");
        $this->load->model("agenda_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataAg = $this->agenda_model->get_all();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Minutes",
            "dataAdmin" => $this->dataAdmin,
            "dataAg"   => $this->dataAg
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/minutes', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        if ($this->dataAdmin->role == 'admin') {
            $this->load->model("datatables");
            $this->datatables->setTable("minutes");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<get-title>',
                '<get-agtitle>',
                '[default_doc=<get-document>]',
                '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-title="<get-title>" data-description="<get-description>" data-photo="<get-photo>"  data-document="<get-document>" data-agenda="<get-agenda>" data-agtitle="<get-agtitle>"  data-creator="<get-creator>" data-agenda="<get-agenda>" data-agtitle="<get-agtitle>" data-datecreation="<get-datecreation>"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-title="<get-title>" data-photo="<get-photo>"><i class="fa fa-trash"></i></button></div>'
            ]);
            $this->datatables->setOrdering(["id", "title", "description", NULL]);
            $this->datatables->setSearchField(["title", "description"]);
            $this->datatables->generate();
        } else if ($this->dataAdmin->role == 'user') {
            $this->load->model("datatables");
            $this->datatables->setTable("minutes");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<get-title>',
                '<get-agtitle>',
                '[default_doc=<get-document>]',
            ]);
            $this->datatables->setOrdering(["id", "title", "description", NULL]);
            $this->datatables->setSearchField(["title", "description"]);
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
        $title = $this->input->post("title");
        $description = $this->input->post("description");
        $agenda = $this->input->post("agenda");
        $agendatitle = $this->input->post("agenda_title");
        $admin = $this->dataAdmin->username;

        if (!$title or !$description) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {
            $ima['upload_path']          = '././img/';
            $ima['allowed_types']        = 'jpeg|jpg|png|JPEG|JPG|PNG';
            $ima['max_size']             = 2048;
            $ima['overwrite']            = TRUE;
            $this->load->library('upload', $ima, 'imageupload');
            $this->imageupload->initialize($ima);
            $uploadim = $this->imageupload->do_upload('userfile');

            $date = 'doc-' . str_replace(' ', '-', $title) . '-' . date('Y-m-d');
            if (!is_dir('documents/' . $date)) {
                mkdir('./documents/' . $date, 0777, TRUE);
            }
            $path = '././documents/' . $date;

            $doc['upload_path']          = $path;
            $doc['allowed_types']        = '*';
            $doc['max_size']             = 2048;
            $doc['overwrite']            = TRUE;
            $this->load->library('upload', $doc, 'docupload');
            $this->docupload->initialize($doc);
            $uploaddoc = $this->docupload->do_upload('document');

            if ($uploadim && $uploaddoc) {
                $gbr = $this->imageupload->data();
                $gambar = $gbr['file_name'];

                $dok = $this->docupload->data();
                $dokumen = $dok['file_name'];

                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "description" => $description,
                    "agenda" => $agenda,
                    "agtitle" => $agendatitle,
                    "photo" => $gambar,
                    "document" => $path . '/' . $dokumen,
                    "creator" => $admin
                ];
            } else  if ($uploadim && !$uploaddoc) {
                $gbr = $this->imageupload->data();
                $gambar = $gbr['file_name'];

                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "description" => $description,
                    "agenda" => $agenda,
                    "agtitle" => $agendatitle,
                    "photo" => $gambar,
                    "creator" => $admin
                ];
            } else  if (!$uploadim && $uploaddoc) {
                $dok = $this->docupload->data();
                $dokumen = $dok['file_name'];

                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "description" => $description,
                    "agenda" => $agenda,
                    "agtitle" => $agendatitle,
                    "document" => $path . '/' . $dokumen,
                    "creator" => $admin
                ];
            } else {
                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "description" => $description,
                    "agenda" => $agenda,
                    "agtitle" => $agendatitle,
                    "creator" => $admin
                ];
            }

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->minutes_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->minutes_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    private function process_bulk()
    {
        $title = $this->input->post("title");
        $description = $this->input->post("description");
        $agenda = $this->input->post("agenda");
        $agtitle = $this->input->post("agenda_title");
        $admin = $this->dataAdmin->username;

        $temp = count($title);

        $insertData = array();

        for ($i = 0; $i < $temp; $i++) {
            $insertData[] = array(
                "id" => NULL,
                "title" => $title[$i],
                "description" => $description[$i],
                "creator" => $admin,
                "agenda" => $agenda[$i],
                "agtitle" => $agtitle[$i]
            );
        }

        $this->minutes_model->post_batch($insertData);


        $response['status'] = TRUE;
        $response['msg'] = "Data berhasil ditambahkan";


        echo json_encode($response);
    }

    function delete($id)
    {
        $response = '';
        $this->minutes_model->delete($id);
        if (!$this->minutes_model->find($id)) {
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
