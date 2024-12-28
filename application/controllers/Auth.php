<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('username')) {
			redirect('admin');
		}

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login | E-Inventory';
			$this->load->view('template2/login2_header', $data);
			$this->load->view('login2', $data);
			$this->load->view('template2/login2_footer');
		} else {
			// validasinya success
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('inventory_pengguna', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' => $user['username'],
					'peran_id' => $user['peran_id']
				];
				$this->session->set_userdata($data);
				if ($user['peran_id'] == 1) {
					redirect('admin');
				} elseif ($user['peran_id'] == 2) {
					redirect('adminaset');
				} elseif ($user['peran_id'] == 3) {
					redirect('adminatk');
				} elseif ($user['peran_id'] == 4) {
					redirect('unit');
				} elseif ($user['peran_id'] == 5) {
					redirect('subunit');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Password Anda Salah!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Username tidak terdaftar!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('peran_id');

		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Anda Sudah Logout!</div>');
		redirect('auth');
	}

	public function blocked()
	{
		$data['title'] = 'Page Not Found';
		$this->load->view('blocked', $data);
	}
}
