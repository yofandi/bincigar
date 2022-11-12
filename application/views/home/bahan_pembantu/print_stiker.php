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
		<b>LAPORAN STOCK BAHAN PEMBANTU (STIKER) HARI INI</b>
		<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
		<div class="col-lg-12">
			<table class="table table-hover">
        <thead>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>STIKER LUAR</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>STIKER DALAM</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>JUMLAH</td>
            <td></td>
            <td></td>
          </tr>
        </thead>
        <thead class="table-bordered">
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th></th>
            <th>Stock</th>
            <th>Masuk</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th></th>
            <th>Stock</th>
            <th>Masuk</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th></th>
            <th>Stock</th>
            <th>Masuk</th>
            <th>Terpakai</th>
            <th>Sisa</th>
          </tr>
        </thead>
        <tbody class="table-bordered">
          <?php $data = $this->db->order_by('id', 'DESC')->get_where('stiker', array('tanggal' => date('Y-m-d')))->result_array(); 
             $no=1; foreach ($data as $key) {
              ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $key['nama_produk'] ?></td>
              <td></td>
              <td><?php echo $key['stock_l'] ?></td>
              <td><?php echo $key['masuk_l'] ?></td>
              <td><?php echo $key['pakai_l'] ?></td>
              <td><?php echo $key['hasil_l'] ?></td>
              <td></td>
              <td><?php echo $key['stock_d'] ?></td>
              <td><?php echo $key['masuk_d'] ?></td>
              <td><?php echo $key['pakai_d'] ?></td>
              <td><?php echo $key['hasil_d'] ?></td>
              <td></td>
              <td><?php echo $key['stock_j'] ?></td>
              <td><?php echo $key['masuk_j'] ?></td>
              <td><?php echo $key['pakai_j'] ?></td>
              <td><?php echo $key['hasil_j'] ?></td>
            </tr>
            <?php $no++;
            } ?>
        </tbody>
        <tfoot class="bg-success text-light table-bordered  ">
          <?php 
          $output = array('stock_l' => '', 'masuk_l' => '', 'pakai_l' => '', 'hasil_l' => '',
      'stock_d' => '', 'masuk_d' => '', 'pakai_d' => '', 'hasil_d' => '',
    'stock_j' => '', 'masuk_j' => '', 'pakai_j' => '', 'hasil_j' => '');
        
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(stock_l) as total_stock_l');
    $this->db->from('stiker');
    $output['stock_l'] .= $this->db->get()->row()->total_stock_l;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(masuk_l) as total_masuk_l');
    $this->db->from('stiker');
    $output['masuk_l'] .= $this->db->get()->row()->total_masuk_l;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(pakai_l) as total_pakai_l');
    $this->db->from('stiker');
    $output['pakai_l'] .= $this->db->get()->row()->total_pakai_l;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(hasil_l) as total_hasil_l');
    $this->db->from('stiker');
    $output['hasil_l'] .= $this->db->get()->row()->total_hasil_l;

    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(stock_d) as total_stock_d');
    $this->db->from('stiker');
    $output['stock_d'] .= $this->db->get()->row()->total_stock_d;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(masuk_d) as total_masuk_d');
    $this->db->from('stiker');
    $output['masuk_d'] .= $this->db->get()->row()->total_masuk_d;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(pakai_d) as total_pakai_d');
    $this->db->from('stiker');
    $output['pakai_d'] .= $this->db->get()->row()->total_pakai_d;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(hasil_d) as total_hasil_d');
    $this->db->from('stiker');
    $output['hasil_d'] .= $this->db->get()->row()->total_hasil_d;

    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(stock_j) as total_stock_j');
    $this->db->from('stiker');
    $output['stock_j'] .= $this->db->get()->row()->total_stock_j;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(masuk_j) as total_masuk_j');
    $this->db->from('stiker');
    $output['masuk_j'] .= $this->db->get()->row()->total_masuk_j;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(pakai_j) as total_pakai_j');
    $this->db->from('stiker');
    $output['pakai_j'] .= $this->db->get()->row()->total_pakai_j;
    $this->db->where('tanggal', date('Y-m-d'));
    $this->db->select('SUM(hasil_j) as total_hasil_j');
    $this->db->from('stiker');
    $output['hasil_j'] .= $this->db->get()->row()->total_hasil_j;
          ?>
          <tr>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td><?php echo $output['stock_l'] ?></td>
            <td><?php echo $output['masuk_l'] ?></td>
            <td><?php echo $output['pakai_l'] ?></td>
            <td><?php echo $output['hasil_l'] ?></td>
            <td>TOTAL</td>
            <td><?php echo $output['stock_d'] ?></td>
            <td><?php echo $output['masuk_d'] ?></td>
            <td><?php echo $output['pakai_d'] ?></td>
            <td><?php echo $output['hasil_d'] ?></td>
            <td>TOTAL</td>
            <td><?php echo $output['stock_j'] ?></td>
            <td><?php echo $output['masuk_j'] ?></td>
            <td><?php echo $output['pakai_j'] ?></td>
            <td><?php echo $output['hasil_j'] ?></td>
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