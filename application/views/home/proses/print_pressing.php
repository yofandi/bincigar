<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Print Proses Pressing</title>
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
		<b>LAPORAN PROSES PRODUKSI (PRESSING) HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-12">
			<table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jenis</th>
            <th>Lama Proses</th>
            <th>Awal Stock</th>
            <th>Mutasi</th>
            <th class="bg-info text-light">Jumlah Batang</th>
            <th>KET</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1;foreach ($data as $key): ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $key['produk'] ?></td>
              <td><?php echo $key['jenis'] ?></td>
              <td><?php echo $key['lama'] ?></td>
              <td><?php echo $key['hasil'] ?></td>
              <td><?php echo $key['tambah_cerutu'] ?></td>
              <td><?php echo $key['hasil_akhir'] ?></td>
              <td><?php echo $key['ket'] ?></td>
            </tr>
          <?php $no++;endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th></th><th>JUMLAH</th><th></th><th></th>
            <th>
              <?php echo $this->db->select('SUM(hasil) as hasil')->get('pressing')->row()->hasil; ?>
            </th>
            <th>
              <?php echo $this->db->select('SUM(tambah_cerutu) as tambah_cerutu')->get('pressing')->row()->tambah_cerutu; ?>
            </th>
            <th>
              <?php echo $this->db->select('SUM(hasil_akhir) as hasil_akhir')->get('pressing')->row()->hasil_akhir; ?>
            </th>
            
            <th></th>
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