<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Laporan Penjualan</title>
</head>
<body id="print">
<div class="col-md-2">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div class="col-md-6">
	<center>LAPORAN PENJUALAN<br>
	Tanggal : <b id="tanggal_awal"><?= $awal ?></b> Sd. <b id="tanggal_akhir"><?= $akhir ?></b></center>
</div><br>
<table class="table table-hover table-bordered">
  <thead class="bg-success text-light" align="center">
   <tr>
      <th>Tanggal</th>
      <th>Bagan</th>
      <th>User</th>
      <th>ID Transaksi</th>
      <th>Produk</th>
      <th>Kode</th>
      <th>Isi</th>
      <th>Kemasan</th>
      <th>Terjual</th>
      <th>HJE (Rp.)</th>
      <th>Diskon</th>
      <th>Ongkir (Rp.)</th>
      <th>Total (Rp.)</th>
      <th>Sistem</th>
      <th>Customer</th>
   </tr>
  </thead>
   <tbody>
    <?php foreach ($db->result() as $key): ?>
    <tr>
      <td><?= $key->tanggal ?></td>
      <td><?= $key->bagan ?></td>
      <td><?= $key->username ?></td>
      <td><?= $key->id_penjualan_bagan ?></td>
      <td><?= $key->sub_produk ?></td>
      <td><?= $key->sub_kode ?></td>
      <td><?= $key->isi ?></td>
      <td><?= $key->kemasan ?></td>
      <td><?= $key->jml ?></td>
      <td><?= $key->hje ?></td>
      <td><?= $key->diskon ?></td>
      <td><?= $key->ongkos ?></td>
      <td><?= $key->total_penj ?></td>
      <td><?= $key->sistem ?></td>
      <td><?= $key->nama_customer ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<div class="col-lg-12" id="show">
  <div class="col-md-12 col-md-offset-12" align="right">
    Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
  </div><br><br>
  <div class="col-md-4"></div><div class="col-md-4"></div><div class="col-md-2"></div>
  <div class="col-md-2" align="center">
    (<b><?= $this->session->userdata('username'); ?></b>)
  </div>
</div>
</body>
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
</html>