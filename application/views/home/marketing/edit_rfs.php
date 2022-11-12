<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Packing / Edit / <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-dark text-light">
			<b><i class="fa fa-edit"></i> Edit Packing ID : <?php echo $data['id'] ?></b>
		</div>
		<div class="card-body">
			
      <form method="post" action="<?php echo base_url('Marketing/update_rfs/'.$data['id']) ?>">
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Tanggal</label>
      			<input type="text" class="form-control" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>">
      		</div>
      	</div>
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Produk/Merek</label>
      			<input type="text" class="form-control" name="produk" value="<?php echo $data['produk'] ?>" readonly>
      		</div>
      	</div>
      	<div class="col-lg-12" id="data_muncul">
      		<div class="form-group">
      			<label>SubProduk : </label>
      			<input type="text" class="form-control" disabled="" value="<?php echo $data['sub_produk'] ?>">
      			<input type="hidden" name="id_subproduk" id="sub_produk" value="<?php echo $data['id_subproduk'] ?>">
      		</div>
      	</div>
      	<div class="col-lg-4">
			<div class="form-group">
				<label>Kemasan : </label>
				<input type="text" class="form-control" disabled="" value="<?php echo $data['kemasan'] ?>">
				<input type="hidden" name="kemasan" value="<?php echo $data['kemasan'] ?>">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label>Isi Kemasan : </label>
				<input type="text" class="form-control" disabled="" value="<?php echo $data['isi'] ?>">
				<input type="hidden" isi="kemasan" value="<?php echo $data['isi'] ?>">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label>Stock Awal : </label>
				<input type="text" class="form-control" disabled="" value="<?php echo $data['stock'] ?>">
				<input type="hidden" name="stock" value="<?php echo $data['stock'] ?>">
			</div>
		</div>
		<div class="col-lg-12">
			<label>Cerutu Hasil Quality Controll</label>
			<input type="text" class="form-control" name="hasil_qc" value="<?php echo $data['stock_batang']; ?>" readonly>
			<input type="hidden" class="form-control" name="hs_sbl" value="<?php echo $data['sisa_stock']; ?>">
		</div>
		<div class="col-lg-5">
			<label>Berapa Packing : </label>
			<input type="text" class="form-control" name="packing" value="<?= $data['masuk'] ?>">
		</div>
		<div class="col-lg-2" style="text-align:center">
			<br><label> X </label>
		</div>
		<div class="col-lg-5">
			<div class="form-group">
				<label> Isi Kemasan : </label>
				<input type="number" class="form-control" disabled="" value="<?php echo $data['isi'] ?>">
				<input type="hidden" name="sisa_sbl" value="<?= $data['sisa'] ?>">
			</div>
		</div>
		<div class="col-lg-12">
			<div class="form-group">
				<label>Stock Keluar : </label>
				<input type="number" class="form-control" name="keluar" value="<?php echo $data['keluar'] ?>">
				<input type="hidden" class="form-control" name="kl_sbl" value="<?php echo $data['keluar'] ?>">
			</div>
			<div class="form-group">
				<label>Keterangan : </label>
				<textarea class="form-control" name="ket"><?php echo $data['ket'] ?></textarea>
			</div>
		</div>
      	<div class="card-footer">
      		<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Update</button>
      	</div></form>
		</div>
	</div>
</div>