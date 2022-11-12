<style type="text/css">
  select.multiselect,
  select.multiselect + div.btn-group,
  select.multiselect + div.btn-group button.multiselect,
  select.multiselect + div.btn-group.open .multiselect-container{
    width:100% !important;
  }
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
		<div class="card-header bg-default"><!--  text-light -->
			<b><i></i>  Laporan Produksi dan Bahan Produksi (TEMBAKAU)</b> <!-- class="fa fa-plus" -->
		</div>
		<div class="card-body">
			<form action="<?= base_url('Home/seacrh_produksi') ?>" method="POST">
			<div class="col-lg-6">
	        	<div class="form-group">
        			<label>Produk Tembakau :</label>
        			<select name="produk[]" id="pkp" multiple="multiple">
        				<?php foreach ($produk->result_array() as $key): ?>
        				<option value="<?= $key['produk'] ?>"><?= $key['produk'] ?></option>
        				<?php endforeach ?>
        			</select>
	        	</div>
	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
        			<label>Jenis Tembakau :</label>
        			<select name="jenis[]" id="kpk" multiple="multiple">
        				<?php foreach ($jenis->result_array() as $key): ?>
        				<option value="<?= $key['jenis'] ?>"><?= $key['jenis'] ?></option>
        				<?php endforeach ?>
        			</select>
	        	</div>
	        </div>
	        <div class="col-lg-12">
	        	<div class="form-group">
		        	<select class="form-control" name="kategori" id="kategori">
		        		<option value="">--Pilih Kategori Tembakau --</option>
		        		<?php foreach ($kategori as $aue => $value) {
		        			echo "<option value='".$value."'>".$aue."</option>";
		        		} ?>
		        	</select>
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
		jQuery("#pkp").multiselect({includeSelectAllOption: true,buttonClass: 'form-control',buttonWidth: '100%'});
		jQuery("#kpk").multiselect({includeSelectAllOption: true,buttonClass: 'form-control',buttonWidth: '100%'});
		jQuery('#awal1').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#tanggal').datepicker({format : 'yyyy-mm-dd'});
	});
	$('#checkAll').click(function () {    
     $('.produk').prop('checked', this.checked);    
 	});

 	$('#checkAll1').click(function () {    
     $('.jenis').prop('checked', this.checked);    
 	});
</script>