<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan Tagihan</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-warning text-light">
			<b> Laporan Tagihan</b>
		</div>
		<div class="card-body">
			<form action="<?= base_url('Home/laporan_tagihan_1') ?>" method="post">
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
					<label>Customer :</label>
					<select name="customer" class="form-control" id="customer">
						<option value="">--- Pilih Semua ---</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
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

				$('#user').change(function(event) {
			    var user = $(this).val();

			    $.ajax({
			      url: '<?= base_url("Home/show_customer/") ?>'+user,
			      type: 'POST',
			      dataType: 'json',
			      success : function (argument) {
			        $('#customer').html(argument);
			      }
			    })
			  });
			}
		})
	});

	jQuery(document).ready(function() {
		jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});
</script>