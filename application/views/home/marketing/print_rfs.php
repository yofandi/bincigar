<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Print Ready For Sale</title>
</head>
<body id="print">
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
  <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
	<center>
		<b>LAPORAN READY FOR SALE HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-8">
			<table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Merk</th>
            <th>Kemasan</th>
            <th>Isi</th>
            <th>Stock</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Sisa</th>
            <th>Ket</th>
            <!-- <th>Masuk</th> -->
          </tr>
        </thead>
        <tbody>
        	<?php $data = $this->db->order_by('id', 'DESC')->get_where('rfs', array('tanggal' => date('Y-m-d')))->result_array(); ?>
        	<?php $no=1; foreach ($data as $key): ?>
        		<tr>
        			<td><?php echo $no; ?></td>
        			<td><?php echo $key['sub_produk'] ?></td>
        			<td><?php echo $key['kemasan'] ?></td>
        			<td><?php echo $key['isi'] ?></td>
        			<td><?php echo $key['stock'] ?></td>
        			<td><?php echo $key['masuk'] ?></td>
              <td><?php echo $key['keluar'] ?></td>
              <td><?php echo $key['sisa'] ?></td>
              <td><?php echo $key['ket'] ?></td>
        		</tr>
        	<?php $no++; endforeach ?>
        </tbody>
        <tfoot class="bg-success text-light">
        	<?php 
	            $this->db->where('tanggal', date('Y-m-d'));
	            $this->db->select('SUM(stock) as total_stock');
	            $this->db->from('rfs');
	            $total_stock = $this->db->get()->row()->total_stock;

	             $this->db->where('tanggal', date('Y-m-d'));
	            $this->db->select('SUM(masuk) as total_masuk');
	            $this->db->from('rfs');
	            $total_masuk = $this->db->get()->row()->total_masuk;

	             $this->db->where('tanggal', date('Y-m-d'));
	            $this->db->select('SUM(sisa) as total_sisa');
	            $this->db->from('rfs');
	            $total_sisa = $this->db->get()->row()->total_sisa;

              $this->db->where('tanggal', date('Y-m-d'));
              $this->db->select('SUM(keluar) as total_keluar');
              $this->db->from('rfs');
              $total_keluar = $this->db->get()->row()->total_keluar;
        	?>
        	<tr>
        		<td></td>
        		<td>TOTAL</td>
        		<td></td><td></td>
        		<td><?php echo $total_stock ?></td>
        		<td><?php echo $total_masuk ?></td>
        		<td><?php echo $total_keluar ?></td>
            <td><?php echo $total_sisa ?></td>
            <td></td>
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