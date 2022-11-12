<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_pembantu extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	// api_sub
	public function api_sub_produk()
	{
		$a = $this->db->select('sub_produk')->order_by('id','ASC')->get('sub_produk')->result_array();
		echo json_encode($a);
	}
	// cincin
	public function cincin()
	{
		$data['cincin'] = $this->db->where('tanggal',date('Y-m-d'))->order_by('id', 'DESC')->get('cincin')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/cincin', $data);
		$this->load->view('home/layout/footer');
	}

	// kemasan
	public function kemasan()
	{
		$data['pakai_kemasan'] = $this->db->where('tanggal',date('Y-m-d'))->order_by('id', 'DESC')->get('pakai_kemasan')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/kemasan',$data);
		$this->load->view('home/layout/footer');
	}

	// 
	public function tambah_kemasan()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
		);

		$cek = $this->db->insert('kemasan', $data);
		
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Barang Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Barang Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";
		}
	}

	// striker
	public function striker()
	{
		$data['stiker'] = $this->db->where('tanggal',date('Y-m-d'))->order_by('id', 'DESC')->get_where('stiker')->result_array(); 
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/striker',$data);
		$this->load->view('home/layout/footer');
	}

	public function cukai()
	{
		$data['cukai'] = $this->db->where('tanggal',date('Y-m-d'))->order_by('id', 'DESC')->get('cukai')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/cukai',$data);
		$this->load->view('home/layout/footer');
	}

	// 
	public function tambah_stiker()
	{	
		$this->db->trans_start();
		error_reporting(0);
		$stock_l = $this->input->post('stock_l');
		$masuk_l = $this->input->post('masuk_l');
		$pakai_l =$this->input->post('pakai_l');
		$hasil_l = $stock_l + $masuk_l - $pakai_l;

		$stock_d = $this->input->post('stock_d');
		$masuk_d = $this->input->post('masuk_d');
		$pakai_d =$this->input->post('pakai_d');
		$hasil_d = $stock_d + $masuk_d - $pakai_d;

		$stock_j = $stock_l + $stock_d;
		$masuk_j = $masuk_l + $masuk_d;
		$pakai_j = $pakai_l + $pakai_d;
		$hasil_j = $hasil_l + $hasil_d;

		$cek = $this->db->where('produk', $this->input->post('produk'))->get('stock_stiker')->num_rows();
		if ($cek > 0) {
			$this->db->set(array(
				'stock_luar' => $hasil_l,
				'stock_dalam' => $hasil_d
			))->where('produk', $this->input->post('produk'))->update('stock_stiker');
		} else {
			$this->db->insert('stock_stiker',['produk' => $_POST['produk'],'stock_luar' => $hasil_l,'stock_dalam' => $hasil_d]);
		}

		$data = array(
			'nama_produk' => $this->input->post('produk'),
			'tanggal' => $this->input->post('tanggal'),
			'stock_l' => $stock_l,
			'masuk_l' => $masuk_l,
			'pakai_l' => $pakai_l,
			'hasil_l' => $hasil_l,

			'stock_d' => $stock_d,
			'masuk_d' => $masuk_d,
			'pakai_d' => $pakai_d,
			'hasil_d' => $hasil_d,

			'stock_j' => $stock_j,
			'masuk_j' => $masuk_j,
			'pakai_j' => $pakai_j,
			'hasil_j' => $hasil_j,

			'tanggal' => date('Y-m-d')
		);

		$cek = $this->db->insert('stiker', $data);
		
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";
		}
		$this->db->trans_complete();
	}

	// hapus_kemasan
	public function hapus_kemasan($id)
	{
		$cek = $this->db->delete('kemasan', array('id' => $id));
		if ($cek) {
			echo "Berhasil Menghapus Kemasan ID ".$id;
		}else{
			echo "Gagal Menghapus Kemasan ID ".$id;
		}
	}
	// hapus_stiker
	public function hapus_stiker($id)
	{
		$this->db->trans_start();
		$show = $this->db->select('nama_produk,masuk_l,pakai_l,masuk_d,pakai_d')->where('id', $id)->get('stiker')->row();
		$ao = $this->db->select('stock_luar,stock_dalam')->where('produk',$show->nama_produk)->get('stock_stiker')->row();

		$lr_now = $ao->stock_luar - $show->masuk_l + $show->pakai_l;
		$dl_now = $ao->stock_dalam - $show->masuk_d + $show->pakai_d;
		
		$this->db->where('produk',$show->nama_produk)->update('stock_stiker',['stock_luar' => $lr_now,'stock_dalam' => $dl_now]);

		$cek = $this->db->delete('stiker', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";
		}
		$this->db->trans_complete();
	}

	// edit_kemasan
	public function edit_kemasan($id)
	{
		$data = $this->db->get_where('kemasan', array('id' => $id))->row_array();
		echo json_encode($data);
	}
	// edit_kemasan
	public function edit_stiker($id)
	{
		$data['data'] = $this->db->get_where('stiker', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/edit_stiker', $data);
		$this->load->view('home/layout/footer');
	}

	// update_kemasan
	public function update_kemasan($id)
	{
		$nama = $_POST['nama'];

		$this->db->set(array('nama' => $nama));
		$this->db->where('id', $id);
		$cek = $this->db->update('kemasan');
		if ($cek) {
			echo "Berhasil MengUpdate Kemasan ID : ".$id;	
		}else{
			echo "Gagal MengUpdate Kemasan ID : ".$id;
		}		
	}
	// update_stiker
	public function update_stiker($id)
	{	
		$this->db->trans_start();
		$po = $this->input->post();
		$stock_l = $this->input->post('stock_l');
		$masuk_l = $this->input->post('masuk_l'); 
		$sisaml = ( $po['masuk_l'] > $po['msk_sbl'] ? $po['masuk_l'] - $po['msk_sbl'] : $po['masuk_l'] < $po['msk_sbl'] ? $po['msk_sbl'] - $po['masuk_l'] : 0);
		$pakai_l =$this->input->post('pakai_l');
		$sisapl = ( $po['pakai_l'] > $po['pakai_sbl'] ? $po['pakai_l'] - $po['pakai_sbl'] : $po['pakai_l'] < $po['pakai_sbl'] ? $po['pakai_sbl'] - $po['pakai_l'] : 0);
		$hasil_l = $stock_l + $masuk_l - $pakai_l;

		$stock_d = $this->input->post('stock_d');
		$masuk_d = $this->input->post('masuk_d');
		$sisamd = ( $po['masuk_d'] > $po['msk_sbd'] ? $po['masuk_d'] - $po['msk_sbd'] : $po['masuk_d'] < $po['msk_sbd'] ? $po['msk_sbd'] - $po['masuk_d'] : 0);
		$pakai_d =$this->input->post('pakai_d');
		$sisapd = ( $po['pakai_d'] > $po['pakai_sbd'] ? $po['pakai_d'] - $po['pakai_sbd'] : $po['pakai_d'] < $po['pakai_sbd'] ? $po['pakai_sbd'] - $po['pakai_d'] : 0);
		$hasil_d = $stock_d + $masuk_d - $pakai_d;

		$stock_j = $stock_l + $stock_d;
		$masuk_j = $masuk_l + $masuk_d;
		$pakai_j = $pakai_l + $pakai_d;
		$hasil_j = $hasil_l + $hasil_d;


		$data = array(
			'nama_produk' => $this->input->post('nama'),

			'stock_l' => $stock_l,
			'masuk_l' => $masuk_l,
			'pakai_l' => $pakai_l,
			'hasil_l' => $hasil_l,

			'stock_d' => $stock_d,
			'masuk_d' => $masuk_d,
			'pakai_d' => $pakai_d,
			'hasil_d' => $hasil_d,

			'stock_j' => $stock_j,
			'masuk_j' => $masuk_j,
			'pakai_j' => $pakai_j,
			'hasil_j' => $hasil_j,

			'tanggal' => date('Y-m-d')
		);
		
		if ($po['masuk_l'] != $po['msk_sbl'] || $po['pakai_l'] != $po['pakai_sbl'] || $po['masuk_d'] != $po['msk_sbd'] || $po['pakai_d'] != $po['pakai_sbd']) {
			
			$sl = ( $po['masuk_l'] > $po['msk_sbl'] ? $po['stockstlnow'] + $sisaml : $po['masuk_l'] < $po['msk_sbl'] ? $po['stockstlnow'] - $sisaml : $po['stockstlnow'] + 0 ); 
			$ps = ( $po['pakai_l'] > $po['pakai_sbl'] ? $sl - $sisapl : $po['pakai_l'] < $po['pakai_sbl'] ? $sl + $sisapl : $sl - 0);

			$sd = ( $po['masuk_d'] > $po['msk_sbd'] ? $po['stockstdnow'] + $sisamd : $po['masuk_d'] < $po['msk_sbd'] ? $po['stockstdnow'] - $sisamd : $po['stockstdnow'] + 0);
			$pa = ( $po['pakai_d'] > $po['pakai_sbd'] ? $sd - $sisapd : $po['pakai_d'] < $po['pakai_sbd'] ? $sd + $sisapd : $sd - 0);

			$this->db->set(array(
				'stock_luar' => $ps,
				'stock_dalam' => $pa
			))->where('produk', $this->input->post('nama'))->update('stock_stiker');
		}

		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('stiker');

		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Barang Striker'); window.location = '".base_url(
				'Bahan_pembantu/striker')."'</script>";
		}
		$this->db->trans_complete();
	}

	// add_cincin
	public function add_cincin()
	{	
		$this->db->trans_start();
		$awal = $this->input->post('stock_awal');
		$masuk = $this->input->post('masuk');
		$terpakai = $this->input->post('terpakai');
		$afkir = $this->input->post('afkir');
		$stock = ($awal + $masuk ) - ($terpakai + $afkir);

		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'nama_produk' => $_POST['produk'],
			'awal' => $awal,
			'masuk' => $masuk,
			'terpakai' => $terpakai,
			'afkir' => $afkir,
			'stock' => $stock,
		);

		$cek1 = $this->db->where('produk',$_POST['produk'])->get('stock_cincin')->num_rows();
		if ($cek1 > 0) {
			$this->db->set(array('stock'=>$stock))->where('produk',$_POST['produk'])->update('stock_cincin');
		} else {
			$this->db->insert('stock_cincin', ['produk' => $_POST['produk'],'stock' => $stock]);
		}

		$cek = $this->db->insert('cincin', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";
		}
		$this->db->trans_complete();
	}

	// ambil_cincin
	public function edit_cincin($id)
	{
		$data['datas'] = $this->db->get_where('cincin', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/edit_cincin',$data);
		$this->load->view('home/layout/footer');
	}

	// update_cincin
	public function update_cincin($id)
	{
		$this->db->trans_start();
		$po = $this->input->post();
		$awal = $this->input->post('awal');
		$masuk = $this->input->post('masuk');
		$sisma = ( $po['masuk'] > $po['masuk_hd'] ? $po['masuk'] - $po['masuk_hd'] : $po['masuk'] < $po['masuk_hd'] ? $po['masuk_hd'] - $po['masuk'] : 0);
		$terpakai = $this->input->post('terpakai');
		$sispa = ( $po['terpakai'] > $po['terpakai_hd'] ? $po['terpakai'] - $po['terpakai_hd'] : $po['terpakai'] < $po['terpakai_hd'] ? $po['terpakai_hd'] - $po['terpakai'] : 0);
		$afkir = $this->input->post('afkir');
		$sisaf = ( $po['afkir'] > $po['afkir_hd'] ? $po['afkir'] - $po['afkir_hd'] : $po['afkir'] < $po['afkir_hd'] ? $po['afkir_hd'] - $po['afkir'] : 0);
		$stock = ($awal + $masuk ) - ($terpakai + $afkir);

		$data = array(
			'nama_produk' => $_POST['nama_produk'],
			'awal' => $awal,
			'masuk' => $masuk,
			'terpakai' => $terpakai,
			'afkir' => $afkir,
			'stock' => $stock,
		);

		$jml = ($po['masuk'] > $po['masuk_hd'] ? $po['staw'] + $sisma : $po['masuk'] < $po['masuk_hd'] ? $po['staw'] - $sisma : $po['staw'] + 0);
		$po = ($po['terpakai'] > $po['terpakai_hd'] ? $jml - $sispa : $po['terpakai'] < $po['terpakai_hd'] ? $jml + $sispa : $jml - 0);
		$ca = ($po['afkir'] > $po['afkir_hd'] ? $po - $sisaf : $po['afkir'] < $po['afkir_hd'] ? $po + $sisaf : $po - 0);

		$this->db->where('produk', $_POST['nama_produk'])->update('stock_cincin',['stock' => $ca]);

		$cek = $this->db->set($data); $this->db->where('id', $id); $cek = $this->db->update('cincin');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";
		}
		$this->db->trans_complete();
	}
	// hapus_cincin
	public function hapus_cincin($id)
	{
		$this->db->trans_start();
		$show = $this->db->select('nama_produk,masuk,terpakai,afkir')->where('id', $id)->get('cincin')->row();
		$awq = $this->db->select('stock')->where('produk', $show->nama_produk)->get('stock_cincin')->row();

		$jml = $awq->stock - $show->masuk + ($show->terpakai + $show->afkir);
		$this->db->where('produk', $show->nama_produk)->update('stock_cincin',['stock' => $jml]);
		$cek = $this->db->delete('cincin', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Barang Cincin'); window.location = '".base_url(
				'Bahan_pembantu/cincin')."'</script>";
		}
		$this->db->trans_complete();
	}
	// cari_stiker
	public function cari_stiker()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output = '';
			$datas = $like->from('stiker')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['nama_produk'].'</td>
				<td>'.$key['stock_l'].'</td>
				<td>'.$key['masuk_l'].'</td>
				<td>'.$key['pakai_l'].'</td>
				<td>'.$key['hasil_l'].'</td>
				<td>'.$key['stock_d'].'</td>
				<td>'.$key['masuk_d'].'</td>
				<td>'.$key['pakai_d'].'</td>
				<td>'.$key['hasil_d'].'</td>
				<td>'.$key['stock_j'].'</td>
				<td>'.$key['masuk_j'].'</td>
				<td>'.$key['pakai_j'].'</td>
				<td>'.$key['hasil_j'].'</td>
				</tr>
				';
				$no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->where('nama_produk', $_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output = '';
			$datas = $like->from('stiker')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['nama_produk'].'</td>
				<td>'.$key['stock_l'].'</td>
				<td>'.$key['masuk_l'].'</td>
				<td>'.$key['pakai_l'].'</td>
				<td>'.$key['hasil_l'].'</td>
				<td>'.$key['stock_d'].'</td>
				<td>'.$key['masuk_d'].'</td>
				<td>'.$key['pakai_d'].'</td>
				<td>'.$key['hasil_d'].'</td>
				<td>'.$key['stock_j'].'</td>
				<td>'.$key['masuk_j'].'</td>
				<td>'.$key['pakai_j'].'</td>
				<td>'.$key['hasil_j'].'</td>
				</tr>
				';
				$no++;
			}
			echo json_encode($output);
		}
		
	}

	// total_stiker
	public function total_stiker()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir']; $produk = $_POST['produk'];
		$output = array('stock_l' => '', 'masuk_l' => '', 'pakai_l' => '', 'hasil_l' => '',
			'stock_d' => '', 'masuk_d' => '', 'pakai_d' => '', 'hasil_d' => '',
			'stock_j' => '', 'masuk_j' => '', 'pakai_j' => '', 'hasil_j' => '');
		if ($produk == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(stock_l) as total_stock_l');
			$this->db->from('stiker');
			$output['stock_l'] .= $this->db->get()->row()->total_stock_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masuk_l) as total_masuk_l');
			$this->db->from('stiker');
			$output['masuk_l'] .= $this->db->get()->row()->total_masuk_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(pakai_l) as total_pakai_l');
			$this->db->from('stiker');
			$output['pakai_l'] .= $this->db->get()->row()->total_pakai_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(hasil_l) as total_hasil_l');
			$this->db->from('stiker');
			$output['hasil_l'] .= $this->db->get()->row()->total_hasil_l;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(stock_d) as total_stock_d');
			$this->db->from('stiker');
			$output['stock_d'] .= $this->db->get()->row()->total_stock_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masuk_d) as total_masuk_d');
			$this->db->from('stiker');
			$output['masuk_d'] .= $this->db->get()->row()->total_masuk_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(pakai_d) as total_pakai_d');
			$this->db->from('stiker');
			$output['pakai_d'] .= $this->db->get()->row()->total_pakai_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(hasil_d) as total_hasil_d');
			$this->db->from('stiker');
			$output['hasil_d'] .= $this->db->get()->row()->total_hasil_d;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(stock_j) as total_stock_j');
			$this->db->from('stiker');
			$output['stock_j'] .= $this->db->get()->row()->total_stock_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masuk_j) as total_masuk_j');
			$this->db->from('stiker');
			$output['masuk_j'] .= $this->db->get()->row()->total_masuk_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(pakai_j) as total_pakai_j');
			$this->db->from('stiker');
			$output['pakai_j'] .= $this->db->get()->row()->total_pakai_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(hasil_j) as total_hasil_j');
			$this->db->from('stiker');
			$output['hasil_j'] .= $this->db->get()->row()->total_hasil_j;

			echo json_encode($output);	
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(stock_l) as total_stock_l');
			$this->db->from('stiker');
			$output['stock_l'] .= $this->db->get()->row()->total_stock_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(masuk_l) as total_masuk_l');
			$this->db->from('stiker');
			$output['masuk_l'] .= $this->db->get()->row()->total_masuk_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(pakai_l) as total_pakai_l');
			$this->db->from('stiker');
			$output['pakai_l'] .= $this->db->get()->row()->total_pakai_l;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(hasil_l) as total_hasil_l');
			$this->db->from('stiker');
			$output['hasil_l'] .= $this->db->get()->row()->total_hasil_l;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(stock_d) as total_stock_d');
			$this->db->from('stiker');
			$output['stock_d'] .= $this->db->get()->row()->total_stock_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(masuk_d) as total_masuk_d');
			$this->db->from('stiker');
			$output['masuk_d'] .= $this->db->get()->row()->total_masuk_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(pakai_d) as total_pakai_d');
			$this->db->from('stiker');
			$output['pakai_d'] .= $this->db->get()->row()->total_pakai_d;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(hasil_d) as total_hasil_d');
			$this->db->from('stiker');
			$output['hasil_d'] .= $this->db->get()->row()->total_hasil_d;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(stock_j) as total_stock_j');
			$this->db->from('stiker');
			$output['stock_j'] .= $this->db->get()->row()->total_stock_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(masuk_j) as total_masuk_j');
			$this->db->from('stiker');
			$output['masuk_j'] .= $this->db->get()->row()->total_masuk_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(pakai_j) as total_pakai_j');
			$this->db->from('stiker');
			$output['pakai_j'] .= $this->db->get()->row()->total_pakai_j;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $produk);
			$this->db->select('SUM(hasil_j) as total_hasil_j');
			$this->db->from('stiker');
			$output['hasil_j'] .= $this->db->get()->row()->total_hasil_j;

			echo json_encode($output);
		}
	}

	// print_stiker
	public function print_stiker()
	{
		$this->load->view('home/bahan_pembantu/print_stiker');
	}
	// cari_cincin
	public function cari_cincin()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('cincin')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['nama_produk'].'</td>
				<td>'.$key['awal'].'</td>
				<td>'.$key['masuk'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['afkir'].'</td>
				<td>'.$key['stock'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->where('nama_produk', $_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('cincin')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['nama_produk'].'</td>
				<td>'.$key['awal'].'</td>
				<td>'.$key['masuk'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['afkir'].'</td>
				<td>'.$key['stock'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
		
	}
	// total_cincin
	public function total_cincin()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];	
		$output = array('awal' => '', 'masuk' => '', 'terpakai' => '', 'afkir' => '', 'stock' => '');
		if ($_POST['produk'] == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(awal) as total_awal');
			$this->db->from('cincin');
			$output['awal'] .= $this->db->get()->row()->total_awal;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('cincin');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(terpakai) as total_terpakai');
			$this->db->from('cincin');
			$output['terpakai'] .= $this->db->get()->row()->total_terpakai;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(afkir) as total_afkir');
			$this->db->from('cincin');
			$output['afkir'] .= $this->db->get()->row()->total_afkir;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('cincin');
			$output['stock'] .= $this->db->get()->row()->total_stock;
			echo json_encode($output);
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $_POST['produk']);
			$this->db->select('SUM(awal) as total_awal');
			$this->db->from('cincin');
			$output['awal'] .= $this->db->get()->row()->total_awal;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $_POST['produk']);
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('cincin');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $_POST['produk']);
			$this->db->select('SUM(terpakai) as total_terpakai');
			$this->db->from('cincin');
			$output['terpakai'] .= $this->db->get()->row()->total_terpakai;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $_POST['produk']);
			$this->db->select('SUM(afkir) as total_afkir');
			$this->db->from('cincin');
			$output['afkir'] .= $this->db->get()->row()->total_afkir;
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('nama_produk', $_POST['produk']);
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('cincin');
			$output['stock'] .= $this->db->get()->row()->total_stock;
			echo json_encode($output);
		}

	}
	// cari_sub
	public function cari_sub($id = null)
	{
		if (!$id) {
			echo "ID Kosong";
		}else{

			$output = '';
			$data = $this->db->get_where('sub_produk', array('id_produk' => $id))->result_array();

			$output .= '<select id="id_sub" name="id_sub" class="form-control">';
			foreach ($data as $key) {
				
				$output .= '
				<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].' | '.$key['isi'].' | '.$key['kemasan'].'</option>
				';
			}
			$output .= '</select>';

			echo json_encode($output);
		}
	}

	// add_cukai
	public function add_cukai()
	{
		$this->db->trans_start();
		$id_sub = $this->input->post('id_sub');
		$datas = $this->db->get_where('sub_produk', array('id' => $this->input->post('sub_produk')))->row_array();

		$lama = $this->input->post('lama');
		$baru = $this->input->post('baru');
		$semua = $this->input->post('semua');
		$masing = $this->input->post('masing');
		$jumlah = ($lama - $semua) + ($baru - $masing); 

		$cek = $this->db->where('id_subproduk', $this->input->post('sub_produk'))->get('stock_cukai')->num_rows();
		if ($cek > 0) {
			$this->db->set(array('stock' => $jumlah))->where('id_subproduk', $this->input->post('sub_produk'))->update('stock_cukai');
		} else {
			$this->db->insert('stock_cukai', ['id_subproduk' => $datas['id'],'sub_produk' => $datas['sub_produk'],'sub_kode' => $datas['sub_kode'],'produk' => $this->input->post('produk-hidd'),'stock' => $jumlah]);
		}

		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'subproduk' => $datas['sub_produk'],
			'sub_kode' => $datas['sub_kode'],
			'lama' => $lama, 
			'baru' => $baru,
			'jumlah' => $jumlah,
			'semua' => $semua,
			'masing' => $masing,
			'isi' => $datas['isi'],
			'hje' => $datas['hje'],
			'tarif' => $datas['tarif'],
			// 'tanggal' => date('Y-m-d')
		);
		$cek = $this->db->insert('cukai', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_cukai
	public function print_cukai()
	{
		$this->load->view('home/bahan_pembantu/print_cukai');
	}

	// cari_cukai
	public function cari_cukai()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['sub_produk'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output['table'] = '';
			$datas = $like->from('cukai')->get()->result_array();
			$no=1;
			$pa = 0;
			foreach ($datas as $key) {
				$ap = $key['lama'] + $key['baru'];
				$pa += $ap;
				$output['table'] .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['subproduk'].'</td>
				<td>'.$key['sub_kode'].'</td>
				<td>'.$key['isi'].'</td>
				<td>'.number_format($key['hje'],2,',','.').'</td>
				<td>'.number_format($key['tarif'],2,',','.').'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['baru'].'</td>
				<td>'.$ap.'</td>
				<td>'.$key['semua'].'</td>
				<td>'.$key['masing'].'</td>
				<td>'.$key['jumlah'].'</td>
				</tr>
				';
				$no++;
			}
			$output['stockjml'] = $pa;
			echo json_encode($output);
		}else{
			$like = $this->db->where('subproduk', $_POST['sub_produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output['table'] = '';
			$datas = $like->from('cukai')->get()->result_array();
			$no=1;
			$pa = 0;
			foreach ($datas as $key) {
				$ap = $key['lama'] + $key['baru'];
				$pa += $ap;
				$output['table'] .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['subproduk'].'</td>
				<td>'.$key['sub_kode'].'</td>
				<td>'.$key['isi'].'</td>
				<td>'.number_format($key['hje'],2,',','.').'</td>
				<td>'.number_format($key['tarif'],2,',','.').'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['baru'].'</td>
				<td>'.$ap.'</td>
				<td>'.$key['semua'].'</td>
				<td>'.$key['masing'].'</td>
				<td>'.$key['jumlah'].'</td>
				</tr>
				';
				$no++;
			}
			$output['stockjml'] = $pa;
			echo json_encode($output);
		}

	}
	// total_cukai
	public function total_cukai()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('lama' => '','baru' => '','jumlah' => '','masuk' => '','semua' => '','masing' => '','akhir' => '');
		if ($_POST['sub_produk'] == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(lama) as total_lama');
			$this->db->from('cukai');
			$output['lama'] = $this->db->get()->row()->total_lama;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(baru) as total_baru');
			$this->db->from('cukai');
			$output['baru'] = $this->db->get()->row()->total_baru;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(jumlah) as total_jumlah');
			$this->db->from('cukai');
			$output['jumlah'] = $this->db->get()->row()->total_jumlah;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(semua) as total_semua');
			$this->db->from('cukai');
			$output['semua'] = $this->db->get()->row()->total_semua;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masing) as total_masing');
			$this->db->from('cukai');
			$output['masing'] = $this->db->get()->row()->total_masing;

			// $this->db->where('tanggal >=',$awal);
			// $this->db->where('tanggal <=',$akhir);
			// $this->db->select('SUM(akhir) as total_akhir');
			// $this->db->from('cukai');
			// $this->db->get()->row()->total_akhir;
			$output['akhir'] = 0;

			echo json_encode($output);
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('subproduk', $_POST['sub_produk']);
			$this->db->select('SUM(lama) as total_lama');
			$this->db->from('cukai');
			$output['lama'] = $this->db->get()->row()->total_lama;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('subproduk', $_POST['sub_produk']);
			$this->db->select('SUM(baru) as total_baru');
			$this->db->from('cukai');
			$output['baru'] = $this->db->get()->row()->total_baru;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('subproduk', $_POST['sub_produk']);
			$this->db->select('SUM(jumlah) as total_jumlah');
			$this->db->from('cukai');
			$output['jumlah'] = $this->db->get()->row()->total_jumlah;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('subproduk', $_POST['sub_produk']);
			$this->db->select('SUM(semua) as total_semua');
			$this->db->from('cukai');
			$output['semua'] = $this->db->get()->row()->total_semua;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('subproduk', $_POST['sub_produk']);
			$this->db->select('SUM(masing) as total_masing');
			$this->db->from('cukai');
			$output['masing'] = $this->db->get()->row()->total_masing;

			// $this->db->where('tanggal >=',$awal);
			// $this->db->where('tanggal <=',$akhir);
			// $this->db->where('subproduk', $_POST['sub_produk']);
			// $this->db->select('SUM(akhir) as total_akhir');
			// $this->db->from('cukai');
			// $this->db->get()->row()->total_akhir;
			$output['akhir'] = 0;

			echo json_encode($output);
		}
		
	}
	// edit_cukai
	public function edit_cukai($id)
	{
		$data['data'] = $this->db->get_where('cukai', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/edit_cukai', $data);
		$this->load->view('home/layout/footer');
	}
	// uodate_cukai
	public function uodate_cukai($id)
	{
		$this->db->trans_start();
		$po = $this->input->post();
		$lama = $this->input->post('lama');
		$baru = $this->input->post('baru');
		$sisba = ( $po['baru'] > $po['baru_hd'] ? $po['baru'] - $po['baru_hd'] : $po['baru'] < $po['baru_hd'] ? $po['baru_hd'] - $po['baru'] : 0);
		$semua = $this->input->post('semua');
		$sisse = ( $po['semua'] > $po['semua_hd'] ? $po['semua'] - $po['semua_hd'] : $po['semua'] < $po['semua_hd'] ? $po['semua_hd'] - $po['semua'] : 0);
		$masing = $this->input->post('masing');
		$sisma = ( $po['masing'] > $po['masing_hd'] ? $po['masing'] - $po['masing_hd'] : $po['masing'] < $po['masing_hd'] ? $po['masing_hd'] - $po['masing'] : 0);
		
		$jumlah = ($lama - $semua) + ($baru - $masing);

		$data = array(
			'lama' => $lama, 
			'baru' => $baru,
			'jumlah' => $jumlah,
			'semua' => $semua,
			'masing' => $masing,
			'tanggal' => date('Y-m-d')
		);

		$ao = $this->db->select('stock')->where('id_subproduk',$po['id_subproduk'])->get('stock_cukai')->row();

		$jml = ( $po['baru'] > $po['baru_hd'] ? $ao->stock + $sisba : $po['baru'] < $po['baru_hd'] ? $ao->stock - $sisba : $ao->stock + 0 );
		$pas = ( $po['semua'] > $po['semua_hd'] ? $jml - $sisse : $po['semua'] < $po['semua_hd'] ? $jml + $sisse : $jml - 0);
		$sap = (  $po['masing'] > $po['masing_hd'] ? $pas - $sisma : $po['masing'] < $po['masing_hd'] ? $pas + $sisma : $pas - 0);
		$this->db->where('id_subproduk',$po['id_subproduk'])->update('stock_cukai', ['stock' => $sap]);

		$this->db->set($data); 
		$this->db->where('id',  $id);
		$cek = $this->db->update('cukai');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";
		}
		$this->db->trans_complete();
	}
	// hapus_cukai
	public function hapus_cukai($id)
	{
		$this->db->trans_start();
		$show = $this->db->select('subproduk,lama,baru,semua,masing,jumlah')->where('id', $id)->get('cukai')->row();
		$ao = $this->db->select('stock')->where(['sub_produk' => $show->subproduk])->get('stock_cukai')->row();

		$hit = $ao->stock - $show->baru + ($show->semua + $show->masing);
		$this->db->where(['sub_produk' => $show->subproduk])->update('stock_cukai',['stock'=>$hit]);
		$cek = $this->db->delete('cukai', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Cukai'); window.location = '".base_url(
				'Bahan_pembantu/cukai')."'</script>";
		}
		$this->db->trans_complete();
	}

	// add_kemasan
	public function add_kemasan()
	{
		$this->db->trans_start();
		$produk = $this->input->post('produk');
		$kemasan = $this->input->post('kemasan');
		$awal = $this->input->post('awal');
		$masuk = $this->input->post('masuk');
		$sisa = $awal + $masuk;

		$terpakai = $this->input->post('terpakai');
		$afkir = $this->input->post('afkir');
		$stock = ($awal + $masuk ) - ($terpakai + $afkir); 

		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'produk' => $produk,
			'awal' => $awal, 
			'masuk' => $masuk,
			'sisa' => $sisa,
			'terpakai' => $terpakai,
			'afkir' => $afkir,
			'stock' => $stock,
			'kemasan' => $kemasan

		);

		$cek = $this->db->where(['produk' => $produk, 'nama_kemasan' => $kemasan])->get('stock_kemasan')->num_rows();
		if ($cek > 0) {
			$this->db->set(array('stock' => $stock))->where(array('produk' => $produk, 'nama_kemasan' => $kemasan))->update('stock_kemasan');
		} else {
			$this->db->insert('stock_kemasan',['produk' => $produk,'nama_kemasan' => $kemasan,'stock' => $stock]);
		}
		$cek = $this->db->insert('pakai_kemasan', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";
		}
		$this->db->trans_complete();
	}

	// edit_pakai_kemasan
	public function edit_pakai_kemasan($id)
	{
		$data['datas'] = $this->db->get_where('pakai_kemasan', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahan_pembantu/edit_pakai_kemasan', $data);
		$this->load->view('home/layout/footer');
	}

	// update_pakai_kemasan
	public function update_pakai_kemasan($id)
	{
		$po = $this->input->post();
		$this->db->trans_start();
		$produk = $this->input->post('produk');
		$kemasan = $this->input->post('kemasan');
		$awal = $this->input->post('awal');
		$masuk = $this->input->post('masuk');
		$sisma = ( $po['masuk'] > $po['masuk_sb'] ? $po['masuk'] - $po['masuk_sb'] : $po['masuk'] < $po['masuk_sb'] ? $po['masuk_sb'] - $po['masuk'] : 0);
		$sisa = $awal + $masuk;

		$terpakai = $this->input->post('terpakai');
		$sispa = ( $po['terpakai'] > $po['terpakai_sb'] ? $po['terpakai'] - $po['terpakai_sb'] : $po['terpakai'] < $po['terpakai_sb'] ? $po['terpakai_sb'] - $po['terpakai'] : 0);
		$afkir = $this->input->post('afkir');
		$sisaf = ( $po['afkir'] > $po['afkir_sb'] ? $po['afkir'] - $po['afkir_sb'] : $po['afkir'] < $po['afkir_sb'] ? $po['afkir_sb'] - $po['afkir'] : 0);
		$stock = ($awal + $masuk ) - ($terpakai + $afkir); 

		$data = array(
			'produk' => $produk,
			'awal' => $awal, 
			'masuk' => $masuk,
			'sisa' => $sisa,
			'terpakai' => $terpakai,
			'afkir' => $afkir,
			'stock' => $stock,
			'tanggal' => date('Y-m-d'),
			'kemasan' => $kemasan
		);

		if ($po['masuk'] != $po['masuk_sb'] || $po['terpakai'] != $po['terpakai_sb'] || $po['afkir'] != $po['afkir_sb']) {
			
			$psl = ( $po['masuk'] > $po['masuk_sb'] ? $po['stockawl'] + $sisma : $po['masuk'] < $po['masuk_sb'] ? $po['stockawl'] - $sisma : $po['stockawl'] + 0);
			$psq = ( $po['terpakai'] > $po['terpakai_sb'] ? $psl - $sispa : $po['terpakai'] < $po['terpakai_sb'] ? $psl + $sispa : $psl - 0);
			$psf = ( $po['afkir'] > $po['afkir_sb'] ? $psq + $sisaf : $po['afkir'] < $po['afkir_sb'] ? $psq - $sisaf : $psq + 0);

			$this->db->set(array('stock' => $psf))->where(array('produk' => $produk, 'nama_kemasan' => $kemasan))->update('stock_kemasan');
		}

		$this->db->set($data); $this->db->where('id', $id);
		$cek = $this->db->update('pakai_kemasan');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";
		}
		$this->db->trans_complete();
	}
	// hapus_pakai_kemasan
	public function hapus_pakai_kemasan($id)
	{
		$this->db->trans_start();
		$show = $this->db->select('produk,kemasan,masuk,terpakai,afkir')->where('id', $id)->get('pakai_kemasan')->row();
		$ao = $this->db->select('stock')->where(['produk' => $show->produk,'nama_kemasan' => $show->kemasan])->get('stock_kemasan')->row();

		$hit = $ao->stock - $show->masuk + ($show->terpakai + $show->afkir);
		$this->db->where(['produk' => $show->produk,'nama_kemasan' => $show->kemasan])->update('stock_kemasan',['stock'=>$hit]);

		$cek = $this->db->delete('pakai_kemasan', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Kemasan'); window.location = '".base_url(
				'Bahan_pembantu/kemasan')."'</script>";
		}
		$this->db->trans_complete();
	}

	// print_pakai_kemasan
	public function print_pakai_kemasan()
	{
		$this->load->view('home/bahan_pembantu/print_pakai_kemasan');
	}

	// cari_kemasan
	public function cari_kemasan()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','ASC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output = '';
			$datas = $like->from('pakai_kemasan')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['kemasan'].'</td>
				<td>'.$key['awal'].'</td>
				<td>'.$key['masuk'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['afkir'].'</td>
				<td>'.$key['stock'].'</td>
				</tr>
				';
				
				$no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','ASC')->where('produk', $_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output = '';
			$datas = $like->from('pakai_kemasan')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['kemasan'].'</td>
				<td>'.$key['awal'].'</td>
				<td>'.$key['masuk'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['afkir'].'</td>
				<td>'.$key['stock'].'</td>
				</tr>
				';
				
				$no++;
			}
			echo json_encode($output);
		}

	}
	// total_kemasan
	public function total_kemasan()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];	
		$output = array('awal' =>'','masuk' =>'','sisa' =>'','terpakai' =>'','afkir' =>'','stock' =>'');
		if ($_POST['produk'] == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(awal) as total_awal');
			$this->db->from('pakai_kemasan');
			$output['awal'] .= $this->db->get()->row()->total_awal;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('pakai_kemasan');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(sisa) as total_sisa');
			$this->db->from('pakai_kemasan');
			$output['sisa'] .= $this->db->get()->row()->total_sisa;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(terpakai) as total_terpakai');
			$this->db->from('pakai_kemasan');
			$output['terpakai'] .= $this->db->get()->row()->total_terpakai;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(afkir) as total_afkir');
			$this->db->from('pakai_kemasan');
			$output['afkir'] .= $this->db->get()->row()->total_afkir;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('pakai_kemasan');
			$output['stock'] .= $this->db->get()->row()->total_stock;
			echo json_encode($output);
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(awal) as total_awal');
			$this->db->from('pakai_kemasan');
			$output['awal'] .= $this->db->get()->row()->total_awal;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('pakai_kemasan');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(sisa) as total_sisa');
			$this->db->from('pakai_kemasan');
			$output['sisa'] .= $this->db->get()->row()->total_sisa;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(terpakai) as total_terpakai');
			$this->db->from('pakai_kemasan');
			$output['terpakai'] .= $this->db->get()->row()->total_terpakai;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(afkir) as total_afkir');
			$this->db->from('pakai_kemasan');
			$output['afkir'] .= $this->db->get()->row()->total_afkir;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('produk', $_POST['produk']);
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('pakai_kemasan');
			$output['stock'] .= $this->db->get()->row()->total_stock;
			echo json_encode($output);
		}
	}
	//filter_stock_cincin
	public function filter_stock_cincin()
	{
		$this->db->select('stock');
		$query = $this->db->get_where('stock_cincin', array('produk' => $_POST['produk']))->row_array();
		if ($query['stock'] == null) {
			echo json_encode(0);
		} else {
			echo json_encode($query['stock']);
		}
	} 
	 //filter_stock_stiker
	public function filter_stock_stiker()
	{
		$query = $this->db->get_where('stock_stiker', array('produk' => $_POST['produk']))->row_array();
		if ($query['stock_luar'] == null) { $stockl = 0; } else { $stockl = $query['stock_luar']; }
		if ($query['stock_dalam'] == null) { $stockd = 0; } else { $stockd = $query['stock_dalam']; }
		$array = [
			'stock_luar' => $stockl,
			'stock_dalam' => $stockd
		];
		echo json_encode($array);
	} 
	 //filter_stock_kemasan
	public function filter_stock_kemasan()
	{
		$query = $this->db->get_where('stock_kemasan', array('produk' => $_POST['produk'], 'nama_kemasan' => $_POST['kemasan']))->row_array();
		if ($query['stock'] == null) {
			echo json_encode(0);
		} else {
			echo json_encode($query['stock']);
		}
	}
	public function cari_cukai_sub($id)
	{
		$data = $this->db->select('stock')->where('id_subproduk', $id)->get('stock_cukai')->row_array();
		if ($data['stock'] == null) {
			echo json_encode(0);
		} else {
			echo json_encode($data['stock']);
		}
	} 
} 