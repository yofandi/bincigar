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
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan Rekapitulasi</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info">
			<b><i></i>  Laporan Rekapitulasi</b>
		</div>
		<div class="card-body">
		<form action="<?= base_url('Home/laporan_rekapitulasi') ?>" method="POST">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan :</label>
					<select name="bagan" id="bagan" class="form-control">
						<option value="">--- Pilih Bagan ---</option>
						<?php foreach ($bagan->result() as $key): ?>
						<option value="<?= $key->nama ?>"><?= $key->nama ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>User :</label>
					<select name="user" id="user" class="form-control">
						<option value="">--- Pilih User ---</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label>Nama Produk : </label>
					<select name="produk[]" id="produk" multiple>
						<?php foreach ($sub_produk->result() as $lue): ?>
						<option value="<?= $lue->id ?>"><?= $lue->sub_produk.' || '.$lue->sub_kode ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label>Tanggal Awal :</label>
					<input type="text" class="form-control" name="awal" id="awal" value="<?= date('Y-01-01') ?>" readonly>
				</div>
			</div>
			<div class="col-lg-2" align="center">
				<div class="form-group">
					<br>
					<b>Sd.</b>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label>Tanggal Akhir :</label>
					<input type="text" class="form-control" name="akhir" id="akhir" value="<?= date('Y-m-d') ?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	$('#bagan').change(function(event) {
		var bagan = $(this).val();

		$.ajax({
			url: '<?= base_url("Marketing/pilih_user/") ?>'+bagan,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#user').html(data);
			}
		})
		
	});
	jQuery(document).ready(function() {
		jQuery("#produk").multiselect({includeSelectAllOption: true,buttonClass: 'form-control',buttonWidth: '100%'});
		jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});
</script>