<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Refrensi / Bagan Store</strong>
		</div>
	</div>
</div>

<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong><i class="fa fa-plus"></i> Tambah Bagan Store</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Deksripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $data = $this->db->order_by('id','ASC')->get('bagan_store')->result_array(); ?>
					<?php $no=1; foreach ($data as $key): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $key['nama'] ?></td>
							<td><?php echo $key['deskripsi'] ?></td>
							<td>
								<button title="Edit" class="btn btn-warning btn-sm" onclick="edit(<?php echo $key['id'] ?>)"><i class="fa fa-edit"></i></button>
								<buttonn title="Hapus" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $key['id'] ?>)"><i class="fa fa-trash"></i></button>
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
			<b><i class="fa fa-edit"></i> Edit Data | ID : <b id="id_cincin"></b></b>
		</div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<label>Nama : </label>
					<input type="text" name="nama2" id="nama2" class="form-control">
				</div>
				<div class="form-group">
					<label>Deskripsi : </label>
					<textarea class="form-control" id="deskripsi2"></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-success" id="update"> Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b>Tambah Bagan Store</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="<?php echo base_url('Marketing/add_bagan') ?>">
        	
        	<div class="form-group">
        		<label>Nama Bagan :</label>
        		<input type="text" name="nama" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Deskripsi :</label>
        		<textarea class="form-control" name="des"></textarea>
        	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
        
      </div>
    </div></form>

  </div>
</div>

<script>
	function edit(id) {
		$.ajax({
			url : '<?php echo base_url("Marketing/edit_bagan/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#nama2').val(data.nama);
				$('#deskripsi2').val(data.deskripsi);

				$('#update').on('click', function(event){
					event.preventDefault();

					var nama = $('#nama2').val();
					var deskripsi = $('#deskripsi2').val();

					$.ajax({
						url : '<?php echo base_url("Marketing/update_bagan/") ?>'+id,
						method : 'POST',
						data : {nama:nama, deskripsi:deskripsi},
						success : function(data){
							alert(data);
							location.reload();
						}
					})
				})
			}
		})
	}

	// hapus
	function hapus(id) {
		$.ajax({
			url : '<?php echo base_url("Marketing/hapus_bagan/") ?>'+id,
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