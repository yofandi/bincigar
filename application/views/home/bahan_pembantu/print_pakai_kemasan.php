<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
  <title>Print Laporan Stock Kemasan</title>
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
    <b>LAPORAN STOCK BAHAN PEMBANTU (KEMASAN) HARI INI</b>
    <br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
    <div class="col-lg-12">
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th class="bg-danger text-light">Kemasan</th>
            <th>Stock Awal</th>
            <th>Masuk</th>
            <th>Sisa Stock</th>
            <th>Terpakai</th>
            <th>Afkir</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php $data = $this->db->order_by('id', 'ASC')->get_where('pakai_kemasan', array('tanggal' => date('Y-m-d')))->result_array(); ?>
          <?php $no=1; foreach ($data as $key): ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $key['produk'] ?></td>
              <td><?php echo $key['kemasan'] ?></td>
              <td><?php echo $key['awal'] ?></td>
              <td><?php echo $key['masuk'] ?></td>
              <td><?php echo $key['sisa'] ?></td>
              <td><?php echo $key['terpakai'] ?></td>
              <td><?php echo $key['afkir'] ?></td>
              <td><?php echo $key['stock'] ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
          <tfoot class="bg-success text-light">
            <?php 
          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(awal) as total_awal');
          $this->db->from('pakai_kemasan');
          $awal = $this->db->get()->row()->total_awal;

          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(masuk) as total_masuk');
          $this->db->from('pakai_kemasan');
          $masuk = $this->db->get()->row()->total_masuk;

          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(sisa) as total_sisa');
          $this->db->from('pakai_kemasan');
          $sisa = $this->db->get()->row()->total_sisa;

          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(terpakai) as total_terpakai');
          $this->db->from('pakai_kemasan');
          $terpakai = $this->db->get()->row()->total_terpakai;

          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(afkir) as total_afkir');
          $this->db->from('pakai_kemasan');
          $afkir = $this->db->get()->row()->total_afkir;

          $this->db->where('tanggal', date('Y-m-d'));
          $this->db->select('SUM(stock) as total_stock');
          $this->db->from('pakai_kemasan');
          $stock = $this->db->get()->row()->total_stock;
            ?>
            <tr>
              <td></td>
              <td>TOTAL</td>
              <td>:</td>
              <td><?php echo $awal ?></td>
              <td><?php echo $masuk ?></td>
              <td><?php echo $sisa ?></td>
              <td><?php echo $terpakai ?></td>
              <td><?php echo $afkir ?></td>
              <td><?php echo $stock ?></td>

            </tr>
          </tfoot>
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