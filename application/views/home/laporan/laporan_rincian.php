<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Rincian</title>
</head>
<body id="print">
<?php 
  $bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
  $setting = $this->db->get_where('setting', array('id' => 1))->row_array();
?>
<div class="col-md-4">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div class="col-md-4" align="center">
	<b>Laporan Rincian Biaya <?php if ($isi['sistem'] == '') {echo "Semua";} else {echo $isi['sistem'];}?></b><br>
	<b>User : <?php if ($isi['user'] == '') {echo "Semua";} else {echo $isi['user'];}?></b><br>
	<text>Tanggal : <b><?= $isi['awal'] ?></b> Sd. <b><?= $isi['akhir'] ?></b></text>
</div><br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No.</th>
			<th>Nama Produk</th>
			<th>Isi</th>
			<th>Jumlah</th>
			<th>Dari</th>
			<th>Diberikan Untuk</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 1;
		$jumlah = 0;
		foreach ($data->result() as $key): ?>
		<tr>
			<td align="center"><?= $no++ ?></td>
			<td><?= $key->sub_produk." || ".$key->sub_kode ?></td>
			<td align="center"><?= $key->kemasan ?></td>
			<td align="center"><?= $key->terjual ?></td>
			<td><?= $key->username ?></td>
			<td><?= $key->nama_customer ?></td>
			<td><?= $key->keterangan ?></td>
		</tr>
		<?php 
		$jumlah += $key->terjual;
		endforeach ?>
		<tr>
			<td colspan="3" align="center">Jumlah</td>
			<td align="center"><?= $jumlah ?></td>
			<td colspan="3"></td>
		</tr>
	</tbody>
</table>
<div class="col-lg-12" id="show">
  <div class="col-md-12 col-md-offset-12" align="right">
    Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
  </div><br><br>
  <div class="col-md-3"><br><br><br>
    (<u><?php echo $setting['direktur'] ?></u>)<br>
    Direktur Operasional
  </div>
  <div class="col-md-3"></div>
  <div class="col-md-3"></div>
  <div class="col-md-3"><br><br><br>
    (<u><?= $setting['rfs'] ?></u>)<br>
    Ready For Sale
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