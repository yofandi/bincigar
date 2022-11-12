<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Edit Penjualan / <?php echo $id; ?></strong>
    </div>
  </div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-edit"></i> Edit Penjualan ID : <?php echo $id; ?></b>	
		</div>	
		<div class="card-body">
		<form action="<?= base_url('Marketing/update_penjualan/'.$id) ?>" method="post">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Tanggal :</label>
					<input type="text" name="tanggal" class="form-control" value="<?= $data->tanggal ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan :</label>
					<input type="text" name="bagan" class="form-control" value="<?= $data->bagan ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Username :</label>
					<input type="text" name="for_user" class="form-control" value="<?= $data->for_user ?>" readonly>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Produk :</label>
					<input type="text" name="produk" class="form-control" value="<?= $data->produk ?>" readonly>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Sub Produk :</label>
					<input type="text" name="" class="form-control" value="<?= $data->subproduk.' || '.$data->sub_kode ?>" readonly>
					<input type="hidden" name="id_subproduk" class="form-control" value="<?= $data->id_subproduk ?>">
					<input type="hidden" name="subproduk" class="form-control" value="<?= $data->subproduk ?>">
					<input type="hidden" name="sub_kode" class="form-control" value="<?= $data->sub_kode ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Stock :</label>
					<input type="number" name="stock_awal" class="form-control" value="<?= $data->stock ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Keluar :</label>
					<input type="number" name="keluar" class="form-control" value="<?= $data->keluar ?>">
					<input type="hidden" name="kl_aw" class="form-control" value="<?= $data->keluar ?>">
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Keterangan</label>
					<textarea name="keterangan" class="form-control"><?= $data->keterangan ?></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Save</button>
			</div>
		</div>
		</form>
	</div>	
</div>