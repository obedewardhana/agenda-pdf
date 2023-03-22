<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("agenda_model");
        $this->load->model("invitation_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
        $this->dataAgenda = $this->agenda_model->get_all();
        $this->dataInv = $this->invitation_model->get_all();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Agenda",
            "dataAdmin" => $this->dataAdmin,
            "dataInv"   => $this->dataInv
        ];

        $this->load->view('administrator/header', $push);
        $this->load->view('administrator/agenda', $push);
        $this->load->view('administrator/footer', $push);
    }

    public function json()
    {
        if ($this->dataAdmin->role == 'admin') {
            $this->load->model("datatables");
            $this->datatables->setTable("agenda");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<div><get-title><br><hr><get-description></div>',
                '[reformat_date=<get-startdate>]',
                '[reformat_date=<get-enddate>]',
                '<get-invtitle>',
                '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-title="<get-title>" data-description="<get-description>" data-photo="<get-photo>" data-startdate="<get-startdate>" data-enddate="<get-enddate>" data-invitation="<get-invitation>" data-invtitle="<get-invtitle>"  data-document="<get-document>"  data-creator="<get-creator>" data-datecreation="<get-datecreation>"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-title="<get-title>" data-photo="<get-photo>"><i class="fa fa-trash"></i></button></div>'
            ]);
            $this->datatables->setOrdering(["id", "title", "description","startdate", "enddate", "invtitle", NULL]);
            $this->datatables->setSearchField(["title", "description","startdate", "enddate", "invtitle",]);
            $this->datatables->generate();
        } else if ($this->dataAdmin->role == 'user') {
            $this->load->model("datatables");
            $this->datatables->setTable("agenda");
            $this->datatables->setColumn([
                '<index>',
                '<button type="button" class="btn-previewimg" data-id="<get-id>" data-photo="<get-photo>"><div class="table-img"><img src="././img/[default_pic=<get-photo>]"></div></button>',
                '<div><get-title><br><hr><get-description></div>',
                '[reformat_date=<get-startdate>]',
                '[reformat_date[<get-enddate>]',
                '<get-invtitle>',
            ]);
            $this->datatables->setOrdering(["id", "title", "description","startdate", "enddate", "invtitle", NULL]);
            $this->datatables->setSearchField(["title", "description","startdate", "enddate", "invtitle",]);
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
        $startdate = $this->input->post("startdate");
        $enddate = $this->input->post("enddate");
        $invitation = $this->input->post("invitation");
        $invitationtitle = $this->input->post("invitation_title");
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

            $date = 'doc-' . str_replace(' ', ' - ', $title) . ' - ' . date('Y-m-d');
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
                    "startdate" => $startdate,
                    "enddate" => $enddate,
                    "photo" => $gambar,
                    "invitation" => $invitation,
                    "invtitle" => $invitationtitle,
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
                    "startdate" => $startdate,
                    "enddate" => $enddate,
                    "invitation" => $invitation,
                    "invtitle" => $invitationtitle,
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
                    "startdate" => $startdate,
                    "enddate" => $enddate,
                    "invitation" => $invitation,
                    "invtitle" => $invitationtitle,
                    "document" => $path . '/' . $dokumen,
                    "creator" => $admin
                ];
            } else {
                $insertData = [
                    "id" => NULL,
                    "title" => $title,
                    "description" => $description,
                    "startdate" => $startdate,
                    "enddate" => $enddate,
                    "invitation" => $invitation,
                    "invtitle" => $invitationtitle,
                    "creator" => $admin
                ];
            }

            $response['status'] = TRUE;

            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->agenda_model->post($insertData);
            } else {
                unset($insertData['id']);

                $response['msg'] = "Data berhasil diedit";
                $this->agenda_model->put($id, $insertData);
            }
        }

        echo json_encode($response);
    }

    private function process_bulk()
    {
        $title = $this->input->post("title");
        $description = $this->input->post("description");
        $startdate = $this->input->post("startdate");
        $enddate = $this->input->post("enddate");
        $invitation = $this->input->post("invitation");
        $invtitle = $this->input->post("invitation_title");
        $admin = $this->dataAdmin->username;

        $temp = count($title);

        $insertData = array();

        for ($i = 0; $i < $temp; $i++) {
            $insertData[] = array(
                "id" => NULL,
                "title" => $title[$i],
                "description" => $description[$i],
                "startdate" => $startdate[$i],
                "enddate" => $enddate[$i],
                "invitation" => $invitation[$i],
                "invtitle" => $invtitle[$i],
                "creator" => $admin
            );
        }

        $this->agenda_model->post_batch($insertData);


        $response['status'] = TRUE;
        $response['msg'] = "Data berhasil ditambahkan";


        echo json_encode($response);
    }

    function delete($id)
    {
        $response = '';
        $this->agenda_model->delete($id);
        if (!$this->agenda_model->find($id)) {
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

    public function report()
    {

        $push = [
            "title"  => "Agenda",
            "agenda" => $this->dataAgenda
        ];

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan.pdf";
        $this->pdf->load_view('report_pdf', $push);
    }
}
