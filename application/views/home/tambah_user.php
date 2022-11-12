<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Tambah Users</strong>
		</div>
	</div>
</div>

<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-plus-circle"></i> Tambah Users</b>
			<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Users</button>
		</div>
		<div class="card-body">
			<table class="table table-hover" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Email</th>
						<th>Level</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $data = $this->db->order_by('id', 'DESC')->get('users')->result_array(); ?>
					<?php $no=1; foreach ($data as $key): ?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $key['username'] ?></td>
							<td><?php echo $key['email'] ?></td>
							<td><?php echo $key['level'] ?></td>
							<td>
								<button class="btn btn-warning" onclick="edit(<?php echo $key['id'] ?>)"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger" onclick="hapus(<?php echo $key['id'] ?>)"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php $no++; endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-lg-4">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-edit"></i> Edit User ID : <b id="id_user"></b></b>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Username : </label>
				<input type="text" id="username" class="form-control">
			</div>
			<div class="form-group">
				<label>Email : </label>
				<input type="email" id="email" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="text" id="password" class="form-control" placeholder="Masukan Password Baru">
			</div>
			<div class="form-group">
				<label>Level : </label>	
				<select class="form-control" id="lvl_1">
      				<option value="">---- Pilih Level ----</option>
      				<?php if ($_SESSION['level'] != 'RFS'): ?>
      				<option value="produksi">Admin Produksi</option>
      				<?php endif ?>
      				<option value="bagan">Admin Bagan</option>
      			</select>
			</div>
			<div class="form-group">
				<select class="form-control" id="level">
      				
      			</select>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-danger" id="update"><i class="fa fa-update"></i> Update</button>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus"></i> Tambah User</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url('Home/add_users') ?>">
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Username : </label>
      			<input type="text" name="username" class="form-control">
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Password : </label>
      			<input type="text" name="password" value="123456" class="form-control">
      		</div>
      	</div>
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Email : </label>
      			<input type="email" name="email" class="form-control">
      		</div>
      	</div>
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Level :</label>
      			<select class="form-control" id="lvl">
      				<option value="">---- Pilih Level ----</option>
      				<?php if ($_SESSION['level'] != 'RFS'): ?>
      				<option value="produksi">Admin Produksi</option>
      				<?php endif ?>
      				<option value="bagan">Admin Bagan</option>
      			</select>
      		</div>
      	</div>
      	<div class="col-lg-12">
      		<div class="form-group">
      			<select class="form-control" name="level" id="pp">
      			</select>
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
 	 </form>
      </div>
    </div>
  </div>
</div>
<script>
	$('#lvl').change(function(event) {
		var lvl = $(this).val();
		
		$.ajax({
			url: '<?= base_url('Home/pilih/') ?>'+lvl,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#pp').html(data);
			}
		})
	});
	$('#lvl_1').change(function(event) {
		var lvl_1 = $(this).val();
		$.ajax({
			url: '<?= base_url('Home/pilih/') ?>'+lvl_1,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#level').html(data);
			}
		})
	});
	// edit
	function edit(id) {
		$.ajax({
			url : '<?php echo base_url("Home/edit_users/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#username').val(data.username);
				$('#email').val(data.email);
				$('#id_user').html(data.id);

				$('#update').on('click', function(event){
						event.preventDefault();
						var username = $('#username').val();
						var email = $('#email').val();
						var level = $('#level').val();
						var password = $('#password').val();

						$.ajax({
							url : '<?php echo base_url("Home/update_users/") ?>'+id,
							method : 'POST',
							data : {
								username : username, email : email, level : level,password:password
							},
							success : function(datas){
								alert(datas); location.reload();
							}
						})

				})
					
				
			}
		})
	}
	// hapus
	function hapus(id) {
		$.ajax({
			url : '<?php echo base_url("Home/hapus_users/") ?>'+id,
			method : 'POST',
			success : function(data){
				alert(data); location.reload();
			}
		})
	}
	$(document).ready(function(){
		jQuery('#table_ku').DataTable({
  responsive: {
    breakpoints: [
      {name: 'bigdesktop', width: Infinity},
      {name: 'meddesktop', width: 1480},
      {name: 'smalldesktop', width: 1280},
      {name: 'medium', width: 1188},
      {name: 'tabletl', width: 1024},
      {name: 'btwtabllandp', width: 848},
      {name: 'tabletp', width: 768},
      {name: 'mobilel', width: 480},
      {name: 'mobilep', width: 320}
    ]
  }
});
	});
</script>