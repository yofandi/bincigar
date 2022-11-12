<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>Rekapitulasi</title>
</head>
<body id="print">
<div class="col-md-4">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div class="col-md-4" align="center">
	<b>Rekapitulasi Stock Cerutu</b><br>
	<b>User : <?php echo $user; ?></b><br>
	<text>Tanggal : <b><?= $awal ?></b> Sd. <b><?= $akhir ?></b></text>
</div><br>
<table class="table table-bordered">
	<thead align="center">
		<tr>
			<th rowspan="2">No.</th>
			<th rowspan="2">Nama Barang</th>
			<th rowspan="2">Price / Pack (Rp.)</th>
			<th rowspan="2">Stok</th>
			<?php $name_table = array('Permintaan','Laku','Return','Jumlah Sisa'); 
			foreach ($name_table as $value):?>
			<th colspan="2"><?= $value ?></th>
			<?php endforeach ?>
		</tr>
		<tr>
			<?php $name_table = array('Permintaan','Laku','Return','Jumlah Sisa'); 
			foreach ($name_table as $value):?>
			<th>Pack</th>
			<th>(Rp.)</th>
			<?php endforeach ?>
		</tr>
	</thead>
	<tbody>
		<?php $no = 1; 
		$stk_aw = 0;
		$pack_per = 0; $rp_per = 0;
		$pack_laku = 0; $rp_laku = 0;
		$pack_return = 0; $rp_return = 0;
		$pack_sisa = 0; $rp_sisa = 0;
		foreach ($produk as $lue): 
			$this->db->select('sub_produk.sub_produk,
							   sub_produk.sub_kode,
							   sub_produk.hje,
							   stock_awalrekap.stock_awal as stokawl,
							   SUM(order.jumlah) as jum_per,
							   SUM(order.total) as total_per,
							   SUM(cerutu_terjual.jml) as jum_laku,
							   SUM(penjualan_cerutu.total) as total_laku,
							    SUM(return_bagan.jumlah) as juml_rej');
			$this->db->from('sub_produk');
			$this->db->join('stock_awalrekap', 'sub_produk.id = stock_awalrekap.id_subproduk', 'left');
			$this->db->join('order', 'sub_produk.id = order.id_subproduk', 'left');
			$this->db->join('cerutu_terjual', 'sub_produk.id = cerutu_terjual.id_subproduk', 'left');
			$this->db->join('penjualan_cerutu', 'cerutu_terjual.id_penjualan_bagan = penjualan_cerutu.id_penjualan_bagan', 'left');
			$this->db->join('return_bagan', 'sub_produk.id = return_bagan.id_subproduk', 'left');
			$this->db->like('penjualan_cerutu.id_users', $id_user, 'BOTH');
			$this->db->like('penjualan_cerutu.bagan', $bagan, 'BOTH');
			$this->db->where("order.tanggal BETWEEN '$awal' AND '$akhir'");
			$this->db->where("stock_awalrekap.tanggal_input_awal",$awal);
			$this->db->where("penjualan_cerutu.tanggal BETWEEN '$awal' AND '$akhir'");
			$this->db->where("return_bagan.tanggal BETWEEN '$awal' AND '$akhir'");
			$this->db->where('sub_produk.id', $lue);
			$tampil = $this->db->get()->row_array();

			$total_return = $tampil['juml_rej'] * $tampil['hje'];

			$jumlah_sisa = $tampil['stokawl'] + $tampil['jum_per'] - $tampil['jum_laku'] - $tampil['juml_rej'];
			$harga_sisa = $jumlah_sisa * $tampil['hje'];
			?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $tampil['sub_produk']." || ".$tampil['sub_kode'] ?></td>
			<td><?= $tampil['hje'] ?></td>
			<td align="center"><?= $tampil['stokawl'] ?></td>
			<td align="right"><?= $tampil['jum_per'] ?></td>
			<td align="right"><?= number_format($tampil['total_per'],0,',','.') ?></td>
			<td align="right"><?= $tampil['jum_laku'] ?></td>
			<td align="right"><?= number_format($tampil['total_laku'],0,',','.') ?></td>
			<td align="right"><?= $tampil['juml_rej'] ?></td>
			<td align="right"><?= number_format($total_return,0,',','.') ?></td>
			<td align="right"><?= $jumlah_sisa ?></td>
			<td align="right"><?= number_format($harga_sisa,0,',','.') ?></td>
		</tr>
		<?php $no++;
		$stk_aw += $tampil['stokawl']; 
		$pack_per += $tampil['jum_per']; $rp_per += $tampil['total_per'];
		$pack_laku += $tampil['jum_laku']; $rp_laku += $tampil['total_laku'];
		$pack_return += $tampil['juml_rej']; $rp_return += $total_return;
		$pack_sisa += $jumlah_sisa; $rp_sisa += $harga_sisa;
		endforeach ?>
	</tbody>
	<footer>
		<tr>
			<td></td>
			<td>Jumlah Cerutu</td>
			<td></td>
			<td align="center"><?= $stk_aw ?></td>
			<td align="right"><?= $pack_per ?></td>
			<td align="right"><?= number_format($rp_per,0,',','.') ?></td>
			<td align="right"><?= $pack_laku ?></td>
			<td align="right"><?= number_format($rp_laku,0,',','.') ?></td>
			<td align="right"><?= $pack_return ?></td>
			<td align="right"><?= number_format($rp_return,0,',','.') ?></td>
			<td align="right"><?= $pack_sisa ?></td>
			<td align="right"> <?= number_format($rp_sisa,0,',','.') ?></td>
		</tr>
	</footer>
</table>
<script src="<?= base_url() ?>assets/assets/js/jquery-3.3.1.min.js"></script>
<script>
	$(document).ready(function(){
		var restorpage = document.body.innerHTML;
	    var printcontent = document.getElementById('print').innerHTML;
	    document.body.innerHTML = printcontent;
	    window.print();
	    document.body.innerHTML = restorpage;
	    window.history.back();
	})
</script>
</body>
</html>