<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proses_produksi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cari_sub($id = null)
	{
		if (!$id) {
			echo "ID Kosong";
		}else{

			$output = '';
			$data = $this->db->get_where('sub_produk', array('id_produk' => $id))->result_array();

			$output .= '<select id="id_sub" class="form-control">';
			foreach ($data as $key) {
				
				$output .= '
				<option value="'.$key['id'].'">'.$key['sub_produk'].' | '.$key['sub_kode'].' | '.$key['isi'].' | '.$key['kemasan'].'</option>
				';
			}
			$output .= '</select>';

			echo json_encode($output);
		}
	}

	// filling
	public function filling()
	{	
		$data['fill'] = $this->db->order_by('id', 'desc')->get('filling')->result_array();
		// $data['data'] = $this->db->order_by('id', 'DESC')->like('tanggal', date('Y-m'))->get_where('data_stock', array('kategori' => 'Filling'));
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/filling', $data);
		$this->load->view('home/layout/footer');
	}
	// add_filling
	public function add_filling()
	{
		$this->db->trans_start();
		$produk = $this->input->post('produk');
		$jenis = $this->input->post('jenis');
		$hasil = $this->input->post('hasil');
		$sisa = $this->input->post('stock') - $this->input->post('terpakai');
		$data = array(
			'produk' => $produk, 
			'jenis' => $jenis,
			'stock' => $this->input->post('stock'),
			'terpakai' => $this->input->post('terpakai'),
			'sisa' => $sisa,
			'hasil' => $hasil,
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$up_stk = array('produksi_pr' => $sisa);
		$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'FILLER 1'))->update('data_produksi', $up_stk);

		$cek1 = $this->db->get_where('filling_tmp', array('produk_fill' => $produk, 'jenis_fill' => $jenis));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_fill' => $produk,'jenis_fill' => $jenis,'hasil_today' => $hasil);
			$this->db->insert('filling_tmp', $object);
		} else {
			$lp = $cek1->result();
			$hs_td = $lp[0]->hasil_today + $hasil;
			$where = array('produk_fill' => $produk, 'jenis_fill' => $jenis);
			$this->db->where($where)->update('filling_tmp', array('hasil_today' => $hs_td));
		}

		$cek = $this->db->insert('filling', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_filling
	public function edit_filling($id)
	{
		$data['datas'] = $this->db->get_where('filling', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_filling', $data);
		$this->load->view('home/layout/footer');
	}
	// update_filling
	public function update_filling($id)
	{
		$this->db->trans_start();
		$produk = $this->input->post('produk');
		$jenis = $this->input->post('jenis');
		$terpakai = $this->input->post('terpakai');
		$tpk = $this->input->post('tpk');
		$hs_cr = (int) ($this->input->post('hs_cr'));
		$hasil = $this->input->post('hasil');
		$sisa = $this->input->post('stock') - $this->input->post('terpakai');
		$data = array(
			'produk' => $produk, 
			'jenis' => $jenis,
			'stock' => $this->input->post('stock'),
			'terpakai' => $terpakai,
			'sisa' => $sisa,
			'hasil' => $hasil,
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$aa = $this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'FILLER 1'))->get('data_produksi');
		if ($terpakai > $tpk) {
			$ll = $terpakai - $tpk;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr - $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'FILLER 1'))->update('data_produksi', $up_stk);
		} else {
			$ll = $tpk - $terpakai;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr + $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'FILLER 1'))->update('data_produksi', $up_stk);
		}
		
		$cek1 = $this->db->get_where('filling_tmp', array('produk_fill' => $produk, 'jenis_fill' => $jenis))->result();
		if ($hasil > $hs_cr) {
			$ll = $hasil - $hs_cr;
			$pp = $cek1[0]->hasil_today + $ll;
			$ob = array('hasil_today' => $pp);

			$this->db->where(array('produk_fill' => $produk, 'jenis_fill' => $jenis));
			$this->db->update('filling_tmp', $ob);
		} else {
			$ll = $hs_cr - $hasil;
			$pp = $cek1[0]->hasil_today - $ll;
			$ob = array('hasil_today' => $pp);

			$this->db->where(array('produk_fill' => $produk, 'jenis_fill' => $jenis));
			$this->db->update('filling_tmp', $ob);
		}

		$this->db->set($data); $this->db->where('id', $id);
		$cek=$this->db->update('filling');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_filling
	public function del_filling($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('filling')->row();
		$dtpro = $this->db->select('hasil_today')->where(['produk_fill' => $show->produk,'jenis_fill' => $show->jenis])->get('filling_tmp')->row();
		$fillpro = $this->db->select('produksi_pr')->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'FILLER 1'])->get('data_produksi')->row();

		$fill = $dtpro->hasil_today - $show->hasil;
		$dt = $fillpro->produksi_pr + $show->terpakai;

		$this->db->where(['produk_fill' => $show->produk,'jenis_fill' => $show->jenis])->update('filling_tmp',['hasil_today' => $fill]);
		$this->db->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'FILLER 1'])->update('data_produksi', ['produksi_pr' => $dt]);

		$cek=$this->db->delete('filling', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Filling'); window.location = '".base_url(
				'Proses_produksi/filling')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_filling
	public function print_filling()
	{
		$this->load->view('home/proses/print_filling');
	}
	// cari_filling
	public function cari_filling()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';

			$datas = $like->from('filling')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tanggal'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->where('produk', $_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';

			$datas = $like->from('filling')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tanggal'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}

	}
	// total_filling
	public function total_filling()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		$output = array('stock' => '', 'terpakai' => '', 'sisa' => '', 'hasil' =>'');
		if ($_POST['produk'] == '') {

			$output['stock'] = $this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('filling')->row()->stock;
			$output['terpakai'] = $this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('filling')->row()->terpakai;
			$output['sisa'] = $this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa) as sisa')->get('filling')->row()->sisa;
			$output['hasil'] = $this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('filling')->row()->hasil;
			echo json_encode($output);
		}else{
			$output['stock'] = $this->db->where('produk', $_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('filling')->row()->stock;
			$output['terpakai'] = $this->db->where('produk', $_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('filling')->row()->terpakai;
			$output['sisa'] = $this->db->where('produk', $_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa) as sisa')->get('filling')->row()->sisa;
			$output['hasil'] = $this->db->where('produk', $_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('filling')->row()->hasil;
			echo json_encode($output);
		}
	}
	public function drw_tk()
	{
		$output = $this->db->where(array('jenis_pr' => $_POST['jenis'], 'kategori_pr' => 'FILLER 1'))->select('produksi_pr')->get('data_produksi')->row_array();
		if ($output['produksi_pr'] == null) {
			$cs = 0;
		} else {
			$cs = $output['produksi_pr'];
		}
		echo json_encode($cs);
	}
	// binding
	public function binding()
	{	
		$data['hah'] = $this->db->query("SELECT * FROM `binding` ORDER BY id DESC");
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/binding', $data);
		$this->load->view('home/layout/footer');
	}
	// add_binding
	public function add_binding()
	{	
		$this->db->trans_start();
		error_reporting(0);
		$sisa = $this->input->post('stock') - $this->input->post('terpakai');
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'stock' => $this->input->post('stock'),
			'terpakai' => $this->input->post('terpakai'), 
			'sisa_stock' => $sisa,
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$up_stk = array('produksi_pr' => $sisa);
		$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Omblad'))->update('data_produksi', $up_stk);

		$fill = $this->db->where(array('produk_fill' => $_POST['produk'],'jenis_fill' => $_POST['jenis']))->get('filling_tmp')->result();
		$cek1 = $this->db->get_where('binding_tmp', array('produk_bind' => $_POST['produk'], 'jenis_bind' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_bind' => $_POST['produk'],'jenis_bind' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('binding_tmp', $object);

			$where1 = array('produk_fill' => $_POST['produk'],'jenis_fill' => $_POST['jenis']);
			$this->db->where($where1)->update('filling_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_bind' => $_POST['produk'], 'jenis_bind' => $_POST['jenis']);
			$this->db->where($where)->update('binding_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_fill' => $_POST['produk'],'jenis_fill' => $_POST['jenis']);
			$this->db->where($where1)->update('filling_tmp', array('hasil_today' => $hasil));
		}

		$cek = $this->db->insert('binding', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Binding'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Binding'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_biding
	public function del_binding($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('binding')->row();
		$bind = $this->db->select('produksi_pr')->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'OMBLAD'])->get('data_produksi')->row();
		$dtpro = $this->db->select('hasil_today')->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->get('binding_tmp')->row();
		$dfpro = $this->db->select('hasil_today')->where(['produk_fill' => $show->produk,'jenis_fill' => $show->jenis])->get('filling_tmp')->row();

		$tbin = $bind->produksi_pr + $show->terpakai;
		$tpr = $dtpro->hasil_today - $show->tambah_cerutu;
		$fpr = $dfpro->hasil_today + $show->tambah_cerutu;

		$this->db->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'OMBLAD'])->update('data_produksi',['produksi_pr' => $tbin]);
		$this->db->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->update('binding_tmp',['hasil_today' => $tpr]);
		$this->db->where(['produk_fill' => $show->produk,'jenis_fill' => $show->jenis])->update('filling_tmp',['hasil_today' => $fpr]);

		$cek = $this->db->delete('binding', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Binding !'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Binding !'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_binding
	public function edit_binding($id = null)
	{
		$data['datas'] = $this->db->get_where('binding', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_binding', $data);
		$this->load->view('home/layout/footer');
	}
	// update_binding
	public function update_binding($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$jenis = $this->input->post('jenis');
		$produk = $this->input->post('produk');
		$tpk = $this->input->post('tpk');
		$terpakai = $this->input->post('terpakai');
		$sisa = $this->input->post('stock') - $terpakai;
		$ad_sb = (int) $this->input->post('ad_sb');
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'stock' => $this->input->post('stock'),
			'terpakai' => $terpakai, 
			'sisa_stock' => $sisa,
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $tambah_cerutu,
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$aa = $this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Omblad'))->get('data_produksi');
		if ($terpakai > $tpk) {
			$ll = $terpakai - $tpk;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr - $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Omblad'))->update('data_produksi', $up_stk);
		} else {
			$ll = $tpk - $terpakai;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr + $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Omblad'))->update('data_produksi', $up_stk);
		}

		$fill = $this->db->where(array('produk_fill' => $_POST['produk'],'jenis_fill' => $_POST['jenis']))->get('filling_tmp')->result();
		$cek1 = $this->db->get_where('binding_tmp', array('produk_bind' => $produk, 'jenis_bind' => $jenis))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mut_ = $cek1[0]->hasil_today + $mut;
			$mt_f = $fill[0]->hasil_today - $mut;

			$where = array('produk_fill' => $produk,'jenis_fill' => $jenis);
			$this->db->where($where)->update('filling_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_bind' => $produk, 'jenis_bind' => $jenis);
			$this->db->where($where1)->update('binding_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $fill[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_fill' => $produk,'jenis_fill' => $jenis);
			$this->db->where($where)->update('filling_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_bind' => $produk, 'jenis_bind' => $jenis);
			$this->db->where($where1)->update('binding_tmp', array('hasil_today' => $mut_));
		}
		

		$this->db->set($data)->where('id', $id)->update('binding');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Binding'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Binding'); window.location = '".base_url(
				'Proses_produksi/binding')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_binding
	public function print_binding()
	{
		$this->load->view('home/proses/print_binding');
	}
	// cari_binding
	public function cari_binding()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('binding')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa_stock'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('binding')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa_stock'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_binding
	public function total_binding()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('stock' => '', 'terpakai' => '', 'sisa_stock' => '', 'hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['stock']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('binding')->row()->stock;
			$output['terpakai']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('binding')->row()->terpakai;
			$output['sisa_stock']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa_stock) as sisa_stock')->get('binding')->row()->sisa_stock;
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('binding')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('binding')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('binding')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			$output['stock']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('binding')->row()->stock;
			$output['terpakai']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('binding')->row()->terpakai;
			$output['sisa_stock']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa_stock) as sisa_stock')->get('binding')->row()->sisa_stock;
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('binding')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('binding')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('binding')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat binding
	public function drw_bn()
	{
		$car = $this->db->select('produksi_pr')->where(array('jenis_pr' => $_POST['jenis'], 'kategori_pr' => 'Omblad'))->get('data_produksi')->row_array();

		$cam = $this->db->select('hasil_today')->where(array('jenis_fill' => $_POST['jenis'],'produk_fill' => $_POST['merek']))->get('filling_tmp')->row_array();
		if ($car['produksi_pr'] == null) { $sr['stockjen'] = 0; } else { $sr['stockjen'] = $car['produksi_pr']; }
		if ($cam['hasil_today'] == null) { $sr['jmlcer'] = 0; } else { $sr['jmlcer'] = $cam['hasil_today']; }
		echo json_encode($sr);
	}
	// pressing
	public function pressing()
	{
		$data['pressing'] = $this->db->order_by('id','DESC')->get('pressing')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/pressing',$data);
		$this->load->view('home/layout/footer');
	}
	// add_pressing
	public function add_pressing()
	{
		$this->db->trans_start();
		error_reporting(0);
		$produk = $this->input->post('produk');
		$jenis = $this->input->post('jenis');
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $produk,
			'jenis' => $jenis,
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $tambah_cerutu,
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);
		$where = array('produk_pres' => $produk,'jenis_pres' => $jenis);
		$cek = $this->db->where($where)->get('pressing_tmp');
		if ($cek->num_rows() == 0) {
			$object = array('produk_pres' => $produk,'jenis_pres' => $jenis,'hasil_today' => $tambah_cerutu);
			$this->db->insert('pressing_tmp', $object);

			$where1 = array('produk_bind' => $produk,'jenis_bind' => $jenis);
			$this->db->where($where1)->update('binding_tmp', array('hasil_today' => $hasil));
		} else {
			$hs = $cek->result();
			$td = $hs[0]->hasil_today + $tambah_cerutu;
			$where_ = array('produk_pres' => $produk,'jenis_pres' => $jenis);
			$this->db->where($where_)->update('pressing_tmp', array('hasil_today' => $td));

			$where1 = array('produk_bind' => $produk,'jenis_bind' => $jenis);
			$this->db->where($where1)->update('binding_tmp', array('hasil_today' => $hasil));
		}
		
		$cek = $this->db->insert('pressing', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_pressing
	public function edit_pressing($id = null)
	{
		$data['datas'] = $this->db->get_where('pressing', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_pressing', $data);
		$this->load->view('home/layout/footer');
	}
	// update_pressing
	public function update_pressing($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$produk = $this->input->post('produk');
		$jenis = $this->input->post('jenis');
		$ad_td = (int) ($this->input->post('ad_td'));
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $produk,
			'jenis' => $jenis,
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);
		$where = array('produk_pres' => $produk,'jenis_pres' => $jenis);
		$where_ = array('produk_bind' => $produk,'jenis_bind' => $jenis);

		$pre = $this->db->where($where)->get('pressing_tmp')->result();
		$bin = $this->db->where($where_)->get('binding_tmp')->result();
		if ($tambah_cerutu > $ad_td) {
			$mut = $tambah_cerutu - $ad_td;
			$add = $bin[0]->hasil_today - $mut;
			$up = $pre[0]->hasil_today + $mut;

			$this->db->where($where)->update('pressing_tmp', array('hasil_today' => $up));
			$this->db->where($where_)->update('binding_tmp', array('hasil_today' => $add));
		} else {
			$mut = $ad_td - $tambah_cerutu;
			$add = $bin[0]->hasil_today + $mut;
			$up = $pre[0]->hasil_today - $mut;

			$this->db->where($where)->update('pressing_tmp', array('hasil_today' => $up));
			$this->db->where($where_)->update('binding_tmp', array('hasil_today' => $add));
		}
		

		$this->db->set($data)->where('id',$id)->update('pressing');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_pressing
	public function del_pressing($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('pressing')->row();
		$dpres = $this->db->select('hasil_today')->where(['produk_pres' => $show->produk,'jenis_pres' => $show->jenis])->get('pressing_tmp')->row();
		$dbind = $this->db->select('hasil_today')->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->get('binding_tmp')->row();

		$tpres = $dpres->hasil_today - $show->tambah_cerutu;
		$tbind = $dbind->hasil_today + $show->tambah_cerutu;

		$this->db->where(['produk_pres' => $show->produk,'jenis_pres' => $show->jenis])->update('pressing_tmp',['hasil_today' => $tpres]);
		$this->db->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->update('binding_tmp',['hasil_today' => $tbind]);

		$cek = $this->db->delete('pressing', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Pressing'); window.location = '".base_url(
				'Proses_produksi/pressing')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_pressing
	public function print_pressing()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get('pressing')->result_array();
		$this->load->view('home/proses/print_pressing',$data);
	}
	// cari_pressing
	public function cari_pressing()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('pressing')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('pressing')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_pressing
	public function total_pressing()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('pressing')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('pressing')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('pressing')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('pressing')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('pressing')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('pressing')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown tingkat pressing
	public function drw_prs()
	{
		$output = $this->db->select('hasil_today')->where(array('jenis_bind' => $_POST['jenis'], 'produk_bind' => $_POST['merek']))->get('binding_tmp')->row_array();
		if ($output['hasil_today'] == null) { $out['dud'] = 0; } else { $out['dud'] = $output['hasil_today']; }
		echo json_encode($out);
	}
	// wrapping
	public function wrapping()
	{	
		$data['wrap']=$this->db->order_by('id', 'DESC')->get('wrapping')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/wrapping', $data);
		$this->load->view('home/layout/footer');
	}
	// add_wrapping
	public function add_wrapping()
	{	
		$this->db->trans_start();
		error_reporting(0);
		$sisa = $this->input->post('stock') - $this->input->post('terpakai');
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'stock' => $this->input->post('stock'),
			'terpakai' => $this->input->post('terpakai'), 
			'sisa' => $sisa,
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$up_stk = array('produksi_pr' => $sisa);
		$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Dekblad'))->update('data_produksi', $up_stk);

		$cek1 = $this->db->get_where('wrapping_tmp', array('produk_wrap' => $_POST['produk'], 'jenis_wrap' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('wrapping_tmp', $object);

			$where1 = array('produk_pres' => $_POST['produk'],'jenis_pres' => $_POST['jenis']);
			$this->db->where($where1)->update('pressing_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_wrap' => $_POST['produk'], 'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where)->update('wrapping_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_pres' => $_POST['produk'],'jenis_pres' => $_POST['jenis']);
			$this->db->where($where1)->update('pressing_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('wrapping', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Wrapping'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Wrapping'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";
		}
		$this->db->trans_complete();
	}

	// del_biding
	public function del_wrapping($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('wrapping')->row();
		$tmb = $this->db->select('produksi_pr')->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'Dekblad'])->get('data_produksi')->row_array();
		$dpres = $this->db->select('hasil_today')->where(['produk_pres' => $show->produk,'jenis_pres' => $show->jenis])->get('pressing_tmp')->row_array();
		$dwrap = $this->db->select('hasil_today')->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->get('wrapping_tmp')->row_array();

		$tbmn = $tmb['produksi_pr'] + $show->terpakai;
		$tpres = $dpres['hasil_today'] + $show->tambah_cerutu;
		$twrap = $dwrap['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['jenis_pr' => $show->jenis,'kategori_pr' => 'Dekblad'])->update('data_produksi',['produksi_pr' => $tbmn]);
		$this->db->where(['produk_pres' => $show->produk,'jenis_pres' => $show->jenis])->update('pressing_tmp',['hasil_today' => $tpres]);
		$this->db->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->update('wrapping_tmp',['hasil_today' => $twrap]);

		$cek = $this->db->delete('wrapping', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus wrapping !'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus wrapping !'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_wrapping
	public function edit_wrapping($id = null)
	{
		$data['datas'] = $this->db->get_where('wrapping', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_wrapping', $data);
		$this->load->view('home/layout/footer');
	}
	// update_wrapping
	public function update_wrapping($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$tpk = $this->input->post('tpk');
		$terpakai = $this->input->post('terpakai');
		$ad_sb = (int) ($this->input->post('ad_sb'));
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$sisa = $this->input->post('stock') - $terpakai;
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'stock' => $this->input->post('stock'),
			'terpakai' => $terpakai, 
			'sisa' => $sisa,
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$aa = $this->db->where(array('jenis_pr' => $_POST['jenis'],'kategori_pr' => 'Dekblad'))->get('data_produksi');
		if ($terpakai > $tpk) {
			$ll = $terpakai - $tpk;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr - $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Dekblad'))->update('data_produksi', $up_stk);
		} else {
			$ll = $tpk - $terpakai;
			$ss = $aa->result();
			$co = $ss[0]->produksi_pr + $ll;
			$up_stk = array('produksi_pr' => $co);
			$this->db->where(array('jenis_pr' => $this->input->post('jenis'), 'kategori_pr' => 'Dekblad'))->update('data_produksi', $up_stk);
		}

		$pre = $this->db->where(array('produk_pres' => $_POST['produk'],'jenis_pres' => $_POST['jenis']))->get('pressing_tmp')->result();
		$cek1 = $this->db->get_where('wrapping_tmp', array('produk_wrap' => $_POST['produk'], 'jenis_wrap' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $pre[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_pres' => $_POST['produk'],'jenis_pres' => $_POST['jenis']);
			$this->db->where($where)->update('pressing_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_wrap' => $_POST['produk'], 'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where1)->update('wrapping_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $pre[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_pres' => $_POST['produk'],'jenis_pres' => $_POST['jenis']);
			$this->db->where($where)->update('pressing_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_wrap' => $_POST['produk'], 'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where1)->update('wrapping_tmp', array('hasil_today' => $mut_));
		}

		$this->db->set($data)->where('id', $id)->update('wrapping');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate wrapping'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate wrapping'); window.location = '".base_url(
				'Proses_produksi/wrapping')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_wrapping
	public function print_wrapping()
	{
		$this->load->view('home/proses/print_wrapping');
	}
	// cari_wrapping
	public function cari_wrapping()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('wrapping')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('wrapping')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['stock'].'</td>
				<td>'.$key['terpakai'].'</td>
				<td>'.$key['sisa'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_wrapping
	public function total_wrapping()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('stock' => '', 'terpakai' => '', 'sisa_stock' => '', 'hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['stock']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('wrapping')->row()->stock;
			$output['terpakai']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('wrapping')->row()->terpakai;
			$output['sisa_stock']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa) as sisa_stock')->get('wrapping')->row()->sisa_stock;
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('wrapping')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('wrapping')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('wrapping')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			$output['stock']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(stock) as stock')->get('wrapping')->row()->stock;
			$output['terpakai']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(terpakai) as terpakai')->get('wrapping')->row()->terpakai;
			$output['sisa_stock']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(sisa) as sisa_stock')->get('wrapping')->row()->sisa_stock;
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('wrapping')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('wrapping')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('wrapping')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat wrapping
	public function drw_wr()
	{
		$car = $this->db->select('produksi_pr')->where(array('jenis_pr' => $_POST['jenis'], 'kategori_pr' => 'Dekblad'))->get('data_produksi')->row_array();
		$cam = $this->db->select('hasil_today')->where(array('produk_pres' => $_POST['merek'], 'jenis_pres' => $_POST['jenis']))->get('pressing_tmp')->row_array();
		$output['produksi_pr'] = ( $car['produksi_pr'] == null ? 0 : $car['produksi_pr']);
		$output['hasil_akhir'] = ( $cam['hasil_today'] == null ? 0 : $cam['hasil_today']);
		echo json_encode($output);
	}
	// drying
	public function drying()
	{	
		$data['Drying']=$this->db->order_by('id','DESC')->get('drying')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/drying',$data);
		$this->load->view('home/layout/footer');
	}
	// add_Drying
	public function add_drying()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('drying_tmp', array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_dry' => $_POST['produk'],'jenis_dry' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('drying_tmp', $object);

			$where1 = array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where1)->update('wrapping_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_dry' => $_POST['produk'],'jenis_dry' => $_POST['jenis']);
			$this->db->where($where)->update('drying_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where1)->update('wrapping_tmp', array('hasil_today' => $hasil));
		}

		$cek = $this->db->insert('drying', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Drying
	public function edit_drying($id = null)
	{
		$data['datas'] = $this->db->get_where('drying', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_drying', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Drying
	public function update_drying($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = (int) $this->input->post('ad_sb');
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'hasil_akhir' => $hasil,
			'lama' => $this->input->post('lama'),
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		$wrap = $this->db->where(array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']))->get('wrapping_tmp')->result();
		$cek1 = $this->db->get_where('drying_tmp', array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $wrap[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where)->update('wrapping_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']);
			$this->db->where($where1)->update('drying_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $wrap[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']);
			$this->db->where($where)->update('wrapping_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']);
			$this->db->where($where1)->update('drying_tmp', array('hasil_today' => $mut_));
		}

		$cek = $this->db->set($data)->where('id',$id)->update('drying');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Drying
	public function del_drying($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('drying')->row();
		$dwr = $this->db->select('hasil_today')->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->get('wrapping_tmp')->row_array();
		$ddr = $this->db->select('hasil_today')->where(['produk_dry' => $show->produk,'jenis_dry' => $show->jenis])->get('drying_tmp')->row_array();

		$twr = $dwr['hasil_today'] + $show->tambah_cerutu;
		$tdr = $ddr['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->update('wrapping_tmp',['hasil_today' => $twr]);
		$this->db->where(['produk_dry' => $show->produk,'jenis_dry' => $show->jenis])->update('drying_tmp',['hasil_today' => $tdr]);

		$cek = $this->db->delete('drying', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Drying'); window.location = '".base_url(
				'Proses_produksi/drying')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_Drying
	public function print_drying()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get_where('drying')->result_array();
		$this->load->view('home/proses/print_drying',$data);
	}
	// cari_Drying
	public function cari_drying()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Drying
	public function total_drying()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat drying
	public function drw_d1()
	{
		$caro = $this->db->select('hasil_today')->where(array('produk_wrap' => $_POST['merek'], 'jenis_wrap' => $_POST['jenis']))->get('wrapping_tmp')->row_array();
		$output['dud'] = ( $caro['hasil_today'] == null ? 0 : $caro['hasil_today']);
		echo json_encode($output);
	}
	// fumigasi
	public function fumigasi()
	{
		$data['Fumigasi'] = $this->db->order_by('id','DESC')->get('fumigasi')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/fumigasi',$data);
		$this->load->view('home/layout/footer');
	}
	// add_Fumigasi
	public function add_fumigasi()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('fumigasi_tmp', array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('fumigasi_tmp', $object);

			$where1 = array('produk_dry2' => $_POST['produk'],'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where1)->update('drying2_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where)->update('fumigasi_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_dry2' => $_POST['produk'],'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where1)->update('drying2_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('fumigasi', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Fumigasi
	public function edit_fumigasi($id = null)
	{
		$data['datas'] = $this->db->get_where('fumigasi', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_Fumigasi', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Fumigasi
	public function update_fumigasi($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = (int) ($this->input->post('ad_sb'));
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$dry = $this->db->where(array('produk_dry2' => $_POST['produk'],'jenis_dry2' => $_POST['jenis']))->get('drying2_tmp')->result();
		$cek1 = $this->db->get_where('fumigasi_tmp', array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $dry[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where)->update('drying2_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where1)->update('fumigasi_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $dry[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where)->update('drying2_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where1)->update('fumigasi_tmp', array('hasil_today' => $mut_));
		}

		$this->db->set($data)->where('id',$id)->update('fumigasi');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Fumigasi
	public function del_fumigasi($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('fumigasi')->row();
		$ddr2 = $this->db->select('hasil_today')->where(['produk_dry2' => $show->produk,'jenis_dry2' => $show->jenis])->get('drying2_tmp')->row_array();
		$dfm = $this->db->select('hasil_today')->where(['produk_fumi' => $show->produk,'jenis_fumi' => $show->jenis])->get('fumigasi_tmp')->row_array();

		$tdr2 = $ddr2['hasil_today'] + $show->tambah_cerutu;
		$tfm = $dfm['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_dry2' => $show->produk,'jenis_dry2' => $show->jenis])->update('drying2_tmp',['hasil_today' => $tdr2]);
		$this->db->where(['produk_fumi' => $show->produk,'jenis_fumi' => $show->jenis])->update('fumigasi_tmp',['hasil_today' => $tfm]);

		$cek = $this->db->delete('fumigasi', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Fumigasi'); window.location = '".base_url(
				'Proses_produksi/fumigasi')."'</script>";
		}
		$this->db->trans_complete();
	}
	// cari_Fumigasi
	public function cari_fumigasi()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('fumigasi')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('fumigasi')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Fumigasi
	public function total_fumigasi()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('fumigasi')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('fumigasi')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('fumigasi')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('fumigasi')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('fumigasi')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('fumigasi')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat fumigasi
	public function drw_fm()
	{
		$care = $this->db->select('hasil_today')->where(array('jenis_dry2' => $_POST['jenis'], 'produk_dry2' => $_POST['merek']))->get('drying2_tmp')->row_array();
		$output['dud'] = ($care['hasil_today'] == null ? 0 : $care['hasil_today']);
		echo json_encode($output);
	}
	// frezer
	public function frezer()
	{	
		$data['Frezer'] = $this->db->order_by('id','DESC')->get('frezer')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/frezer',$data);
		$this->load->view('home/layout/footer');
	}
	// add_Frezer
	public function add_frezer()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('frezer_tmp', array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('frezer_tmp', $object);

			$where1 = array('produk_dry' => $_POST['produk'],'jenis_dry' => $_POST['jenis']);
			$this->db->where($where1)->update('drying_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where)->update('frezer_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']);
			$this->db->where($where1)->update('drying_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('frezer', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Frezer
	public function edit_frezer($id = null)
	{
		$data['datas'] = $this->db->get_where('frezer', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_frezer', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Frezer
	public function update_frezer($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = (int) ($this->input->post('ad_sb'));
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$fumi = $this->db->where(array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']))->get('drying_tmp')->result();
		$cek1 = $this->db->get_where('frezer_tmp', array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $fumi[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']);
			$this->db->where($where)->update('drying_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where1)->update('frezer_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $fumi[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_dry' => $_POST['produk'], 'jenis_dry' => $_POST['jenis']);
			$this->db->where($where)->update('drying_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where1)->update('frezer_tmp', array('hasil_today' => $mut_));
		}

		$this->db->set($data)->where('id',$id)->update('frezer');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Frezer
	public function del_frezer($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('frezer')->row();
		$ddr = $this->db->select('hasil_today')->where(['produk_dry' => $show->produk,'jenis_dry' => $show->jenis])->get('drying_tmp')->row_array();
		$dfr = $this->db->select('hasil_today')->where(['produk_frez' => $show->produk,'jenis_frez' => $show->jenis])->get('frezer_tmp')->row_array();

		$tdr = $ddr['hasil_today'] + $show->tambah_cerutu;
		$tfr = $dfr['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_dry' => $show->produk,'jenis_dry' => $show->jenis])->update('drying_tmp',['hasil_today' => $tdr]);
		$this->db->where(['produk_frez' => $show->produk,'jenis_frez' => $show->jenis])->update('frezer_tmp',['hasil_today' => $tfr]);

		$cek = $this->db->delete('frezer', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Frezer'); window.location = '".base_url(
				'Proses_produksi/frezer')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_Frezer
	public function print_frezer()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get('frezer')->result_array();
		$this->load->view('home/proses/print_frezer',$data);
	}
	// cari_Frezer
	public function cari_frezer()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('frezer')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('frezer')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Frezer
	public function total_frezer()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('frezer')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('frezer')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('frezer')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('frezer')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('frezer')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('frezer')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown tingkat frezer
	public function drw_fr()
	{
		$output = $this->db->select('hasil_today')->where(array('jenis_dry' => $_POST['jenis'], 'produk_dry' => $_POST['merek']))->get('drying_tmp')->row_array();
		$care['dud'] = ($output['hasil_today'] == null ? 0 : $output['hasil_today']);
		echo json_encode($care);	
	}
	// drying2
	public function drying2()
	{ 
		$data['Drying2'] = $this->db->order_by('id','DESC')->get('drying2')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/drying2',$data);
		$this->load->view('home/layout/footer');
	}
  // add_Drying2
	public function add_drying2()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('drying2_tmp', array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('drying2_tmp', $object);

			$where1 = array('produk_frez' => $_POST['produk'],'jenis_frez' => $_POST['jenis']);
			$this->db->where($where1)->update('frezer_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where)->update('drying2_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where1)->update('frezer_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('drying2', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Drying2
	public function edit_drying2($id = null)
	{
		$data['datas'] = $this->db->get_where('drying2', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_drying2', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Drying2
	public function update_drying2($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = (int) ($this->input->post('ad_sb'));
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$frez = $this->db->where(array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']))->get('frezer_tmp')->result();
		$cek1 = $this->db->get_where('drying2_tmp', array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $frez[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where)->update('frezer_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where1)->update('drying2_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $frez[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_frez' => $_POST['produk'], 'jenis_frez' => $_POST['jenis']);
			$this->db->where($where)->update('frezer_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry2' => $_POST['produk'], 'jenis_dry2' => $_POST['jenis']);
			$this->db->where($where1)->update('drying2_tmp', array('hasil_today' => $mut_));
		}		

		$this->db->set($data)->where('id',$id)->update('drying2');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Drying2
	public function del_drying2($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('drying2')->row();
		$dfr = $this->db->select('hasil_today')->where(['produk_frez' => $show->produk,'jenis_frez' => $show->jenis])->get('frezer_tmp')->row_array();
		$ddr2 = $this->db->select('hasil_today')->where(['produk_dry2' => $show->produk,'jenis_dry2' => $show->jenis])->get('drying2_tmp')->row_array();

		$tfr = $dfr['hasil_today'] + $show->tambah_cerutu;
		$tdr2 = $ddr2['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_frez' => $show->produk,'jenis_frez' => $show->jenis])->update('frezer_tmp',['hasil_today' => $tfr]);
		$this->db->where(['produk_dry2' => $show->produk,'jenis_dry2' => $show->jenis])->update('drying2_tmp',['hasil_today' => $tdr2]);

		$cek = $this->db->delete('drying2', ['id' => $id]);
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Drying2'); window.location = '".base_url(
				'Proses_produksi/drying2')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_Drying2
	public function print_drying2()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get('drying2')->result_array();
		$this->load->view('home/proses/print_drying2',$data);
	}
	// cari_Drying2
	public function cari_drying2()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying2')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying2')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Drying2
	public function total_drying2()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying2')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying2')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying2')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying2')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying2')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying2')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat drying2
	public function drw_d2()
	{
		$output = $this->db->select('hasil_today')->where(array('jenis_frez' => $_POST['jenis'], 'produk_frez' => $_POST['merek']))->get('frezer_tmp')->row_array();
		$care['dud'] = ($output['hasil_today'] == null ? 0 : $output['hasil_today']);
		echo json_encode($care);
	}
	// cool
	public function cool()
	{
		$data['Cool'] = $this->db->order_by('id','DESC')->get('cool')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/cool',$data);
		$this->load->view('home/layout/footer');
	}
	// add_Cool
	public function add_cool()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'hasil_akhir' => $hasil,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('cool_tmp', array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('cool_tmp', $object);

			$where1 = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where1)->update('fumigasi_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where)->update('cool_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where1)->update('fumigasi_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('cool', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Cool'); window.location = '".base_url(
				'Proses_produksi/cool')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Cool'); window.location = '".base_url(
				'Proses_produksi/cool')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Cool
	public function edit_cool($id = null)
	{
		$data['datas'] = $this->db->get_where('cool', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_cool', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Cool
	public function update_cool($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = $this->input->post('ad_sb');
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$frez = $this->db->where(array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']))->get('fumigasi_tmp')->result();
		$cek1 = $this->db->get_where('cool_tmp', array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $frez[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where)->update('fumigasi_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where1)->update('cool_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $frez[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_fumi' => $_POST['produk'], 'jenis_fumi' => $_POST['jenis']);
			$this->db->where($where)->update('fumigasi_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where1)->update('cool_tmp', array('hasil_today' => $mut_));
		}		

		$this->db->set($data)->where('id',$id)->update('cool');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Cool'); window.location = '".base_url(
				'Proses_produksi/Cool')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Cool'); window.location = '".base_url(
				'Proses_produksi/Cool')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Cool
	public function del_cool($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('cool')->row();
		$dfm = $this->db->select('hasil_today')->where(['produk_fumi' => $show->produk,'jenis_fumi' => $show->jenis])->get('fumigasi_tmp')->row_array();
		$dcl = $this->db->select('hasil_today')->where(['produk_cool' => $show->produk,'jenis_cool' => $show->jenis])->get('cool_tmp')->row_array();

		$tfm = $dfm['hasil_today'] + $show->tambah_cerutu;
		$tcl = $dcl['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_fumi' => $show->produk,'jenis_fumi' => $show->jenis])->update('fumigasi_tmp',['hasil_today' => $tfm]);
		$this->db->where(['produk_cool' => $show->produk,'jenis_cool' => $show->jenis])->update('cool_tmp',['hasil_today' => $tcl]);

		$cek = $this->db->delete('cool', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Cool'); window.location = '".base_url(
				'Proses_produksi/cool')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Cool'); window.location = '".base_url(
				'Proses_produksi/cool')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_Cool
	public function print_cool()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get('cool')->result_array();
		$this->load->view('home/proses/print_cool',$data);
	}
	// cari_Cool
	public function cari_cool()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('cool')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('cool')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Cool
	public function total_cool()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('cool')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('cool')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('cool')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('cool')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('cool')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('cool')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}
	// dropdown bertingkat cool
	public function drw_cl()
	{
		$care = $this->db->select('hasil_today')->where(array('jenis_fumi' => $_POST['jenis'], 'produk_fumi' => $_POST['merek']))->get('fumigasi_tmp')->row_array();
		$output['dud'] = ($care['hasil_today'] == null ? 0 : $care['hasil_today']);
		echo json_encode($output);
	}
	// drying3
	public function drying3()
	{ 
		$data['Drying3'] = $this->db->order_by('id','DESC')->get('drying3')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/drying3',$data);
		$this->load->view('home/layout/footer');
	}
 	// add_Drying3
	public function add_drying3()
	{
		$this->db->trans_start();
		error_reporting(0);
		$hasil = $this->input->post('hasil') - $this->input->post('tambah_cerutu');
		$data = array(
			'produk' => $_POST['produk'],
			'jenis' => $_POST['jenis'],
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $this->input->post('tambah_cerutu'),
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cek1 = $this->db->get_where('drying3_tmp', array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis'],'hasil_today' => $this->input->post('tambah_cerutu'));
			$this->db->insert('drying3_tmp', $object);

			$where1 = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where1)->update('cool_tmp', array('hasil_today' => $hasil));
		} else {
			$dr = $cek1->result();
			$hasil_ = $dr[0]->hasil_today + $this->input->post('tambah_cerutu');
			$where = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']);
			$this->db->where($where)->update('drying3_tmp', array('hasil_today' => $hasil_));

			$where1 = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where1)->update('cool_tmp', array('hasil_today' => $hasil));
		}

		$this->db->insert('drying3', $data);
		if (!$cek) {
			echo "<script>alert('Berhasil Menambahkan Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_Drying3
	public function edit_drying3($id = null)
	{
		$data['datas'] = $this->db->get_where('drying3', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_drying3', $data);
		$this->load->view('home/layout/footer');
	}
	// update_Drying3
	public function update_drying3($id)
	{
		$this->db->trans_start();
		error_reporting(0);
		$ad_sb = $this->input->post('ad_sb');
		$tambah_cerutu = $this->input->post('tambah_cerutu');
		$hasil = $this->input->post('hasil') - $tambah_cerutu;
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'),
			'hasil' => $this->input->post('hasil'),
			'hasil_akhir' => $hasil,
			'tambah_cerutu' => $tambah_cerutu,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username'],
			'lama' => $this->input->post('lama')
		);

		$cool = $this->db->where(array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']))->get('cool_tmp')->result();
		$cek1 = $this->db->get_where('drying3_tmp', array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']))->result();
		if ($tambah_cerutu > $ad_sb) {
			$mut = $tambah_cerutu - $ad_sb;
			$mt_f = $cool[0]->hasil_today - $mut;
			$mut_ = $cek1[0]->hasil_today + $mut;

			$where = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where)->update('cool_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']);
			$this->db->where($where1)->update('drying3_tmp', array('hasil_today' => $mut_));
		} else {
			$mut = $ad_sb - $tambah_cerutu;
			$mt_f = $cool[0]->hasil_today + $mut;
			$mut_ = $cek1[0]->hasil_today - $mut;

			$where = array('produk_cool' => $_POST['produk'], 'jenis_cool' => $_POST['jenis']);
			$this->db->where($where)->update('cool_tmp', array('hasil_today' => $mt_f));

			$where1 = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']);
			$this->db->where($where1)->update('drying3_tmp', array('hasil_today' => $mut_));
		}		

		$this->db->set($data)->where('id',$id)->update('drying3');
		if (!$cek) {
			echo "<script>alert('Berhasil MengUpdate Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";
		}
		$this->db->trans_complete();
	}
	// del_Drying3
	public function del_drying3($id)
	{
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('drying3')->row();
		$dcl = $this->db->select('hasil_today')->where(['produk_cool' => $show->produk,'jenis_cool' => $show->jenis])->get('cool_tmp')->row_array();
		$ddr3 = $this->db->select('hasil_today')->where(['produk_dry3' => $show->produk,'jenis_dry3' => $show->jenis])->get('drying3_tmp')->row_array();

		$tcl = $dcl['hasil_today'] + $show->tambah_cerutu;
		$tdr3 = $ddr3['hasil_today'] - $show->tambah_cerutu;

		$this->db->where(['produk_dry3' => $show->produk,'jenis_dry3' => $show->jenis])->update('drying3_tmp',['hasil_today' => $tdr3]);
		$this->db->where(['produk_cool' => $show->produk,'jenis_cool' => $show->jenis])->update('cool_tmp',['hasil_today' => $tcl]);

		$cek = $this->db->delete('drying3', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Proses Drying3'); window.location = '".base_url(
				'Proses_produksi/drying3')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_Drying3
	public function print_drying3()
	{	
		$data['data'] = $this->db->order_by('id','desc')->get('drying3')->result_array();
		$this->load->view('home/proses/print_drying3',$data);
	}
	// cari_Drying3
	public function cari_drying3()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		if ($_POST['produk'] == '') {
			$like = $this->db->order_by('id','DESC')->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying3')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}else{
			$like = $this->db->order_by('id','DESC')->where('produk',$_POST['produk'])->where("tanggal BETWEEN '$awal' AND '$akhir'");
			$output ='';
			$datas = $like->from('drying3')->get()->result_array();
			$no=1;
			foreach ($datas as $key) {
				$output .= '
				<tr>
				<td>'.$no.'</td>
				<td>'.$key['tanggal'].'</td>
				<td>'.$key['produk'].'</td>
				<td>'.$key['jenis'].'</td>
				<td>'.$key['lama'].'</td>
				<td>'.$key['hasil'].'</td>
				<td>'.$key['tambah_cerutu'].'</td>
				<td>'.$key['hasil_akhir'].'</td>
				<td>'.$key['ket'].'</td>
				</tr>
				'; $no++;
			}
			echo json_encode($output);
		}
	}
	// total_Drying3
	public function total_drying3()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$output = array('hasil' => '', 'mutasi' => '', 'hasil_akhir' => '');
		if ($_POST['produk'] == '') {
			$output['hasil']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying3')->row()->hasil;
			$output['mutasi']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying3')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying3')->row()->hasil_akhir;
			echo json_encode($output);		
		}else{
			
			$output['hasil']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil) as hasil')->get('drying3')->row()->hasil;
			$output['mutasi']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(tambah_cerutu) as tambah_cerutu')->get('drying3')->row()->tambah_cerutu;
			$output['hasil_akhir']=$this->db->where('produk',$_POST['produk'])->where('tanggal >=',$awal)->where('tanggal <=',$akhir)->select('SUM(hasil_akhir) as hasil_akhir')->get('drying3')->row()->hasil_akhir;
			echo json_encode($output);
		}	
	}

	public function drw_d3()
	{
		$care = $this->db->select('hasil_today')->where(array('produk_cool' => $_POST['merek'],'jenis_cool' => $_POST['jenis']))->get('cool_tmp')->row_array();
		$output['dud'] = ($care['hasil_today'] == null ? 0 : $care['hasil_today']);
		echo json_encode($output);
	}
	// qc
	public function qc()
	{
		$data['qc__'] = $this->db->order_by('id','DESC')->get('qc')->result_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/qc',$data);
		$this->load->view('home/layout/footer');
	}

	// tambah_qc
	public function tambah_qc()
	{
		$this->db->trans_start();
		error_reporting(0);
		$accept = $this->input->post('accept');
		$r_bind = $this->input->post('binding');
		$r_wrap = $this->input->post('wrapping');
		$r_qc = 0;
		$r_ruja = $this->input->post('buang');
		if ($r_bind == 0 && $r_wrap == 0 & $r_ruja == 0) {$sta_1 = 1;} else {$sta_1 = 0;}
		if ($r_qc == 0) {$sta_qc = 1;} else {$sta_qc = 0;}
		
		$reject = $r_bind + $r_wrap + $r_ruja + $r_qc;
		$sisa = $this->input->post('stock') - $accept - $reject;

		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'), 
			'stock' => $this->input->post('stock'),
			'accept' => $accept,
			'binding_rej' => $r_bind,
			'wrapping_rej' => $r_wrap,
			'rusak_rej' => $r_ruja,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);
		$cek1 = $this->db->get_where('qual_con_tmp', array('produk_q' => $_POST['produk']));
		if ($cek1->num_rows() == 0) {
			$object = array('produk_q' => $_POST['produk'],'stock_q' => $accept);
			$this->db->insert('qual_con_tmp', $object);

			$where1 = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']);
			$this->db->where($where1)->update('drying3_tmp', array('hasil_today' => $sisa));
		} else {
			$dr = $cek1->row();
			$hasil_ = $dr->stock_q + $accept;
			$where = array('produk_q' => $_POST['produk']);
			$this->db->where($where)->update('qual_con_tmp', array('stock_q' => $hasil_));

			$where1 = array('produk_dry3' => $_POST['produk'], 'jenis_dry3' => $_POST['jenis']);
			$this->db->where($where1)->update('drying3_tmp', array('hasil_today' => $sisa));
		}

		$bin = $this->db->select('hasil_today')->where(['produk_bind' => $_POST['produk'],'jenis_bind' => $_POST['jenis']])->get('binding_tmp')->row_array();
		$wra = $this->db->select('hasil_today')->where(['produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']])->get('wrapping_tmp')->row_array();
		
		$cek = $this->db->insert('qc', $data);
		if ($cek) {
			if ($r_bind == 0 && $r_wrap == 0 && $r_ruja == 0 && $r_qc == 0) {
				
			} else {
				$tbin = $bin['hasil_today'] + $r_bind;
				$twra = $wra['hasil_today'] + $r_wrap;

				$this->db->where(['produk_bind' => $_POST['produk'],'jenis_bind' => $_POST['jenis']])->update('binding_tmp',['hasil_today' => $tbin]);
				$this->db->where(['produk_wrap' => $_POST['produk'],'jenis_wrap' => $_POST['jenis']])->update('wrapping_tmp',['hasil_today' => $twra]);

				$kps = $this->db->where(['jenis_tmp' => $_POST['jenis'],'kategori_tmp' => 'FILLER 2'])->get('data_stock_tmp');
				$aps = $kps->row();
				if ($kps->num_rows() > 0) {
					$as = $aps->hs_sblm + $r_ruja;
					$this->db->where(['jenis_tmp' => $_POST['jenis'],'kategori_tmp' => 'FILLER 2'])->update('data_stock_tmp',['hs_sblm' => $as]);
				} else {
					$this->db->insert('data_stock_tmp',['jenis_tmp' => $_POST['jenis'],'kategori_tmp' => 'FILLER 2','hs_sblm' => $r_ruja]);
				}
			}
			echo "<script>alert('Berhasil Menambahkan Quality Controll'); window.location = '".base_url(
				'Proses_produksi/qc')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Quality Controll'); window.location = '".base_url(
				'Proses_produksi/qc')."'</script>";
		}
		$this->db->trans_complete();
	}
	// edit_qc
	public function edit_qc($id)
	{
		$data['data'] = $this->db->get_where('qc', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_qc', $data);
		$this->load->view('home/layout/footer');
	}
	// update_qc
	public function update_qc($id)
	{
		$this->db->trans_start();
		$stock = $this->input->post('stock');
		$acp = (int) ($this->input->post('acp'));
		$accept = $this->input->post('accept');
		$rjt = (int) ($this->input->post('rjt'));
		$reject = $this->input->post('reject');

		$cc = $stock - $acp - $rjt;
		$kk = $stock - $accept - $reject;
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'), 
			'stock' => $stock,
			'reject' => $reject,
			'accept' => $accept,
			'ket' => $this->input->post('ket'),
			'tanggal' => $this->input->post('tanggal'),
			'author' => $_SESSION['username']
		);

		// $sisa = $this->input->post('stock') - $this->input->post('accept') - $this->input->post('reject');
		// $this->db->order_by('id', 'DESC')->set(array('hasil_akhir' => $sisa))->where('produk', $this->input->post('produk'))->update('drying3');
		$cek = $this->db->set($data)->where('id',$id)->update('qc');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Quality Controll'); window.location = '".base_url(
				'Proses_produksi/qc')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Quality Controll'); window.location = '".base_url(
				'Proses_produksi/qc')."'</script>";
		}
		$this->db->trans_complete();
	}
	// print_qc
	public function print_qc()
	{
		
	}
	// hapus_qc
	public function hapus_qc($id)
	{	
		$this->db->trans_start();
		$show = $this->db->where('id',$id)->get('qc')->row();
		$ddr3 = $this->db->select('hasil_today')->where(['produk_dry3' => $show->produk,'jenis_dry3' => $show->jenis])->get('drying3_tmp')->row_array();
		$dqc = $this->db->select('stock_q')->where(['produk_q' => $show->produk])->get('qual_con_tmp')->row_array();
		$dbn = $this->db->select('hasil_today')->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->get('binding_tmp')->row_array();
		$dwr = $this->db->select('hasil_today')->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->get('wrapping_tmp')->row_array();
		$drs = $this->db->where(['jenis_tmp' => $show->jenis,'kategori_tmp' => 'FILLER 2'])->get('data_stock_tmp');

		$tdr3 = $ddr3['hasil_today'] + $show->accept + $show->binding_rej + $show->wrapping_rej + $show->rusak_rej;
		$tqc = $dqc['stock_q'] - $show->accept;
		$tbn = $dbn['hasil_today'] - $show->binding_rej;
		$twr = $dwr['hasil_today'] - $show->wrapping_rej;

		$this->db->where(['produk_dry3' => $show->produk,'jenis_dry3' => $show->jenis])->update('drying3_tmp',['hasil_today' => $tdr3]);
		$this->db->where(['produk_q' => $show->produk])->update('qual_con_tmp',['stock_q' => $tqc]);
		$this->db->where(['produk_bind' => $show->produk,'jenis_bind' => $show->jenis])->update('binding_tmp',['hasil_today' => $tbn]);
		$this->db->where(['produk_wrap' => $show->produk,'jenis_wrap' => $show->jenis])->update('wrapping_tmp',['hasil_today' => $twr]);

		if ($drs->num_rows() > 0) {
			$kasaq = $drs->row_array();
			$asf = $kasaq['hs_sblm'] + $show->rusak_rej;
			$this->db->where(['jenis_tmp' => $show->jenis,'kategori_tmp' => 'FILLER 2'])->update('data_stock_tmp',['hs_sblm' => $asf]);
		}

		$da = $this->db->get_where('qc', array('id' => $id))->row_array();
		$b = $this->db->order_by('id', 'DESC')->set(array('hasil_akhir' => $da['stock']))->where('produk', $da['produk'])->update('drying3');
		if ($b) {
			$cek = $this->db->delete('qc', array('id' => $id));
			if ($cek) {
				echo "<script>alert('Berhasil Menghapus Quality Controll'); window.location = '".base_url(
					'Proses_produksi/qc')."'</script>";	
			}else{
				echo "<script>alert('Gagal Menghapus Quality Controll'); window.location = '".base_url(
					'Proses_produksi/qc')."'</script>";
			}
		}
		$this->db->trans_complete();
	}
	// ambil_qc
	public function ambil_qc()
	{
		echo json_encode($this->db->order_by('id','DESC')->get('qc')->row_array());
	}
	// kirim_pesan
	public function kirim_pesan()
	{
		$id = $_POST['id']; $pesan = $_POST['pesan'];
		$data = array(
			'id_qc' => $id,
			'pesan' => $pesan, 
			'tanggal' => date('Y-m-d'),
			'author' => $_SESSION['username'],
			'status' => 0,
		);
		$cek=$this->db->insert('pesan', $data);
		if ($cek) {
			echo "Berhasil Mengirim Pesan !!!";
		}else{
			echo "Gagal Mengirim Pesan !!!";
		}
	}
	// packing
	public function packing()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/packing');
		$this->load->view('home/layout/footer');
	}

	// semua_subproduk
	public function semua_subproduk()
	{
		$a = $this->db->select('sub_produk')->select('sub_kode')->from('sub_produk')->get()->result_array();
		echo json_encode($a);
	}


	// laporan_produksi
	public function laporan_produksi()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/laporan_produksi');
		$this->load->view('home/layout/footer');
	}
	// add_laporan_produksi
	public function add_laporan_produksi()
	{
		$data = array(
			// 'tanggal' => date('Y-m-d'),
			'tanggal' => $this->input->post('tanggal'),
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'), 
			'jumlah' => $this->input->post('jumlah'),
			'dek' => $this->input->post('dek'),
			'omb' => $this->input->post('omb'),
			'fill' => $this->input->post('fill'),
		);
		$cek = $this->db->insert('laporan_produksi', $data);
		// $cek = $this->db->insert('qc', array('accept' => $ac, 'reject' => $re, 'tanggal' => date('Y-m-d')));
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";
		}
	}
	// edit_laporan_produksi
	public function edit_laporan_produksi($id)
	{	
		$data['data'] = $this->db->get_where('laporan_produksi', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/proses/edit_laporan_produksi', $data);
		$this->load->view('home/layout/footer');
	}
	// update_laporan_produksi
	public function update_laporan_produksi($id)
	{
		$data = array(
			'produk' => $this->input->post('produk'),
			'jenis' => $this->input->post('jenis'), 
			'jumlah' => $this->input->post('jumlah'),
			'dek' => $this->input->post('dek'),
			'omb' => $this->input->post('omb'),
			'fill' => $this->input->post('fill'),
		);
		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('laporan_produksi');
		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";
		}
	}
	// hapus_laporan_produksi
	public function hapus_laporan_produksi($id)
	{
		$cek = $this->db->delete('laporan_produksi', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menghapus Laporan Produksi'); window.location = '".base_url(
				'Proses_produksi/laporan_produksi')."'</script>";
		}
	}
	// print_laporan_produksi
	public function print_laporan_produksi()
	{
		$this->load->view('home/proses/print_laporan_produksi');
	}
	// cari_laporan_produksi
	public function cari_laporan_produksi()
	{
		$awal = $_POST['awal']; $akhir = $_POST['akhir'];
		
		$like = $this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
		$output ='';

		$datas = $like->from('laporan_produksi')->get()->result_array();
		$no=1;
		foreach ($datas as $key) {
			$output .= '
			<tr>
			<td>'.$no.'</td>
			<td>'.$key['tanggal'].'</td>
			<td>'.$key['produk'].'</td>
			<td>'.$key['jenis'].'</td>
			<td>'.$key['jumlah'].'</td>
			<td>'.$key['dek'].'</td>
			<td>'.$key['omb'].'</td>
			<td>'.$key['fill'].'</td>
			</tr>
			'; $no++;
		}
		echo json_encode($output);
	}
	// filter_qc
	public function filter_qc()
	{
		$produk = $this->input->post('produk');
		$jenis = $this->input->post('jenis');
		$care = $this->db->select('hasil_today')->where(array('produk_dry3' => $produk,'jenis_dry3' => $jenis))->get('drying3_tmp')->row_array();
		$output['hasil_today'] = ($care['hasil_today'] == null ? 0 : $care['hasil_today']);
		echo json_encode($output);
	}
}