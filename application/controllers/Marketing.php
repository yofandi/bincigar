<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class marketing extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('cart');
	} 

	public function rfs()
	{
		$data['pack'] = $this->db->order_by('id', 'DESC')->get_where('rfs')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/rfs',$data);
		$this->load->view('home/layout/footer');
	}

	// cari_sub
	public function cari_sub($id = null)
	{
		if (!$id) {
			echo "ID Kosong";
		}else{

			$output = '';
			$data = $this->db->get_where('sub_produk', array('id_produk' => $id))->result_array();

			$output .= '<select id="id_sub" class="form-control" name="id_sub">';
			foreach ($data as $key) {
				
				$output .= '
				<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['kemasan'].'</option>
				';
			}
			$output .= '</select>';

			echo json_encode($output);
		}
	}

	

	// cari_rfs
	public function cari_rfs()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('rfs')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
					<td>'.$no.'</td>
					<td>'.$key['tanggal'].'</td>
					<td>'.$key['sub_produk'].'</td>
					<td>'.$key['kemasan'].'</td>
					<td>'.$key['isi'].'</td>
					<td>'.$key['stock'].'</td>
					<td>'.$key['masuk'].'</td>
					<td>'.$key['keluar'].'</td>
					<td>'.$key['sisa'].'</td>
					<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->where('sub_produk', $_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('rfs')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
					<td>'.$no.'</td>
					<td>'.$key['tanggal'].'</td>
					<td>'.$key['sub_produk'].'</td>
					<td>'.$key['kemasan'].'</td>
					<td>'.$key['isi'].'</td>
					<td>'.$key['stock'].'</td>
					<td>'.$key['masuk'].'</td>
					<td>'.$key['keluar'].'</td>
					<td>'.$key['sisa'].'</td>
					<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
			
	}
	// total_rfs
	public function total_rfs()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		$output = array('masuk' => '', 'keluar' => '', 'sisa' => '', 'stock' => '');
		if ($_POST['produk'] == '') {
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('kategori', 'Filling');
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('rfs');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('kategori', 'Filling');
			$this->db->select('SUM(keluar) as total_keluar');
			$this->db->from('rfs');
			$output['keluar'] .= $this->db->get()->row()->total_keluar;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('kategori', 'Filling');
			$this->db->select('SUM(sisa) as total_sisa');
			$this->db->from('rfs');
			$output['sisa'] .= $this->db->get()->row()->total_sisa;


			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			// $this->db->where('kategori', 'Filling');
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('rfs');
			$output['stock'] .= $this->db->get()->row()->total_stock;

			echo json_encode($output);			
		}else{
			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('sub_produk', $_POST['produk']);
			$this->db->select('SUM(masuk) as total_masuk');
			$this->db->from('rfs');
			$output['masuk'] .= $this->db->get()->row()->total_masuk;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('sub_produk', $_POST['produk']);
			$this->db->select('SUM(keluar) as total_keluar');
			$this->db->from('rfs');
			$output['keluar'] .= $this->db->get()->row()->total_keluar;

			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('sub_produk', $_POST['produk']);
			$this->db->select('SUM(sisa) as total_sisa');
			$this->db->from('rfs');
			$output['sisa'] .= $this->db->get()->row()->total_sisa;


			$this->db->where('tanggal >=',$awal);
			$this->db->where('tanggal <=',$akhir);
			$this->db->where('sub_produk', $_POST['produk']);
			$this->db->select('SUM(stock) as total_stock');
			$this->db->from('rfs');
			$output['stock'] .= $this->db->get()->row()->total_stock;

			echo json_encode($output);
		}			
			
	}

	// bagan_store
	public function bagan_store()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/bagan_store');
		$this->load->view('home/layout/footer');
	}
	// add_bagan
	public function add_bagan()
	{
		$data = array(
			'nama' => $this->input->post('nama'),
			'deskripsi' => $this->input->post('des'), 
		);
		$cek = $this->db->insert('bagan_store', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Bagan Store'); window.location = '".base_url(
				'Marketing/bagan_store')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Bagan Store'); window.location = '".base_url(
				'Marketing/bagan_store')."'</script>";
		}
	}
	// edit_bagan
	public function edit_bagan($id)
	{
		echo json_encode($this->db->get_where('bagan_store', array('id' => $id))->row_array());
	}
	// update_bagan
	public function update_bagan($id)
	{
		$this->db->set(array('nama' => $_POST['nama'], 'deskripsi' => $_POST['deskripsi']));
		$this->db->where('id', $id);
		$cek = $this->db->update('bagan_store');
		if ($cek) {
			echo "Berhasil MengUpdate Bagan Store ID ".$id;
		}else{
			echo "Gagal MengUpdate Bagan Store ID ".$id;
		}
	}
	// hapus_bagan
	public function hapus_bagan($id)
	{
		$cek = $this->db->delete('bagan_store', array('id' => $id));
		if ($cek) {
			echo "Berhasil MengHapus Bagan Store ID ".$id;
		}else{
			echo "Gagal MengHapus Bagan Store ID ".$id;
		}
	}

	// baganstore
	public function transaksi()
	{
		$data['sub_produk'] = $this->db->get('sub_produk');

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/baganstore',$data);
		$this->load->view('home/layout/footer');
	}
	// add_penjualan
	public function add_penjualan()
	{	
		$bagan = $this->input->post('bagan');
		$stock = $this->input->post('stock');
		$terjual = $this->input->post('terjual');
		$mutasi = $this->input->post('mutasi');
		$hasil = $stock - $terjual - $mutasi;


		$data = array('mutasi' => $mutasi,'tanggal' => $this->input->post('tanggal'),'bagan' => $bagan, 'stock' => $stock, 'terjual' => $terjual, 'sisa' => $hasil);
		$cek = $this->db->insert('penjualan', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Penjualan Bagan Store'); window.location = '".base_url(
				'Marketing/baganstore')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Penjualan Bagan Store'); window.location = '".base_url(
				'Marketing/baganstore')."'</script>";
		}
	}

	// hapus_penjualan
	public function hapus_penjualan($id)
	{	
		$a = $this->db->get_where('penjualan', array('id' => $id))->row_array();
		$data = $this->db->order_by('id', 'DESC')->get_where('penjualan', array('id_subproduk' => $a['id_subproduk']))->row_array();
		$stock = $data['stock'];

		// echo $a['id_subproduk'].$stock;
		$b = $this->db->set(array('keluar' => $stock))->order_by('id', 'DESC')->where('id_subproduk', $a['id_subproduk'])->update('rfs');
		if ($b) {
			$cek = $this->db->delete('penjualan', array('id' => $id));
			if ($cek) {
				echo "<script>alert('Berhasil MengHapus Penjualan Bagan Store'); window.location = '".base_url(
					'Marketing/transaksi')."'</script>";	
			}else{
				echo "<script>alert('Gagal MengHapus Penjualan Bagan Store'); window.location = '".base_url(
					'Marketing/transaksi')."'</script>";
			}
		}
		
	}	
	// edit_penjualan
	public function edit_penjualan($id)
	{		
		$data['data'] = $this->db->get_where('penjualan', array('id' => $id))->row();
		$data['id'] = $id;
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/edit_baganstore', $data);
		$this->load->view('home/layout/footer');
	}
	// update_penjualan
	public function update_penjualan($id)
	{		
		$Post = $this->input->post();

		$sisa = $Post['stock_awal'] - $Post['keluar'];

		$tmp = $this->db->where('id_subproduk',$Post['id_subproduk'])->get('rfs_stock_keluar')->row();
		if ($Post['keluar'] > $Post['kl_aw']) {
			$hsl = $Post['keluar'] - $Post['kl_aw'];
			$total = $tmp->stock_keluar - $hsl;
		} else {
			$hsl = $Post['kl_aw'] - $Post['keluar'];
			$total = $tmp->stock_keluar + $hsl;
		}

		$object = array('stock_keluar' => $total);
		$this->db->where('id_subproduk',$Post['id_subproduk'])->update('rfs_stock_keluar', $object);

		$update = array('produk' => $Post['produk'],
						'id_subproduk' => $Post['id_subproduk'],
						'subproduk' => $Post['subproduk'],
						'sub_kode' => $Post['sub_kode'],
						'stock' => $Post['stock_awal'],
						'keluar' => $Post['keluar'],
						'sisa' => $sisa,
						'keterangan' => $this->input->post('keterangan'),
						'bagan' => $Post['bagan'],
						'for_user' => $Post['for_user'],
						'tanggal' => $Post['tanggal'],
						'author' => $this->session->userdata('level'));

		$cek = $this->db->where('id',$id)->update('penjualan', $update);
		
		if ($cek) {
			echo "<script>alert('Berhasil Mengupdate Data RFS'); window.location = '".base_url(
					'Marketing/transaksi')."'</script>";
		} else {
			echo "<script>alert('Gagal Mengupdate Data RFS'); window.location = '".base_url(
					'Marketing/transaksi')."'</script>";
		}
		
	}

	public function return_rfs()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/return_rfs');
		$this->load->view('home/layout/footer');
	}

	public function get_id_produk()
	{
		$pro = $this->input->post('produk');
		$output['id'] = $this->db->select('id')->where('produk',$pro)->get('produk')->row()->id;
		echo json_encode($output);
	}

	public function add_return()
	{
		$cek = $this->db->select('id_rtn,jumlah')->get_where('return_rfs',array('id_produk' => $_POST['id']));
		$stok = $this->db->where('id_subproduk',$this->input->post('sub'))->get('rfs_stock_keluar')->row();
		if ($cek->num_rows() > 0) {
			$upd_stok = $stok->stock_keluar - $_POST['jumlah'];
			$this->db->where('id_subproduk',$this->input->post('sub'))->update('rfs_stock_keluar', array('stock_keluar' => $upd_stok));

			$cek_ = $cek->result();
			$jml = $cek_[0]->jumlah + $_POST['jumlah'];

			$ins = array('id_subproduk' => $this->input->post('sub'),
				'id_produk' => $this->input->post('id'),
				'jumlah' => $jml,
				'ket' => $this->input->post('ket'),
				'tanggal' => $this->input->post('tanggal'),
				'status' => 0);

			$this->db->where('id_rtn', $cek_[0]->id_rtn);
			$db = $this->db->update('return_rfs', $ins);
		} else {
			$upd_stok = $stok->stock_keluar - $_POST['jumlah'];
			$this->db->where('id_subproduk',$this->input->post('sub'))->update('rfs_stock_keluar', array('stock_keluar' => $upd_stok));
			
			$jml = $_POST['jumlah'];

			$ins = array('id_subproduk' => $this->input->post('sub'),
				'id_produk' => $this->input->post('id'),
				'jumlah' => $jml,
				'ket' => $this->input->post('ket'),
				'tanggal' => $this->input->post('tanggal'),
				'status' => 0);

			$db = $this->db->insert('return_rfs', $ins);
		}

		if ($db) {
			echo "berhasil";
		} else {
			echo "gagal";
		}
		
	}

	public function return_bagan()
	{
		$data['produk'] = $this->db->get('produk');

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/return_bagan',$data);
		$this->load->view('home/layout/footer');
	}

	public function add_return_bagan()
	{
		$Post = $this->input->post();

		$stock_bagan = $this->db->where(array('id_subproduk' => $Post['id_subproduk'],'id_users' => $Post['id_sess']))->get('stock_bagan')->row();

		$hs_bg = $stock_bagan->stock_barang - $Post['jumlah'];

		$this->db->where(array('id_subproduk' => $Post['id_subproduk'],'id_users' => $Post['id_sess']))->update('stock_bagan', array('stock_barang' => $hs_bg));

		$object = array('id_subproduk' => $Post['id_subproduk'],
						'jumlah' => $Post['jumlah'],
						'bagan' => $Post['bagan'],
						'author' => $Post['user'],
						'keterangan' => $Post['keterangan'],
						'tanggal' => $Post['tanggal'],
						'status' => 0);
		$cek = $this->db->insert('return_bagan', $object);
		if ($cek) {
			echo "<script>alert('Berhasil Menambah Return Bagan'); window.location = '".base_url(
				'Marketing/return_bagan')."'</script>";
		} else {
			echo "<script>alert('Gagal Menambah Return Bagan'); window.location = '".base_url(
				'Marketing/return_bagan')."'</script>";
		}
		
	}

	public function lihat_return_bagan($id)
	{
		$this->db->select('return_bagan.*,
						   produk.produk,
						   sub_produk.sub_produk,
						   sub_produk.sub_kode');
		$this->db->from('return_bagan');
		$this->db->join('sub_produk', 'return_bagan.id_subproduk = sub_produk.id', 'inner');
		$this->db->join('produk', 'sub_produk.id_produk = produk.id', 'inner');
		$this->db->where('return_bagan.id_return_bagan',$id);
		$data['return'] = $this->db->get()->row();

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/lihat_return_bagan',$data);
		$this->load->view('home/layout/footer');
	}

	public function add_stockreturn_bagan($id)
	{
		$jml = $this->input->post('jumlah');
		$id_sub = $this->input->post('id_sub');
		$show = $this->db->select('stock_keluar')->get('rfs_stock_keluar')->row();

		$hasil = $show->stock_keluar + $jml;

		$this->db->where('id_subproduk',$id_sub)->update('rfs_stock_keluar', array('stock_keluar' => $hasil));

		$cek = $this->db->where('id_return_bagan',$id)->update('return_bagan', array('status' => 1));
		if ($cek) {
			echo "<script>alert('Berhasil Menerima Return Bagan'); window.location = '".base_url(
				'Home/index')."'</script>";
		} else {
			echo "<script>alert('Gagal Menerima Return Bagan'); window.location = '".base_url(
				'Home/index')."'</script>";
		}
	}
	// print_penjualan
	public function print_penjualan()
	{
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$data['produk'] = $this->input->post('produk');
		$this->load->view('home/marketing/print_penjualan',$data);
	}
	public function total_penjualan()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir']; $bagan = $_POST['bagan'];
		
		$output = array('stock' => '', 'terjual' => '', 'sisa' => '','mutasi' => '');
		if ($bagan == '') {
			$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->select('SUM(stock) as total_stock');
		$this->db->from('penjualan');
		$output['stock'] .= $this->db->get()->row()->total_stock;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->select('SUM(terjual) as total_terjual');
		$this->db->from('penjualan');
		$output['terjual'] .= $this->db->get()->row()->total_terjual;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->select('SUM(sisa) as total_sisa');
		$this->db->from('penjualan');
		$output['sisa'] .= $this->db->get()->row()->total_sisa;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->select('SUM(mutasi) as total_mutasi');
		$this->db->from('penjualan');
		$output['mutasi'] .= $this->db->get()->row()->total_mutasi;

		echo json_encode($output);
		}else{
			$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->where('bagan', $bagan);
		$this->db->select('SUM(stock) as total_stock');
		$this->db->from('penjualan');
		$output['stock'] .= $this->db->get()->row()->total_stock;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->where('bagan', $bagan);
		$this->db->select('SUM(terjual) as total_terjual');
		$this->db->from('penjualan');
		$output['terjual'] .= $this->db->get()->row()->total_terjual;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->where('bagan', $bagan);
		$this->db->select('SUM(sisa) as total_sisa');
		$this->db->from('penjualan');
		$output['sisa'] .= $this->db->get()->row()->total_sisa;

		$this->db->where('tanggal >=',$awal);
		$this->db->where('tanggal <=',$akhir);
		$this->db->where('bagan', $bagan);
		$this->db->select('SUM(mutasi) as total_mutasi');
		$this->db->from('penjualan');
		$output['mutasi'] .= $this->db->get()->row()->total_mutasi;

		echo json_encode($output);
		}		
	}

	// print_rfs
	public function print_rfs()
	{
		$this->load->view('home/marketing/print_rfs');
	}

	public function penjualan_1()
	{
		$this->db->select('users.username,
						   penjualan_cerutu.bagan,
						   penjualan_cerutu.id_penjualan_bagan as id_bagan,
						   penjualan_cerutu.harga_semua_cerutu as hr_all,
						   penjualan_cerutu.diskon,
						   penjualan_cerutu.sistem,
						   penjualan_cerutu.ongkos,
						   penjualan_cerutu.total,
						   penjualan_cerutu.yang_dibayar as pay,
						   penjualan_cerutu.tanggal,
						   penjualan_cerutu.no_invoice,
						   penjualan_cerutu.lokasi_kirim,
						   penjualan_cerutu.departure_date,
						   penjualan_cerutu.vessel,
						   penjualan_cerutu.port_of_loading,
						   penjualan_cerutu.port_of_destination,
						   penjualan_cerutu.keterangan,
						   customer.nama_customer');		
		$this->db->from('penjualan_cerutu');
		$this->db->join('users', 'penjualan_cerutu.id_users = users.id', 'inner');
		$this->db->join('customer', 'penjualan_cerutu.customer = customer.id_customer', 'inner');
		if ($_SESSION['level'] == 'Super Admin') {
			
		} else {
			$this->db->like('penjualan_cerutu.id_users', $this->session->userdata('id'), 'BOTH');
		}
		$this->db->order_by('penjualan_cerutu.id_penjualan_bagan', 'desc');
		$data['penjualan'] = $this->db->get();

		$data['produk'] = $this->db->get('produk');

		$data['setting'] = $this->db->get_where('setting', array('id' => 1))->row();

		$data['bagan'] = $this->db->select('nama')->get('bagan_store');

		$data['customer'] = $this->db->where('id_users',$this->session->userdata('id'))->get('customer');

		$data['sistem'] = array('Cash','Transfer','Promosi','Souvenir','VVIP');

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/penjualan',$data);
		$this->load->view('home/layout/footer');
	}

	public function view_tambah_penjualan_1()
	{
		$data['invoice_sam'] = $this->M_model->make_invoice();
		$data['produk'] = $this->db->get('produk');
		$data['bagan'] = $this->db->select('nama')->get('bagan_store');
		$data['customer'] = $this->db->where('id_users',$this->session->userdata('id'))->get('customer');
		$data['sistem'] = array('Cash','Transfer','Promosi','Souvenir','VVIP');

        $this->db->select('sub_produk.id,
			sub_produk.sub_produk,
			sub_produk.sub_kode,
			sub_produk.hje,
			stock_bagan.stock_barang as stock,
			users.username,
			users.level');
		$this->db->from('sub_produk');
		$this->db->join('stock_bagan', 'sub_produk.id = stock_bagan.id_subproduk', 'inner');
		$this->db->join('users', 'stock_bagan.id_users = users.id', 'inner');
		$this->db->order_by('users.id', 'desc');
		if ($this->session->userdata('level') != 'Super Admin') {
			$this->db->where('stock_bagan.id_users', $this->session->userdata('id'));
		}
		$data['barang_show'] = $this->db->get();

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/tambah_penjualan',$data);
		$this->load->view('home/layout/footer');
	}

	public function show_cart()
	{
		$output['table'] = '';
		$output['tot_blanja'] = '';
		$no = 1;
		$tot = 0;
		foreach ($this->cart->contents() as $value) {
			$tot_ = $value['options']['total'];
			$output['table'] .= '
			<tr>
	        	<td>'.$no.'</td>
	        	<td>'.$value['name'].'</td>
	        	<td align="right">'.$value['qty'].'</td>
	        	<td align="">'.$value['options']['discount'].'</td>
	        	<td align="right">'.number_format($value['options']['total'],0,',','.').'</td>
	        	<td>
	        	<a href="'.base_url('Marketing/remove_cart/'.$value['rowid'].'/'.$value['name']).'" class="btn btn-warning btn-sm"><i class="fa fa-trash-o"></i></a>
	        	</td>
	        </tr>
			';
		$no++;
		$tot += $tot_;
		}
		$output['table'] .= '
			<tr>
	        	<td align="center" colspan="4">Total</td>
	        	<td align="right">'.number_format($tot,0,',','.').'</td>
	        </tr>
			';
		$output['tot_blanja'] .= $tot;
		echo json_encode($output);
	}

	public function remove_cart($rowid,$name)
	{
		$a = $this->cart->remove($rowid);
		if ($a) {
			echo '<script>alert("Berhasil Hapus barang belanja '.$name.'"); window.location="'.base_url('Marketing/view_tambah_penjualan_1').'"</script>';
		} else {
			echo '<script>alert("Gagal Hapus barang belanja '.$name.'"); window.location="'.base_url('Marketing/view_tambah_penjualan_1').'"</script>';
		}
	}

	public function add_to_cart()
	{

		$data = array('id'      => $this->input->post('id'),
                'qty'     => $this->input->post('jml'),
                'price'   => $this->input->post('harga'),
                'name'    => $this->input->post('nama'),
                'options' => array('specific' => $this->input->post('stokaw'),'discount' => $this->input->post('diskon'),'total' => $this->input->post('harga_now'))
            	);
		$this->cart->insert($data);
	}

	public function print_invoice($id)
	{
		$this->db->select('cerutu_terjual.jml,
			cerutu_terjual.diskon_cerutu_terjual,cerutu_terjual.total,
			sub_produk.sub_produk,sub_produk.sub_kode,sub_produk.hje');
		$this->db->from('cerutu_terjual');
		$this->db->join('sub_produk', 'cerutu_terjual.id_subproduk = sub_produk.id', 'left');
		$this->db->where('cerutu_terjual.id_penjualan_bagan', $id);
		$data['data_terbeli'] = $this->db->get();

		$this->db->select('penjualan_cerutu.id_penjualan_bagan,
			penjualan_cerutu.tanggal,penjualan_cerutu.no_invoice,penjualan_cerutu.lokasi_kirim,
			penjualan_cerutu.departure_date,vessel,penjualan_cerutu.port_of_loading,
			penjualan_cerutu.port_of_destination,penjualan_cerutu.diskon,penjualan_cerutu.ongkos,
			penjualan_cerutu.total,customer.nama_customer');
		$this->db->from('penjualan_cerutu');
		$this->db->join('customer', 'penjualan_cerutu.customer = customer.id_customer', 'left');
		$this->db->where('penjualan_cerutu.id_penjualan_bagan', $id);
		$data['penjualan_cerutu'] = $this->db->get()->row();
		$this->load->view('home/marketing/invoice_penjualan',$data);
	}

	public function add_penjualan_1()
	{
		$po = $this->input->post();

		$ins = array('harga_semua_cerutu' => $po['harga_semua_cerutu'],
					 'diskon' => $po['diskon'],
				     'sistem' => $po['sistem'],
			         'ongkos' => $po['ongkos'],
		             'total' => $po['tot_all'],
	                 'yang_dibayar' => $po['yangdibayar'],
					 'id_users' => $po['user'],
					 'bagan' => $po['bagan'],
					 'tanggal' => $po['tanggal'],
					 'author' => $this->session->userdata('username'),
					 'customer' => $po['customer'],
					 'no_invoice' => $po['no_invoice'],
					 'lokasi_kirim' => $po['alamat_kirim'],
					 'departure_date' => $po['tanggal_pengiriman'],
					 'vessel' => $po['pelabuhan'],
					 'port_of_loading' => $po['port_loading'],
					 'port_of_destination' => $po['port_destination'],
					 'keterangan' => $po['keterangan']);
		$cek = $this->db->insert('penjualan_cerutu', $ins);
		if ($cek) {
			$id_penjceru = $this->db->select('id_penjualan_bagan')->order_by('id_penjualan_bagan','desc')->get('penjualan_cerutu', 1)->row();
			$i = 0;
			foreach ($this->cart->contents() as $value) {
				$hje_2 = $this->db->select('hje')->where('id',$value['id'])->get('sub_produk')->row();
				$total = $value['options']['total'];
				$data = array('id_penjualan_bagan' => $id_penjceru->id_penjualan_bagan,
							  'id_subproduk' => $value['id'],
							  'jml' => $value['qty'],
							  'diskon_cerutu_terjual' => $value['options']['discount'],
							  'total' => $total,
							  'tanggal' => $po['tanggal']);
				$this->db->insert('cerutu_terjual', $data);

				$cekaw = $this->db->where(array('id_subproduk' => $value['id'],'id_users' => $po['user']))->get('stock_awalrekap');
				if ($cekaw->num_rows() > 0) {
					$app = $cekaw->row();
					$tahun = date("Y", strtotime($app->tanggal_input_awal));
					$tahun_now = date('Y');
					if ($tahun != $tahun_now) {
						$this->db->where(array('id_subproduk' => $value['id'],'id_users' => $po['user']))->update('stock_awalrekap', array('stock_awal' => $value['options']['specific'],'tanggal_input_awal' => date('Y-01-01')));
					}
				} else {
					$data_aw = array('id_subproduk' => $value['id'],
									 'id_users' => $po['user'],
									 'stock_awal' => $value['options']['specific'],
									 'tanggal_input_awal' => date('Y-01-01'));
					$this->db->insert('stock_awalrekap', $data_aw);
				}
				
				$stok_merk = $this->db->select('stock_barang')->where(array('id_subproduk' => $value['id'],'id_users' => $po['user']))->get('stock_bagan')->row();

				$stok_new = $stok_merk->stock_barang - $value['qty'];

				$this->db->where(array('id_subproduk' => $value['id'],'id_users' => $po['user']));
				$this->db->update('stock_bagan', array('stock_barang' => $stok_new));
				$i++;
			}

			$this->cart->destroy();

			if ($po['tot_all'] > $po['yangdibayar']) {
				$kurang = $po['tot_all'] - $po['yangdibayar'];
				$data_2 = array('id_penjualan_bagan' => $id_penjceru->id_penjualan_bagan,
								'yang_dibayar' => $po['yangdibayar'],
								'kurang' => $kurang,
								'tanggal' => $po['tanggal'],
								'status_pembayaran' => 1);
				$this->db->insert('piutang', $data_2);
			}
			echo "<script>alert('Berhasil Menambahkan Penjualan Cerutu'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";	
		} else {
			echo "<script>alert('Gagal Menambahkan Penjualan Cerutu'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";	
		}
		
	}

	public function update_penjualan1($id)
	{
		$Post = $this->input->post();
		$where = array('id_penjualan_bagan' => $id);
		$data = array('diskon' => $Post['dis_modal'],
					  'sistem' => $Post['sistem'], 
					  'ongkos' => $Post['ong_modal'],
					  'total' => $Post['tot_modal'],
					  'yang_dibayar' => $Post['pay_modal'],
					  'no_invoice' => $Post['no_invoice'],
					  'lokasi_kirim' => $Post['alamat_kirim'],
					  'departure_date' => $Post['tanggal_departure'],
					  'vessel' => $Post['pelabuhan'],
					  'port_of_loading' => $Post['port_loading'],
					  'port_of_destination' => $Post['port_destination'],
					  'keterangan' => $Post['keterangan']);
		$this->db->where($where);
		$cek = $this->db->update('penjualan_cerutu', $data);
		if ($cek) {
			if ($Post['pay_modal'] < $Post['tot_modal']) {
				$kurang = $Post['tot_modal'] - $Post['pay_modal'];
				$ins = array('id_penjualan_bagan' => $id,
							 'yang_dibayar' => $Post['pay_modal'],
							 'kurang' => $kurang,
							 'tanggal' => date('Y-m-d'),
							 'status_pembayaran' => 1);

				$this->db->insert('piutang', $ins);
			}
			echo "<script>alert('Berhasil Mengupdate Penjualan Cerutu'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";
		} else {
			echo "<script>alert('Gagal Mengupdate Penjualan Cerutu'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";
		}
		
	}

	public function delete_penjualan1($id)
	{
		$cek = $this->db->where('id_penjualan_bagan',$id)->delete('penjualan_cerutu');

		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Data Transaksi'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";	
		} else {
			echo "<script>alert('Gagal Menghapus Data Transaksi'); window.location = '".base_url(
				'Marketing/penjualan_1')."'</script>";	
		}
		
	}

	public function show_kurang_piutang($id)
	{
		$output['kurang'] = $this->db->select('kurang')->where('id_penjualan_bagan',$id)->order_by('id_piutang','desc')->get('piutang', 1)->row()->kurang;
		echo json_encode($output);
	}

	public function piutang()
	{
		$this->db->select('piutang.*,
						   penjualan_cerutu.no_invoice,
						   customer.nama_customer');
		$this->db->from('piutang');
		$this->db->join('penjualan_cerutu', 'piutang.id_penjualan_bagan = penjualan_cerutu.id_penjualan_bagan', 'inner');
		$this->db->join('customer', 'penjualan_cerutu.customer = customer.id_customer', 'inner');
		$this->db->where('piutang.status_pembayaran','1');
		$this->db->order_by('piutang.id_piutang', 'desc');
		if ($this->session->userdata('level') == 'Super Admin') {
			
		} else {	
		$this->db->where('customer.id_users', $this->session->userdata('id'));
		}
		$data['piutang'] = $this->db->get();

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/piutang',$data);
		$this->load->view('home/layout/footer');
	}

	public function add_piutang()
	{
		$Post = $this->input->post();

		$kurang = $Post['kurang'] - $Post['bayar'];

		if ($kurang <= 0) {
			$status = 2;
			$kurang_1 = 0;

			$get = $this->db->where('id_penjualan_bagan',$Post['no_tra'])->get('penjualan_cerutu')->row();
			$total = $get->total;

			$this->db->where('id_penjualan_bagan',$Post['no_tra'])->update('penjualan_cerutu', array('yang_dibayar' => $total));

			$this->db->where('id_penjualan_bagan',$Post['no_tra'])->update('piutang', array('status_pembayaran' => $status));
		} else{
			$status = 1;
			$kurang_1 = $kurang;

			$get = $this->db->where('id_penjualan_bagan',$Post['no_tra'])->get('penjualan_cerutu')->row();
			$yangbyr = $get->yang_dibayar;
			$byr_now = $yangbyr + $Post['bayar'];

			$this->db->where('id_penjualan_bagan',$Post['no_tra'])->update('penjualan_cerutu', array('yang_dibayar' => $byr_now));
		}

		$object = array('id_penjualan_bagan' => $Post['no_tra'],
						'yang_dibayar' => $Post['bayar'],
						'kurang' => $kurang_1,
						'status_pembayaran' => $status);
		$cek = $this->db->insert('piutang', $object);
		if ($cek) {
			echo "<script>alert('Berhasil Menambah Data Piutang'); window.location = '".base_url(
				'Marketing/piutang')."'</script>";
		} else {
			echo "<script>alert('Gagal Menambah Data Piutang'); window.location = '".base_url(
				'Marketing/piutang')."'</script>";
		}
	}

	public function delete_piutang($id)
	{
		$cek = $this->db->where('id_piutang',$id)->delete('piutang');
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Data Piutang'); window.location = '".base_url(
				'Marketing/piutang')."'</script>";
		} else {
			echo "<script>alert('Gagal Menghapus Data Piutang'); window.location = '".base_url(
				'Marketing/piutang')."'</script>";
		}
	}
	
	// cari_subproduk
	public function cari_subproduk()
	{
		$produk = $_POST['produk'];
		$output = '';
		$produk = $this->db->get_where('produk', array('produk' => $produk))->row_array();
		$data = $this->db->get_where('sub_produk', array('id_produk' => $produk['id']))->result_array();

		$output .= '<div class="form-group"><label>SubProduk : </label><select id="id_sub" name="id_sub" class="form-control">';
		foreach ($data as $key) {
			
			$output .= '
			<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].'</option>
			';
		}
		$output .= '</select></div>';

		echo json_encode($output);
	}

	// cek_stock_sub_produk
	public function cek_stock_sub_produk()
	{
		$id = $this->input->post('id_sub');
		$produk = $this->input->post('produk');
		$data =  $this->db->order_by('id', 'DESC')->get_where('stock_subproduk', array('id_subproduk' => $id));
		$output = '';
		$info = $this->db->get_where('sub_produk', array('id' => $id))->row_array();
		$datas = $data->row_array();
		$rfs = $this->db->select('stock_q')->get_where('qual_con_tmp', array('produk_q' => $produk))->row_array();
		if ($data->num_rows() == 0) {
			$output .= '
		<div class="col-lg-6">
			<div class="form-group">
				<label>Stock Awal : </label>
				<input type="text" class="form-control" name="stock" value="0" readonly>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>Kemasan : </label>
				<input type="text" class="form-control" name="kemasan" value="'.$info['kemasan'].'" readonly>
			</div>
		</div>
		<div class="col-lg-12">
			<label>Cerutu Hasil Quality Controll</label>
			<input type="text" class="form-control" name="hasil_qc" value="'.$rfs['stock_q'].'" readonly>
		</div>
		<div class="col-lg-5">
			<label>Berapa Packing : </label>
			<input type="text" class="form-control" name="packing" autocomplete="off">
		</div>
		<div class="col-lg-2" style="text-align:center">
			<br><label> X </label>
		</div>
		<div class="col-lg-5">
			<div class="form-group">
				<label> Isi Kemasan : </label>
				<input type="number" class="form-control" name="isi_kemasan" value="'.$info['isi'].'" readonly>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>Stock Keluar : </label>
				<input type="number" class="form-control" name="keluar" autocomplete="off" value="0">
			</div
			<div class="form-group">
				<label>Keterangan : </label>
				<textarea class="form-control" name="ket"></textarea>
			</div>
		</div>
			';
		}else{
			
			$output .= '
		<div class="col-lg-6">
			<div class="form-group">
				<label>Stock Awal : </label>
				<input type="text" class="form-control" name="stock" value="'.$datas['stock'].'" readonly>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>Kemasan : </label>
				<input type="text" class="form-control" name="kemasan" value="'.$info['kemasan'].'" readonly>
			</div>
		</div>
		<div class="col-lg-12">
			<label>Cerutu Hasil Quality Controll</label>
			<input type="text" class="form-control" name="hasil_qc" value="'.$rfs['stock_q'].'" readonly>
		</div>
		<div class="col-lg-5">
			<label>Berapa Packing : </label>
			<input type="text" class="form-control" name="packing" autocomplete="off">
		</div>
		<div class="col-lg-2" style="text-align:center">
			<br><label> X </label>
		</div>
		<div class="col-lg-5">
			<div class="form-group">
				<label> Isi Kemasan : </label>
				<input type="number" class="form-control" name="isi_kemasan" value="'.$info['isi'].'" readonly>
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>Stock Keluar : </label>
				<input type="number" class="form-control" name="keluar" autocomplete="off" value="0">
			</div
			<div class="form-group">
				<label>Keterangan : </label>
				<textarea class="form-control" name="ket"></textarea>
			</div>
		</div>
			';
		}
		echo json_encode($output);
	}
	// tambah_rfs
	public function tambah_rfs()
	{	
		$this->db->trans_start();
		$id_sub = $this->input->post('id_sub');
		$sub_produk = $this->db->get_where('sub_produk', array('id' =>$id_sub))->row_array();
		$produk = $this->input->post('produk');
		$tanggal = $this->input->post('tanggal');
		$jenis = $this->input->post('jenis');
		
		$stock = $this->input->post('stock');
		$hasil_qc = $this->input->post('hasil_qc');
		$packing = $this->input->post('packing');
		$keluar = $this->input->post('keluar');
		$ket = $this->input->post('ket');
		// $tanggal = $this->input->post('tanggal');
		$jumlah = $packing * $sub_produk['isi'];
		$sisa_stock = $hasil_qc - $jumlah;
		$sisa = ($stock + $packing) - $keluar;
		$data = array(
			'id_subproduk' => $id_sub,
			'stock' => $stock,
			'masuk' => $packing,
			'keluar' => $keluar,
			'sisa' => $sisa,
			'ket' => $ket,
			'produk' => $produk,
			'sub_produk' => $sub_produk['sub_produk'],
			'kemasan' => $sub_produk['kemasan'],
			'isi' => $sub_produk['isi'],
			'stock_batang' => $hasil_qc,
			'jumlah' => $jumlah,
			'sisa_stock' => $sisa_stock,
			'author' => $_SESSION['username'],
			'tanggal' => $tanggal
		);
		$ceking = $this->db->get_where('stock_subproduk', array('id_subproduk' => $id_sub))->num_rows();
		if ($ceking == 0) {
			$this->db->insert('stock_subproduk', array('sub_produk' => $sub_produk['sub_produk'],'id_subproduk' => $id_sub, 'stock' => $sisa, 'sub_kode' => $sub_produk['sub_kode'], 'produk' => $produk));
		}else{
			$this->db->set(array('stock' => $sisa))->where('id_subproduk', $id_sub)->update('stock_subproduk');
		}

		$ceking2 = $this->db->get_where('rfs_stock_keluar', array('id_subproduk' => $id_sub));
		if ($ceking2->num_rows() == 0) {
			$object = array('id_subproduk' => $id_sub,'stock_keluar' => $keluar);
			$this->db->insert('rfs_stock_keluar', $object);
		} else {
			$check = $ceking2->result();
			$st_out = $check[0]->stock_keluar + $keluar;
			$this->db->where('id_subproduk', $id_sub);
			$this->db->update('rfs_stock_keluar', array('stock_keluar' => $st_out));
		}
		
		
		$where_ = array('produk_q' => $produk);
		$this->db->where($where_)->update('qual_con_tmp', array('stock_q' => $sisa_stock));

		$cek = $this->db->insert('rfs', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";
		}
		$this->db->trans_complete();
	}
	// hapus_rfs
	public function hapus_rfs($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('rfs')->row();
		$dqc = $this->db->select('stock_q')->where('produk_q',$show->produk)->get('qual_con_tmp')->row_array();
		$stk = $this->db->select('stock')->where('id_subproduk',$show->id_subproduk)->get('stock_subproduk')->row_array();
		$out = $this->db->select('stock_keluar')->where('id_subproduk',$show->id_subproduk)->get('rfs_stock_keluar')->row_array();

		$tqc = $dqc['stock_q'] + $show->jumlah;
		$tst = $stk['stock'] - $show->masuk;
		$tou = $out['stock_keluar'] - $show->keluar;

		$this->db->where('produk_q',$show->produk)->update('qual_con_tmp',['stock_q' => $tqc]);
		$this->db->where('id_subproduk',$show->id_subproduk)->update('stock_subproduk',['stock' => $tst]);
		$this->db->where('id_subproduk',$show->id_subproduk)->update('rfs_stock_keluar',['stock_keluar'=>$tou]);

		$cek = $this->db->delete('rfs', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_rfs
	public function edit_rfs($id = null)
	{
		if (!$id) {
			redirect(base_url('Marketing/rfs'));
		}else{
			$data['data'] = $this->db->get_where('rfs', array('id' => $id))->row_array();
			$this->load->view('home/layout/header');
			$this->load->view('home/marketing/edit_rfs', $data);
			$this->load->view('home/layout/footer');
		}
	}
	// update_rfs
	public function update_rfs($id)
	{
		$this->db->trans_start();
		$id_sub = $this->input->post('id_subproduk');
		$sub_produk = $this->db->get_where('sub_produk', array('id' =>$id_sub))->row_array();
		$produk = $this->input->post('produk');
		$tanggal = $this->input->post('tanggal');
		
		$stock = $this->input->post('stock');
		$hasil_qc = $this->input->post('hasil_qc');
		$packing = $this->input->post('packing');
		$kl_sbl = (int) $this->input->post('kl_sbl');
		$keluar = $this->input->post('keluar');
		$ket = $this->input->post('ket');
		// $tanggal = $this->input->post('tanggal');
		$jumlah = $packing * $sub_produk['isi'];
		$sisa_stock = $hasil_qc - $jumlah;
		$hs_sbl = (int) $this->input->post('hs_sbl');
		$sisa = ($stock + $packing) - $keluar;
		$sisa_sbl = $this->input->post('sisa_sbl');
		$data = array(
			'id_subproduk' => $id_sub,
			'stock' => $stock,
			'masuk' => $packing,
			'keluar' => $keluar,
			'sisa' => $sisa,
			'ket' => $ket,
			'sub_produk' => $sub_produk['sub_produk'],
			'kemasan' => $sub_produk['kemasan'],
			'isi' => $sub_produk['isi'],
			'stock_batang' => $hasil_qc,
			'jumlah' => $jumlah,
			'sisa_stock' => $sisa_stock,
			'author' => $_SESSION['username'],
			'tanggal' => $tanggal
		);

		$zz = $this->db->select('stock')->where('id_subproduk', $id_sub)->get('stock_subproduk')->result();
		if ($sisa_sbl > $sisa) {
			$qq = $sisa_sbl - $sisa;
			$cc = $zz[0]->stock - $qq;
			$this->db->set(array('stock' => $cc))->where('id_subproduk', $id_sub)->update('stock_subproduk');
		} else {
			$qq = $sisa - $sisa_sbl;
			$cc = $zz[0]->stock + $qq;
			$this->db->set(array('stock' => $cc))->where('id_subproduk', $id_sub)->update('stock_subproduk');
		}

		$stock_out = $this->db->select('stock_keluar')->get_where('rfs_stock_keluar',array('id_subproduk' => $id_sub))->result();
		if ($kl_sbl > $keluar) {
			$hasil = $kl_sbl - $keluar;
			$st_out = $stock_out[0]->stock_keluar - $hasil;
			$this->db->where('id_subproduk', $id_sub);
			$this->db->update('rfs_stock_keluar', array('stock_keluar' => $st_out));
		} else {
			$hasil = $keluar - $kl_sbl;
			$st_out = $stock_out[0]->stock_keluar + $hasil;
			$this->db->where('id_subproduk', $id_sub);
			$this->db->update('rfs_stock_keluar', array('stock_keluar' => $st_out));
		}
		
		
		$where_ = array('produk_q' => $produk);
		$qual = $this->db->select('stock_q')->where($where_)->get('qual_con_tmp')->result();
		if ($hs_sbl > $sisa_stock) {
			$gg = $hs_sbl - $sisa_stock;
			$ll = $qual[0]->stock_q - $gg;
			$this->db->where($where_)->update('qual_con_tmp', array('stock_q' => $ll));
		} else {
			$gg = $sisa_stock - $hs_sbl;
			$ll = $qual[0]->stock_q + $gg;
			$this->db->where($where_)->update('qual_con_tmp', array('stock_q' => $ll));
		}

		$cek = $this->db->set($data)->where('id', $id)->update('rfs');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Packing !'); window.location = '".base_url(
				'Marketing/rfs')."'</script>";
		}		
		$this->db->trans_complete();
	}

	// cari_subproduk2
	public function cari_subproduk2($id)
	{
		$output = '';
		$data=$this->db->get_where('sub_produk', array('id_produk' => $id))->result_array();
		$output .= '<div class="form-group"><select class="form-control" id="id_subproduk" name="id_subproduk">';
		foreach ($data as $key) {
			$output .= '<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].'</option>';
		}
		$output .= '</select></div>';
		echo json_encode($output);
	}
	public function c_p($id)
	{
		$output = '';
		$output .= '<option value="">--- Pilih Sub Produk ---</option>';
		$data = $this->db->get_where('sub_produk', array('id_produk' => $id))->result_array();	
		foreach ($data as $key) {
			$output .= '<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].'</option>';
		}
		echo json_encode($output);
	}

	public function search_hje($id,$user)
	{
		$output['hje'] = $this->db->select('hje')->get_where('sub_produk', array('id' => $id))->row()->hje;

		$output['stok'] = $this->db->select('stock_barang as stok')->get_where('stock_bagan',array('id_subproduk' => $id,'id_users' => $user))->row()->stok;
		echo json_encode($output);
	}

	public function pilih_user($level)
	{
		$output = '';
		$output .= '<option value="">--- Pilih User ---</option>';
		$data = $this->db->select('id,username')->where('level',$level)->get('users')->result_array();
		foreach ($data as $key) {
			$output .= '<option value="'.$key['id'].'">'.$key['username'].'</option>';
		}
		echo json_encode($output);
	}
	// filter_penjualan
	public function filter_penjualan($id)
	{
		$output = array('pesan' => '', 'data' => '');
		$data = $this->db->select('stock_keluar')->get_where('rfs_stock_keluar', array('id_subproduk' => $id));
		if ($data->num_rows() == 0) {
			$output['pesan'] .= 'salah';
			$output['data'] .= 'salah';
		}else{
			$output['pesan'] .= 'benar';
			$datas = $data->row_array();

			$output['data'] .= '

			<div class="col-lg-6">
				<div class="form-group">
					<label>Stock Awal :</label>
					<input type="number" name="stock_awal" class="form-control" value="'.$datas['stock_keluar'].'" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Stock Keluar : </label>
					<input type="text" class="form-control" name="keluar" value="" autocomplete="off">
				</div>
			</div>
			';
		}

		echo json_encode($output);
	}

	public function cari_name_user($bagan)
	{
		$output = '';
		$data = $this->db->select('username')->where('level',$bagan)->get('users');
		if ($data->num_rows() <= 0) {
				$output .= '<option value="">--- Kosong ---</option>';
		} else {
			foreach ($data->result_array() as $key) {
				$output .= '<option value="'.$key['username'].'">'.$key['username'].'</option>';
			}
		}

		echo json_encode($output);
	}

	// tambah_penjualan
	public function tambah_penjualan()
	{
		$tanggal = $this->input->post('tanggal');
		$produk = $this->input->post('produk');
		$id_subproduk = $this->input->post('id_subproduk');
		$stock = $this->input->post('stock_awal');
		$keluar = $this->input->post('keluar');
		$bagan = $this->input->post('bagan');

		$sub_produk = $this->db->get_where('sub_produk', array('id' => $id_subproduk))->row_array();

		$sisa = $stock - $keluar;
		$infoproduk = $this->db->get_where('produk', array('id' => $produk))->row_array();
		$data = array(
			'tanggal' => $tanggal,
			'produk' => $infoproduk['produk'], 
			'id_subproduk' => $id_subproduk,
			'subproduk' => $sub_produk['sub_produk'],
			'sub_kode' => $sub_produk['sub_kode'],
			'stock' => $stock,
			'keluar' => $keluar,
			'sisa' => $sisa,
			'keterangan' => $this->input->post('keterangan'),
			'bagan' => $bagan,
			'for_user' => $this->input->post('for_user'),
			'author' => $_SESSION['username'],
		);
		$this->db->set(array('stock_keluar' => $sisa))->where('id_subproduk', $id_subproduk)->update('rfs_stock_keluar');

		$name_user = $this->db->select('id')->get_where('users', array('username' => $this->input->post('for_user')))->row();

		$stock_bagan = $this->db->where(array('id_subproduk' => $id_subproduk,'id_users' => $name_user->id))->get('stock_bagan');
		if ($stock_bagan->num_rows() > 0) {
			$show = $stock_bagan->row();
			$stock_bgn_now = $show->stock_barang + $keluar;
			$this->db->where(array('id_subproduk' => $id_subproduk,'id_users' => $name_user->id))->update('stock_bagan', array('stock_barang' => $stock_bgn_now));
		} else {
			$array = array('id_subproduk' => $id_subproduk,'id_users' => $name_user->id,'stock_barang' => $keluar);
			$this->db->insert('stock_bagan', $array);
		}

		$cek = $this->db->insert('penjualan', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Produk RFS !'); window.location = '".base_url(
				'Marketing/transaksi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Produk RFS !'); window.location = '".base_url(
				'Marketing/transaksi')."'</script>";
		}
	}
	// hasil_laporan
	public function hasil_laporan()
	{
		$data['produk'] = $this->db->get('produk');
		$data['bagan'] = $this->db->get('bagan_store');

		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/hasil_laporan',$data);
		$this->load->view('home/layout/footer');
	}

	public function cari_penjualan_1()
	{
		$data['bagan'] = $this->input->post('bagan');
		$data['id_users'] = $this->input->post('user');
		$data['customer'] = $this->input->post('customer');
		$data['id_subproduk'] = $this->input->post('subproduk');
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');
		$data['bulan'] = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
		$data['setting'] = $this->db->get_where('setting', array('id' => 1))->row_array();

		$this->db->select('cerutu_terjual.jml,
						   cerutu_terjual.total,
						   penjualan_cerutu.id_penjualan_bagan,
						   penjualan_cerutu.diskon,
						   penjualan_cerutu.ongkos,
						   penjualan_cerutu.total as total_penj,
						   penjualan_cerutu.bagan,
						   penjualan_cerutu.sistem,
						   penjualan_cerutu.tanggal,
						   sub_produk.sub_produk,
						   sub_produk.sub_kode,
						   sub_produk.kemasan,
						   sub_produk.isi,
						   sub_produk.hje,
						   users.username,
						   customer.nama_customer
						   ');
		$this->db->from('cerutu_terjual');
		$this->db->join('penjualan_cerutu', 'cerutu_terjual.id_penjualan_bagan = penjualan_cerutu.id_penjualan_bagan', 'inner');
		$this->db->join('sub_produk', 'cerutu_terjual.id_subproduk = sub_produk.id', 'inner');
		$this->db->join('users', 'penjualan_cerutu.id_users = users.id', 'inner');
		$this->db->join('customer', 'penjualan_cerutu.customer = customer.id_customer', 'inner');
		$this->db->like(array('penjualan_cerutu.bagan' => $_POST['bagan'],
							  'penjualan_cerutu.id_users' => $_POST['user'],
							  'penjualan_cerutu.customer' => $_POST['customer'],
							  'cerutu_terjual.id_subproduk' => $_POST['subproduk']
							));
		$this->db->where("penjualan_cerutu.tanggal BETWEEN '$awal' AND '$akhir'");
		$data['db'] = $this->db->get();
		$this->load->view('home/marketing/laporan_penjualan', $data);
	}
	public function order()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/order');
		$this->load->view('home/layout/footer');
	}

	// add_order
	public function add_order()
	{
		$subproduk = $this->db->get_where('sub_produk', array('id' => $this->input->post('id_sub')))->row_array();
		$total = $this->input->post('jumlah') * $subproduk['hje'];
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'subproduk' => $subproduk['sub_produk'], 
			'id_subproduk' => $subproduk['id'], 
			'sub_kode' => $subproduk['sub_kode'],
			'kemasan' => $subproduk['kemasan'],
			'isi' => $subproduk['isi'],
			'hje' => $subproduk['hje'],
			'total' => $total,
			'produk' => $this->input->post('produk'),
			'jumlah' => $this->input->post('jumlah'),
			'ket' => $this->input->post('ket'),
			'bagan' => $this->input->post('bagan'),
			'author' => $_SESSION['username'],
		);
		$cek = $this->db->insert('order', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Melakukan Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";	
		}else{
			echo "<script>alert('Gagal Melakukan Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";
		}
	}
	// notif_accept_order
	public function notif_accept_order($id)
	{	
		$this->db->set(array('status' => 1))->where('id', $id)->update('order');
		redirect(base_url('Marketing/lihat_order/'.$id));
	}
	// lihat_order
	public function lihat_order($id)
	{
		$data['data'] = $this->db->get_where('order', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/lihat_order', $data);
		$this->load->view('home/layout/footer');
	}
	// accept_order
	public function accept_order($id)
	{
		$data = $this->db->get_where('order', array('id' => $id))->row_array();
		$stock=$this->db->get_where('stock_subproduk', array('id_subproduk' => $data['id_subproduk']))->row_array();
		$produk = $this->db->select('produk')->where('id',$data['produk'])->get('Table')->row();

		$persen = ($data['total'] /100) * $this->input->post('diskon');
		$sisa = $stock['stock'] - $data['jumlah'];

		$datas = array(
			'produk' => $produk['produk'],
			'id_subproduk' => $data['id_subproduk'], 
			'subproduk' => $data['subproduk'],
			'sub_kode' => $data['sub_kode'],
			'stock' => $stock['stock'],
			'keluar' => $data['jumlah'],
			'sisa' => $sisa,
			'bagan' => $data['bagan'],
			'for_user' => $data['author'],
			'tanggal' => $data['tanggal'],
			'author' => $_SESSION['username']
		);

		$this->db->set(array('stock' => $sisa))->where('id_subproduk', $data['id_subproduk'])->update('stock_subproduk');

		$id_usr = $this->db->select('id')->where('username',$data['author'])->get('users')->row_array();

		$cari = $this->db->where(array('id_subproduk' => $data['id_subproduk'],'id_users' => $id_usr['id']))->get('stock_bagan');

		if ($cari->num_rows() > 0) {
			$stk_bgn = $cari->row();
			$update_stok = $stk_bgn->stock_barang + $data['jumlah'];

			$this->db->where(array('id_subproduk' => $data['id_subproduk'],'id_users' => $id_usr['id']))->update('stock_bagan', array('stock_barang' => $update_stok));
		} else {
			$ins = array('id_subproduk' => $data['id_subproduk'],'id_users' => $id_usr['id'],'stock_barang' => $data['jumlah']);
			$this->db->insert('stock_bagan', $ins);
		}
		
		
		$cek = $this->db->insert('penjualan',$datas);

		if ($cek) {
			echo "<script>alert('Berhasil Melakukan Transaksi Penjualan !'); window.location = '".base_url(
				'Marketing/transaksi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Melakukan Transaksi Penjualan !'); window.location = '".base_url(
				'Marketing/transaksi')."'</script>";
		}
	}
	// edit_order
	public function edit_order($id)
	{
		$data['data'] = $this->db->get_where('order', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/marketing/edit_order', $data);
		$this->load->view('home/layout/footer');
	}
	// update_order
	public function update_order($id)
	{
		$subproduk = $this->db->get_where('sub_produk', array('id' => $this->input->post('id_sub')))->row_array();
		$total = $this->input->post('jumlah') * $subproduk['hje'];
		$data = array(
			'tanggal' => $this->input->post('tanggal'),
			'subproduk' => $subproduk['sub_produk'], 
			'id_subproduk' => $subproduk['id'], 
			'sub_kode' => $subproduk['sub_kode'],
			'kemasan' => $subproduk['kemasan'],
			'isi' => $subproduk['isi'],
			'hje' => $subproduk['hje'],
			'total' => $total,
			'produk' => $this->input->post('produk'),
			'jumlah' => $this->input->post('jumlah'),
			'ket' => $this->input->post('ket'),
			'bagan' => $this->input->post('bagan'),
			'author' => $_SESSION['username'],
		);
		$this->db->set($data)->where('id', $id);
		$cek = $this->db->update('order');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";
		}
	}
	public function del_order($id)
	{
		$cek = $this->db->delete('order', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Order !'); window.location = '".base_url(
				'Marketing/order')."'</script>";
		}

	}
}	