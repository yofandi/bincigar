<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Merek extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
	} 

	public function index()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/merek/index');
		$this->load->view('home/layout/footer');
	}

	//add_produk
	public function add_produk()
	 {
	 	$merek = $this->input->post("merek");
	 	

	 	$data = array('produk' => $merek);

	 	$cek = $this->db->insert('produk', $data);
	 	if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Produk Baru !'); window.location = '".base_url(
				'Merek')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Produk Baru !'); window.location = '".base_url(
				'Merek')."'</script>";
		}
	 } 

	 // update_produk
	 public function update_produk($id)
	 {
	 	$merek = $_POST['edit_produk2'];
	 	// $hje = $this->input->post("hje");
	 	// $kode = $this->input->post("kode");
	 	// $tarif = $this->input->post("tarif");
	 	// $isi = $this->input->post("isi");

	 	$data = array('produk' => $merek);

	 	$this->db->set($data);
	 	$this->db->where('id', $id);
	 	$cek = $this->db->update('produk');
	 	if ($cek) {
			echo "Berhasil MengUpdate Produk !";
		}else{
			echo "Gagal MengUpdate Produk !";
		}
	 }

	// aMBIL
	public function ambil()
	{
		$output = '';
		$data = $this->db->order_by('id', 'ASC')->get('produk')->result_array();
		$no = 1;
		foreach ($data as $key) {
			$output .= '
				<tr>	
					<td style="text-align:center">'.$no.'</td>
					<td style="text-align:center">'.$key['produk'].'</td>
					<td>
					<button id="klik_'.$no.'" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button><button type="button" class="btn btn-warning btn-sm" onclick="edit_produk('.$key['id'].')"><i class="fa fa-edit"></i> </button><button class="btn btn-sm btn-danger" onclick="hapus_produk('.$key['id'].')" title="Hapus"><i class="fa fa-trash"></i></button>
					</td>
				</tr>

				

				<script>


				$("#klik_'.$no.'").on("click", function(){
					$("#produk_utama").val("'.$key['produk'].'");
					$("#tampil_kode").val("'.$key['id'].'");
					$("#tampil_produk").val("'.$key['produk'].'");
					
				});
				
				function hapus_produk(id) {
					$.ajax({
						url : "'.base_url("Merek/hapus_produk/").'"+id,
						method : "POST",
						success : function(data){
							alert(data);
							location.reload();
						}
					})
				}
				
				</script>
			'; $no++;
		}
		echo json_encode($output);
	}
	// edit_produk
	public function edit_produk($id)
	{
		$data['data'] = $this->db->get_where('produk', array('id' => $id))->row_array();
		
		$this->load->view('home/layout/header');
		$this->load->view('home/merek/edit_produk', $data);
		$this->load->view('home/layout/footer');
	}
	// hapus_produk
	public function hapus_produk($id)
	{
		$cek = $this->db->delete('produk', array('id' => $id));
		if ($cek) {
			echo "Berhasil Menghapus Produk !";	
		}else{
			echo "Gagal Menghapus Produk !";
		}
	}
	// tambah_sub_produk
	public function tambah_sub_produk()
	{
		$kode = $_POST['kode'];
		$hje = $_POST['hje'];
		$isi = $_POST['isi'];
		$tarif = $_POST['tarif'];
		$kemasan = $_POST['kemasan'];

		$sub_produk = $_POST['sub_produk'];
		$sub_kode = $_POST['sub_kode'];

		$data = array(
			'id_produk' => $kode, 
			'hje' => $hje,
			'kemasan' => $kemasan, 
			'isi' => $isi, 
			'tarif' => $tarif, 
			'sub_kode' => $sub_kode,
			'sub_produk' => $sub_produk
		);
		$cek = $this->db->insert('sub_produk', $data);	
		if ($cek) {
			echo "Berhasil Menambahkan Sub Produk !";
		}else{
			echo "Gagal Menambahkan Sub P roduk !";
		}
	}

	// ambil sub
	public function ambil_sub()
	{
		$kode = $_POST['kode'];
		$no =1;
		$output = '';
		$sub_produk = $this->db->get_where('sub_produk', array('id_produk' => $kode))->result_array();
		foreach ($sub_produk as $key) {
			
			$output .= '<tr>
					<td>'.$key['sub_kode'].'</td>
					<td>'.$key['sub_produk'].'</td>
					<td>'.$key['kemasan'].'</td>
					<td>'.$key['isi'].'</td>
					<td>Rp.'.number_format($key['hje'],2,',','.').'</td>
					<td>Rp.'.number_format($key['tarif'],2,',','.').'</td>
					<td>
					<button onclick="edit_subproduk('.$key['id'].')" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal3"><i class="fa fa-edit"></i></button>
					<button onclick="hapus_subproduk('.$key['id'].')" class="btn btn-danger btn-sm" title="Hapus"><i class="fa fa-trash"></i></button>
					</td>
			</tr>';
			 $no++;
		}
		echo json_encode($output);
	}
	// edit_subproduk
	public function edit_subproduk($id)
	{
		$a = $this->db->get_where('sub_produk', array('id' => $id))->row_array();
		echo json_encode($a);
	}
	// update_subproduk
	public function update_subproduk($id)
	{
		$sub_produk = $_POST['sub_produk'];
		$sub_kode = $_POST['sub_kode'];

		$kemasan_edit = $_POST['kemasan_edit'];
		$isi_edit = $_POST['isi_edit'];
		$hje_edit = $_POST['hje_edit'];
		$tarif_edit = $_POST['tarif_edit'];

		$data = array('sub_produk' => $sub_produk, 'sub_kode' => $sub_kode,
			'hje' => $hje_edit, 'isi' => $isi_edit, 'tarif' => $tarif_edit, 'kemasan' => $kemasan_edit
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('sub_produk');

		if ($cek) {
			echo "Berhasil MengUpdate Sub Produk !";
		}else{
			echo "Gagal MengUpdate Sub Produk !";
		}
	}
	// hapus_subproduk
	public function hapus_subproduk($id)
	{
		$cek = $this->db->delete('sub_produk', array('id' => $id));
		if ($cek) {
			echo "Berhasil MengHapus Sub Produk !";
		}else{
			echo "Berhasil MengHapus Sub Produk !";
		}
	}

	// ambil_produk
	public function ambil_produk($id)
	{
		$data = $this->db->get_where('produk', array('id' => $id))->row_array();
		echo json_encode($data);
	}
}