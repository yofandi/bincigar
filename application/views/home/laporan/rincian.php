<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan Rincian</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-primary text-light">
			<b>Laporan Rincian</b>
		</div>
		<div class="card-body">
			<form action="<?= base_url('Home/laporan_rincian') ?>" method="post">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan :</label>
					<select name="bagan" id="bagan" class="form-control">
						<option value="">--- Pilih Semua ---</option>
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
						<option value="">--- Pilih Semua ---</option>
					</select>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Sistem :</label>
					<select name="sistem" class="form-control">
						<option value="">--- Pilih Semua ---</option>
						<?php foreach ($sistem as $lue): ?>
						<option value="<?= $lue ?>"><?= $lue ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label>Tanggal Awal :</label>
					<input type="text" name="awal" id="awal" class="form-control" value="<?= date('Y-m-d') ?>">
				</div>
			</div>
			<div class="col-lg-2" align="center">
				<br><b>Sd.</b>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label>Tanggal Akhir :</label>
					<input type="text" name="akhir" id="akhir" class="form-control" value="<?= date('Y-m-d') ?>">
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
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
		jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});
</script>