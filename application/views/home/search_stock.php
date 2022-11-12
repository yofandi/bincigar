<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<title>cari stock bahan</title>
</head>
<style>
  table {text-align: center;}
  table tr th {text-align: center;}
  body{
    font-family: "Times New Roman", Times, serif;
    padding-top: 20px;
    padding-bottom: 40px;
    font-size: 0.5em;
  }
</style>
<body id="print">
<?php $num_ktg = $kategori->num_rows(); ?>
<div class="col-md-4">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div>
	<b style="margin-left: 160px">STOCK BAHAN (TEMBAKAU)</b><br>
	<b style="margin-left: 190px">Unit Produksi BIN</b><br>
	<text style="margin-left: 640px">Tanggal : <b><?= $awal ?></b> Sd. <b><?= $akhir ?></b></text>
</div><br>
<div>
	<div class="col-md-4">
		<h4>Jenis : <?php if ($jenis == "") { echo "Semua"; } else{ echo $jenis; } ?></h4>
	</div>
	<div class="col-md-4" align="center">
		<h4>Asal : <?php if ($asal == "") { echo "Semua"; } else{ echo $asal; } ?></h4>
	</div>
	<div class="col-md-4" align="right">
		<h4>Satuan : kg</h4>
	</div>
</div><br><br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2" class="posi">No</th>
			<th rowspan="2" class="posi">Tanggal</th>
			<th colspan="<?php echo $num_ktg; ?>" class="bg-success">Stok Masuk</th>
			<th rowspan="1">Jumlah</th>
			<th colspan="<?php echo $num_ktg; ?>" class="bg-success">Diterima</th>
			<th rowspan="1">Jumlah</th>
			<th colspan="<?php echo $num_ktg; ?>" class="bg-success">Diproduksi</th>
			<th rowspan="1">Jumlah</th>
			<th colspan="<?php echo $num_ktg; ?>" class="bg-success">Stock Hari Ini</th>
			<th rowspan="1">Jumlah</th>
			<th rowspan="2" class="posi">Paraf</th>
		</tr>
		<tr>
			<?php for ($i=0; $i < 4; $i++): 
				foreach ($kategori->result() as $key):?>
				<th><?php echo $key->kategori; ?></th>
				<?php endforeach ?>
			<th>Jumlah</th>
			<?php endfor?>
		</tr>
	</thead>
	<tbody id="isi">
	<?php 
		$no = 1;

		$tot_jumlah1 = 0;
		$tot_jumlah2 = 0;
		$tot_jumlah3 = 0;
		$tot_jumlah4 = 0;

		$begin = new DateTime($awal);
		$end   = new DateTime($akhir);
		for ($i = $begin; $i <= $end; $i->modify('+1 day')) { 
			$tgl_ = $i->format("Y-m-d");
		?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $tgl_ ?></td>
			<?php $jumlah1 = 0;
				foreach ($kategori->result() as $al){
					$this->db->select('SUM(stock_masuk) as stock_masuk,kategori');
					$this->db->where(array('tanggal' => $tgl_,'kategori' => $al->kategori));
					$this->db->like('jenis', $jenis, 'BOTH');
					$this->db->like('asal', $asal, 'BOTH');
					$st_msk = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$st = $st_msk[0]->stock_masuk;
					echo $st;
				} elseif ($kate_ != $al->kategori) {
					$st = 0;
					echo $st;
				} else {
					$st = $st_msk[0]->stock_masuk;
					echo $st;
				}
				?></td>
				<?php $jumlah1 += $st;} ?>
			<td><?= $jumlah1 ?></td>

			<?php $jumlah2 = 0; 
				foreach ($kategori->result() as $au){
					$this->db->select('SUM(diterima) as diterima');
					$this->db->where(array('tanggal' => $tgl_,'kategori' => $au->kategori));
					$this->db->like('jenis', $jenis, 'BOTH');
					$this->db->like('asal', $asal, 'BOTH');
					$diterima = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$dit = $diterima[0]->diterima;
					echo $dit;
				} elseif ($kate_ != $au->kategori) {
					$dit = 0;
					echo $dit;
				} else {
					$dit = $diterima[0]->diterima;
					echo $dit;
				}
				?></td>
				<?php $jumlah2 += $dit;} ?>
			<td><?= $jumlah2 ?></td>

			<?php $jumlah3 = 0; 
				foreach ($kategori->result() as $ak){
					$this->db->select('SUM(diproduksi) as diproduksi');
					$this->db->where(array('tanggal' => $tgl_,'kategori' => $ak->kategori));
					$this->db->like('jenis', $jenis, 'BOTH');
					$this->db->like('asal', $asal, 'BOTH');
					$diproduksi = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$dip = $diproduksi[0]->diproduksi;
					echo $dip;
				} elseif ($kate_ != $ak->kategori) {
					$dip = 0;
					echo $dip;
				} else {
					$dip = $diproduksi[0]->diproduksi;
					echo $dip;
				}
				?></td>
				<?php $jumlah3 += $dip;} ?>
			<td><?= $jumlah3 ?></td>

			<?php $jumlah4 = 0;
				foreach ($kategori->result() as $ap){
					$this->db->select('SUM(hari_ini) as hari_ini');
					$this->db->where(array('tanggal' => $tgl_,'kategori' => $ap->kategori));
					$this->db->like('jenis', $jenis, 'BOTH');
					$this->db->like('asal', $asal, 'BOTH');
					$hari_ini = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$har = $hari_ini[0]->hari_ini;
					echo $har;
				} elseif ($kate_ != $ap->kategori) {
					$har = 0;
					echo $har;
				} else {
					$har = $hari_ini[0]->hari_ini;
					echo $har;
				}
				?></td>
				<?php $jumlah4 += $hari_ini[0]->hari_ini;} ?>
			<td><?= $jumlah4 ?></td>

			<td></td>
		</tr>
		<?php
		$tot_jumlah1 += $jumlah1;
		$tot_jumlah2 += $jumlah2;
		$tot_jumlah3 += $jumlah3;
		$tot_jumlah4 += $jumlah4;
		} ?>
	</tbody>
	<tfoot>
		<tr style="background-color: #e5e5e5;">
			<td colspan="2">Jumlah</td>
			<?php foreach ($kategori->result() as $key):
				$this->db->select('SUM(stock_masuk) as stock_masuk');
				$this->db->where('kategori',$key->kategori);
				$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
				$this->db->like('jenis', $jenis, 'BOTH');
				$this->db->like('asal', $asal, 'BOTH');
				$tot_msk = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$tot_msk1 = $tot_msk[0]->stock_masuk;
					echo $tot_msk1;
				} elseif ($kate_ != $key->kategori) {
					$tot_msk1 = 0;
					echo $tot_msk1;
				} else {
					$tot_msk = $tot_msk[0]->stock_masuk;
					echo $tot_msk;
				}
				?></td>
				<?php endforeach ?>
			<td><?= $tot_jumlah1 ?></td>

			<?php foreach ($kategori->result() as $euy):
				$this->db->select('SUM(diterima) as diterima');
				$this->db->where('kategori',$euy->kategori);
				$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
				$this->db->like('jenis', $jenis, 'BOTH');
				$this->db->like('asal', $asal, 'BOTH');
				$tot_trm = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$tot_trm1 = $tot_trm[0]->diterima;
					echo $tot_trm1;
				} elseif ($kate_ != $euy->kategori) {
					$tot_trm1 = 0;
					echo $tot_trm1;
				} else {
					$tot_trm1 = $tot_trm[0]->diterima;
					echo $tot_trm1;
				}
				?></td>
				<?php endforeach ?>
			<td><?= $tot_jumlah2 ?></td>

			<?php foreach ($kategori->result() as $lap):
				$this->db->select('SUM(diproduksi) as diproduksi');
				$this->db->where('kategori',$lap->kategori);
				$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
				$this->db->like('jenis', $jenis, 'BOTH');
				$this->db->like('asal', $asal, 'BOTH');
				$tot_prd = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$tot_prd1 = $tot_prd[0]->diproduksi;
					echo $tot_prd1;
				} elseif ($kate_ != $lap->kategori) {
					$tot_prd1 = 0;
					echo $tot_prd1;
				} else {
					$tot_prd1 = $tot_prd[0]->diproduksi;
					echo $tot_prd1;
				}
				?></td>
				<?php endforeach ?>
			<td><?= $tot_jumlah3 ?></td>

			<?php foreach ($kategori->result() as $jar):
				$this->db->select('SUM(hari_ini) as hari_ini');
				$this->db->where('kategori',$jar->kategori);
				$this->db->where("tanggal BETWEEN '$awal' AND '$akhir'");
				$this->db->like('jenis', $jenis, 'BOTH');
				$this->db->like('asal', $asal, 'BOTH');
				$tot_ini = $this->db->get('data_stock')->result();
				?>
				<td><?php 
				if ($kate_ == "") {
					$tot_ini1 = $tot_ini[0]->hari_ini;
					echo $tot_ini1;
				} elseif ($kate_ != $jar->kategori) {
					$tot_ini1 = 0;
					echo $tot_ini1;
				} else {
					$tot_ini1 = $tot_ini[0]->hari_ini;
					echo $tot_ini1;
				}
				?></td>
				<?php endforeach ?>
			<td><?= $tot_jumlah4 ?></td>
			<td></td>
		</tr>
	</tfoot>
</table>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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