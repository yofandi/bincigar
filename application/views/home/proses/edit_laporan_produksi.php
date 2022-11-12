<style>
  table {text-align: center;}
  table tr th {text-align: center;}
</style> 
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Laporan Produksi / Edit / <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-primary text-light">
			<strong><i class="fa fa-edit"></i> Edit Laporan Produksi ID : <?php echo $data['id'] ?></strong>
			<!-- <div class="pull-right"></div> -->
		</div>
    <div class="card-body">
      <form method="post" action="<?php echo base_url('proses_produksi/update_laporan_produksi/'.$data['id']) ?>">
      <div class="col-lg-6">
        <div class="form-group">
          <div class="form-group">
            <label>Produk/Merek :</label>
            <select class="form-control" name="produk">
              <?php $merek = $this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
              <?php foreach ($merek as $produk): ?>
                <option value="<?php echo $produk['produk'] ?>"><?php echo $produk['produk'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah :</label>
            <input type="text" name="jumlah" class="form-control" value="<?php echo $data['jumlah'] ?>">
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
            <label>Jenis Tembakau :</label>
            <select class="form-control" name="jenis">
              <?php $jenis = $this->db->order_by('id','ASC')->get('jenis')->result_array(); ?>
              <?php foreach ($jenis as $jeniss): ?>
                <option value="<?php echo $jeniss['jenis'] ?>"><?php echo $jeniss['jenis'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Dekblad :</label>
            <input type="text" name="dek" class="form-control" value="<?php echo $data['dek'] ?>">
          </div>
          <div class="form-group">
            <label>Omblad :</label>
            <input type="text" name="omb" class="form-control" value="<?php echo $data['omb'] ?>">
          </div>
          <div class="form-group">
            <label>Fillter :</label>
            <input type="text" name="fill" class="form-control" value="<?php echo $data['fill'] ?>">
          </div>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-danger" type="submit"><i class="fa fa-save"></i> Update</button>
    </div></form>
	</div>
</div>