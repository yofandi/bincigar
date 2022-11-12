<style type="text/css">
.table_scroll {
	border-spacing: 0;
}

.table_scroll tbody,
.table_scroll thead tr { display: block; }

.table_scroll tbody {
	height: 500px;
	overflow-y: scroll;
	overflow-x: hidden;
}

.table_scroll tbody td,
.table_scroll thead th {
	width: 140px;
}

.table_scroll thead th:last-child {
	width: 156px; /* 140px + 16px scrollbar width */
}

.table_scroll thead tr th { 
	height: 30px;
	line-height: 30px;
	/*text-align: left;*/
}


.table_scroll tbody td:last-child, thead th:last-child {
	border-right: none !important;
}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Produk</strong>
		</div>
	</div>
</div>

<div class="col-lg-4">
	<div class="card">
		<div id="tampil_edit">
			<div class="card-header">
				<b>Edit Produk ID : <b id="id_produk"></b></b>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Nama Produk :</label>
					<input type="text" class="form-control" name="edit_produk" id="edit_produk">
				</div>
				<div class="form-group">
					<button id="update_produk" class="btn btn-info">Update</button>
				</div>
			</div>
		</div>
		<div class="card-header bg-danger text-light">
			<b>Daftar Produk</b>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table_scroll table-hover table-border">
				<input type="hidden" id="tampil_kode" name="tampil_kode" class="form-control" disabled="">
				<thead>
					<tr>
						<th style="text-align:center;">NO</th>
						<th style="text-align:center;">PRODUK</th>
						<th style="text-align: center;">OPSI</th>
					</tr>
				</thead>
				<tbody id="data_produk">

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="col-lg-8">
	<div class="card">
		<div class="card-header bg-info text-justifity text-light">
			<b><i class="fa fa-list"></i> Submenu Produk</b>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Produk : </label>
				<input type="text" disabled="" id="produk_utama" class="form-control">
			</div>
			<div id="tampil_sub">
				<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i> Tambah</button>
				<button onclick="lihat_sub()" class="btn btn-success btn-sm"> Lihat Sub</button>
			</div>
			<hr>
			<div class="table-responsive">
				<table class="table" id="table_ku">
					<thead>
						<tr>
							<!-- <th>No</th> -->
							<th>Kode</th>
							<th>Nama</th>
							<th>Kemasan</th>
							<th>Isi</th>
							<th>HJE</th>
							<th>Tarif</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody id="tampilkan_subproduk"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
  	<form>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus-circle"></i> Tambah SubMenu Produk</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<label>Produk : </label>
      		<input type="text" id="tampil_produk" class="form-control" disabled="">
      	</div>
      	<hr>
      	<div class="col-lg-6">
      		<div class="form-group">
	      		<label>Sub Produk : </label>
	      		<input type="text" id="sub_produk" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Kode Sub Produk : </label>
	      		<input type="text" id="kode_sub_produk" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Isi : </label>
	      		<input type="text" id="isi" class="form-control">
	      	</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
	      		<label>Harga Jual Eceran (HJE) : </label>
	      		<input type="text" id="hje" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Tarif : </label>
	      		<input type="text" id="tarif" class="form-control">
	      	</div>
	      	<div class="form-group">
	      		<label>Kemasan : </label>
	      		<select id="kemasan" class="form-control">
	      			<?php 
	      		$a = $this->db->order_by('id', 'DESC')->get('kemasan')->result_array();
	      			foreach ($a as $keys) {
	      				?>
	      			<option value="<?php echo $keys['nama'] ?>"><?php echo $keys['nama'] ?></option>
	      				<?php
	      			}
	      			?>
	      		</select>
	      	</div>
      	</div>

      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" id="tambah_sub" class="btn btn-info" value="Tambah">
      </div>
    </div>
    </form>
  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus"></i> Tambah Produk</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body"><form method="post" action="<?php echo base_url("Merek/add_produk") ?>">
      	<div class="form-group">
      		<label>Nama Merek/Produk : </label>
      		<input type="text" name="merek" class="form-control">
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
      </div></form>
    </div>
  </div>
</div>

