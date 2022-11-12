<style>
	th {text-align: center;}
	tbody {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Home / Daftar Return RFS</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-primary text-light">
		<b>Daftar Retrun RFS</b>
		</div>
		<div class="card-body">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Produk</th>
						<th>Sub Produk</th>
						<th>Jumlah (kemasan)</th>
						<th>Keterangan</th>
						<th>Tanggal</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1; foreach ($reject->result() as $key) { ?>
					<tr>
						<td><?= $no ?></td>
						<td><?= $key->produk ?></td>
						<td><?= $key->sub_produk.' | '.$key->sub_kode ?></td>
						<td><?= $key->jumlah ?></td>
						<td><?= $key->ket ?></td>
						<td><?= $key->tanggal ?></td>
						<td><a href="<?= base_url('Home/kirim_return/'.$key->id_rtn) ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	function kirim(id) {
		$.ajax({
			url: '<?= base_url("Home/terima_reject_qc/") ?>'+id,
			type: 'get',
			success : function (data) {
				alert(data);
				window.location.reload();
			}
		})
	}
</script>