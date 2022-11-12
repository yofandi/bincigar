<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Tambah Laporan</strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-dark text-light">
			<b><i class="fa fa-plus"></i> Tambah Laporan</b>
		</div>
		<div class="card-body">
			<input type="hidden" id="id_laporan" value="<?php echo $data['id'] ?>">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Tanggal : </label>
					<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo $data['tanggal'] ?>">	
				</div>
			</div>
			<div class="col-lg-12">
				<b>*1. Pengamatan Lingkungan*</b>
				<div class="form-group">
					<label>Cerah Hujan : </label>
					<input type="text" name="cerah_hujan" id="cerah_hujan" class="form-control" required="" value="<?php echo $data['cerah_hujan'] ?>">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Pagi : </label>
					<input type="text" name="pagi" id="pagi" class="form-control" required="" value="<?php echo $data['pagi'] ?>">
					<small>25C - 70%</small>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Siang : </label>
					<input type="text" name="siang" id="siang" class="form-control" required="" value="<?php echo $data['siang'] ?>">
					<small>28C-  70%</small>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Sore : </label>
					<input type="text" name="sore" id="sore" class="form-control" required="" value="<?php echo $data['sore'] ?>">
					<small>28C - 74%</small>
				</div>
			</div>
			<div class="col-lg-12">
				<b>*2. Tangkapan Lasio:*</b>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Bak Air : </label>
					<textarea class="form-control" name="bak_air" id="bak_air" rows="5" required=""><?php echo $data['bak_air'] ?></textarea>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Lasiotrap Di Ruangan : </label>
					<textarea class="form-control" name="lasiotrap_ruangan" id="lasiotrap_ruangan" rows="5"><?php echo $data['lasiotrap_ruangan'] ?></textarea>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Lasiotrap Di Lemari : </label>
					<textarea class="form-control" name="lasiotrap_lemari" id="lasiotrap_lemari" rows="5"><?php echo $data['lasiotrap_lemari'] ?></textarea>
				</div>
			</div>
			<div class="col-lg-12">
				<b>*3. Catatan Penjualan*</b>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>DS : </label>
					<input type="number" name="ds" id="ds" class="form-control" required="" value="<?php echo $data['ds'] ?>"> 
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Store : </label>
					<input type="number" name="store" id="store" class="form-control" required="" value="<?php echo $data['store'] ?>"> 
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Agent : </label>
					<input type="number" name="agent" id="agent" class="form-control" required="" value="<?php echo $data['agent'] ?>"> 
				</div>
			</div>
			<div class="col-lg-12">
				<b>*4. Laporan DS*</b>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Call : </label>
					<input type="text" value="<?php echo $data['call'] ?>" name="call" id="call" class="form-control" required=""> 
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Efektif Call : </label>
					<input type="text" name="efektif_call" value="<?php echo $data['efektif_call'] ?>" id="efektif_call" class="form-control" required=""> 
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label>Noo : </label>
					<input type="text" name="noo" id="noo" class="form-control" required="" value="<?php echo $data['noo'] ?>"> 
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<b>*5. Catatan Direksi*</b>
					<textarea class="form-control" id="direksi"><?php echo $data['direksi'] ?></textarea>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<b>*6. Kesulitan*</b>
					<textarea class="form-control" id="kesulitan"><?php echo $data['kesulitan'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<a href="<?php echo base_url("Home/print_laporan") ?>" class="btn btn-danger pull-right" id="laporan" style="margin-left: 10px;"><i class="fa fa-print"></i> Lihat Laporan</a>

			<button class="btn btn-info pull-right" id="simpan"><i class="fa fa-save"></i> Simpan & Kirim</button>

		</div>
	</div>

	<div class="alert alert-info" id="info">
		<b><i class="fa fa-info"></i> Laporan Berhasil Di Simpan Dan Kirimkan.</b>
	</div>
</div>

<script>
	$('#info').hide(); $('#laporan').hide();
	$('#simpan').on('click', function(event){
		event.preventDefault();

		var tanggal = $('#tanggalan').val();
		var cerah_hujan = $('#cerah_hujan').val();
		var pagi = $('#pagi').val();
		var siang = $('#siang').val();
		var sore = $('#sore').val();
		var bak_air = $('#bak_air').val();
		var lasiotrap_ruangan = $('#lasiotrap_ruangan').val();
		var lasiotrap_lemari = $('#lasiotrap_lemari').val();
		var ds = $('#ds').val();
		var store = $('#store').val();
		var agent = $('#agent').val();
		var call = $('#call').val();
		var efektif_call = $('#efektif_call').val();
		var noo = $('#noo').val();
		var direksi = $('#direksi').val();
		var kesulitan = $('#kesulitan').val();
		var id = $('#id_laporan').val();

		console.log(tanggal,cerah_hujan,pagi,siang,sore,bak_air,lasiotrap_ruangan,lasiotrap_lemari,ds,store,agent,call,efektif_call,noo,direksi,kesulitan)
		$.ajax({
			url : '<?php echo base_url("Home/update_laporan/") ?>'+id,
			method : 'POST',
			data : {
				tanggal:tanggal,cerah_hujan:cerah_hujan,pagi:pagi,siang:siang,sore:sore,bak_air:bak_air,lasiotrap_ruangan:lasiotrap_ruangan,lasiotrap_lemari:lasiotrap_lemari,ds:ds,store:store,agent:agent,call:call,efektif_call:efektif_call,noo:noo,direksi:direksi,kesulitan:kesulitan
			},
			// method : 'POST',
			success : function(data){
				alert(data);
				$('#info').fadeIn();
			$('#laporan').fadeIn();
			}
		})
	});
	$(document).ready(function(){
		// jQuery('#direksi').froalaEditor();
		// jQuery('#kesulitan').froalaEditor();
		jQuery('#tanggalan').datepicker();
	})
</script>