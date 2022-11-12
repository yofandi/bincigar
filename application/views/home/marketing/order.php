<style>
	table {text-align: center;}
	table tr th {text-align: center;}
	th{text-transform: uppercase;}
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Marketing / Order</strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong><i class="fa fa-plus"></i> Tambah Bagan Store</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<?php 
		if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS') {
			?>
		<table class="table table-hover table-bordered table-responsive" id="table_ku">
			<thead>
				<tr>
					<th>NO</th>
					<th>Produk</th>
					<th>Kode</th>
					<th>Kemasan</th>
					<th>Isi</th>
					<th>hje</th>
					<th>jumlah</th>
					<th>total</th>
					<th>bagan</th>
					<th>tanggal</th>
					<!-- <th>aksi</th> -->
				</tr>
			</thead>
			<tbody>
				<?php $data = $this->db->order_by('id', 'DESC')->get('order')->result_array(); ?>
				<?php $no=1; foreach ($data as $key): ?>
				<tr>
					
					<td><?php echo $no ?></td>
					<td><?php echo $key['subproduk'] ?></td>
					<td><?php echo $key['sub_kode'] ?></td>
					<td><?php echo $key['kemasan'] ?></td>
					<td><?php echo $key['isi'] ?></td>
					<td style="text-align: right;"><?php echo 'Rp.'.number_format($key['hje'],2,',','.'); ?></td>
					<td><?php echo $key['jumlah'] ?></td>
					<td style="text-align: right;"><?php echo 'Rp.'.number_format($key['total'],2,',','.'); ?></td>
					<td><?php echo $key['bagan'] ?></td>
					<td><?php echo $key['tanggal'] ?></td>
					<!-- <td>
						<a href="<?php echo base_url('Marketing/edit_order/'.$key['id']) ?>" class="text-warning" title="Edit"><i class="fa fa-edit"></i></a>
						<a href="<?php echo base_url('Marketing/del_order/'.$key['id']) ?>" class="text-danger" title="Hapus"><i class="fa fa-trash"></i></a>
					</td> -->
				
				</tr>
				<?php $no++; endforeach ?>
			</tbody>
		</table>
			<?php	
		}else{
			?>
		<table id="table_ku" class="table table-hover table-responsive table-bordered">
			<thead class="thead-dark">
				<tr>
					<th>NO</th>
					<th>Produk</th>
					<th>Kode</th>
					<th>Kemasan</th>
					<th>Isi</th>
					<th>HJE</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Bagan</th>
					<th>Tanggal</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<?php $bagan = $this->db->order_by('id', 'DESC')->get_where('order', array('bagan' => $_SESSION['level']))->result_array(); ?>
			<tbody>
				<?php $no=1;foreach ($bagan as $key): ?>
				<tr>
					<td><?php echo $no ?></td>
					<td><?php echo $key['subproduk'] ?></td>
					<td><?php echo $key['sub_kode'] ?></td>
					<td><?php echo $key['kemasan'] ?></td>
					<td><?php echo $key['isi'] ?></td>
					<td style="text-align: right;"><?php echo 'Rp.'.number_format($key['hje'],2,',','.'); ?></td>
					<td><?php echo $key['jumlah'] ?></td>
					<td style="text-align: right;"><?php echo 'Rp.'.number_format($key['total'],2,',','.'); ?></td>
					<td><?php echo $key['bagan'] ?></td>
					<td><?php echo $key['tanggal'] ?></td>
					<td>
						<a href="<?php echo base_url('Marketing/edit_order/'.$key['id']) ?>" class="text-warning" title="Edit"><i class="fa fa-edit"></i></a>
						<a href="<?php echo base_url('Marketing/del_order/'.$key['id']) ?>" class="text-danger" title="Hapus"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				<?php $no++;endforeach ?>
			</tbody>
		</table>
			<?php
		}
			?>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b>Tambah Order</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url('Marketing/add_order') ?>">
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Tanggal : </label>
      			<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?= date('Y-m-d') ?>">
      		</div>
      	</div>
      	<div class="col-lg-8">
      		<div class="form-group">
      			<label>Produk : </label>
      			<select class="form-control" name="produk" id="produk">
      				<?php $data = $this->db->get('produk')->result_array(); ?>
      				<?php foreach ($data as $key): ?>
      					<option value="<?php echo $key['id'] ?>"><?php echo $key['produk'] ?></option>
      				<?php endforeach ?>
      			</select>
      		</div>
      	</div>
      	<div class="col-lg-4">
      		<div class="form-group">
      			<label>FILTER</label><br>
      			<button class="btn btn-info" id="filter"><i class="fa fa-search"></i> FILTER</button>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Suproduk :</label>
      			<div id="tampil"></div>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Bagan : </label>
      			<?php 
      		if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS') {
      			?>
      			<select class="form-control" name="bagan">
      		<?php $bagan = $this->db->get('bagan_store')->result_array(); ?>
      		<?php foreach ($bagan as $key): ?>
      			<option value="<?php echo $key['nama'] ?>"><?php echo $key['nama'] ?></option>
      		<?php endforeach ?>
      			</select>
      			<?php
      		}elseif($_SESSION['level'] == 'STORE'){
      			echo "<input type='text' class='form-control' name='bagan' value='STORE' readonly>";
      		}elseif($_SESSION['level'] == 'AGENT'){
      			echo "<input type='text' class='form-control' name='bagan' value='AGENT' readonly>";
      		}elseif($_SESSION['level'] == 'PHRI'){
      			echo "<input type='text' class='form-control' name='bagan' value='PHRI' readonly>";
      		}elseif($_SESSION['level'] == 'NON PHRI'){
      			echo "<input type='text' class='form-control' name='bagan' value='NON PHRI' readonly>";
      		}elseif($_SESSION['level'] == 'EXPORT'){
      			echo "<input type='text' class='form-control' name='bagan' value='EXPORT' readonly>";
      		}elseif($_SESSION['level'] == 'SOUVENIR'){
      			echo "<input type='text' class='form-control' name='bagan' value='SOUVENIR' readonly>";
      		}
      		else{}

      			?>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Keterangan : </label>
      			<textarea name="ket" class="form-control"></textarea>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Quantity/Jumlah : </label>
      			<input type="number" name="jumlah" class="form-control">
      		</div>
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
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#table_ku').DataTable({responsive : true});
	});
	$('#filter').on('click', function(event){
		event.preventDefault();
		var produk = $('#produk').val();
		$.ajax({
			url : '<?php echo base_url("Marketing/cari_sub/") ?>'+produk,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#tampil').html(data);
			}
		})
	})
</script>