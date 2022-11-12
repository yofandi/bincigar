<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
	<title>Print Penjualan</title>
</head>
<body id="print">
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
	<center>
		<b>LAPORAN PRODUKSI DAN BAHAN PRODUK HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-8">
			<table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk/Merek</th>
            <th>Jumlah</th>
            <th>Jenis</th>
            <th>Dek</th>
            <th>Omb</th>
            <th>Fill</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $data= $this->db->get_where('laporan_produksi', array('tanggal' => date('Y-m-d')))->result_array(); ?>
          <?php $no=1; foreach ($data as $key): ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $key['produk'] ?></td>
              <td><?php echo $key['jumlah'] ?></td>
              <td><?php echo $key['jenis'] ?></td>
              <td><?php echo $key['dek'] ?></td>
              <td><?php echo $key['omb'] ?></td>
              <td><?php echo $key['dek'] ?></td>
            </tr>
          <?php $no++; endforeach ?>
        </tbody>
        <tfoot class="bg-success text-light"></tfoot>
      </table>
      <div class="col-lg-12">
          <div style="margin-left: 600px">Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?></div><br><br>
          (<u><?php echo $setting['direktur'] ?></u>)<b style="margin-right: 300px"></b>(<u><?php echo $setting['qc'] ?></u>)
          <br>Direktur Operasional<b style="margin-right: 300px"></b>Quality Control     
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
		})
	</script>
</body>
</html>