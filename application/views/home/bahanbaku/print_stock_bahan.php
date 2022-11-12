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
  #show {text-align: center;}
</style>
<body id="print">

<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $stock = $this->db->order_by('id', 'DESC')->get('data_stock')->result_array(); ?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
  <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
	<center>
		<b>LAPORAN STOCK BAHAN HARI INI</b>
		<br>Tanggal : <?php echo $bulan[date('m')].' '.date('Y'); ?><!-- date('d').' '. -->
		<div class="col-lg-12">
			<table class="table table-hover">
        <thead class="bg-info text-light">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Asal</th>
            <th>Jenis</th>
            <th>Kategori</th>
            <th>Masuk</th>
            <th>DiTerima</th>
            <th>DiProduksi</th>
            <th>Stok Sisa</th>
            <th>Ket</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($stock as $keysss) {
            ?>
          <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $keysss['tanggal'] ?></td>
            <td><?php echo $keysss['asal'] ?></td>
            <td><?php echo $keysss['jenis'] ?></td>
            <td><?php echo $keysss['kategori'] ?></td>
            <td><?php echo $keysss['stock_masuk'] ?></td>
            <td><?php echo $keysss['diterima'] ?></td>
            <td><?php echo $keysss['diproduksi'] ?></td>
            <td><?php echo $keysss['hari_ini'] ?></td>
            <td><?php echo $keysss['ket'] ?></td>
          <?php $no++;
          } ?>
        </tbody>
        <tfoot class="bg-success text-light">
          <?php 
          $output = array('masuk' => '', 'diterima' => '', 'diproduksi' => '', 'hari_ini' => '');
      
              $this->db->select('SUM(stock_masuk) as masuk');
              $this->db->from('data_stock');
              $output['masuk'] .= $this->db->get()->row()->masuk;

              $this->db->select('SUM(diterima) as diterima');
              $this->db->from('data_stock');
              $output['diterima'] .= $this->db->get()->row()->diterima;

              $this->db->select('SUM(diproduksi) as diproduksi');
              $this->db->from('data_stock');
              $output['diproduksi'] .= $this->db->get()->row()->diproduksi;

              $this->db->select('SUM(hari_ini) as hari_ini');
              $this->db->from('data_stock');
              $output['hari_ini'] .= $this->db->get()->row()->hari_ini;
          ?>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>TOTAL</th>
            <th> : </th>
            <th><?php echo $output['masuk'] ?></th>
            <th><?php echo $output['diterima'] ?></th>
            <th><?php echo $output['diproduksi'] ?></th>
            <th><?php echo $output['hari_ini'] ?></th>
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
