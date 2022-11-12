<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<title>Stock Cerutu</title>
</head>
<body id="print">
<div class="col-md-4">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div class="col-md-4" align="center">
	<b>Laporan Stock Harian</b><br>
	<text>Tanggal : <b><?= $awal ?></b> Sd. <b><?= $akhir ?></b></text>
</div><br>
<table class="table table-bordered">
	<thead>
		<tr align="center">
			<th rowspan="3">No.</th>
			<th rowspan="3">Kode</th>
			<th rowspan="3">Barang</th>
			<th rowspan="2" colspan="2">Produksi (Batang)</th>
			<th colspan="4">Packing</th>
			<th colspan="9">Gagal Produk / Reject (Btg)</th>
			<th rowspan="3">Stock S/D Hari Ini</th>
		</tr>
		<tr align="center">
			<th rowspan="2">Kemasan</th>
			<th rowspan="2">Isi</th>
			<th colspan="2">Batang</th>
			<th colspan="2">Binding</th>
			<th colspan="2">Wraping</th>
			<th colspan="2">Packing</th>
			<th colspan="2">Filler 2</th>
			<th rowspan="2">Jumlah</th>
		</tr>
		<tr align="center">
			<th>Hi</th>
			<th>S/d</th>
			<th>Hi</th>
			<th>S/d</th>
			<th>Hi</th>
			<th>s/d</th>
			<th>Hi</th>
			<th>s/d</th>
			<th>Hi</th>
			<th>s/d</th>
			<th>Hi</th>
			<th>s/d</th>
		</tr>
	</thead>
	<tbody>
		<tbody>
		<?php 
		$alfabet = 'A';
		foreach ($produk->result() as $key): 
		$sb = $this->db->where('id_produk',$key->id)->get('sub_produk');
		if ($sb->num_rows() > 0) {
		$ll = $sb->row();
		// $this->db->select('SUM(rfs.stock_batang) as stock_batang');
		// $this->db->from('rfs');
		// $this->db->join('sub_produk', 'rfs.id_subproduk = sub_produk.id', 'inner');
		// $this->db->where(array('sub_produk.id_produk' => $ll->id_produk));
		// $this->db->where("rfs.tanggal",date('Y-m-d'));
		// $hi_produk = $this->db->get()->row();
		$this->db->select('SUM(accept) as stock_batang');
		$this->db->where('produk',$key->produk);
		$this->db->where('tanggal', date('Y-m-d'));
		$hi_produk = $this->db->get('qc')->row();

		// $this->db->select('SUM(rfs.stock_batang) as stock_batang');
		// $this->db->from('rfs');
		// $this->db->join('sub_produk', 'rfs.id_subproduk = sub_produk.id', 'inner');
		// $this->db->where(array('sub_produk.id_produk' => $ll->id_produk));
		// $this->db->where("rfs.tanggal BETWEEN '$awal' AND '$akhir'");
		// $sd_produk = $this->db->get()->row();
		$this->db->select('SUM(accept) as stock_batang');
		$this->db->where('produk',$key->produk);
		$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
		$sd_produk = $this->db->get('qc')->row();

		$this->db->select('SUM(reject.r_binding) as r_binding,
						   SUM(reject.r_wrapping) as r_wrapping,
						   SUM(reject.r_packing) as r_packing,
						   SUM(reject.r_rusak) as r_rusak');
		$this->db->from('reject');
		$this->db->join('sub_produk', 'reject.id_subproduk = sub_produk.id', 'inner');
		$this->db->where('sub_produk.id_produk', $ll->id_produk);
		$this->db->where("reject.tanggal",date('Y-m-d'));
		$hi_reject = $this->db->get()->row();

		$this->db->select('SUM(reject.r_binding) as r_binding,
						   SUM(reject.r_wrapping) as r_wrapping,
						   SUM(reject.r_packing) as r_packing,
						   SUM(reject.r_rusak) as r_rusak');
		$this->db->from('reject');
		$this->db->join('sub_produk', 'reject.id_subproduk = sub_produk.id', 'inner');
		$this->db->where('sub_produk.id_produk', $ll->id_produk);
		$this->db->where("reject.tanggal BETWEEN '$awal' AND '$akhir' ");
		$sd_reject = $this->db->get()->row();

		$jml_reject= $sd_reject->r_binding + $sd_reject->r_wrapping + $sd_reject->r_packing + $sd_reject->r_rusak;
		?>	
		<tr>
			<td><?= $alfabet ?></td>
			<td><?= $key->produk ?></td>
			<td></td>
			<td align="right"><?= $hi_produk->stock_batang ?></td>
			<td align="right"><?= $sd_produk->stock_batang ?><input type="number" class="hidd action" id="jml_btg<?= $alfabet ?>" value="<?= $sd_produk->stock_batang ?>"></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="right" id="stt<?= $alfabet ?>"></td>
			<td><?= $hi_reject->r_binding ?></td>
			<td><?= $sd_reject->r_binding ?></td>
			<td><?= $hi_reject->r_wrapping ?></td>
			<td><?= $sd_reject->r_wrapping ?></td>
			<td><?= $hi_reject->r_packing ?></td>
			<td><?= $sd_reject->r_packing ?></td>
			<td><?= $hi_reject->r_rusak ?></td>
			<td><?= $sd_reject->r_rusak ?></td>
			<td id="jml_reject<?= $alfabet ?>"></td>
			<td align="right" id="pp<?= $alfabet ?>"></td>
		</tr>
			<?php 
			$no = 1;
			$sd_total = 0;
			$tot_rej = 0;
			foreach ($merk as $lue): 
			$sub = $this->db->where(array('id' => $lue,'id_produk' => $key->id))->get('sub_produk');
			if ($sub->num_rows() > 0) { 
				$show = $sub->row();

				$this->db->select('SUM(rfs.stock_batang) as stock_batang,
					SUM(rfs.jumlah) as jumlah');
				$this->db->from('rfs');
				$this->db->join('sub_produk', 'rfs.id_subproduk = sub_produk.id', 'inner');
				$this->db->where(array('sub_produk.id' => $show->id,'sub_produk.id_produk' => $show->id_produk));
				$this->db->where("rfs.tanggal",date('Y-m-d'));
				$hi_data = $this->db->get()->row();

				$this->db->select('SUM(rfs.stock_batang) as stock_batang,
					SUM(rfs.jumlah) as jumlah');
				$this->db->from('rfs');
				$this->db->join('sub_produk', 'rfs.id_subproduk = sub_produk.id', 'inner');
				$this->db->where(array('sub_produk.id' => $show->id,'sub_produk.id_produk' => $show->id_produk));
				$this->db->where("rfs.tanggal BETWEEN '$awal' AND '$akhir'");
				$sd_data = $this->db->get()->row();

				$this->db->select('SUM(reject.r_binding) as r_binding,
								   SUM(reject.r_wrapping) as r_wrapping,
								   SUM(reject.r_packing) as r_packing,
								   SUM(reject.r_rusak) as r_rusak');
				$this->db->from('reject');
				$this->db->join('sub_produk', 'reject.id_subproduk = sub_produk.id', 'inner');
				$this->db->where('reject.id_subproduk', $show->id);
				$this->db->where("reject.tanggal",date('Y-m-d'));
				$hi_reject_merk = $this->db->get()->row();

				$this->db->select('SUM(reject.r_binding) as r_binding,
								   SUM(reject.r_wrapping) as r_wrapping,
								   SUM(reject.r_packing) as r_packing,
								   SUM(reject.r_rusak) as r_rusak');
				$this->db->from('reject');
				$this->db->join('sub_produk', 'reject.id_subproduk = sub_produk.id', 'inner');
				$this->db->where('reject.id_subproduk', $show->id);
				$this->db->where("reject.tanggal BETWEEN '$awal' AND '$akhir' ");
				$sd_reject_merk = $this->db->get()->row();

				$jml_reject_merk = $sd_reject_merk->r_binding + $sd_reject_merk->r_wrapping + ($sd_reject_merk->r_packing * $show->isi) + $sd_reject_merk->r_rusak;
			?>
			<tr>
				<td align="right"><?= $no ?></td>
				<td><?= $show->sub_kode ?></td>
				<td><?= $show->sub_produk ?></td>
				<td align="right"><?= $hi_data->stock_batang ?></td>
				<td align="right"><?= $sd_data->stock_batang ?><input type="" class="hidd action" id="cici<?= $no ?>" value="<?= $sd_data->stock_batang ?>"></td>
				<td align="center"><?= $show->kemasan ?></td>
				<td align="right"><?= $show->isi ?></td>
				<td align="right"><?= $hi_data->jumlah ?></td>
				<td align="right"><?= $sd_data->jumlah ?><input type="" class="hidd action" id="caca<?= $no ?>" value="<?= $sd_data->jumlah?>"></td>
				<td><?= $hi_reject_merk->r_binding ?></td>
				<td><?= $sd_reject_merk->r_binding ?></td>
				<td><?= $hi_reject_merk->r_wrapping ?></td>
				<td><?= $sd_reject_merk->r_wrapping ?></td>
				<td><?php echo $p = $hi_reject_merk->r_packing * $show->isi; ?></td>
				<td><?php echo $l = $sd_reject_merk->r_packing * $show->isi; ?></td>
				<td><?= $hi_reject_merk->r_rusak ?></td>
				<td><?= $sd_reject_merk->r_rusak ?></td>
				<td><?= $jml_reject_merk ?></td>
				<td align="right" id=""></td>
			</tr>
			<script>
				var cici<?= $no ?> = $('#cici<?= $no ?>').val();
				var caca<?= $no ?> = $('#caca<?= $no ?>').val();

				var coco<?= $no ?> = cici<?= $no ?> - caca<?= $no ?>;
				$('#coco<?= $no ?>').html(coco<?= $no ?>);
			</script>
			<?php  
			$tot_rej += $jml_reject_merk;
			$sd_total += $sd_data->jumlah; } ?>
			<?php $no++; endforeach ?>
			<tr class="hidd action">
				<td>
					<input type="number" id="sd_tot<?= $alfabet ?>" value="<?= $sd_total ?>">
					<input type="number" id="tot_rej<?= $alfabet ?>" value="<?= $tot_rej ?>">
				</td>
			</tr>
			<script>
				var sd_tot<?= $alfabet ?> = $('#sd_tot<?= $alfabet ?>').val();
				$('#stt<?= $alfabet ?>').html(sd_tot<?= $alfabet ?>);

				var tot_rej<?= $alfabet ?> = $('#tot_rej<?= $alfabet ?>').val();
				$('#jml_reject<?= $alfabet ?>').html(tot_rej<?= $alfabet ?>);

				var jml_btg<?= $alfabet ?> = $('#jml_btg<?= $alfabet ?>').val();

				var jumlah<?= $alfabet ?> = jml_btg<?= $alfabet ?> - sd_tot<?= $alfabet ?> - tot_rej<?= $alfabet ?>;
				
				$('#pp<?= $alfabet ?>').html(jumlah<?= $alfabet ?>);
			</script>
		<?php } ?>
		<?php $alfabet++; endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			
		</tr>
	</tfoot>
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