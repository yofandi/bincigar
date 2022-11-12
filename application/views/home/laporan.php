<style>
	table {text-align: center;}
	table tr th {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Laporan</strong>
		</div>
	</div>
</div>


<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-plus"></i> Tambah Laporan Harian</b>
			<?php if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS'): ?>
			<a href="<?php echo base_url('Home/add_laporan') ?>"class="btn btn-danger pull-right btn-sm"> <i class="fa fa-plus-circle"></i> Tambah Laporan</a><?php endif ?>
		</div>
		<div class="card-body">
			<table class="table table-hover" id="table_ku">
				<thead class="bg-dark text-light">
					<tr>
						<td>No</td>
						<td>Tanggal</td>
						<td>Direksi</td>
						<td>Kesulitan</td>
						<?php if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS') {
							echo "<td>Aksi</td>";
						}else{ echo "";} ?>
					</tr>
				</thead>
				<tbody>
					<?php $laporan = $this->db->order_by('id', 'DESC')->get('laporan')->result_array(); ?>
					<?php $no=1;foreach ($laporan as $key): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo 	$key['tanggal'] ?></td>
							<td><?php echo 	$key['direksi'] ?></td>
							<td><?php echo 	$key['kesulitan'] ?></td>
							<?php if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS') {
								?>
							<td>
								<a href="#" class="btn btn-info btn-sm text-light" data-toggle="modal" data-target="#myModal<?= $no ?>"><i class="fa fa-send"></i> Kirim</a>
								<div id="myModal<?= $no ?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content" align="left">
								      <div class="modal-header">
								        <h4 class="modal-title">Kirim Laporan ID : <?= $key['id'] ?></h4>
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								      </div>
								      <form action="<?= base_url('Home/send_email/'.$key['id']) ?>" method="post" accept-charset="utf-8">
								      <div class="modal-body">
								        <div class="row">
			                              <div class="col-lg-12">
				                              <div class="form-group">
					                              <label>Kepada : </label>
					                              <input type="email" name="kepada" class="form-control" placeholder="Contoh: otheremail@gmail.com">	
				                              </div>
			                              </div>
			                              <div class="col-lg-12">
				                              <div class="form-group">
					                              <label>Subject : </label>
					                              <input type="text" name="subject" class="form-control" placeholder="Subject">
				                              </div>
			                              </div>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-info">Send</button>
								      </div>
								      </form>
								    </div>

								  </div>
								</div>
								<a href="<?php echo base_url('Home/edit_laporan/'.$key['id']) ?>" class="btn btn-warning btn-sm text-light"><i class="fa fa-edit"></i> Edit</a>
								<a href="<?php echo base_url('Home/hapus_laporan/'.$key['id']) ?>" class="btn btn-danger btn-sm text-light"><i class="fa fa-trash"></i> Hapus</a>
							</td>
								<?php
							}else{ echo "";} ?>
							
						</tr>
					<?php $no++;endforeach ?>
				</tbody>
			</table>	
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		
	})
</script>
