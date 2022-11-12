<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Edit Pressing / <?php echo $datas['id'] ?></strong>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-success text-light">
      <strong><i class="fa fa-edit"></i> Edit Proses Pressing</strong>
    </div>
    <div class="card-body">
      
        <form method="post" action="<?php echo base_url('proses_produksi/update_pressing/'.$datas['id']) ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal :</label>
            <input type="text" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <?php $binding = $this->db->order_by('id','DESC')->get('binding')->row_array(); ?>
          <label>Produk/Merek :</label>
          <input type="text" class="form-control" name="produk" value="<?php echo $datas['produk'] ?>" readonly>
        </div>
        <div class="col-lg-6">
          <label>Jenis Tembakau :</label>
          <input type="text" class="form-control" name="jenis" value="<?php echo $datas['jenis'] ?>" readonly>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Batang Cerutu Yang Di Hasilkan Sebelumnya :</label>
            <input type="number" step="any" class="form-control" name="hasil" value="<?php echo $datas['hasil'] ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6">
          <label>Cerutu Yang Di tambahkan :</label>
          <input type="hidden" step="any" name="ad_td" value="<?php echo $datas['tambah_cerutu']; ?>">
          <input type="number" step="any" name="tambah_cerutu" class="form-control" value="<?php echo $datas['tambah_cerutu']; ?>">
        </div>
        <div class="col-lg-12">
          <div class="col-lg-6">
          <div class="form-group">
            <label>Lama Proses</label>
            <input type="text" name="lama" class="form-control" value="<?php echo $datas['lama'] ?>">
            <small>4 Jam, 30 Menit</small>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Keterangan : </label>
            <textarea class="form-control" name="ket"><?php echo $datas['ket'] ?></textarea>
          </div>
        </div>
        </div>
      
    </div>
    <div class="card-footer">
      <button class="btn btn-danger pull-right" type="submit"><i class="fa fa-save"></i> Update</button>
    </div></form>
  </div>
</div>

<script>
  $(document).ready(function(){
    jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
  });
</script>
