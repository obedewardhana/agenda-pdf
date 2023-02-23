<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    private $id;

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('id_session') == '') {
            redirect('member/login');
        }

        $this->load->model('member_model');
        $this->load->model('product_model');
        $this->load->model('cart_model');
        $this->load->library('upload');
    }

    public function index()
    {

        $push = [
            "pageTitle" => "Cart"
        ];

        $id = $this->session->userdata('id_member');
        $push['datas'] = $this->cart_model->get_items($id)->result();
        $push["count"] = $this->cart_model->count_qty($id)->row();
        $push["totals"] = $this->cart_model->count_total($id)->row();

        $this->template->load(template() . '/template', template() . '/cart', $push);
    }

    public function add($id)
    {
        $product = $this->product_model->find($id);
        $idproduct = $product->id;
        $qty = $this->input->post('qty');
        $name = $product->name;
        $price = $product->price;
        $idregister = $this->session->userdata('id_member');

        $cek = $this->cart_model->check($idregister, $idproduct);

        $insertData = [
            "id" => NULL,
            "id_register" => $idregister,
            "id_product" => $idproduct,
            "name" => $name,
            "price" => $price,
            "qty" => $qty,
            "subtotal" => $qty * ($product->price),
            'photo' => $product->photo
        ];

        $updateData = [
            "qty" => $cek->qty + $qty,
            "subtotal" => $cek->subtotal + ($qty * ($product->price))
        ];

        if (count($cek) == 1) {
            $this->cart_model->put($updateData, $idregister, $idproduct);
        } else {
            $this->cart_model->post($insertData);
        }

        redirect('member/services');
    }

    public function delete()
    {
        $idregister = $this->session->userdata('id_member');
        $this->cart_model->delete($idregister);
        redirect('cart');
    }

    public function delete_item($id)
    {
        $this->cart_model->delete_item($id);
        redirect('cart');
    }

    public function checkout()
    {

        $push = [
            "pageTitle" => "Checkout"
        ];

        $idregister = $this->session->userdata('id_member');
        $cek = $this->cart_model->check2($idregister);

        if (count($cek) == 1) {
            $id = $this->session->userdata('id_member');
            $push['datas'] = $this->cart_model->get_items($id)->result();
            $push["count"] = $this->cart_model->count_qty($id)->row();
            $push["totals"] = $this->cart_model->count_total($id)->row();
            $push['data'] = $this->member_model->get_profile($id)->row_array();

            $this->template->load(template() . '/template', template() . '/checkout', $push);
        } else {
            redirect('cart');
        }
    }

    function order()
    {
        $kode = $this->input->post('kode', TRUE);
        $name = $this->input->post('nmlgkp', TRUE);
        $address = $this->input->post('almtlgkp', TRUE);
        $email = $this->input->post('email', TRUE);
        $phone = $this->input->post('nohp', TRUE);
        $notes = $this->input->post('notes', TRUE);
        $date = date('Y-m-d');
        $total = $this->input->post('total', TRUE);
        $status = "Menunggu Pembayaran";

        if ($this->input->post('kode')) {
            $id = $this->session->userdata('id_member');

            $insertData = [
                "id" => NULL,
                "customerid" => $kode,
                "customername" => $name,
                "customerphone" => $phone,
                "customeraddress" => $address,
                "customeremail" => $email,
                "customernotes" => $notes,
                "date" => $date,
                "total" => $total,
                "status" => $status
            ];

            $order_id = $this->cart_model->post_order($insertData);

            $details = $this->cart_model->get_items($id)->result();

            $items_batch = [];
            $stock_batch = [];

            foreach ($details as $detail) {
                $temp = array();
                $temp["id"] = NULL;
                $temp["id_order"] = $order_id;
                $temp["id_product"] = $detail->id_product;
                $temp["name"] = $detail->name;
                $temp["price"] = $detail->price;
                $temp["subtotal"] = $detail->subtotal;
                $temp["qty"] = $detail->qty;
                $temp["photo"] = $detail->photo;

                $idproduct = $detail->id_product;
                $getstock = $this->product_model->get_stock($idproduct);

                $tempStock = array();
                $tempStock["id"] = $detail->id_product;
                $tempStock["stock"] = $getstock->stock - $detail->qty;

                $items_batch[] = $temp;
                $stock_batch[] = $tempStock;
            }

            $this->cart_model->post_details($items_batch);
            $this->cart_model->update_stock($stock_batch);

            $idregister = $this->session->userdata('id_member');
            $this->cart_model->delete($idregister);

            $this->session->set_flashdata('success_profile', 'Data berhasil diubah!');
            redirect('member/dashboard');
        } else {
            $this->session->set_flashdata('failed_profile', 'Data gagal diubah!');
            redirect('member/dashboard');
        }
    }

    function confirm()
    {
        $config['upload_path'] = '././img/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //nama yang terupload nantinya

        $this->upload->initialize($config);
        if (!empty($_FILES['xfoto']['name'])) {
            if ($this->upload->do_upload('xfoto')) {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = '././img/' . $gbr['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '60%';
                $config['new_image'] = '././img/' . $gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $gambar = $gbr['file_name'];
                date_default_timezone_set('Asia/Jakarta');
                $kode = $this->input->post('kode', TRUE);
                $tanggal = $this->input->post('tgltransfer', TRUE);
                $status = 'Dalam review';

                $this->cart_model->update_confirm($status, $tanggal, $gambar, $kode);
                echo $this->session->set_flashdata('success_profile', 'Konfirmasi anda berhasil terkirim. Silahkan menunggu 1x24 jam untuk dapat diproses!');
                redirect('member/dashboard');
            } else {
                echo $this->session->set_flashdata('failed_profile', 'Maaf, konfirmasi anda tidak valid!');
                redirect('member/dashboard');
            }
        } else {
            redirect('member/home');
        }
    }
}

/* End of file Cart.php */
