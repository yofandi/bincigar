<style>
	.pp {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Daftar Reject Tembakau</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-primary text-light">
		<b>Daftar Reject Dari Quality Control</b>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead class="pp">
					<tr>
						<th>No.</th>
						<th>Jenis</th>
						<th>Produk</th>
						<th>Sub Produk</th>
						<th>Binding (batang)</th>
						<th>Wrapping (batang)</th>
						<th>Filler 2 (batang)</th>
						<th>Packing (kemasan)</th>
						<th>Keterangan</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($reject->result() as $key) { ?>
					<tr>
						<td class="pp"><?= $no ?></td>
						<td class="pp"><?= $key->jenis ?></td>
						<td class="pp"><?= $key->produk ?></td>
						<td class="pp"><?= $key->sub_produk." | ".$key->sub_kode ?></td>
						<td class="pp"><?= $key->bind ?></td>
						<td class="pp"><?= $key->wrap ?></td>
						<td class="pp"><?= $key->rusak ?></td>
						<td class="pp"><?= $key->pack ?></td>
						<td class="pp"><?= $key->keterangan ?></td>
						<td><input type="hidden" id="status_<?=$no?>" value="<?=$key->status?>">
							<button type="button" onclick="proses('<?=$key->id?>')" id="terima<?=$no?>" class="btn btn-warning">Terima & Proses</button>
							<button type="button" id="finish<?=$no?>" class="btn btn-success" data-toggle="modal" data-target="#myModal<?= $no ?>"></i>Selesai</button> <!-- onclick="kirim('<?= $key->id ?>')" -->
							<!-- Modal -->
						<div id="myModal<?= $no ?>" class="modal fade" role="dialog">
						  <div class="modal-dialog modal-lg">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						      	<b><i class="fa fa-plus-circle"></i> Terima Reject</b>
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title"></h4>
						      </div>
						      <form method="post" action="<?= base_url('Home/terima_reject/'.$key->id) ?>">
						      <div class="modal-body">
						        <div class="col-lg-4">
						        	<div class="form-group">
						        		<label>Binding :</label>
						        		<input type="hidden" name="id_sub" value="<?= $key->id_sub ?>">
						        		<input type="hidden" name="sub_produk" value="<?= $key->sub_produk ?>">
						        		<input type="hidden" name="sub_kode" value="<?= $key->sub_kode ?>">
						        		<input type="hidden" name="jenis" value="<?= $key->jenis ?>">
						        		<input type="hidden" name="produk" value="<?= $key->produk ?>">
						        		<input type="number" class="form-control" name="bind" value="<?= $key->bind ?>" readonly>
						        	</div>
						        </div>
						        <div class="col-lg-4">
						        	<div class="form-group">
						        		<label>Wrapping :</label>
						        		<input type="number" class="form-control" name="wrap" value="<?= $key->wrap ?>" readonly>
						        	</div>
						        </div>
						        <div class="col-lg-4">
						        	<div class="form-group">
						        		<label>Packing :</label>
						        		<input type="number" class="form-control" name="pack" value="<?= $key->pack ?>" readonly>
						        	</div>
						        </div>
						        <div class="col-lg-4">
							     	<div class="form-group">
							      		<label>Filler 2 (batang)</label>
							      		<input type="text" class="form-control" value="<?= $key->rusak ?>" readonly>
							     	</div>
							    </div>
						        <div class="col-lg-4 pp">
						        	<br>
						        	<b>Convert</b>
							    </div>
							    <div class="col-lg-4">
							     	<div class="form-group">
							      		<label>Filler 2 (Kg)</label>
							      		<input type="number" step="any" class="form-control" name="fill2">
							     	</div>
							    </div>
						      </div>
						      <div class="modal-footer">
						      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        <input type="submit" name="tambah" class="btn btn-info">
						      </div>
						  	  </form>		
						    </div>
						  </div>
						</div>
						<script>
							var sta = $('#status_<?=$no?>').val();
							if (sta == 2) {
								$('#terima<?=$no?>').hide();
								$('#finish<?=$no?>').fadeIn();
							} else {
								$('#terima<?=$no?>').fadeIn();
								$('#finish<?=$no?>').hide();
							}
							function proses(id) {
								$.ajax({
									url: '<?= base_url("Home/terima_proses/") ?>'+id,
									type: 'GET',
									success : function (data) {
										window.location.reload();
									}
								})
							}
						</script>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
