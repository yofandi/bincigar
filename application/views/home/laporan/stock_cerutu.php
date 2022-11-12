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
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan Stock Harian</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-success">
			<b> Laporan Stock Harian</b>
		</div>
		<div class="card-body">
		<form action="<?= base_url('Home/laporan_stock_cerutu') ?>" method="post">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Nama Barang : </label>
					<select name="merk[]" id="merk" multiple>
						<?php foreach ($produk->result() as $key):
							$cek = $this->db->where('id_produk',$key->id)->get('sub_produk');
							if ($cek->num_rows() > 0): ?>
							<optgroup label="<?= $key->produk ?>" class="group-1">
								<?php 
								$db = $this->db->where('id_produk',$key->id)->get('sub_produk');
								foreach ($db->result() as $lue): ?>
									<option value="<?= $lue->id ?>"><?= $lue->sub_kode ?></option>
								<?php endforeach ?>
							</optgroup>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="form-group">
					<label>Tanggal Awal :</label>
					<input type="text" class="form-control" name="awal" id="awal" value="<?= date('Y-m-d') ?>">
				</div>
			</div>
			<div class="col-lg-2" align="center">
				<br>
				<b>Sd.</b>
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
				<button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	jQuery(document).ready(function() {
		jQuery("#merk").multiselect({
			includeSelectAllOption: true,
			enableFiltering: true,
        	enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
            enableCollapsibleOptGroups: true,
            buttonClass: 'form-control',buttonWidth: '100%'});
		jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});
</script>