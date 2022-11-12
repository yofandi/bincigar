<style>
  table {text-align: center;}
  thead{text-transform: uppercase;}
  table tr th {text-align: center;}
  #show {text-align: center;}
  select {text-align-last: center;padding-right: 29px;}
</style>
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Penjualan</strong>
    </div>
  </div>
</div>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <b><i class="fa fa-book"></i> Semua Laporan Penjualan</b>
    </div>
    <div class="card-body">
    <form action="<?= base_url('Marketing/cari_penjualan_1') ?>" method="post">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Bagan :</label>
            <select name="bagan" id="bagan" class="form-control">
              <option value="">--- Pilih Bagan ---</option>
              <?php foreach ($bagan->result() as $lue): ?>
              <option value="<?= $lue->nama ?>"><?= $lue->nama ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>User :</label>
            <select name="user" id="user" class="form-control">
               <option value="">--- Pilih User ---</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Customer :</label>
            <select name="customer" id="customer" class="form-control">
               <option value="">--- Pilih Customer ---</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Produk :</label>
            <select name="produk" id="produk" class="form-control">
              <option value="">--- Pilih Produk ---</option>
              <?php foreach ($produk->result() as $key): ?>
              <option value="<?= $key->id ?>"><?= $key->produk ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Sub Produk :</label>
            <select name="subproduk" id="subproduk" class="form-control">
              <option value="">--- Pilih Sub Produk ---</option>
            </select>
          </div>
        </div>
        <div class="col-lg-5">
          <input type="text" id="awal2" name="awal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-lg-2" align="center">
          Sd.
        </div>
        <div class="col-lg-5">
          <input type="text" id="akhir2" name="akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-info" type="submit"><i class="fa fa-print"></i> Print</button> 
    </div>
    </form>
  </div>
</div>
<script>
	$(document).ready(function(){
	    jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
	    jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	    jQuery('#awal2').datepicker({format : 'yyyy-mm-dd'});
	    jQuery('#akhir2').datepicker({format : 'yyyy-mm-dd'});
	    jQuery('#table_ku').DataTable({
	        responsive: true
	    });
	  });

  $('#bagan').change(function(event) {
    var bagan = $(this).val();
    $.ajax({
      url: '<?= base_url("Marketing/pilih_user/") ?>'+bagan,
      type: 'POST',
      dataType: 'json',
      success : function (data) {
        $('#user').html(data);

        $('#user').change(function(event1) {
          var user = $(this).val();
          $.ajax({
            url: '<?= base_url("Home/show_customer/") ?>'+user,
            type: 'POST',
            dataType: 'json',
            success : function (isi) {
              $('#customer').html(isi);
            }
          })

        });
      }
    })

  });

  $('#produk').change(function(event) {
    var produk = $(this).val();

    $.ajax({
      url: '<?= base_url("Marketing/c_p/") ?>'+produk,
      type: 'POST',
      dataType: 'json',
      success : function (show) {
        $('#subproduk').html(show);
      }
    })

  });
</script>