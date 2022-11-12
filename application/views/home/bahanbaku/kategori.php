<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Referensi / Kategori</strong>
		</div>
	</div>
</div>
<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-info text-light">
			<strong>Kategori Bahan Baku ( Tembakau )</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Deskripsi</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $key) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['kategori'] ?></td>
						<td><?php echo $key['deskripsi'] ?></td>
						<td><?php echo $key['keterangan'] ?></td>
						<td>
							<button title="Edit" class="btn btn-warning" onclick="edit(<?php echo $key['id'] ?>)"><i class="fa fa-edit"></i></button>
							<button title="Hapus" class="btn btn-danger" onclick="hapus(<?php echo $key['id'] ?>)"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
					<?php $no++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="col-lg-4">
	<div class="card">
		<div class="card-header bg-success text-light">
			<strong><i class="fa fa-edit"></i> Edit Kategori ( Tembakau )</strong>
		</div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<label>Nama : </label>
					<input type="text" id="nama2" class="form-control">
				</div>
				<div class="form-group">
					<label>Deskripsi : </label>
					<textarea id="des2" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>Keterangan : </label>
					<textarea id="ket2" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<button id="update" class="btn btn-danger">Update</button>
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
      	<label>Tambah Kategori Tembakau</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="<?php echo base_url('Bahanbaku/tambah_kat') ?>">
        	
        	<div class="form-group">
        		<label>Kategori :</label>
        		<input type="text" name="kategori" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Deskripsi :</label>
        		<textarea name="deskripsi" class="form-control"></textarea>
        	</div>
        	<div class="form-group">
        		<label>Keterangan :</label>
        		<textarea name="keterangan" class="form-control"></textarea>
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
			url : '<?php echo base_url("Bahanbaku/edit_kat/") ?>'+id,
			method : 'POSt',
			dataType : 'JSON',
			success : function(data){
				$('#nama2').val(data.kategori);
				$('#des2').val(data.deskripsi);
				$('#ket2').val(data.keterangan);

				$('#update').on('click', function(event){
					event.preventDefault();

					var kategori = $('#nama2').val();
					var des = $('#des2').val();
					var ket = $('#ket2').val();

					$.ajax({
						url : '<?php echo base_url("Bahanbaku/update_kat/") ?>'+id,
						method : 'POST',
						data : {kategori:kategori,des:des,ket:ket},
						success : function(data) {
							alert(data);
							location.reload();
						}
					})
					// alert(ke);
				})
			}
		})
	}
	function hapus(id) {
		$.ajax({
			url : '<?php echo base_url("Bahanbaku/hapus_kat/") ?>'+id,
			method : 'POST',
			success : function(data){
				alert(data);
				location.reload();
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