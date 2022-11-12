<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Edit Filling / <?php echo $datas['id'] ?></strong>
    </div>
  </div>
</div>
<?php //$filing = $this->db->order_by('id','DESC')->get_where('data_stock', array('kategori' => 'Fillter'))->row_array();?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-success text-light">
      <strong><i class="fa fa-edit"></i> Edit Filling</strong>
    </div>
    <div class="card-body">
      
        <form method="post" action="<?php echo base_url('Proses_produksi/update_filling/'.$datas['id']) ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal :</label>
            <input type="text" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Jenis :</label>
            <input type="text" class="form-control" name="jenis" value="<?php echo $datas['jenis']; ?>" readonly>
            <!-- <input type="hidden" value="<?php echo $filing['jenis'] ?>"> -->
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Produk :</label>
            <select class="form-control" name="produk">
              <?php $data=$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
              <?php foreach ($data as $key): ?>
                <option value="<?php echo $key['produk'] ?>" 
                  <?php if ($key['produk'] == $datas['produk']) {
                   echo 'selected="selected"';
                  } 
                   ?>
                  ><?php echo $key['produk'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Stock :</label>
            <input type="number" step="any" class="form-control" name="stock" value="<?php echo $datas['stock'] ?>" readonly>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="hidden" step="any" name="tpk" value="<?php  echo $datas['terpakai']; ?>">
            <input type="number" step="any" name="terpakai" class="form-control" value="<?php echo $datas['terpakai'] ?>">
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Batang Cerutu Yang Di Hasilkan :</label>
            <input type="hidden" name="hs_cr" class="form-control" value="<?php echo $datas['hasil'] ?>">
            <input type="number" name="hasil" class="form-control" value="<?php echo $datas['hasil'] ?>">
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
