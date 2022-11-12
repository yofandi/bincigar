<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->load->view('index');
	}

	// login
	public function login()
	{
		$email = $this->input->post('email');
		$password = sha1($this->input->post('password'));

		$cek = $this->db->get_where('users', array('username' => $email, 'password' => $password));

		if ($cek->num_rows() === 0) {
			echo "<script>alert('Gagal Login Ke Application !'); window.location = '".base_url(
				'Index')."'</script>";
		}else{
			
			$ambil = $cek->row_array();

			$data = array(
				'id' => $ambil['id'],
				'username' => $ambil['username'], 
				'email' => $ambil['email'],
				'password' => $this->input->post('password'),
				'level' => $ambil['level'],
			);

			$this->session->set_userdata($data);

			redirect('Home/index');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Index');
	}
}