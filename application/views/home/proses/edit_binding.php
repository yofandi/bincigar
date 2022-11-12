<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Edit Binding / <?php echo $datas['id'] ?></strong>
    </div>
  </div>
</div>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-success text-light">
      <strong><i class="fa fa-edit"></i> Edit Binding</strong>
    </div>
    <div class="card-body">
      <?php $binding = $this->db->order_by('id','DESC')->get_where('data_stock', array('kategori'=>'Omblad'))->row_array();?>
        <form method="post" action="<?php echo base_url('Proses_produksi/update_binding/'.$datas['id']) ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal :</label>
            <input type="text" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Stock Bakau (Omblad):</label>
            <input type="number" step="any" class="form-control" name="stock" value="<?php echo $datas['stock'] ?>" readonly>
            <input type="hidden" name="produk" value="<?php echo $datas['produk']; ?>">
            <input type="hidden" name="jenis" value="<?php echo $datas['jenis']; ?>">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="hidden" step="any" name="tpk" value="<?php echo $datas['terpakai'] ?>">
            <input type="number" step="any" name="terpakai" class="form-control" value="<?php echo $datas['terpakai'] ?>">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Batang Cerutu Yang Di Hasilkan Sebelumnya :</label>
            <input type="number" name="hasil" class="form-control" value="<?php echo $datas['hasil']; ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6">
          <label>Cerutu yang ditambahkan :</label>
          <input type="hidden" name="ad_sb" value="<?php echo $datas['tambah_cerutu']; ?>">
          <input type="number" name="tambah_cerutu" class="form-control" value="<?php echo $datas['tambah_cerutu'] ?>">
        </div>
        <div class="col-lg-12">
          <label>Keterangan : </label>
          <textarea class="form-control" name="ket"><?php echo $datas['ket'] ?></textarea>
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
