<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Edit Password</strong>
		</div>
	</div>
</div>

<form method="post" action="<?php echo base_url('Home/update_password') ?>">
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-user"></i> Edit Password</b>
		</div>
		<div class="card-body">
			<div class="col-lg-6">
				<div class="form-group">
					<label>Password Lama : </label>
					<input type="password" required="" name="password1" class="form-control">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Password Baru : </label>
					<input type="password" required="" name="password2" class="form-control">
				</div>
				<div class="form-group">
					<label>Ulangi Password : </label>
					<input type="password" required="" name="password3" class="form-control">
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="pull-right">
				<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
</form>