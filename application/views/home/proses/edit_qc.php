<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Edit QC / <?php echo $data['id'] ?>
			</strong>
		</div>
	</div>
</div>
<style>
  table {text-align: center;}
  table tr th {text-align: center; text-transform: uppercase;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-plus-circle"></i> Tambah Quality Controll</b>
			<!-- <button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button> -->
		</div>
		<div class="card-body">
			<form  method="post" action="<?php echo base_url('Proses_produksi/update_qc/'.$data['id']) ?>">
		        <?php $drying3 = $this->db->order_by('id', 'DESC')->get('drying3')->row_array(); ?>
		      	<div class="col-lg-12">
		      		<div class="form-group">
		        		<label>Tanggal : </label>
		        		<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo date('Y-m-d') ?>"><small>
		        	</div>
		        	<div class="form-group">
		      			<label>STOCK AWAL : </label>
		      			<input type="text" name="stock" class="form-control" value="<?php echo $drying3['hasil'] ?>" readonly>
		      		</div>
		      	</div>
		      	<div class="col-lg-6">
		      		<div class="form-group">
		      			<label>Produk/Merek : </label>
		      			<input type="text" name="produk" class="form-control" value="<?php echo $drying3['produk'] ?>" readonly>
		      		</div>
		      		<div class="form-group">
		        		<label>Reject :</label>
		        		<input type="number" name="reject" class="form-control" value="<?php echo $data['reject'] ?>">
		        		<input type="hidden" name="rjt" class="form-control" value="<?php echo $data['reject'] ?>">
		        	</div>
		      	</div>
		      	<div class="col-lg-6">
		      		<div class="form-group">
		      			<label>Jenis Tembakau : </label>
		      			<input type="text" disabled="" class="form-control" value="<?php echo $drying3['jenis'] ?>">
		      			<input type="hidden" name="jenis" value="<?php echo $drying3['jenis'] ?>">
		      		</div>
		      		<div class="form-group">
		        		<label>Accept :</label>
		        		<input type="number" name="accept" class="form-control" value="<?php echo $data['accept'] ?>">
		        		<input type="hidden" name="acp" class="form-control" value="<?php echo $data['accept'] ?>">
		        	</div>
		      	</div>
		      	<div class="col-lg-12">
		      		<div class="form-group">
		        		<label>Keterangan :</label>
		        		<textarea class="form-control" name="ket"><?php echo $data['ket'] ?></textarea>
		        	</div>
		      	</div>
	      		<div class="form-group">
	      			<button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Update</button>
	      		</div>
		</div></form>
	</div>
</div>