<style>
	#importFrm{margin-bottom: 20px;display: none;}
    #importFrm input[type=file] {display: inline;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Kirim Return RFS</strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-primary text-light">
			<b>Kirim Retrun RFS</b>
		</div>
		<div class="card-body">
			<form action="<?= base_url('Home/proses_sortir/'.$id) ?>" method="POST">
			<div class="col-lg-12">
				<?= "<div class='col-lg-3'><b> Produk : </b>".$r_rfs->produk."</div><div class='col-lg-3'><b>Sub Produk : </b>".$r_rfs->sub_produk." | ".$r_rfs->sub_kode."</div><div class='col-lg-3'><b> Jumlah (Kemasan) : </b>".$r_rfs->jumlah."</div>" ?>
				<div class="col-lg-3">
				<input type="hidden" name="jml_rfs" value="<?= $r_rfs->jumlah ?>">
                <a href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Show Form</a>
				</div>
			</div>
			<div class="col-lg-12">
				<hr size="100">
			</div>
			<div id="importFrm">
				<div class="col-lg-12">
					<div class="form-group">
						<input type="number" class="form-control" name="packing" id="packing" value="0">
						<small>*packing</small>
					</div>
				</div>
		      	<div class="col-lg-6">
		          <div class="form-group">
		            <label>Jenis Tembakau :</label>
		            <select name="jenis" class="form-control">
		              <?php foreach ($bd as $lue): ?>
		                <option value="<?= $lue->jenis ?>"><?= $lue->jenis ?></option>
		              <?php endforeach ?>
		            </select>
		          </div>
		        </div>
		      	<div class="col-lg-6">
		      		<div class="form-group">
		      			<label>Jumlah (Batang) : </label>
		      			<input type="number" class="form-control" name="batang" id="batang" value="<?= $b = $r_rfs->jumlah * $r_rfs->isi ?>" readonly>
		      			<input type="hidden" id="jumlah" value="<?= $r_rfs->jumlah ?>">
		      			<input type="hidden" id="isi" name="isi" value="<?= $r_rfs->isi ?>">
		      			<input type="hidden" class="form-control" name="produk" value="<?= $r_rfs->id ?>">
		      		</div>
		      	</div>
				<div class="col-lg-4">
					<div class="form-group">
						<input type="number" class="form-control" name="bind" value="0">
						<small>*binding</small>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<input type="number" class="form-control" name="wrap" value="0">
						<small>*wrapping</small>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						<input type="number" class="form-control" name="out" value="0">
						<small>*filler 2</small>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<label>Keterangan :</label>
						<textarea name="ket" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#packing').keyup(function(event) {
		var packing = $(this).val();
		var jumlah = parseInt($('#jumlah').val());
		var sisa = jumlah - packing;
		var isi = parseInt($('#isi').val());
		hitung = sisa * isi;
		$('#batang').val(hitung);
	});

	$(document).ready(function(){
		jQuery("form").prop('autocomplete', 'off');
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});
</script>