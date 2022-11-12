<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Upload Foto</strong>
		</div>
	</div>
</div>

<div class="col-lg-6">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-upload"></i> Upload Foto : </b>
		</div>
		<div class="card-body">
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Home/update_foto') ?>">
				<div class="form-group">
					<label>Foto : </label>
					<input type="file" name="foto" class="form-control">
					<input type="hidden" name="fto" value="<?php echo $data['upload_foto']; ?>">
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit"> Upload</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-lg-6"><center>
	<img style="width: 50%" src="<?php echo base_url('assets/images/'.$data['upload_foto']) ?>">
</center></div>