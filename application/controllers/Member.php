<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->model('member_model');
		$this->load->model('cart_model');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->load->helper('string');
	}

	public function register()
	{
		$push = [
			"pageTitle" => "Register"
		];

		if($this->session->userdata('id_member') != ''){
			redirect('member/dashboard');
		}

		$this->template->load(template() . '/template', template() . '/register', $push);
	}

	public function login()
	{
		$push = [
			"pageTitle" => "Login"
		];

		if($this->session->userdata('id_member') != ''){
			redirect('member/dashboard');
		}

		$this->template->load(template() . '/template', template() . '/login', $push);
	}

	function simpan_register()
	{
		$nmlgkp = $this->input->post('nmlgkp', TRUE);
		$almtlgkp = $this->input->post('almtlgkp', TRUE);
		$nohp = $this->input->post('nohp', TRUE);
		$email = $this->input->post('email', TRUE);
		$pass = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
		$tmplhr = $this->input->post('tmplhr', TRUE);
		$tgllhr = $this->input->post('tgllhr', TRUE);
		$id_session = md5($this->input->post('nmlgkp')) . '-' . date('YmdHis');
		$this->form_validation->set_rules('email', 'Email', 'is_unique[member.register_email]');

		if ($this->form_validation->run() != false) {
			$this->member_model->simpan_register($nmlgkp, $almtlgkp,  $nohp, $email, $pass, $tmplhr, $tgllhr, $id_session);
			$this->session->set_flashdata('success_register', 'Registrasi Berhasil, Silahkan login untuk melakukan pemesanan!');
			//echo $this->session->set_flashdata('msg','Success');
			redirect('member/login');
		} else {
			$this->session->set_flashdata('failed_register', 'Registrasi Gagal, Email sudah terdaftar!');
			redirect('member/register');
		}
	}

	function auth()
	{

		$push = [
			"pageTitle" => "Login"
		];

		if ($this->input->post()) {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$cek = $this->member_model->cek_user($email);
			$row = $cek->row_array();
			$total = $cek->num_rows();

			if ($total > 0) {
				$hash = $row['register_password'];
				if (password_verify($password, $hash)) {
					$this->session->set_userdata(array(
						'email' => $row['register_email'],
						'nama_lengkap' => $row['register_nmlgkp'],
						'id_member' => $row['register_id'],
						'id_session' => $row['id_session']
					));
					redirect('member/dashboard');
				} else {
					$this->session->set_flashdata('login_failed', 'Password salah!');
					redirect('member/login');
				}
			} else {
				$this->session->set_flashdata('login_failed', 'Email belum terdaftar!');
				redirect('member/login');
			}
		} else if ($this->session->userdata('id_session') != '') {
			redirect('member/home');
		} else {
			$this->template->load(template() . '/template', template() . '/login', $push);
		}
	}

	public function dashboard()
	{
		
        if($this->session->userdata('id_session') == '') {
            redirect('member/login');
        }

		$push = [
			"pageTitle" => "Member",
		];
		$id = $this->session->userdata('id_member');
		$push['data'] = $this->member_model->get_profile($id)->row_array();
		$push['orders'] = $this->cart_model->get_orders($id)->result();
        $push["count"] = $this->cart_model->count_qty($id)->row();
		

		$this->template->load(template() . '/template', template() . '/dashboard', $push);
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('member/login');
	}

	function forgot()
	{

		$push = [
			"pageTitle" => "Forgot Password"
		];

		if ($this->session->userdata('id_session') == '') {
			if ($this->input->post()) {
				$email = $this->input->post('email');
				$cek = $this->member_model->cek_user($email);
				$row = $cek->row_array();
				$total = $cek->num_rows();

				if ($total > 0) {
					$email           = $this->input->post('email');
					$subject         = "Permintaan Perubahaan Password";
					$message         = "<html><body>
					<table style='margin-left:25px'>
					<tr><td>Halo $row[register_nmlgkp],<br>
					Seseorang baru saja meminta untuk mengatur ulang kata sandi Anda.<br>
					Klik di sini untuk mengganti kata sandi Anda.<br>
					Atau Anda dapat copas (Copy Paste) url dibawah ini ke address Bar Browser anda :<br>
					<a href='" . base_url() . "member/reset/$row[id_session]'>" . base_url() . "member/reset/$row[id_session]</a><br><br>
			  
					Tidak meminta penggantian ini?<br>
					Jika Anda tidak meminta kata sandi baru, segera beri tahu kami.<br></td></tr>
					</table>
					</body></html> \n";

					$config = [
						'mailtype'  => 'html',
						'charset'   => 'utf-8',
						'protocol'  => 'smtp',
						'smtp_host' => 'smtp.gmail.com',
						'smtp_user' => 'mrmekanikweb@gmail.com',  // Email gmail
						'smtp_pass'   => 'cobalagi123',  // Password gmail
						'smtp_crypto' => 'ssl',
						'smtp_port'   => 465,
						'crlf'    => "\r\n",
						'newline' => "\r\n"
					];

					$this->email->initialize($config);

					$this->email->from('mrmekanikweb@gmail.com', 'Website Bengkel');
					$this->email->to($email);
					$this->email->cc('');
					$this->email->bcc('');
					$this->email->attach('');

					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->set_mailtype("html");

					if ($this->email->send()) {
						$this->session->set_flashdata('link_sent', 'Link untuk merubah password telah dikirim ke email anda.');
						$this->template->load(template() . '/template', template() . '/emailsent', $push);
					} else {
						$this->session->set_flashdata('failed_sent', $this->email->print_debugger());
						$this->template->load(template() . '/template', template() . '/emailsent', $push);
					}
				} else {
					$this->session->set_flashdata('email_notexist', 'Email belum terdaftar!');
					redirect('member/forgot');
				}
			} else {
				$this->template->load(template() . '/template', template() . '/forgot', $push);
			}
		} else {
			redirect('member/login');
		}
	}

	function reset()
	{

		$push = [
			"pageTitle" => "Reset Password"
		];

		$this->session->set_userdata(array('id_session' => $this->uri->segment(3)));
		$usr = $this->member_model->edit('member', array('id_session' => $this->session->id_session));
		if ($usr->num_rows() >= 1) {
			if ($this->input->post()) {
				$data = array('register_password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT));
				$where = array('id_session' => $this->input->post('id_session'));
				$this->member_model->update('member', $data, $where);

				$newsession = array('id_session' => random_string('alnum', 16) . '-' . date('YmdHis'));
				$where2 =  array('id_session' => $this->uri->segment(3));
				$this->member_model->update('member', $newsession, $where2);

				$this->session->unset_userdata('id_session');
				$this->session->set_flashdata('success_reset', 'Password berhasil diubah!');
				redirect('member/login');
			} else {
				$this->template->load(template() . '/template', template() . '/reset', $push);
			}
		} else {
			$this->session->set_flashdata('failed', 'Link Kadaluarsa!');
			$this->template->load(template() . '/template', template() . '/reset', $push);
		}
	}

	function services()
	{
		$push = [
			"pageTitle" => "Services"
		];

		$id = $this->session->userdata('id_member');
        $push["count"] = $this->cart_model->count_qty($id)->row();

		$this->template->load(template() . '/template', template() . '/services', $push);
	}

	function simpan_profile()
	{
		$kode = $this->input->post('kode', TRUE);
		$nmlgkp = $this->input->post('nmlgkp', TRUE);
		$almtlgkp = $this->input->post('almtlgkp', TRUE);
		$nohp = $this->input->post('nohp', TRUE);
		$pass = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
		$tmplhr = $this->input->post('tmplhr', TRUE);
		$tgllhr = $this->input->post('tgllhr', TRUE);

		if ($this->input->post('kode')) {
			if ($this->input->post('password')) {
				$this->member_model->update_register($kode, $nmlgkp, $almtlgkp, $nohp, $pass, $tmplhr, $tgllhr);
				$this->session->set_flashdata('success_profile', 'Data berhasil diubah!');
				redirect('member/dashboard');
			} else {
				$id = $this->session->userdata('id_member');
				$push = $this->member_model->get_profile($id)->row_array();
				$pass = $push['register_password'];
				$this->member_model->update_register($kode, $nmlgkp, $almtlgkp, $nohp, $pass, $tmplhr, $tgllhr);
				$this->session->set_flashdata('success_profile', 'Data berhasil diubah!');
				redirect('member/dashboard');
			}
		} else {
			$this->session->set_flashdata('failed_profile', 'Data gagal diubah!');
			redirect('member/dashboard');
		}
	}
}
