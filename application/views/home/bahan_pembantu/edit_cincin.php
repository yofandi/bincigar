<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Edit Cincin / <?php echo $datas['id']; ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-edit"></i> Edit Bahan Cincin</b>
		</div>
		<div class="card-body">
			<div class="col-lg-12">
      		<form method="post" action="<?php echo base_url('Bahan_pembantu/update_cincin/'.$datas['id']) ?>">
      		<div class="col-lg-6">
      			<div class="form-group">
      				<label>Produk : </label>
      				<?php 
                              $data = $this->db->order_by('id', 'ASC')->get('produk')->result_array(); 
                              $stock = $this->db->select('stock')->where('produk', $datas['nama_produk'])->get('stock_cincin')->row_array();
                              ?>
                              <input type="hidden" name="staw" value="<?= $stock['stock'] ?>">
                              <input type="hidden" name="nama_produk" value="<?= $datas['nama_produk'] ?>">
      				<select class="form-control" disabled>
      					<?php foreach ($data as $key): ?>
      						<option value="<?php echo $key['produk'] ?>" <?php if ($key['produk'] == $datas['nama_produk']): ?>
                                          selected
                                          <?php endif ?>><?php echo $key['produk'] ?></option>
      					<?php endforeach ?>
      				</select>
      			</div>
      			<div class="form-group">
      				<label>Stock Awal : </label>
      				<input type="number" class="form-control" name="awal" value="<?php echo $datas['awal'] ?>" readonly>
      			</div>
      			<div class="form-group">
      				<label>Stock Masuk : </label>
      				<input type="number" class="form-control" name="masuk" value="<?php echo $datas['masuk'] ?>">
                              <input type="hidden" name="masuk_hd" value="<?php echo $datas['masuk'] ?>">
      			</div>
      		</div>
      		<div class="col-lg-6">
      			<div class="form-group">
      				<label>Stock Terpakai : </label>
      				<input type="number" class="form-control" name="terpakai" value="<?php echo $datas['terpakai'] ?>">
                              <input type="hidden" name="terpakai_hd" value="<?php echo $datas['terpakai'] ?>">
      			</div>
      			<div class="form-group">
      				<label>Stock Afkir : </label>
      				<input type="number" class="form-control" name="afkir" value="<?php echo $datas['afkir'] ?>">
                              <input type="hidden" name="afkir_hd" value="<?php echo $datas['afkir'] ?>">
      			</div>
      			<div class="form-group">
      				<button type="sumit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Update</button>
      			</div>
      		</div></form>
      	</div>
		</div>		
	</div>
</div>