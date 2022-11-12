<style>
  table {text-align: center;}
  thead{text-transform: uppercase;}
  table tr th {text-align: center;}
  #show {text-align: center;}
</style>
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Return RFS</strong>
    </div>
  </div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-plus"></i> Tambah Return RFS</b>	
		</div>
		<div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Tanggal : </label>
					<input type="text" class="form-control" id="tanggalan" value="<?= date('Y-m-d') ?>" autocomplete="off">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Produk : </label>
					<input type="hidden" id="prd">
					<select id="produk" class="form-control">
						<option value="">--- Pilih Produk ---</option>
						<?php $prd = $this->db->select('produk')->get('produk');
						foreach ($prd->result() as $key): ?>
						<option value="<?= $key->produk ?>"><?= $key->produk ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-lg-6">
				<label>Sub Produk : </label>
				<select class="form-control" name="id_sub" id="sub">
					
				</select>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Jumlah Return : </label>
					<input type="number" class="form-control" id="jumlah" value="0" autocomplete="off">
					<small>*satuan perkemasan</small>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Keterangan : </label>
					<textarea id="ket" class="form-control" placeholder="Keterangan Return"></textarea>
				</div>
			</div>
		    <div class="col-lg-12">
		     	<div class="form-group">
			     <button class="btn btn-info" onclick="kirim()"><i class="fa fa-save"></i> Kirim</button>
			    </div>
		    </div>
		</div>	
	</div>
</div>
<script>
	$(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});

	$('#produk').on('change',function() {
		var prd = $(this).val();
		$.ajax({
			url: '<?= base_url("Marketing/get_id_produk") ?>',
			type: 'POST',
			dataType: 'JSON',
			data: {produk:prd},
			success : function (data) {
				$('#prd').val(data.id);
				var id_ = data.id;
				$.ajax({
					url: '<?= base_url("Marketing/c_p/") ?>'+id_,
					type: 'GET',
					dataType: 'json',
					success : function (up) {
						$('#sub').html(up);
					}
				})
				
			}
		})
	});

	function kirim(argument) {
		var id = $('#prd').val();
		var tanggal = $("#tanggalan").val();
		var sub = $('#sub').val();
		var jumlah = $("#jumlah").val();
		var ket = $("#ket").val();

		$.ajax({
			url: '<?= base_url('Marketing/add_return') ?>',
			type: 'POST',
			data: {id:id,sub:sub,tanggal:tanggal,jumlah:jumlah,ket:ket},
			success : function (data) {
				alert(data);
				$("#tanggalan").val("");
				$("#produk").val("");
				$('#sub').val("");
				$("#jumlah").val("0");
				$("#ket").val("");
			}
		})
	}
</script>