<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Return Bagan</strong>
    </div>
  </div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-plus"></i> Tambah Return Bagan</b>	
		</div>
		<div class="card-body">
		<form action="<?= base_url('Marketing/add_return_bagan') ?>" method="post">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Tanggal :</label>
					<input type="text" class="form-control" name="tanggal" id="tanggalan" value="<?= date('Y-m-d') ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Bagan :</label>
					<input type="text" name="bagan" class="form-control" value="<?= $this->session->userdata('level'); ?>" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Username :</label>
					<input type="text" name="user" class="form-control" value="<?= $this->session->userdata('username'); ?>" readonly>
					<input type="hidden" name="id_sess" id="id_sess" value="<?= $this->session->userdata('id'); ?>">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Produk :</label>
					<select id="produk" class="form-control">
						<option value="">--- Pilih Produk ---</option>
						<?php foreach ($produk->result() as $pro): ?>
						<option value="<?= $pro->id ?>"><?= $pro->produk ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Sub Produk :</label>
					<select id="sub_produk" name="id_subproduk" class="form-control">
					</select>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group">
					<label>Stock Saat ini (perkemasan) :</label>
					<input type="number" class="form-control" id="stk_aw" readonly>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Jumlah Return (perkemasan) :</label>
					<input type="number" class="form-control" name="jumlah">
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Keterangan :</label>
					<textarea name="keterangan" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<button type="submit" class="pull-right btn btn-info"><i class="fa fa-save"></i> SAVE</button>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});

	$('#produk').change(function(event) {
		var id_produk = $(this).val();

		$.ajax({
			url: '<?= base_url("Marketing/c_p/") ?>'+id_produk,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#sub_produk').html(data);

				$('#sub_produk').change(function(event) {
					var id = $(this).val();
					var usr = $('#id_sess').val();

					$.ajax({
						url: '<?= base_url("Marketing/search_hje/") ?>'+id+'/'+usr,
						type: 'POST',
						dataType: 'json',
						success :function (arg) {
							$('#stk_aw').val(arg.stok);
						}
					})
					
				});
			}
		})
	});
</script>