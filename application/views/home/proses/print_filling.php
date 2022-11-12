<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Print Penjualan</title>
</head>
<style>
  table {text-align: center;}
  table tr th {text-align: center;}
</style>
<body id="print">
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
  <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
	<center>
		<b>LAPORAN PROSES PRODUKSI (FILLING) HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-8">
			<table class="table table-hover table-bordered">
        
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jenis</th>
            <th>Stock</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th class="bg-info text-light">Jumlah Batang</th>
          </tr>
        </thead>
        <tbody>
          <?php $data=$this->db->order_by('id','desc')->get('filling')->result_array(); ?>
          <?php $no=1;foreach ($data as $key): ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $key['produk'] ?></td>
              <td><?php echo $key['jenis'] ?></td>
              <td><?php echo $key['stock'] ?></td>
              <td><?php echo $key['terpakai'] ?></td>
              <td><?php echo $key['sisa'] ?></td>
              <td><?php echo $key['hasil'] ?></td>
            </tr>
          <?php $no++;endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th></th><th>JUMLAH</th><th></th>
            <th>
              <?php echo $this->db->select('SUM(stock) as stock')->get('filling')->row()->stock; ?>
            </th>
            <th>
              <?php echo $this->db->select('SUM(terpakai) as terpakai')->get('filling')->row()->terpakai; ?>
            </th>
            <th>
              <?php echo $this->db->select('SUM(sisa) as sisa')->get('filling')->row()->sisa; ?>
            </th>
            <th>
              <?php echo $this->db->select('SUM(hasil) as hasil')->get('filling')->row()->hasil; ?>
            </th>
          </tr>
        </tfoot>
      </table>
      <div class="col-lg-12" id="show">
        <div class="col-md-12 col-md-offset-12" align="right">
          Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        </div><br><br><br><br>
        <div class="col-md-3">
          (<u><?php echo $setting['direktur'] ?></u>)<br>
          Direktur Operasional
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
          (<u><?php echo $setting['kabag'] ?></u>)<br>
          Kabag. Produksi
        </div>
      </div>
	</center>

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