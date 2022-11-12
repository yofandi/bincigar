<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Pembantu / Option</strong>
		</div>
	</div>
</div>

<?php $data = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>

<div class="col-lg-6">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-gears"></i> Setting Application</b>
		</div>
		<div class="card-body">
			<form method="post" action="<?php echo base_url('Home/update_option'); ?>">
				<div class="form-group">
					<label>Direktur Operasional : </label>
					<input type="text" name="direktur" class="form-control" value="<?php echo $data['direktur'] ?>">
				</div>
				<div class="form-group">
					<label>Kabag.Produksi : </label>
					<input type="text" name="kabag" class="form-control"  value="<?php echo $data['kabag'] ?>">
				</div>
				<div class="form-group">
					<label>Quality Control : </label>
					<input type="text" name="qc" class="form-control" value="<?php echo $data['qc'] ?>">
				</div>
				<div class="form-group">
					<label>RFS : </label>
					<input type="text" name="rfs" class="form-control" value="<?php echo $data['rfs'] ?>">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="col-lg-6">
	
</div>