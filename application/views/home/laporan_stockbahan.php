<?php $num_ktg = $kategori->num_rows(); ?>
<style>
	table {text-align: center;}
	table tr th {text-align: center; font-size: 12;}
	.posi {
		width:100px; /* dimensi lebar */
  		height:100px; /* dimensi tinggi */
  		line-height:100px; /* sama dengan tinggi elemen, posisi di tengah secara vertikal */
  		text-align:center; /* posisi di tengah secara horizontal */
  	}
  	.b {text-align:center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan Stock Bahan (TEMBAKAU)</strong>
		</div>
	</div>
</div>


<div class="col-lg-12">
	<div class="card" id="print">
		<div class="card-header bg-info text-light">
			<b><i></i>  Laporan Stock Bahan (TEMBAKAU)</b> <!-- class="fa fa-plus" -->
			<?php if ($_SESSION['level'] == 'Super Admin'): ?><!-- 
			<a href="#"class="btn btn-danger pull-right btn-sm"  data-toggle="modal" data-target="#modal"> <i class="fa fa-search"></i> Filter</a> --><?php endif ?>
		</div>
		<div class="card-body">
			<form action="<?= base_url('Home/search_stock') ?>" method="POST">
			<div class="col-lg-12">
	        	<div class="form-group">
		        	<select class="form-control" name="jenis" id="jenis">
		        		<option value="">--Pilih Semua Jenis Tembakau --</option>
		        		<?php foreach ($jenis->result_array() as $key) {
		        			echo "<option value='".$key['jenis']."'>".$key['jenis']."</option>";
		        		} ?>
		        	</select>
	        	</div>
	        </div>
	        <div class="col-lg-12">
	        	<div class="form-group">
		        	<select class="form-control" name="kate_" id="kategori">
		        		<option value="">--Pilih Semua Kategori Tembakau --</option>
		        		<?php foreach ($kategori->result_array() as $aue) {
		        			echo "<option value='".$aue['kategori']."'>".$aue['kategori']."</option>";
		        		} ?>
		        	</select>
	        	</div>
	        </div>
	        <div class="col-lg-12">
	        	<div class="form-group">
		        	<div class="form-group">
			        	<select class="form-control" name="asal" id="asal">
			        		<option value="">---Pilih Semua Asal---</option>
				          	<option value="Tanam Sendiri">Tanam Sendiri</option>
				          	<option value="Beli Exsternal">Beli Exsternal</option>
			        	</select>
			        </div>
	        	</div>
	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<input type="text" name="awal" id="awal1" class="form-control" value="<?php echo date('Y-m-d') ?>">
	        	</div>

	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<input type="text" name="akhir" id="akhir" class="form-control" value="<?php echo date('Y-m-d') ?>">
	        	</div>
	        </div>
	        <div class="col-lg-12">
	        	<button class="btn btn-danger" type="submit"> <i class=" fa fa-search"></i> Print</button>
	        </div>
			</form>
	      </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		jQuery('#awal1').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});
</script>
