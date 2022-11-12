<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Marketing / Order / <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-success text-light">
			<b><i class="fa fa-mobile"></i> Order Masuk ID : <?php echo $data['id'] ?></b>
		</div>
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Marketing/accept_order/'.$data['id']) ?>">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Tanggal : </label>
					<input type="text" class="form-control" value="<?php echo $data['tanggal'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Author : </label>
					<input type="text" class="form-control" name="author" value="<?php echo $data['author'] ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Produk : </label>
					<input type="text" class="form-control" value="<?php echo $data['subproduk'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Kode : </label>
					<input type="text" class="form-control" value="<?php echo $data['sub_kode'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Kemasan : </label>
					<input type="text" class="form-control" value="<?php echo $data['kemasan'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Isi : </label>
					<input type="text" class="form-control" value="<?php echo $data['isi'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Harga Jual Eceran (HJE) : </label>
					<input type="text" class="form-control" value="<?php  echo 'Rp.'.number_format($data['hje'],2,',','.'); ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Quntity / Jumlah : </label>
					<input type="text" class="form-control" value="<?php echo $data['jumlah'] ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Total : </label>
					<input type="text" class="form-control" value="<?php  echo 'Rp.'.number_format($data['total'],2,',','.'); ?>" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan : </label>
					<input type="text" class="form-control" value="<?php echo $data['bagan'] ?>" disabled="">
				</div>
			</div>
			<?php $stock=$this->db->get_where('stock_subproduk', array('id_subproduk' => $data['id_subproduk']))->row_array(); ?>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Stock Tersedia : </label>
					<input type="text" class="form-control" value="<?php echo $stock['stock'] ?>" disabled="">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Accept</button>
			<!-- <a class="btn btn-danger pull-right" href="<?php echo base_url('Marketing/order') ?>"><i class="fa fa-save"></i> Reject</a> -->
		</form>
		</div>
	</div>
</div>