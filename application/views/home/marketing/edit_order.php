<style>
	table {text-align: center;}
	table tr th {text-align: center;}
	th{text-transform: uppercase;}
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Marketing / Order / Edit / <?php echo $data['id'] ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong><i class="fa fa-edit"></i> EDIT ORDER ID : <?php echo $data['id'] ?></strong>
		</div>
		<div class="card-body">
			
      	<form method="post" action="<?php echo base_url('Marketing/update_order/'.$data['id']) ?>">
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Tanggal : </label>
      			<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo $data['tanggal'] ?>">
      		</div>
      	</div>
      	<div class="col-lg-8">
      		<div class="form-group">
      			<label>Produk : </label>
      			<select class="form-control" name="produk" id="produk">
      				<?php $datas = $this->db->get('produk')->result_array(); ?>
      				<?php foreach ($datas as $key): ?>
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
      			<input type='text' class='form-control' value='<?php echo $data['bagan'] ?>' disabled=''>
      			<input type='hidden' name='bagan' value='<?php echo $data['bagan'] ?>'>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Keterangan : </label>
      			<textarea name="ket" class="form-control"><?php echo $data['ket'] ?></textarea>
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Quantity/Jumlah : </label>
      			<input type="number" name="jumlah" value="<?php echo $data['jumlah'] ?>" class="form-control">
      		</div>
      	</div>
     
  </div>
  <div class="card-footer">
  	<div class="form-group">
      		<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Update</button>
      	</div> </form>
  </div>
	</div>
</div>

<script>
	$(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
		// jQuery('#table_ku').DataTable({responsive : true});
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