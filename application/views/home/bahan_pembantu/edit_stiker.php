<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Striker / <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<strong><i class="fa fa-edit"></i> Edit Bahan Pembantu ( Striker )</strong>
		</div>
		<div class="card-body">
			<form  method="post" action="<?php echo base_url('Bahan_pembantu/update_stiker/'.$data['id']) ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Nama Produk :</label>
            <?php $produk = $this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
            <select name="nama" class="form-control">
              <?php foreach ($produk as $key): ?>
                <option value="<?php echo $key['produk'] ?>" <?php if ($key['produk'] == $data['nama_produk']): ?>
                  selected
                <?php endif ?> ><?php echo $key['produk'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <b><i class="fa fa-plus-circle"></i> Stiker Luar</b>
          <?php $stock = $this->db->get_where('stock_stiker', array('produk' => $data['nama_produk']))->row_array(); ?>
          <input type="hidden" name="stockstlnow" value="<?= $stock['stock_luar'] ?>">
          <input type="hidden" name="stockstdnow" value="<?= $stock['stock_dalam'] ?>">
          <div class="form-group">
            <label>Stock Awal :</label>
            <input type="text" name="stock_l" value="<?php echo $data['stock_l'] ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Masuk :</label>
            <input type="number" name="masuk_l" class="form-control" value="<?php echo $data['masuk_l'] ?>">
            <input type="hidden" name="msk_sbl" value="<?php echo $data['masuk_l'] ?>">
          </div>
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="number" name="pakai_l" class="form-control" value="<?php echo $data['pakai_l'] ?>">
            <input type="hidden" name="pakai_sbl" value="<?php echo $data['pakai_l'] ?>">
          </div>
        </div>
        <div class="col-lg-6">
          <b><i class="fa fa-plus-circle"></i> Stiker Dalam</b>
          <div class="form-group">
            <label>Stock Awal :</label>
            <input type="text" name="stock_d" value="<?php echo $data['stock_d'] ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Masuk :</label>
            <input type="number" name="masuk_d" class="form-control" value="<?php echo $data['masuk_d'] ?>">
            <input type="hidden" name="msk_sbd" value="<?php echo $data['masuk_d'] ?>">
          </div>
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="number" name="pakai_d" class="form-control" value="<?php echo $data['pakai_d'] ?>">
            <input type="hidden" name="pakai_sbd" value="<?php echo $data['pakai_d'] ?>">
          </div>
        </div>
       
		</div>
		<div class="card-footer">
			<button class="btn btn-success pull-right" type="submit">Update</button>
		</div>	</form>
	</div>
</div>