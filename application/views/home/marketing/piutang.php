<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Piutang</strong>
    </div>
  </div>
</div>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-warning text-light">
			<b><i class="fa fa-credit-card-alt"></i> PIUTANG BULAN INI : <?php echo date('Y').' '.$bulan[date('m')] ?></b>

			<button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Tambah Piutang</button>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover table-bordered" id="table_ku">
					<thead align="center">
						<tr>
							<th>No.</th>
							<th>Tanggal</th>
							<th>Invoice</th>
							<th>Customer</th>
							<th>Yang Dibayarkan</th>
							<th>Kurang</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach ($piutang->result() as $key): $date = date_create($key->tanggal);?>
						<tr>
							<td><?= $no ?></td>
							<td><?= date_format($date,'Y-m-d') ?></td>
							<td align="center"><?= $key->no_invoice ?></td>
							<td align="center"><?= $key->nama_customer ?></td>
							<td align="right"><?= number_format($key->yang_dibayar,2,',','.') ?></td>
							<td align="right"><?= number_format($key->kurang,2,',','.') ?></td>
							<td align="center"><?php if ($key->status_pembayaran == 1) {echo "Belum Lunas";} else {echo "Lunas";}
							 ?></td>
							<td><a href="<?= base_url('Marketing/delete_piutang/'.$key->id_piutang) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
						</tr>
						<?php $no++; endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<label><i class="fa fa-plus"></i> Tambah Piutang</label>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
			<form action="<?= base_url('Marketing/add_piutang') ?>" method="post">
				<div class="col-lg-6">
					<div class="form-group">
						<label>ID Transaksi :</label>
						<input type="text" class="form-control" name="no_tra" id="id_penjualan" value="0">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Yang Harus Dibayar :</label>
						<input type="text" class="form-control" id="kurang" readonly>
						<input type="hidden" class="form-control" name="kurang" id="kr">
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<label>Bayar (Rp.) :</label>
						<input type="number" class="form-control" name="bayar">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<button type="submit" class="pull-right btn btn-danger"><i class="fa fa-save"></i> SAVE</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
    	jQuery('#tanggal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#table_ku').DataTable({
			responsive: true
		});
	});

	$('#id_penjualan').keyup(function(event) {
		var id = $(this).val();

		$.ajax({
			url: '<?= base_url("Marketing/show_kurang_piutang/") ?>'+id,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#kr').val(data.kurang);
				$('#kurang').val(accounting.formatMoney(data.kurang));
			}
		})
	});
</script>