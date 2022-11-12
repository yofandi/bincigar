<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahanbaku extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	} 

	public function index()
	{	

		$data['stock'] = $this->db->order_by('id', 'DESC')->get_where('data_stock')->result_array();
		$data['jenis'] = $this->db->get('jenis')->result_array();
		$data['kategori'] = $this->db->get('kategori')->result_array();
		$data['setting'] = $this->db->get_where('setting', array('id' => 1))->row_array();

		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/index',$data);
		$this->load->view('home/layout/footer');
	}

	// jenis
	public function jenis()
	{	
		$data['data'] = $this->db->get('jenis');
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/jenis', $data);
		$this->load->view('home/layout/footer');
	}
	// tambah_jenis
	public function tambah_jenis()
	{
		$data = array(
			'jenis' => $this->input->post('jenis'),
			'deskripsi' => $this->input->post('deskripsi'),
			'keterangan' => $this->input->post('keterangan')
		);

		$cek = $this->db->insert('jenis', $data);
		
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Jenis Tembakau'); window.location = '".base_url(
				'Bahanbaku/jenis')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Jenis Tembakau'); window.location = '".base_url(
				'Bahanbaku/jenis')."'</script>";
		}
	}
	// update jenis
	public function update_jenis($id)
	{
		$data = array('jenis' => $this->input->post('jenis'),
			'deskripsi' => $this->input->post('deskripsi'),
			'keterangan' => $this->input->post('keterangan')
		);
		$where = array('id' => $id );

		$this->db->where($where);
		$this->db->update('jenis', $data);

		redirect('Bahanbaku/jenis');
	}
	
	// hapus_jenis
	public function hapus_jenis($id)
	{
		$cek = $this->db->delete('jenis', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Jenis Tembakau'); window.location = '".base_url(
				'Bahanbaku/jenis')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Jenis Tembakau'); window.location = '".base_url(
				'Bahanbaku/jenis')."'</script>";
		}
	}


	// kategoru
	public function kategori()
	{	
		$data['data'] = $this->db->get('kategori')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/kategori', $data);
		$this->load->view('home/layout/footer');
	}
	// hapus_kat
	public function hapus_kat($id)
	{
		$cek = $this->db->delete('kategori', array('id' => $id));
		if ($cek) {
			echo "Berhasil Menghapus Kategori ID ".$id;
		}else{
			echo "Gagal Menghapus Kategori ID ".$id;
		}
	}
	public function edit_kat($id)
	{
		$a = $this->db->get_where('kategori', array('id' => $id))->row_array();
		echo json_encode($a);
	}
	// update_kat
	public function update_kat($id)
	{
		$kategori = $_POST['kategori'];
		$des = $_POST['des'];
		$ket = $_POST['ket'];
		
		$data = array(
			'kategori' => $kategori, 
			'deskripsi' => $des,
			'keterangan' => $ket,
		);

		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('kategori');

		if ($cek) {
			echo "Berhasil MengUpdate Kategori !";
		}else{
			echo "Gagal MengUpdate Kategori !";
		}
	}
	// tambah_kat
	public function tambah_kat()
	{ 
		$data = array(
			'kategori' => $this->input->post('kategori'),
			'deskripsi' => $this->input->post('deskripsi'),
			'keterangan' => $this->input->post('keterangan')
		);

		$cek = $this->db->insert('kategori', $data);
		
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan kategori Tembakau'); window.location = '".base_url(
				'Bahanbaku/kategori')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan kategori Tembakau'); window.location = '".base_url(
				'Bahanbaku/kategori')."'</script>";
		}
	}


	// add_stock
	public function add_stock()
	{
		$this->db->trans_start();
		error_reporting(0);
		$jenis = $this->input->post('jenis');
		$kategori = $this->input->post('kategori');
		$masuk = $this->input->post('masuk');
		$diterima = $this->input->post('diterima');
		$produksi = $this->input->post('produksi');
		$ket = $this->input->post('ket');
		$asal = $this->input->post('asal');

		$takau = $this->db->query("SELECT hari_ini FROM data_stock WHERE jenis = '$jenis' AND kategori ='$kategori' ORDER BY id DESC LIMIT 1")->result();
		
		$hari = $takau[0]->hari_ini + $diterima - $produksi;

		$jns = $this->db->where(array('jenis_tmp' => $jenis,'kategori_tmp' => $kategori))->get('data_stock_tmp');
		if ($jns->num_rows() == 0) {
			$lkl = array('jenis_tmp' => $jenis, 'kategori_tmp' => $kategori, 'hs_sblm' => $hari);
			$this->db->insert('data_stock_tmp', $lkl);
		} else {
			$lkl = array('hs_sblm' => $hari);
			$where = array('jenis_tmp' => $jenis, 'kategori_tmp' => $kategori);
			$this->db->where($where)->update('data_stock_tmp', $lkl);
		}

		$prd = $this->db->where(array('jenis_pr' => $jenis,'kategori_pr' => $kategori))->get('data_produksi');
		if ($prd->num_rows() == 0) {
			$prd1 = $produksi;
			$klk = array('jenis_pr' => $jenis, 'kategori_pr' => $kategori, 'produksi_pr' => $prd1);
			$this->db->insert('data_produksi', $klk);
		} else {
			$pp = $prd->row();
			$prd1 = $pp->produksi_pr + $produksi;
			$klk = array('produksi_pr' => $prd1);
			$this->db->where(array('jenis_pr' => $jenis, 'kategori_pr' => $kategori))->update('data_produksi', $klk);
		}
		
		$data = array(
			'asal' => $asal,
			'tanggal' => $this->input->post('tanggal'), 
			'jenis' => $jenis,
			'kategori' => $kategori,
			'stock_masuk' => $masuk,
			'diterima' => $diterima,
			'diproduksi' => $produksi,
			'hari_ini' => $hari,
			'ket' => $ket,
			'author' => $_SESSION['username'],
		);		
		$cek = $this->db->insert('data_stock', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Stock Tembakau'); window.location = '".base_url(
				'Bahanbaku')."'</script>";
		}else{
			echo "<script>alert('Gagal Menambahkan Stock Tembakau'); window.location = '".base_url(
				'Bahanbaku')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_stock
	public function edit_stock($id)
	{	
		$data['data'] = $this->db->get_where('data_stock', array('id' => $id))->row_array();
		$data['stock_sb'] = $this->db->query("SELECT id,hari_ini FROM data_stock WHERE id < '$id' ORDER BY id DESC")->result();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/edit_stock', $data);
		$this->load->view('home/layout/footer');
	}

	// update_stock
	public function update_stock($id)
	{
		error_reporting(0);
		$this->db->trans_start();
		$jenis = $this->input->post('jenis');
		$kategori = $this->input->post('kategori');
		$masuk = $this->input->post('masuk');
		$diterima = $this->input->post('diterima');
		$produksi = $this->input->post('diproduksi');
		$stock_sb = (int) ($this->input->post('stock_sb'));
		$ket = $this->input->post('ket');
		$asal = $this->input->post('asal');

		$hari = $stock_sb + $diterima - $produksi;

		$data = array(
			'asal' => $asal,
			'tanggal' => date('Y-m-d'),
			'jenis' => $jenis,
			'kategori' => $kategori,
			'stock_masuk' => $masuk,
			'diterima' => $diterima,
			'diproduksi' => $produksi,
			'hari_ini' => $hari,
			'ket' => $ket,
			'author' => $_SESSION['username'],
		);

		$jk = $this->db->where('id',$id)->get('data_stock')->result();
		$mm = $this->db->where(array('jenis_pr' => $jenis,'kategori_pr' => $kategori))->get('data_produksi')->result();
		if ($jk[0]->diproduksi > $produksi) {
			$ll = $jk[0]->diproduksi - $produksi;
			$kk = $mm[0]->produksi_pr - $ll;
		} else {
			$ll = $produksi - $jk[0]->diproduksi;
			$kk = $mm[0]->produksi_pr + $ll;
		}
		

		$zc = array('hs_sblm' => $hari);
		$this->db->where(array('jenis_tmp' => $jenis,'kategori_tmp' => $kategori))->update('data_stock_tmp', $zc);
		$ct = array('produksi_pr' => $kk);
		$this->db->where(array('jenis_pr' => $jenis, 'kategori_pr' => $kategori))->update('data_produksi', $ct);

		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('data_stock');

		if ($cek) {
			$db = $this->db->query("SELECT * FROM data_stock WHERE id > '$id' AND kategori = 'Filler'"); 
			for ($i= 0; $i < $db->num_rows(); $i++) { 
				$dt = $this->db->select('hs_sblm')->where(array('jenis_tmp' => $jenis,'kategori_tmp' => $kategori))->get('data_stock_tmp')->result();
				$nl = $db->result_array();
				
				$x =  $dt[0]->hs_sblm + $nl[$i]['diterima'] - $nl[$i]['diproduksi'];

				$data_11 = array('hs_sblm' => $x );
				$this->db->where(array('jenis_tmp' => $nl[$i]['jenis'],'kategori_tmp' => $nl[$i]['kategori']))->update('data_stock_tmp', $data_11);

				$data_12 = array('hari_ini' => $x );
				$this->db->where(array('id' => $nl[$i]['id'] ))->update('data_stock', $data_12);
				
			}			
			echo "<script>alert('Berhasil MengEdit Data Stock'); window.history.back()</script>";	
		}else{
			echo "<script>alert('Gagal MengEdit Data Stock'); window.history.back()</script>";
		}
		$this->db->trans_complete();
	}
	// hapus_stock
	public function hapus_stock($id)
	{
		$this->db->trans_start();
		$show = $this->db->select('jenis,kategori,stock_masuk,diterima,diproduksi,hari_ini')->where('id', $id)->get('data_stock')->row();
		$stock = $this->db->select('hs_sblm')->where(['jenis_tmp' => $show->jenis,'kategori_tmp' => $show->kategori])->get('data_stock_tmp')->row();
		$pro = $this->db->select('produksi_pr')->where(['jenis_pr' => $show->jenis,'kategori_pr' => $show->kategori])->get('data_produksi')->row();

		$stk = $stock->hs_sblm - $show->diterima + $show->diproduksi;
		$prd = $pro->produksi_pr - $show->diproduksi;

		$this->db->where(['jenis_tmp' => $show->jenis,'kategori_tmp' => $show->kategori])->update('data_stock_tmp',['hs_sblm' => $stk]);
		$this->db->where(['jenis_pr' => $show->jenis,'kategori_pr' => $show->kategori])->update('data_produksi',['produksi_pr' => $prd]);

		$cek = $this->db->delete('data_stock', array('id' => $id));
		if ($cek) {
			echo "Berhasil Menghapus Data Stock !";
		}else{
			echo "Gagal Menghapus Data Stock !";
		}
		$this->db->trans_complete();
	}

	// cari_stock_bahan
	public function cari_stock_bahan()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['jenis'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('data_stock')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['asal'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['kategori'].'</td>
				<td>'.$key['stock_masuk'].'</td>
				<td>'.$key['diterima'].'</td>
				<td>'.$key['diproduksi'].'</td>
				<td>'.$key['hari_ini'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->where('jenis', $_POST['jenis'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('data_stock')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['asal'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['kategori'].'</td>
				<td>'.$key['stock_masuk'].'</td>
				<td>'.$key['diterima'].'</td>
				<td>'.$key['diproduksi'].'</td>
				<td>'.$key['hari_ini'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_stock_bahan
	public function total_stock_bahan()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		$output = array('masuk' => '', 'diterima' => '', 'diproduksi' => '', 'hari_ini' => '');		
		if ($_POST['jenis'] == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(stock_masuk) as masuk');
			$this->db->from('data_stock');
			$output['masuk'] .= $this->db->get()->row()->masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(diterima) as diterima');
			$this->db->from('data_stock');
			$output['diterima'] .= $this->db->get()->row()->diterima;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(diproduksi) as diproduksi');
			$this->db->from('data_stock');
			$output['diproduksi'] .= $this->db->get()->row()->diproduksi;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(hari_ini) as hari_ini');
			$this->db->from('data_stock');
			$output['hari_ini'] .= $this->db->get()->row()->hari_ini;

			echo json_encode($output);
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(stock_masuk) as masuk');
			$this->db->from('data_stock');
			$output['masuk'] .= $this->db->get()->row()->masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(diterima) as diterima');
			$this->db->from('data_stock');
			$output['diterima'] .= $this->db->get()->row()->diterima;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(diproduksi) as diproduksi');
			$this->db->from('data_stock');
			$output['diproduksi'] .= $this->db->get()->row()->diproduksi;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('jenis', $_POST['jenis']);
			$this->db->select('SUM(hari_ini) as hari_ini');
			$this->db->from('data_stock');
			$output['hari_ini'] .= $this->db->get()->row()->hari_ini;

			echo json_encode($output);
		}
	}

	// print_stock_bahan
	public function print_stock_bahan()
	{
		$this->load->view('home/bahanbaku/print_stock_bahan');
	}
	
	// stock_cincin
	public function stock_cincin()
	{
		$data['data'] = $this->db->get('stock_cincin')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/stock_cincin', $data);
		$this->load->view('home/layout/footer');
	}
	// add_stock_cincin
	public function add_stock_cincin()
	{
		$cek=$this->db->insert('stock_cincin',array('produk'=>$this->input->post('produk'),'stock'=>$this->input->post('stock')));
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Stock Cincin !'); window.location = '".base_url(
				'Bahanbaku/stock_cincin')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Stock Cincin !'); window.location = '".base_url(
				'Bahanbaku/stock_cincin')."'</script>";
		}
	}
	// hapus_stock_cincin
	public function hapus_stock_cincin($id)
	{
		$cek = $this->db->delete('stock_cincin',array('id'=>$id));
		if ($cek) {
			echo "Berhasil Menghapus Stock Cincin !";	
		}else{
			echo "Gagal Menghapus Stock Cincin !";
		}
	}
	// edit_stock_cincin
	public function edit_stock_cincin($id)
	{
		echo json_encode($this->db->get_where('stock_cincin', array('id' => $id))->row_array());
	}
	// update_stock_cincin
	public function update_stock_cincin($id)
	{
		$cek=$this->db->set(array('produk'=>$_POST['produk'],'stock'=>$_POST['stock']))->where('id',$id)->update('stock_cincin');
		if ($cek) {
			echo "Berhasil MengUpdate Stock Cincin !";
		}else{
			echo "Gagal MengUpdate Stock Cincin !";
		}
	}

	// stock_Stiker
	public function stock_Stiker()
	{
		$data['data'] = $this->db->get('stock_stiker')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/stock_stiker', $data);
		$this->load->view('home/layout/footer');
	}
	// add_stock_Stiker
	public function add_stock_Stiker()
	{	
		$jumlah = $this->input->post('stock_luar') - $this->input->post('stock_dalam');
		$cek=$this->db->insert('stock_stiker',
			array(
				'produk'=>$this->input->post('produk'),
				'stock_luar'=>$this->input->post('stock_luar'), 
				'stock_dalam'=>$this->input->post('stock_dalam'), 
				'jumlah' => $jumlah
			));
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Stock Stiker !'); window.location = '".base_url(
				'Bahanbaku/stock_stiker')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Stock Stiker !'); window.location = '".base_url(
				'Bahanbaku/stock_stiker')."'</script>";
		}
	}
	// hapus_stock_Stiker
	public function hapus_stock_Stiker($id)
	{
		$cek = $this->db->delete('stock_stiker',array('id'=>$id));
		if ($cek) {
			echo "Berhasil Menghapus Stock Stiker !";	
		}else{
			echo "Gagal Menghapus Stock Stiker !";
		}
	}
	// edit_stock_Stiker
	public function edit_stock_Stiker($id)
	{
		echo json_encode($this->db->get_where('stock_stiker', array('id' => $id))->row_array());
	}
	// update_stock_Stiker
	public function update_stock_Stiker($id)
	{	
		$jumlah = $_POST['stock_luar'] + $_POST['stock_dalam'];
		$cek=$this->db->set(array(
			'produk'=>$_POST['produk'],
			'stock_luar'=>$_POST['stock_luar'],
			'stock_dalam'=>$_POST['stock_dalam'],
			'jumlah' => $jumlah))->where('id',$id)->update('stock_stiker');
		if ($cek) {
			echo "Berhasil MengUpdate Stock Stiker !";
		}else{
			echo "Gagal MengUpdate Stock Stiker !";
		}
	}

	// stock_Kemasan
	public function stock_Kemasan()
	{
		$data['data'] = $this->db->get('stock_kemasan')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/stock_kemasan', $data);
		$this->load->view('home/layout/footer');
	}
	// add_stock_Kemasan
	public function add_stock_Kemasan()
	{
		$cek=$this->db->insert('stock_kemasan',array('produk'=>$this->input->post('produk'),'nama_kemasan'=>$this->input->post('kemasan'),'stock'=>$this->input->post('stock')));
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Stock Kemasan !'); window.location = '".base_url(
				'Bahanbaku/stock_kemasan')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Stock Kemasan !'); window.location = '".base_url(
				'Bahanbaku/stock_kemasan')."'</script>";
		}
	}
	// hapus_stock_Kemasan
	public function hapus_stock_Kemasan($id)
	{
		$cek = $this->db->delete('stock_kemasan',array('id'=>$id));
		if ($cek) {
			echo "Berhasil Menghapus Stock Kemasan !";	
		}else{
			echo "Gagal Menghapus Stock Kemasan !";
		}
	}
	// edit_stock_Kemasan
	public function edit_stock_Kemasan($id)
	{
		echo json_encode($this->db->get_where('stock_kemasan', array('id' => $id))->row_array());
	}
	// update_stock_Kemasan
	public function update_stock_Kemasan($id)
	{
		$cek=$this->db->set(array('produk'=>$_POST['produk'],'nama_kemasan'=>$_POST['kemasan'],'stock'=>$_POST['stock']))->where('id',$id)->update('stock_kemasan');
		if ($cek) {
			echo "Berhasil MengUpdate Stock Kemasan !";
		}else{
			echo "Gagal MengUpdate Stock Kemasan !";
		}
	}

	// stock_Cukai
	public function stock_Cukai()
	{
		$data['data'] = $this->db->order_by('id', 'DESC')->get('stock_cukai')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/bahanbaku/stock_cukai', $data);
		$this->load->view('home/layout/footer');
	}
	// add_stock_Cukai
	public function add_stock_Cukai()
	{
		$sub_produk = $this->db->get_where('sub_produk', array('id' => $this->input->post('sub_produk')))->row_array();
		$produk = $this->db->get_where('produk', array('id' => $this->input->post('produk')))->row_array();
		$cek=$this->db->insert('stock_cukai',array(
			'id_subproduk'=>$this->input->post('sub_produk'),
			'sub_produk'=>$sub_produk['sub_produk'],
			'sub_kode'=>$sub_produk['sub_kode'],
			'produk'=>$produk['produk'],
			'stock'=>$this->input->post('stock')
		));
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Stock Cukai !'); window.location = '".base_url(
				'Bahanbaku/stock_cukai')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Stock Cukai !'); window.location = '".base_url(
				'Bahanbaku/stock_cukai')."'</script>";
		}
	}
	// hapus_stock_Cukai
	public function hapus_stock_Cukai($id)
	{
		$cek = $this->db->delete('stock_cukai',array('id'=>$id));
		if ($cek) {
			echo "Berhasil Menghapus Stock Cukai !";	
		}else{
			echo "Gagal Menghapus Stock Cukai !";
		}
	}
	// edit_stock_Cukai
	public function edit_stock_Cukai($id)
	{
		echo json_encode($this->db->get_where('stock_cukai', array('id' => $id))->row_array());
	}
	// update_stock_Cukai
	public function update_stock_Cukai($id)
	{
		$cek=$this->db->set(array('produk'=>$_POST['produk'],'stock'=>$_POST['stock']))->where('id',$id)->update('stock_cukai');
		if ($cek) {
			echo "Berhasil MengUpdate Stock Cukai !";
		}else{
			echo "Gagal MengUpdate Stock Cukai !";
		}
	}
	// cari_sub
	public function cari_sub()
	{
		$output = ''; $produk = $_POST['produk'];
		$data = $this->db->get_where('sub_produk', array('id_produk' => $produk))->result_array();
		$output .= '<div class="form-group"><select id="sub_produk_in" name="sub_produk" class="form-control">';
		foreach ($data as $key) {
			$output .= '<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].'</option>';
		}
		$output .= '</select></div>';
		echo json_encode($output);
	}

	public function cari_sub1()
	{
		$produk = $_POST['produk'];
		$output['name_produk'] = $this->db->select('produk')->where('id',$produk)->get('produk')->row()->produk;
		$output['select'] = ''; 
		$data = $this->db->get_where('sub_produk', array('id_produk' => $produk))->result_array();
		$output['select'] .= '<div class="form-group"><select id="sub_produk_in" name="sub_produk" class="form-control">';
		foreach ($data as $key) {
			$output['select'] .= '<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].'</option>';
		}
		$output['select'] .= '</select></div>';
		echo json_encode($output);
	}	
}