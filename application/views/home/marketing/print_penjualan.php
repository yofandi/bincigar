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
  thead{text-transform: uppercase;}
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
		<b>LAPORAN PENJUALAN HARI INI</b>
		<br>Tanggal : <?= '<b>'.$awal.'</b> Sd. <b>'.$akhir.'</b>' ?>
		<div class="col-lg-12">
			<table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>Produk</th>
            <th>Kode</th>
            <th>Packing</th>
            <th>Isi</th>
            <th>Stok Awal</th>
            <th>Keluar</th>
            <th>Sisa Stok</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $no = 1; 
          $stock = 0;
          $keluar = 0;
          $sisa = 0;
          foreach ($produk as $key): 
          $this->db->select('sub_produk.sub_produk,
                             sub_produk.sub_kode,
                             sub_produk.kemasan,
                             sub_produk.isi,
                             SUM(penjualan.stock) as stock,
                             SUM(penjualan.keluar) as keluar,
                             SUM(penjualan.sisa) as sisa,
                             penjualan.keterangan');
          $this->db->from('sub_produk'); 
          $this->db->join('penjualan', 'sub_produk.id = penjualan.id_subproduk', 'left');
          $this->db->where('penjualan.id_subproduk', $key);
          $this->db->where("penjualan.tanggal BETWEEN '$awal' AND '$akhir'");
          $db = $this->db->get()->row();

          $stock += $db->stock;
          $keluar += $db->keluar;
          $sisa += $db->sisa;
          ?>            
          <tr>
            <td><?= $no ?></td>
            <td><?= $db->sub_produk ?></td>
            <td><?= $db->sub_kode ?></td>
            <td><?= $db->kemasan ?></td>
            <td><?= $db->isi ?></td>
            <td><?= $db->stock ?></td>
            <td><?= $db->keluar ?></td>
            <td><?= $db->sisa ?></td>
            <td><?= $db->keterangan ?></td>
          </tr>
          <?php $no++; endforeach ?>
        </tbody>
        <footer>
          <tr>
            <td colspan="5"></td>
            <td><?= $stock ?></td>
            <td><?= $keluar ?></td>
            <td><?= $sisa ?></td>
            <td></td>
          </tr>
        </footer>
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
          (<u><?php echo $setting['qc'] ?></u>)<br>
          Quality Control
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