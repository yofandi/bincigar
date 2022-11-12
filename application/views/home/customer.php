<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Referensi / Customer</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong>Customer</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#mymodal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="table_ku">
					<thead>
						<tr>
							<th>No.</th>
							<th>Pelanggan Milik</th>
							<th>Nama Customer</th>
							<th>No.Telepon</th>
							<th>Email</th>
							<th>alamat</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($customer->result() as $key): ?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $key->username ?></td>
							<td><?= $key->nama_customer ?></td>
							<td><?= $key->no_telf ?></td>
							<td><?= $key->email ?></td>
							<td><?= $key->alamat ?></td>
							<td><?= $key->keterangan ?></td>
							<td>
								<a href="#" title="edit" class="btn btn-warning" data-toggle="modal" data-target="#Modal<?= $key->id_customer ?>"><i class="fa fa-pencil-square-o"></i></a>

								<div id="Modal<?= $key->id_customer ?>" class="modal fade" role="dialog">
				          <div class="modal-dialog modal-lg">
				            <div class="modal-content">
				              <div class="modal-header">
				                <label><i class="fa fa-pencil-square-o"></i> Edit Customer</label>
				                <button type="button" class="close" data-dismiss="modal">&times;</button>
				                <h4 class="modal-title"></h4>
				              </div>
				              <form action="<?= base_url('Home/update_customer/'.$key->id_customer) ?>" method="post">
				              <div class="modal-body">
				               <div class="col-lg-12">
				                 <div class="form-group">
				                 <label>Nama Customer :</label>
				                 <input type="text" class="form-control" name="nama_1" value="<?= $key->nama_customer ?>">
				                 </div>
				               </div>
				               <div class="col-lg-6">
				                <div class="form-group">
				                 <label>Email :</label>
				                 <input type="text" class="form-control" name="email_1" value="<?= $key->email ?>">
				                </div>
				               </div>
				               <div class="col-lg-6">
				               	<div class="form-group">
				               		<label>No.Telefon :</label>
				               		<input type="text" class="form-control" name="telf_1" value="<?= $key->no_telf ?>">
				               	</div> 		
				               </div>
				               <div class="col-lg-6">
				               	<div class="form-group">
				               		<label>Alamat :</label>
				               		<textarea name="alamat_1" class="form-control"><?= $key->alamat ?></textarea>
				               	</div> 		
				               </div>
				               <div class="col-lg-6">
				               	<div class="form-group">
				               		<label>Keterangan :</label>
				               		<textarea name="keterangan_1" class="form-control"><?= $key->keterangan ?></textarea>
				               	</div> 		
				               </div>
				              </div>
				              <div class="modal-footer">
				                <button class="btn btn-danger" type="submit">Save</button>
				              </div>
				              </form>
				            </div>
				          </div>
				        </div>

								<a href="<?= base_url('Home/delete_customer/'.$key->id_customer) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>
						<?php $no++; endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="card-footer">
			
		</div>
	</div>
</div>
<div id="mymodal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<label><i class="fa fa-plus"></i> Tambah Customer</label>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<form action="<?= base_url('Home/add_customer') ?>" method="post">
			<div class="modal-body">
				<?php if ($this->session->userdata('level') == 'Super Admin'): ?>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Bagan :</label>
						<select id="bagan" class="form-control">
							<option value="">--- Pilih Bagan ---</option>
							<?php foreach ($bagan_store->result() as $lue): ?>
							<option value="<?= $lue->nama ?>"><?= $lue->nama ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>User :</label>
						<select name="user" id="user" class="form-control">
						</select>
					</div>
				</div>
				<?php else: ?>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Bagan :</label>
						<input type="text" class="form-control" value="<?= $this->session->userdata('level'); ?>" readonly>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>User :</label>
						<input type="text" class="form-control" value="<?= $this->session->userdata('username'); ?>" readonly>			
						<input type="hidden" class="form-control" name="user" value="<?= $this->session->userdata('id'); ?>">			
					</div>
				</div>
				<?php endif ?>
				<div class="col-lg-12">
					<div class="form-group">
						<label>Nama Customer :</label>
						<input type="text" class="form-control" name="nama">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>No. Telefon :</label>
						<input type="text" class="form-control" name="telf">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Email :</label>
						<input type="text" class="form-control" name="email">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Alamat :</label>
						<textarea name="alamat" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Keterangan :</label>
						<textarea name="keterangan" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<button type="submit" class=" pull-right btn btn-danger"><i class="fa fa-save"></i> SAVE</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
    	jQuery('#tanggal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#table_ku').DataTable({
			responsive: true
		});
	});
	$('#bagan').change(function(event) {
		var bagan = $(this).val();

		$.ajax({
			url: '<?= base_url("Marketing/pilih_user/") ?>'+bagan,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#user').html(data);
			}
		})
	});
</script>