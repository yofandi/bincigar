<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index()
	{	
		$data['cincin'] =  $this->db->get('stock_cincin');
		$data['cukai'] =  $this->db->get('stock_cukai');	
		$data['stiker'] =  $this->db->get('stock_stiker');	
		$data['kemasan'] =  $this->db->get('stock_kemasan');	
		$data['packing'] =  $this->db->get('stock_subproduk');
		$this->db->select('produk.produk,sub_produk.sub_kode,
			sub_produk.sub_produk,rfs_stock_keluar.stock_keluar');
		$this->db->from('rfs_stock_keluar');
		$this->db->join('sub_produk', 'rfs_stock_keluar.id_subproduk = sub_produk.id', 'inner');
		$this->db->join('produk', 'sub_produk.id_produk = produk.id', 'inner');
		$data['ready_for_sale'] = $this->db->get();
		$this->load->view('home/layout/header');
		$this->load->view('home/index',$data);
		$this->load->view('home/layout/footer');
	}

	// edit_profile
	public function edit_profile()
	{	
		$data['data'] = $this->db->get_where('users', array('id' => $_SESSION['id']))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/edit_profile', $data);
		$this->load->view('home/layout/footer');
	}
	// update_profile
	public function update_profile()
	{
		$po = $this->input->post();
		$email = $this->input->post('email');
		$username = $this->input->post('username');

		$data = array('nama_lengkap' => $po['nama_lengkap'],'username' => $username, 'email' => $email);

		$this->db->set($data);
		$this->db->where('id', $_SESSION['id']);
		$cek = $this->db->update('users');

		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Profile'); window.location = '".base_url(
				'Home/edit_profile')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Profile'); window.location = '".base_url(
				'Home/edit_profile')."'</script>";
		}
	}

	// edit_password
	public function edit_password()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/edit_password');
		$this->load->view('home/layout/footer');
	}
	// update_password
	public function update_password()
	{
		$pass1 = $this->input->post('password1');
		$pass2 = $this->input->post('password2');
		$pass3 = $this->input->post('password3');

		if ($pass2 === $pass3) {
			
			$cek = $this->db->get_where('users', array('password' => sha1($pass1)))->num_rows();
			if ($cek === 0) {

				echo "<script>alert('Password Tidak Di Temukan !'); window.location = '".base_url(
				'Home/edit_password')."'</script>";
			}else{

				$this->db->set(array('password' => sha1($pass2)));
				$this->db->where('id', $_SESSION['id']);
				$cek = $this->db->update('users');

				echo "<script>alert('Berhasil MengUpdate Password !'); window.location = '".base_url(
				'Home/edit_password')."'</script>";
			}
		}else{
			echo "<script>alert('Password Tidak Sama, Ulangi Password !'); window.location = '".base_url(
				'Home/edit_password')."'</script>";
		}
	}

	// upload_foto
	public function upload_foto()
	{	
		$data['data'] = $this->db->get_where('users', array('id' => $_SESSION['id']))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/upload_foto', $data);
		$this->load->view('home/layout/footer');
	}

	// update_foto
	public function update_foto()
	{
		error_reporting(0);
		$foto = $this->input->post('fto');
		unlink('./assets/images/'.$foto);

		$config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload');

        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('foto'))
        {
            $error = array('error' => $this->upload->display_errors());
			echo $error['error'];
        }
        else
        {	
        	$data = $this->upload->data();
        	$gambar = $data['file_name'];
        	
        	$this->db->set(array('upload_foto' => $gambar));
        	$this->db->where('id', $_SESSION['id']);
        	$cek = $this->db->update('users');

        	if ($cek) {
			echo "<script>alert('Berhasil MengUpload Foto Profile'); window.location = '".base_url(
				'Home/upload_foto')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpload Foto Profile'); window.location = '".base_url(
				'Home/upload_foto')."'</script>";
		}
        }
	}


	// option
	public function option()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/option');
		$this->load->view('home/layout/footer');
	}

	// update_option
	public function update_option()
	{
		$direktur = $this->input->post('direktur');
		$kabag = $this->input->post('kabag');
		$qc = $this->input->post('qc');
		$rfs = $this->input->post('rfs');

		$data = array('direktur' => $direktur, 'kabag' => $kabag, 'qc' => $qc,'rfs' => $rfs);
		
		$this->db->where('id', 1);
		$cek = $this->db->update('setting',$data);

		if ($cek) {
			echo "<script>alert('Berhasil MengUpdate Setting'); window.location = '".base_url(
				'Home/option')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengUpdate Setting'); window.location = '".base_url(
				'Home/option')."'</script>";
		}
	}
	public function pilih($argument)
	{
		$output = '';
		if ($argument === 'produksi') {
			$level = $this->db->get('level_user')->result_array();
			foreach ($level as $key) {
				$output .= '<option value="'.$key['level'].'">'.$key['level'].'</option>';
			}
		} else {
			$bagan_store = $this->db->get('bagan_store')->result_array();
			foreach ($bagan_store as $key) {
				$output .= '<option value="'.$key['nama'].'">'.$key['nama'].'</option>';
			}
		}
		
		echo json_encode($output);
	}
	// tambah_user
	public function tambah_user()
	{
		$data['level_user'] = $this->db->get('level_user');
		$this->load->view('home/layout/header');
		$this->load->view('home/tambah_user', $data);
		$this->load->view('home/layout/footer');
	}
	// add_users
	public function add_users()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = sha1($this->input->post('password'));
		$level = $this->input->post('level');

		$data = array(
			'username' => $username,
			'email' => $email, 
			'password' => $password,
			'level' => $level,
			'upload_foto' => 'img.png'
		);

		$cek = $this->db->insert('users', $data);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Users !'); window.location = '".base_url(
				'Home/tambah_user')."'</script>";	
		}else{
			echo "<script>alert('Gagal Menambahkan Users !'); window.location = '".base_url(
				'Home/tambah_user')."'</script>";
		}
	}

	// edit_users
	public function edit_users($id)
	{
		$data = $this->db->get_where('users', array('id' => $id))->row_array();
		echo json_encode($data);
	}

	// hapus_users
	public function hapus_users($id)
	{
		$cek = $this->db->delete('users', array('id' => $id));
		if ($cek) {
			echo "Berhasil MengHapus Users ID ".$id;
		}else{
			echo 'Gaga; MengHapus Users ID '.$id;
		}
	}

	// update_users
	public function update_users($id)
	{
		$username = $_POST['username'];
		$email = $_POST['email']; $level = $_POST['level']; $password= sha1($_POST['password']);

		$data = array('username' => $username, 'email' => $email, 'password' => $password, 'level' => $level);
		$this->db->set($data);
		$this->db->where('id', $id);
		$cek = $this->db->update('users');
		if ($cek) {
			echo "Berhasil MengUpdate Users ID ".$id;
		}else{
			echo "Gagal MengUpdate Users ID ".$id;
		}
	}
	// notif_accept
	public function notif_accept($id)
	{
		$this->db->set(array('status' => 1))->where('id',$id)->update('pesan');
		redirect(base_url('Home/'));
	}
	// laporan
	public function laporan()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/laporan');
		$this->load->view('home/layout/footer');
	}
	// add_laporan
	public function add_laporan()
	{
		$this->load->view('home/layout/header');
		$this->load->view('home/add_laporan');
		$this->load->view('home/layout/footer');
	}
	// simpan_laporan
	public function simpan_laporan()
	{
		$data = array(
			'tanggal' => $_POST['tanggal'],
			'cerah_hujan' => $_POST['cerah_hujan'], 
			'pagi' => $_POST['pagi'],
			'siang' => $_POST['siang'],
			'sore' => $_POST['sore'],
			'bak_air' => $_POST['bak_air'],
			'lasiotrap_ruangan' => $_POST['lasiotrap_ruangan'],
			'lasiotrap_lemari' => $_POST['lasiotrap_lemari'],
			'ds' => $_POST['ds'],
			'store' => $_POST['store'],
			'agent' => $_POST['agent'],
			'call' => $_POST['call'],
			'efektif_call' => $_POST['efektif_call'],
			'noo' => $_POST['noo'],
			'direksi' => $_POST['direksi'],
			'kesulitan' => $_POST['kesulitan'],
			'author' => $_SESSION['username']
		);
		
		$cek = $this->db->insert('laporan', $data);
		if ($cek) {
			echo "Berhasil Menyimpan Laporan !";
		}else{
			echo "Gagal Menyimpan Laporan !";
		}
	}

	public function send_email($id)
	{
		$config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = $this->session->userdata('email');
        $config['smtp_pass'] = $this->session->userdata('password');
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
		
        $bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
        $setting = $this->db->get_where('setting', array('id' => 1))->row_array();
        $data=$this->db->where('id', $id)->get('laporan')->row_array();
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
        </head>
        <body>
		      <div class="col-12">
		        Kepada Yth.: <br>
		      Direksi BIN <br><br>

		      Dengan hormat, <br>
		      Bersama ini kami melaporkan kegiatan Cigar Store tanggal '.date('d').' '.$bulan[date('m')].' '.date('Y').' sbb : <br><br>
		      

		      *1. Pengamatan lingkungan:* <br>
		    - Curah hujan         : '.$data['cerah_hujan'].'<br>

		    - Suhu dan kelembahan : <br>
		         Pagi  :  '.$data['pagi'].' <br>

		         Siang :  '.$data['siang'].' <br>

		         Sore  :  '.$data['sore'].' <br>

		         <br>
		      *2. Tangkapan Lasio:* <br>
		      - Bak air              : '.$data['bak_air'].' <br>
		      - Lasiotrap di ruangan : '.$data['lasiotrap_ruangan'].' <br>

		      - Lasiotrap di lemari  : '.$data['lasiotrap_lemari'].' <br>

		      <br>
		      *3. Catatan Penjualan* <br>
		      - Ds     : Rp. '.number_format($data['ds'],2,',','.').' <br> 

		      - Store  : Rp. '.number_format($data['store'],2,',','.').' <br>

		      - Agent  : Rp. '.number_format($data['agent'],2,',','.').' <br>

		                    
		      <br>
		      *4. Laporan DS* <br>
		      - Call            : '.$data['call'].' <br>

		      - Efektif Call.   : '.$data['efektif_call'].' <br>

		      - Noo.            : '.$data['noo'].' <br>

		      <br>
		      *5. Catatan Direksi* <br>
		       '.$data['direksi'].'
		      *6. Kesulitan <br>
		       '.$data['kesulitan'].' 
		      Demikian laporan kami, selanjutnya mohon petunjuk dan instruksi lebih lanjut. Terimakasih.  
		      <br><br>
		      Hormat kami,
		      <br><br>
		      <b><u>'.$this->session->userdata('username').'</u></b><br>
		      '.$this->session->userdata('level').'
		      </div>
		</body>

        </html>
        ';
        // Load library email dan konfigurasinya
        $this->email->initialize($config);
        $from = $this->session->userdata('email');
        $to = $this->input->post('kepada');
        $subject = $this->input->post('subject');

        $this->email->from($from, $this->session->userdata('username'));
        $this->email->to($to);
        
        $this->email->subject($subject);
        $this->email->message($html);
        
        // die(var_dump($this->email->send()));
        if ($this->email->send()) {
            echo "<script>alert('Sukses! email berhasil dikirim'); window.location = '".base_url(
				'Home/laporan')."'</script>";
        } else {
            echo "<script>alert('Error! email tidak dapat dikirim'); window.location = '".base_url(
				'Home/laporan')."'</script>";
        }
	}

	// print_laporan
	public function print_laporan()
	{
		$this->load->view('home/print_laporan');
	}
	public function view_laporan($id)
	{	
		$data['data'] = $this->db->get_where('laporan', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/view_laporan', $data);
		$this->load->view('home/layout/footer');
	}
	// edit_laporan
	public function edit_laporan($id)
	{
		$data['data'] = $this->db->get_where('laporan', array('id' => $id))->row_array();
		$this->load->view('home/layout/header');
		$this->load->view('home/edit_laporan', $data);
		$this->load->view('home/layout/footer');
	}
	// update_laporan
	public function update_laporan($id)
	{
		$data = array(
			'tanggal' => $_POST['tanggal'],
			'cerah_hujan' => $_POST['cerah_hujan'], 
			'pagi' => $_POST['pagi'],
			'siang' => $_POST['siang'],
			'sore' => $_POST['sore'],
			'bak_air' => $_POST['bak_air'],
			'lasiotrap_ruangan' => $_POST['lasiotrap_ruangan'],
			'lasiotrap_lemari' => $_POST['lasiotrap_lemari'],
			'ds' => $_POST['ds'],
			'store' => $_POST['store'],
			'agent' => $_POST['agent'],
			'call' => $_POST['call'],
			'efektif_call' => $_POST['efektif_call'],
			'noo' => $_POST['noo'],
			'direksi' => $_POST['direksi'],
			'kesulitan' => $_POST['kesulitan'],
			'author' => $_SESSION['username']
		);



		$cek = $this->db->set($data)->where('id',$id)->update('laporan');
		if ($cek) {
			echo "Berhasil MengUpdate Laporan !";
		}else{
			echo "Gagal MengUpdate Laporan !";
		}
	}

	public function hapus_laporan($id)
	{
		$cek = $this->db->delete('laporan', array('id' => $id));
		if ($cek) {
			echo "<script>alert('Berhasil MengHapus Laporan !'); window.location = '".base_url(
				'Home/laporan')."'</script>";	
		}else{
			echo "<script>alert('Gagal MengHapus Laporan !'); window.location = '".base_url(
				'Home/laporan')."'</script>";
		}
	}

	public function laporan_stockbahan()
	{
		$data['kategori'] = $this->db->order_by('id', 'desc')->get('kategori');
		$data['jenis'] = $this->db->get('jenis');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan_stockbahan',$data);
		$this->load->view('home/layout/footer');
	}

	public function search_stock()
	{
		$data['jenis'] = $this->input->post('jenis');
		$data['kate_'] = $this->input->post('kate_');
		$data['asal'] = $this->input->post('asal');
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');

		$data['kategori'] = $this->db->order_by('id', 'desc')->get('kategori');
		$this->load->view('home/search_stock', $data);
	}

	public function lap_reject()
	{
		$this->db->select('produk.produk,
	   					   sub_produk.id as id_sub,
	   					   sub_produk.sub_produk,
       					   sub_produk.sub_kode,
       					   reject.id_reject as id,
       					   reject.jenis,
       					   reject.r_binding as bind,
       					   reject.r_wrapping as wrap,
       					   reject.r_packing as pack,
       					   reject.r_rusak as rusak,
       					   reject.keterangan,
       					   reject.status');
		$this->db->from('reject');
		$this->db->join('sub_produk', 'sub_produk.id = reject.id_subproduk', 'inner');
		$this->db->join('produk', 'sub_produk.id_produk = produk.id', 'inner');
		$this->db->where('status',0);
		$this->db->or_where('status',2);
		$data['reject'] = $this->db->get();

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan_reject1',$data);
		$this->load->view('home/layout/footer');
	}

	public function terima_proses($id)
	{
		$this->db->where('id_reject',$id)->update('reject', array('status' => 2));
	}

	public function terima_reject($id)
	{
		$Post = $this->input->post();
		// proses add ke binding
		$bind = $this->db->select('hasil_today')->where(array('produk_bind' => $Post['produk'],'jenis_bind' => $Post['jenis']))->get('binding_tmp');
		if ($bind->num_rows() > 0) {
			$binding = $bind->row();
			$add_bind = $binding->hasil_today + $Post['bind'];
			$this->db->where(array('produk_bind' => $Post['produk'],'jenis_bind' => $Post['jenis']))->update('binding_tmp', array('hasil_today' => $add_bind));
		} else{
			$data = array('produk_bind' => $Post['produk'],'jenis_bind' => $Post['jenis'],'hasil_today' => $Post['bind']);
			$this->db->insert('binding_tmp', $data);
		}
		// proses add ke wrapping
		$wrap = $this->db->select('hasil_today')->where(array('produk_wrap' => $Post['produk'],'jenis_wrap' => $Post['jenis']))->get('wrapping_tmp');
		if ($wrap->num_rows() > 0) {
			$wrapping = $wrap->row();
			$add_wrap = $wrapping->hasil_today + $Post['wrap'];

			$this->db->where(array('produk_wrap' => $Post['produk'],'jenis_wrap' => $Post['jenis']))->update('wrapping_tmp', array('hasil_today' => $add_wrap));
		} else {
			$data1 = array('produk_wrap' => $Post['produk'],'jenis_wrap' => $Post['jenis'],'hasil_today' => $Post['wrap']);
			$this->db->insert('wrapping_tmp', $data1);
		}
		// proses add ke packing
		$pack = $this->db->where('id_subproduk',$Post['id_sub'])->get('stock_subproduk');
		if ($pack->num_rows() > 0) {
			$pack1 = $pack->row();
			$add_pack = $pack1->stock + $Post['pack'];
			$this->db->where('id_subproduk',$Post['id_sub'])->update('stock_subproduk',array('stock' => $add_pack));
		} else {
			$object = array('produk' => $Post['produk'],'sub_produk' => $Post['sub_produk'],'sub_kode' => $Post['sub_kode'],'stock' => $Post['pack'],'id_subproduk' => $Post['id_sub']);
			$this->db->insert('stock_subproduk', $object);
		}
		// proses add ke FILLER 2
		$fil2 = $this->db->where(array('jenis_pr' => $Post['jenis'],'kategori_pr' => 'FILLER 2'))->get('data_produksi');
		if ($fil2->num_rows() > 0) {
			$filler_2 = $fil2->row();
			$add_fil2 = $filler_2->produksi_pr + $Post['fill2'];
			$this->db->where(array('jenis_pr' => $Post['jenis'],'kategori_pr' => 'FILLER 2'))->update('data_produksi',array('produksi_pr' => $add_fil2));
		} else {
			$object1 = array('jenis_pr' => $Post['jenis'],'kategori_pr' => 'FILLER 2','produksi_pr' => $Post['fill2']);
			$this->db->insert('data_produksi', $object1);
		}
		// update reject
		$cek = $this->db->where('id_reject',$id)->update('reject',array('status' => 1));
		if ($cek) {
			echo "<script>alert('Berhasil Update Reject !'); window.location = '".base_url(
				'Home/lap_reject')."'</script>";	;
		} else {
			echo "<script>alert('Gagal Update Reject !'); window.location = '".base_url(
				'Home/lap_reject')."'</script>";	;
		}
	}

	public function return_rfs()
	{
		$this->db->select('produk.produk,
						   sub_produk.sub_produk,
						   sub_produk.sub_kode,
						   return_rfs.id_rtn,
						   return_rfs.jumlah,
						   return_rfs.ket,
						   return_rfs.tanggal,
						   return_rfs.status');
		$this->db->from('produk');
		$this->db->join('sub_produk', 'produk.id = sub_produk.id_produk', 'inner');
		$this->db->join('return_rfs', 'sub_produk.id = return_rfs.id_subproduk', 'inner');
		$this->db->where('status',0);
		$data['reject'] = $this->db->get();

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan_reject_qc',$data);
		$this->load->view('home/layout/footer');
	}
	
	public function kirim_return($id)
	{
		$data['id'] = $id;
		$data['produk'] = $this->db->order_by('id','ASC')->get('produk')->result_array();
		$data['bd'] = $this->db->select('jenis')->get('jenis')->result();

		$this->db->select('produk.produk,
						   sub_produk.id,
						   sub_produk.sub_produk,
						   sub_produk.sub_kode,
						   sub_produk.isi,
						   return_rfs.id_rtn,
						   return_rfs.jumlah,
						   return_rfs.ket,
						   return_rfs.tanggal,
						   return_rfs.status');
		$this->db->from('produk');
		$this->db->join('sub_produk', 'produk.id = sub_produk.id_produk', 'inner');
		$this->db->join('return_rfs', 'sub_produk.id = return_rfs.id_subproduk', 'inner');
		$this->db->where('return_rfs.id_rtn',$id);
		$data['r_rfs'] = $this->db->get()->row();
		$this->load->view('home/layout/header');
		$this->load->view('home/kirim_returnrfs',$data);
		$this->load->view('home/layout/footer');
	}

	public function proses_sortir($id)
	{
		$Post = $this->input->post();

		$hasil = $Post['batang'] - $Post['bind'] - $Post['wrap'] - $Post['out'];
		$hs_bagi = $hasil / $Post['isi'];

		if ($Post['bind'] == 0 & $Post['wrap'] == 0 & $Post['out'] == 0 & $Post['packing'] == 0) {$status1 = 1;} else {$status1 = 0;}

		if ($hasil > 0) {$status = 0;} else {$status = 1;}
		
		$ect = array('jumlah' => $hs_bagi,'status' => $status);
		$this->db->where('id_rtn',$id)->update('return_rfs', $ect);

		$object = array('jenis' => $Post['jenis'],'id_subproduk' => $Post['produk'],'r_binding' => $Post['bind'],
						'r_wrapping' => $Post['wrap'],'r_packing' => $Post['packing'],'r_rusak' => $Post['out'],
						'keterangan' => $Post['ket'],'status' => $status1,'tanggal' => date('Y-m-d'));
		$cek = $this->db->insert('reject', $object);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Data Reject !'); window.location = '".base_url(
				'Home/return_rfs')."'</script>";
		} else {
			echo "<script>alert('Gagal Menambahkan Data Reject !'); window.location = '".base_url(
				'Home/return_rfs')."'</script>";
		}
		
	}

	public function laporan_produksi()
	{
		$data['kategori'] = array('FILLER' => 'FILLER 1','OMBLAD' => 'OMBLAD','DEKBLAD' => 'DEKBLAD');
		$data['jenis'] = $this->db->get('jenis');
		$data['produk'] = $this->db->get('produk');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan_produksi',$data);
		$this->load->view('home/layout/footer');
	}

	public function seacrh_produksi()
	{
		$data['produk'] = $this->input->post('produk');
		$data['jenis'] = $this->input->post('jenis');
		$data['kategori'] = $this->input->post('kategori');
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$this->load->view('home/search_laporan',$data);
	}

	public function show_customer($id)
	{
		$output = '';
		$output .= '<option value="">--- Pilih Customer ---</option>';
		$db = $this->db->where('id_users',$id)->get('customer');
		foreach ($db->result_array() as $key) {
			$output .= '<option value="'.$key['id_customer'].'">'.$key['nama_customer'].'</option>';
		}
		echo json_encode($output);
	}

	public function customer()
	{
		if ($this->session->userdata('level') === 'Super Admin') {
			
		} else {
			$this->db->like('id_users', $this->session->userdata('id'), 'BOTH');
		}

		$this->db->select('customer.*,users.username');
		$this->db->from('customer');
		$this->db->join('users', 'customer.id_users = users.id', 'left');
		$data['customer'] = $this->db->get();
		$data['bagan_store'] = $this->db->get('bagan_store');

		$this->load->view('home/layout/header');
		$this->load->view('home/customer',$data);
		$this->load->view('home/layout/footer');
	}

	public function add_customer()
	{
		$Post = $this->input->post();

		$ins = array('id_users' => $Post['user'],
					 'nama_customer' => $Post['nama'],
					 'no_telf' => $Post['telf'],
					 'email' => $Post['email'],
					 'alamat' => $Post['alamat'],
					 'keterangan' => $Post['keterangan']);

		$cek = $this->db->insert('customer', $ins);
		if ($cek) {
			echo "<script>alert('Berhasil Menambahkan Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		} else {
			echo "<script>alert('Gagal Menambahkan Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		}
	}

	public function update_customer($id)
	{
		$Post = $this->input->post();

		$upd = array('nama_customer' => $Post['nama_1'],
					 'no_telf' => $Post['email_1'],
					 'email' => $Post['telf_1'],
					 'alamat' => $Post['alamat_1'],
					 'keterangan' => $Post['keterangan_1']);
		$cek = $this->db->where('id_customer',$id)->update('customer', $upd);
		if ($cek) {
			echo "<script>alert('Berhasil Mengupdate Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		} else {
			echo "<script>alert('Gagal Mengupdate Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		}
	}

	public function delete_customer($id)
	{
		$cek = $this->db->where('id_customer',$id)->delete('customer');
		if ($cek) {
			echo "<script>alert('Berhasil Menghapus Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		} else {
			echo "<script>alert('Gagal Menghapus Customer !'); window.location = '".base_url(
				'Home/customer')."'</script>";
		}
	}

	public function rekapitulasi()
	{
		$data['bagan'] = $this->db->get('bagan_store');
		$data['sub_produk'] = $this->db->get('sub_produk');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan/rekapitulasi',$data);
		$this->load->view('home/layout/footer');
	}

	public function laporan_rekapitulasi()
	{
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$data['produk'] = $this->input->post('produk');
		$data['id_user'] = $this->input->post('user');
		$data['bagan'] = $this->input->post('bagan');
		$user123 = $this->input->post('user');
		$get = $this->db->select('username')->where('id',$user123)->get('users');
		if ($get->num_rows() > 0) {
			$get1 = $get->row();
			$data['user'] = $get1->username;
		} else {
			$data['user'] = "Semua";
		}
		
		$this->load->view('home/laporan/laporan_rekapitulasi',$data);
	}

	public function stock_cerutu()
	{
		$data['produk'] = $this->db->get('produk');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan/stock_cerutu',$data);
		$this->load->view('home/layout/footer');
	}

	public function laporan_stock_cerutu()
	{
		$data['produk'] = $this->db->get('produk');
		$data['merk'] = $this->input->post('merk');
		$data['awal'] = $this->input->post('awal');
		$data['akhir'] = $this->input->post('akhir');
		$this->load->view('home/laporan/laporan_stock_cerutu',$data);
	}

	public function daftar_tagihan()
	{
		$data['bagan'] = $this->db->get('bagan_store');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan/daftar_tagihan',$data);
		$this->load->view('home/layout/footer');
	}

	public function laporan_tagihan_1()
	{
		$post = $this->input->post();
		$data['post'] = $this->input->post();

		$this->db->select('customer.*');
		$this->db->from('customer');
		$this->db->join('users', 'customer.id_users = users.id', 'inner');
		$this->db->like('customer.id_customer', $post['customer'], 'BOTH');
		$this->db->like('customer.id_users', $post['user'], 'BOTH');
		$this->db->like('users.level', $post['bagan'], 'BOTH');
		$data['tagihan'] = $this->db->get();
		$this->load->view('home/laporan/laporan_tagihan', $data);
	}

	public function rincian()
	{
		$data['bagan'] = $this->db->get('bagan_store');
		$data['sistem'] = array('Cash','Transfer','Promosi','Souvenir','VVIP');

		$this->load->view('home/layout/header');
		$this->load->view('home/laporan/rincian',$data);
		$this->load->view('home/layout/footer');
	}

	public function laporan_rincian()
	{
		$Post = $this->input->post();
		$bagan = $Post['bagan'];
		$user = $Post['user'];
		$sistem = $Post['sistem'];
		$awal = $Post['awal'];
		$akhir = $Post['akhir'];

		$db_users = $this->db->select('username')->where('id',$user)->get('users');
		$pp=$db_users->row();
		if ($db_users->num_rows() > 0) { $usr=$pp->username;} else {$usr='';}

		$this->db->select('sub_produk.sub_produk,
						   sub_produk.sub_kode,
						   sub_produk.kemasan,
						   cerutu_terjual.jml as terjual,
						   users.username,
						   customer.nama_customer,
						   penjualan_cerutu.keterangan');
		$this->db->from('cerutu_terjual');
		$this->db->join('sub_produk', 'cerutu_terjual.id_subproduk = sub_produk.id', 'inner');
		$this->db->join('penjualan_cerutu', 'cerutu_terjual.id_penjualan_bagan = penjualan_cerutu.id_penjualan_bagan', 'inner');
		$this->db->join('users', 'penjualan_cerutu.id_users = users.id', 'inner');
		$this->db->join('customer', 'penjualan_cerutu.customer = customer.id_customer', 'inner');
		$this->db->like('penjualan_cerutu.bagan', $bagan, 'BOTH');
		$this->db->like('users.id', $user, 'BOTH');
		$this->db->like('penjualan_cerutu.sistem', $Post['sistem'], 'BOTH');
		$this->db->where("penjualan_cerutu.tanggal BETWEEN '$awal' AND '$akhir'");
		$data['data'] = $this->db->get();

		$data['isi'] = array('user' => $usr,'sistem' => $sistem,'sistem' => $Post['sistem'],'awal' => $awal,'akhir' => $akhir);

		$this->load->view('home/laporan/laporan_rincian', $data);
	}

}