<div id="myModalku" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus"></i> Tambah Produk</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body"><form method="post" action="<?php echo base_url("Merek/add_produk") ?>">
      	<div class="form-group">
      		<label>Nama Merek/Produk : </label>
      		<input type="text" name="merek" class="form-control">
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
      </div></form>
    </div>
  </div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus"></i> Edit Merek/Produk</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body"><form method="post" action="<?php echo base_url("Merek/add_produk") ?>">
      	<form>
      		<input type="hidden" id="sub_id">
      		<div class="col-lg-6">
      			<div class="form-group">
	      			<label>Sub Produk :</label>
	      			<input type="text" name="sub_produk_edit" id="sub_produk_edit" class="form-control"> 
	      		</div>
	      		<div class="form-group">
	      			<label>Sub Kode : </label>
	      			<input type="text" name="sub_kode_edit" id="sub_kode_edit" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Isi : </label>
	      			<input type="text" name="isi_edit" id="isi_edit" class="form-control">
	      		</div>
      		</div>
      		<div class="col-lg-6">
      			<div class="form-group">
	      			<label>Harga Jual Eceran (HJE) : </label>
	      			<input type="text" name="hje_edit" id="hje_edit" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Tarif : </label>
	      			<input type="text" name="tarif_edit" id="tarif_edit" class="form-control">
	      		</div>
	      		<div class="form-group">
	      			<label>Kemasan : </label>
	      			<select name="kemasan_edit" id="kemasan_edit" class="form-control">
	      			<?php 
	      		$a = $this->db->order_by('id', 'DESC')->get('kemasan')->result_array();
	      			foreach ($a as $keys) {
	      				?>
	      			<option value="<?php echo $keys['nama'] ?>"><?php echo $keys['nama'] ?></option>
	      				<?php
	      			}
	      			?>
	      		</select>
	      		</div>
      		</div>
      	</form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" id="update_subproduk" class="btn btn-info">
      </div></form>
    </div>

  </div>
</div>

<script>
	$(document).ready(function(){
		$.ajax({
			url : '<?php echo base_url("Merek/ambil") ?>',
			dataType : 'JSON',
			method : 'POST',
			success : function(data){
				// console log
				$('#data_produk').append(data);
				console.log();
			}
		})
	})
	// tambah_sub
	$('#tambah_sub').on('click', function(event){
		event.preventDefault();
		var kode = $('#tampil_kode').val();
		var hje = $('#hje').val();
		var isi = $('#isi').val();
		var kemasan = $('#kemasan').val();
		var tarif = $('#tarif').val();
		var sub_kode = $('#kode_sub_produk').val();
		var sub_produk = $('#sub_produk').val();
		if (kode == '') {
			alert('tidak boleh kosong !');
		}else{

			$.ajax({
				url : '<?php echo base_url("Merek/tambah_sub_produk") ?>',
				method : 'POST',
				data : {sub_produk:sub_produk, kode:kode, sub_kode:sub_kode,hje:hje, tarif:tarif, isi:isi,kemasan:kemasan},
				success : function(data){
					alert(data);
					location.reload();
				}
			})
		}
	})

	function lihat_sub() {
		var kode = $('#tampil_kode').val();

		$.ajax({
			url : '<?php echo base_url("Merek/ambil_sub") ?>',
			method : 'POST',
			dataType : 'JSON',
			data : {kode:kode},
			success : function(data){
				$('#tampilkan_subproduk').html(data);
			}
		})
	}

	// edit subproduk
	function edit_subproduk(id) {
		$.ajax({
			url : '<?php echo base_url("Merek/edit_subproduk/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			// data : {kode:kode},
			success : function(data){
				$('#sub_kode_edit').val(data.sub_kode);
				$('#sub_produk_edit').val(data.sub_produk);
				$('#hje_edit').val(data.hje);
				$('#tarif_edit').val(data.tarif);
				$('#isi_edit').val(data.isi);
				// $('#kemasan_edit').val(data.sub_produk);
				$('#sub_id').val(data.id);
			}
		})
	}

	$('#update_subproduk').on('click', function(event){
		event.preventDefault();

		var id = $('#sub_id').val();
		var isi_edit = $('#isi_edit').val();
		var tarif_edit = $('#tarif_edit').val();
		var hje_edit = $('#hje_edit').val();
		var kemasan_edit = $('#kemasan_edit').val();
		var sub_produk = $('#sub_produk_edit').val();
		var sub_kode = $('#sub_kode_edit').val();
		$.ajax({
			url : '<?php echo base_url("Merek/update_subproduk/") ?>'+id,
			data : { sub_produk:sub_produk, sub_kode :sub_kode, kemasan_edit:kemasan_edit, hje_edit:hje_edit,tarif_edit:tarif_edit,isi_edit:isi_edit },
			method : 'POST',
			success : function(data){
				alert(data);
				location.reload();
			}
		})
	})

	// hapus_subproduk
	function hapus_subproduk(id) {
		$.ajax({
			url : '<?php echo base_url("Merek/hapus_subproduk/") ?>'+id,
			method : 'POST',
			success : function(data){
				alert(data); location.reload();
			}
		})
	}
	// tampil_edit
	$('#tampil_edit').hide();

	function edit_produk(id) {
		$('#tampil_edit').fadeIn();
		$('#id_produk').html(id);
		$.ajax({
			url : '<?php echo base_url("Merek/ambil_produk/") ?>'+id,
			method :'POST',
			dataType : 'JSON',
			success : function(data){
				$('#edit_produk').val(data.produk);

				$('#update_produk').on('click', function(event){
					event.preventDefault();
					var edit_produk2 = $('#edit_produk').val();
					$.ajax({
						url : '<?php echo base_url("Merek/update_produk/") ?>'+id,
						data : {edit_produk2:edit_produk2},
						method : 'POST',
						success : function(data){
							alert(data);
							location.reload();
						}
					})
				})
			}
		})
	}
</script>