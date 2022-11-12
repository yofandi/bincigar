<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Print Laporan Cukai</title>
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
		<b>LAPORAN STOCK BAHAN PEMBANTU (CUKAI) HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-12">
			<table class="table table-hover">
        <thead class="bg-info text-light">
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Kode</th>
            <th>Isi</th>
            <th>HJE</th>
            <th>Tarif</th>
            <th>Cukai Lama</th>
            <th>Cukai Baru</th>
            <th>Jumlah Stock</th>
            <th>Cukai Lama Terpakai</th>
            <th>Cukai Baru Terpakai</th>
            <th>Stock Akhir</th>
          </tr>
        </thead>
        <tbody>
          <?php $data = $this->db->order_by('id', 'ASC')->get_where('cukai', array('tanggal' => date('Y-m-d')))->result_array(); 
          $no = 1;
          $sum_lama = 0;
          $sum_baru = 0;
          $sum_jar = 0;
          $sum_semua = 0;
          $sum_masing = 0;
          $sum_jumlah = 0;
          foreach ($data as $key): 
            $sum_lama += $key['lama'];
            $sum_baru += $key['baru'];

            $set = $key['lama'] + $key['baru'];
            $sum_jar += $set;

            $sum_semua += $key['semua'];
            $sum_masing += $key['masing'];
            $sum_jumlah += $key['jumlah'];
          ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $key['subproduk'] ?></td>
              <td><?php echo $key['sub_kode'] ?></td>
              <td><?php echo $key['isi'] ?></td>
              <td style="text-align: right;"><?php echo 'Rp.'.number_format($key['hje'],2,',','.'); ?></td>
              <td style="text-align: right;"><?php echo 'Rp.'.number_format($key['tarif'],2,',','.'); ?></td>
              <td><?php echo $key['lama'] ?></td>
              <td><?php echo $key['baru'] ?></td>
              <td><?= $set ?></td>
              <td><?php echo $key['semua'] ?></td>
              <td><?php echo $key['masing'] ?></td>
              <td><?php echo $key['jumlah'] ?></td>
              <!-- <td><?php echo $key['subproduk'] ?></td> -->
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot class="bg-info text-light">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>TOTAL</th>
            <th>:</th>
            <th><?= $sum_lama ?></th>
            <th><?= $sum_baru ?></th>
            <th><?= $sum_jar ?></th>
            <th><?= $sum_semua ?></th>
            <th><?= $sum_masing ?></th>
            <th><?= $sum_jumlah ?></th>
          </tr>
        </tfoot>
      </table>
      <div class="col-lg-12" id="show">
        <div class="col-md-12 col-md-offset-12" align="right">
          Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        </div><br><br>
        <div class="col-md-3">
          (<u><?php echo $setting['direktur'] ?></u>)<br><br><br>
          Direktur Operasional
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
          (<u><?php echo $setting['qc'] ?></u>)<br><br><br>
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