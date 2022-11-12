<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>&nbsp</title>
</head>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<body id="print">
<div class="col-md-4">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 150px">
</div>
<div class="col-md-8">
	<h4>BOS IMAGE NUSANTARA</h4><br> <!-- id="font" -->
	<h6>Office : Brawijaya Street No.5, Jubung, Jember 68151 <br>
	Phone Office : +62 331 487 135 <br> Fax Office : +62 331 481 085 <br>Email : info@bincigar.com - marketing@bincigar.com <br>Website : <a href="www.bincigar.com">www.bincigar.com</a></h6>
</div> <br>
<div class="col-lg-12" align="center">
	<hr style="width: 100%;">
	<b>Daftar Tagihan</b><br>
</div>
<table class="table table-bordered" style="font-size: 12px;">
	<thead align="center">
		<tr>
			<th>No.</th>
			<th>Nama</th>
			<th>Total Harga Cerutu (Rp.)</th>
			<th>Diskon (%)</th>
			<th>Ongkir (Rp.)</th>
			<th>Jumlah (Rp.)</th>
			<th>Yang Dibayar (Rp.)</th>
			<th>Yang Harus Dibayar (Rp.)</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; 
		$jum_tot_cerutu = 0;
		$jum_yang_dibayar = 0;
		$jum_ongkos = 0;
		$jum_jumlah = 0;
		$jum_yangharus = 0;
		foreach ($tagihan->result() as $key): 
		$this->db->select('SUM(piutang.yang_dibayar) as yang_dibayar,
						   MIN(piutang.kurang) as kurang,
						   penjualan_cerutu.harga_semua_cerutu,
						   penjualan_cerutu.diskon,
						   penjualan_cerutu.ongkos,
						   penjualan_cerutu.total,
						   penjualan_cerutu.yang_dibayar,
						   penjualan_cerutu.keterangan
						   ');
		$this->db->from('penjualan_cerutu');
		$this->db->join('piutang', 'penjualan_cerutu.id_penjualan_bagan = piutang.id_penjualan_bagan', 'inner');
		$this->db->where('penjualan_cerutu.customer',$key->id_customer);
		$this->db->where('piutang.status_pembayaran', '1');
		$this->db->like('penjualan_cerutu.bagan', $post['bagan'], 'BOTH');
		$this->db->limit(1);
		$tampil = $this->db->get()->row();
		?>
		<tr>
			<td align="center"><?= $no++ ?></td>
			<td align="center"><?= $key->nama_customer ?></td>
			<td align="right"><?= number_format($tampil->harga_semua_cerutu,2,',','.') ?></td>
			<td align="center"><?= $tampil->diskon ?></td>
			<td align="right"><?= number_format($tampil->ongkos,2,',','.') ?></td>
			<td align="right"><?= number_format($tampil->total,2,',','.') ?></td>
			<td align="right"><?= number_format($tampil->yang_dibayar,2,',','.') ?></td>
			<td align="right"><?= number_format($tampil->kurang,2,',','.') ?></td>
			<td><?= $tampil->keterangan ?></td>
		</tr>
		<?php 
		$jum_tot_cerutu += $tampil->harga_semua_cerutu;
		$jum_ongkos += $tampil->ongkos;
		$jum_jumlah += $tampil->total;
		$jum_yang_dibayar += $tampil->yang_dibayar;
		$jum_yangharus += $tampil->kurang;
	    endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<td align="center" colspan="2">Total</td>
			<td align="right"><?= number_format($jum_tot_cerutu,2,',','.') ?></td>
			<td></td>
			<td align="right"><?= number_format($jum_ongkos,2,',','.') ?></td>
			<td align="right"><?= number_format($jum_jumlah,2,',','.') ?></td>
			<td align="right"><?= number_format($jum_yang_dibayar,2,',','.') ?></td>
			<td align="right"><?= number_format($jum_yangharus,2,',','.') ?></td>
			<td></td>
		</tr>
	</tfoot>
</table>
<div class="col-lg-12">
  <div class="col-md-3"></div>
  <div class="col-md-3"></div>
  <div class="col-md-3"></div>
  <div class="col-md-3" align="center"><br>
  	Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?><br><br><br><br>
    (<u><?php echo $this->session->userdata('username'); ?></u>)<br>
    <?php if ($post['bagan'] == "") {
    	echo $this->session->userdata('level');
    } else {
    	echo $post['bagan'];
    }
     ?>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function(){
		var restorpage = document.body.innerHTML;
		   var printcontent = document.getElementById('print').innerHTML;
		   document.body.innerHTML = printcontent;
		   window.print();
		   document.body.innerHTML = restorpage;
       window.history.back();
	})
</script>
</body>
</html>