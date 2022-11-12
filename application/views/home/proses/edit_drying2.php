<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Edit Drying2 / <?php echo $datas['id'] ?></strong>
    </div>
  </div>
</div>
<?php $filing = $this->db->order_by('id','DESC')->get('data_stock')->row_array();?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-success text-light">
      <strong><i class="fa fa-edit"></i> Edit Proses Drying2</strong>
    </div>
    <div class="card-body">
      
        <form method="post" action="<?php echo base_url('Proses_produksi/update_drying2/'.$datas['id']) ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal :</label>
            <input type="text" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <label>Produk/Merek :</label>
          <input type="text" name="produk" value="<?php echo $datas['produk'] ?>" class="form-control" readonly>
        </div>
        <div class="col-lg-6">
          <label>Jenis Tembakau :</label>
          <input type="text" name="jenis" value="<?php echo $datas['jenis'] ?>" class="form-control" readonly>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Batang Cerutu Yang Di Hasilkan Sebelumnya :</label>
            <input type="number" class="form-control" name="hasil" value="<?php echo $datas['hasil'] ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6">
          <label>Cerutu Yang Di tambahkan :</label>
          <input type="hidden" name="ad_sb" class="form-control" value="<?php echo $datas['tambah_cerutu'] ?>">
          <input type="number" name="tambah_cerutu" class="form-control" value="<?php echo $datas['tambah_cerutu'] ?>">
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
