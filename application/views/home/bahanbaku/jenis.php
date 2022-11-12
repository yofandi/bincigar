<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Referensi / Jenis</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong>Jenis Bahan Baku ( Tembakau )</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
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
					<?php $no=1; foreach ($data->result_array() as $key) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['jenis'] ?></td>
						<td><?php echo $key['deskripsi'] ?></td>
						<td><?php echo $key['keterangan'] ?></td>
						<td>
							<a class="btn btn-warning"><i class="fa fa-edit" data-toggle="modal" data-target="#myModal1<?php echo $no;?>"></i></a> 

							<div id="myModal1<?php echo $no;?>" class="modal fade" role="dialog">
							  <div class="modal-dialog">

							    <!-- Modal content-->
							    <div class="modal-content">
							      <div class="modal-header">
							      	<label>Edit Jenis Tembakau</label>
							        <button type="button" class="close" data-dismiss="modal">&times;</button>
							        <h4 class="modal-title"></h4>
							      </div>
							      <div class="modal-body">
							        <form  method="post" action="<?php echo base_url('Bahanbaku/update_jenis/'.$key['id']); ?>">
							        	
							        	<div class="form-group">
							        		<label>Jenis :</label>
							        		<input type="text" name="jenis" class="form-control" value="<?php echo $key['jenis']; ?>">
							        	</div>
							        	<div class="form-group">
							        		<label>Deskripsi :</label>
							        		<textarea name="deskripsi" class="form-control"><?php echo $key['deskripsi']; ?></textarea>
							        	</div>
							        	<div class="form-group">
							        		<label>Keterangan :</label>
							        		<textarea name="keterangan" class="form-control"><?php echo $key['keterangan']; ?></textarea>
							        	</div>

							        
							      </div>
							      <div class="modal-footer">
							      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        <input type="submit" name="tambah" class="btn btn-info">
							        
							      </div>
							    </div></form>

							  </div>
							</div>
							<a title="Hapus" href="<?php echo base_url('Bahanbaku/hapus_jenis/'.$key['id']) ?>" class="btn btn-danger"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
					<?php $no++;
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<label>Tambah Jenis Tembakau</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="<?php echo base_url('Bahanbaku/tambah_jenis') ?>">
        	
        	<div class="form-group">
        		<label>Jenis :</label>
        		<input type="text" name="jenis" class="form-control">
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