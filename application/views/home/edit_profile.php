<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Edit Profile</strong>
		</div>
	</div>
</div>

<form method="post" action="<?php echo base_url('Home/update_profile') ?>">
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-edit"></i> Edit Profile</b>
		</div>
		<div class="card-body">
			<div class="col-lg-12">
				<div class="form-group">
					<label>Nama Lengkap : </label>
					<input type="text" required="" name="nama_lengkap" value="<?php echo $data['nama_lengkap'] ?>" class="form-control">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Username : </label>
					<input type="text" required="" name="username" value="<?php echo $data['username'] ?>" class="form-control">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Email : </label>
					<input type="email" required="" name="email" value="<?php echo $data['email'] ?>" class="form-control">
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Level : </label>
					<input type="text" disabled="" value="<?php echo $data['level'] ?>" class="form-control">
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