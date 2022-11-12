<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / RFS / Return Bagan / <?= $return->id_return_bagan ?></strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-success text-light">
			<b><i class="fa fa-mobile"></i> Return Bagan Masuk ID : <?= $return->id_return_bagan ?></b>
		</div>
		<div class="card-body">
		<form action="<?= base_url('Marketing/add_stockreturn_bagan/'.$return->id_return_bagan) ?>" method="post">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Tanggal :</label>
					<input type="text" class="form-control" id="tanggalan" value="<?= $return->tanggal ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan :</label>
					<input type="text" class="form-control" value="<?= $return->bagan ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Username :</label>
					<input type="text" class="form-control" value="<?= $return->author ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Produk :</label>
					<input type="text" class="form-control" value="<?= $return->produk ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Sub Produk :</label>
					<input type="text" class="form-control" value="<?= $return->sub_produk.' || '.$return->sub_kode ?>" readonly>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Jumlah (perkemasan) :</label>
					<input type="hidden" name="id_sub" value="<?= $return->id_subproduk?>">
					<input type="text" class="form-control" name="jumlah" value="<?= $return->jumlah ?>" readonly>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Keterangan :</label>
					<textarea class="form-control" readonly><?= $return->keterangan ?></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="pull-right btn btn-danger"><i class="fa fa-plus"></i> Tambah Ke Stock</button>
			</div>
		</div>
		</form>
	</div>
</div>