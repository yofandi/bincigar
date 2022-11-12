<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Referensi / Stock Kemasan</strong>
		</div>
	</div>
</div>
<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-info text-light">
			<strong>Stock ( Kemasan )</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Kemasan</th>
						<th>Stock Awal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $key) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['produk'] ?></td>
						<td><?php echo $key['nama_kemasan'] ?></td>
						<td><?php echo $key['stock'] ?></td>
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
					<label>Produk : </label>
					<input type="text" id="produk" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label>Stock : </label>
					<input type="text" id="stock" class="form-control">
				</div>
				<div class="form-group">
					<label>Kemasan</label>
					<select class="form-control" id="kemasan">
        			<?php $kemasan=$this->db->order_by('id','ASC')->get('kemasan')->result_array(); ?>
        			<?php foreach ($kemasan as $key): ?>
        				<option value="<?php echo $key['nama'] ?>"><?php echo $key['nama'] ?></option>
        			<?php endforeach ?>
        		</select>
				</div>
				<div class="form-group">
					<button id="update" class="btn btn-danger">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong>Daftar Bahan Kemasan</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$data = $this->db->get('kemasan')->result_array();
					$no=1; foreach ($data as $key) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['nama'] ?></td>
						<!-- <td><?php echo $key['keterangan'] ?></td> -->
						<td>
							<button type="button" onclick="edit2(<?php echo $key['id'] ?>)" class="btn btn-info" title="Edit" data-toggle="modal" ><i class="fa fa-edit"></i> </button>
							<button class="btn btn-danger" title="Hapus" onclick="hapus2(<?php echo $key['id'] ?>)"><i class="fa fa-trash"></i></button>
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
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-edit"></i> Edit Kemasan | ID : <b id="id_kemasan"></b></b>
		</div>
		<div class="card-body">
			<form>
				<div class="form-group">
					<label>Nama Kemasan : </label>
					<input type="text" name="kemasan2" id="kemasan2" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn success" id="update"><i class="fa fa-save"></i> Update</button>
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
        <form  method="post" action="<?php echo base_url('Bahanbaku/add_stock_Kemasan') ?>">
        	
        	<div class="form-group">
        		<label>Produk :</label>
        		<select class="form-control" name="produk">
        			<?php $produk=$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
        			<?php foreach ($produk as $key): ?>
        				<option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Kemasan :</label>
        		<select class="form-control" name="kemasan">
        			<?php $kemasan=$this->db->order_by('id','ASC')->get('kemasan')->result_array(); ?>
        			<?php foreach ($kemasan as $key): ?>
        				<option value="<?php echo $key['nama'] ?>"><?php echo $key['nama'] ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Stock Awal :</label>
        		<input name="stock" class="form-control" type="number">
        	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
        
      </div>
    </div></form>

  </div>
</div>


<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus"></i> Tambah Bahan Pembantu ( Kemasan )</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="<?php echo base_url('Bahan_pembantu/tambah_kemasan') ?>">
        	
        	<div class="form-group">
        		<label>Nama :</label>
        		<input type="text" name="nama" class="form-control">
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
	function hapus2(id) {
		$.ajax({
			url : '<?php echo base_url("Bahan_pembantu/hapus_kemasan/") ?>'+id,
			method : 'POST',
			success : function(data){
				alert(data);
				location.reload();
			}
		})
	}
	$(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});
	function edit2(id) {
		$.ajax({
			url : '<?php echo base_url("Bahan_pembantu/edit_kemasan/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#id_kemasan.html').val(id);
				$('#kemasan2').val(data.nama);

				$('#update').on('click', function(event){
					event.preventDefault();

					var nama = $('#kemasan2').val();

					$.ajax({
						url : '<?php echo base_url("Bahan_pembantu/update_kemasan/") ?>'+id,
						method : 'POST',
						data : {nama:nama},
						success : function(data){
							alert(data);
							location.reload();
						}
					})
				})
				// $('#myModal2').modal('show');
			}
		})
	}

	function edit(id) {
		
		$.ajax({
			url : '<?php echo base_url("Bahanbaku/edit_stock_Kemasan/") ?>'+id,
			method : 'POSt',
			dataType : 'JSON',
			success : function(data){
				$('#produk').val(data.produk);
				$('#stock').val(data.stock);
				// $('#ket2').val(data.keterangan);

				$('#update').on('click', function(event){
					event.preventDefault();
					var produk = $('#produk').val();
					var stock = $('#stock').val();
					var kemasan = $('#kemasan').val();
					$.ajax({
						url : '<?php echo base_url("Bahanbaku/update_stock_Kemasan/") ?>'+id,
						method : 'POST',
						data : {kemasan:kemasan,produk:produk, stock:stock},
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
			url : '<?php echo base_url("Bahanbaku/hapus_stock_Kemasan/") ?>'+id,
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