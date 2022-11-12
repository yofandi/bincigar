<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Referensi / Stock Stiker</strong>
		</div>
	</div>
</div>
<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-info text-light">
			<strong>Stock ( Stiker )</strong>
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
						<th>Stock Awal (LUAR)</th>
						<th>Stock Awal (DALAM)</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($data as $key) {
						?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['produk'] ?></td>
						<td><?php echo $key['stock_luar'] ?></td>
						<td><?php echo $key['stock_dalam'] ?></td>
						<td>
							<button title="Edit" class="btn btn-warning btn-sm" onclick="edit(<?php echo $key['id'] ?>)"><i class="fa fa-edit"></i></button>
							<button title="Hapus" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $key['id'] ?>)"><i class="fa fa-trash"></i></button>
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
					<input type="text" id="produk" class="form-control" disabled="">
				</div>
				<div class="form-group">
					<label>Stock Luar: </label>
					<input type="text" id="stock_luar" class="form-control">
				</div>
				<div class="form-group">
					<label>Stock Dalam: </label>
					<input type="text" id="stock_dalam" class="form-control">
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
        <form  method="post" action="<?php echo base_url('Bahanbaku/add_stock_Stiker') ?>">
        	
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
        		<label>Stock Awal (LUAR):</label>
        		<input name="stock_luar" class="form-control" type="number">
        	</div>
        	<div class="form-group">
        		<label>Stock Awal (DALAM):</label>
        		<input name="stock_dalam" class="form-control" type="number">
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
			url : '<?php echo base_url("Bahanbaku/edit_stock_Stiker/") ?>'+id,
			method : 'POSt',
			dataType : 'JSON',
			success : function(data){
				$('#produk').val(data.produk);
				$('#stock_luar').val(data.stock_luar);
				$('#stock_dalam').val(data.stock_dalam);
				// $('#ket2').val(data.keterangan);

				$('#update').on('click', function(event){
					event.preventDefault();
					var produk = $('#produk').val();
					var stock_luar = $('#stock_luar').val();
					var stock_dalam = $('#stock_dalam').val();
					$.ajax({
						url : '<?php echo base_url("Bahanbaku/update_stock_Stiker/") ?>'+id,
						method : 'POST',
						data : {produk:produk, stock_luar:stock_luar,stock_dalam:stock_dalam},
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
			url : '<?php echo base_url("Bahanbaku/hapus_stock_Stiker/") ?>'+id,
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