<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Edit <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-edit"></i> Edit Stock | ID : <?php echo $data['id'] ?></b>
		</div>
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Bahanbaku/update_stock/'.$data['id']) ?>">
				<div class="col-lg-6">
					<div class="form-group">
						<label>Jenis :</label>
						<input type="text" class="form-control" name="jenis" value="<?php echo $data['jenis'] ?>">
					</div>
					<div class="form-group">
						<label>Kategori :</label>
						<input type="text" class="form-control" name="kategori" value="<?php echo $data['kategori'] ?>">
					</div>
					<div class="form-group">
			            <label>Asal : </label>
			            <select class="form-control" name="asal">
			              <option value="Tanam Sendiri">Tanam Sendiri</option>
			              <option value="Beli Exsternal">Beli Exsternal</option>
			            </select>
			          </div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Masuk :</label>
						<input type="number" class="form-control" name="masuk" value="<?php echo $data['stock_masuk'] ?>">
					</div>
					<div class="form-group">
						<label>DiTerima :</label>
						<input type="number" class="form-control" name="diterima" value="<?php echo $data['diterima'] ?>">
					</div>
					<div class="form-group">
						<label>Di Produksi : </label>
						<input type="number" name="diproduksi" class="form-control" value="<?php echo $data['diproduksi'] ?>">
						<input type="hidden" name="stock_sb" value="<?php echo $stock_sb[0]->hari_ini; ?>">
					</div>
					<!-- <div class="form-group">
						<label>Stock Hari Ini :</label>
					</div> -->
					<div class="form-group">
						<label>Ket :</label>
						<textarea class="form-control" name="ket" ><?php echo $data['ket'] ?></textarea>
					</div>
					<div class="form-group">
						<a href="<?= base_url('Bahanbaku/') ?>" class="btn btn-danger">Kembali</a>
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>