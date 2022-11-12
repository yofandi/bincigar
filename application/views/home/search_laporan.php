<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
	<title>cari produksi</title>
</head>
<style>
  table {text-align: center;}
  table tr th {text-align: center;}
 /* body{
    font-family: "Times New Roman", Times, serif;
    padding-top: 20px;
    padding-bottom: 40px;
    font-size: 0.5em;
  }*/
  .bg_color{background-color : #e7f9bb;}
</style>
<body id="print">
<div class="col-lg-3">
	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 100px">
</div>
<div class="col-lg-6" align="center">
	<b>LAPORAN PRODUKSI DAN BAHAN PRODUKSI</b><br>
	Tanggal: <b><?= $awal ?></b> sd <b> <?= $akhir ?></b>
</div><br><br><br>
<table class="table table-bordered">
	<thead align="center">
		<tr>
			<th rowspan="4">No.</th>
			<th colspan="2">Jml Cerutu</th>
			<th colspan="<?php $x = 3 + (5 * count($jenis)); echo $x; ?>">Bahan (Kg)</th>
		</tr>
		<tr>
			<th rowspan="3">Merek</th>
			<th rowspan="3">Jumlah</th>
		</tr>
		<tr>
			<?php for ($i=0; $i < count($jenis); $i++) { ?>
			<th colspan="3"><?= $jenis[$i] ?></th>
			<th class="bg_color" colspan="2"></th>
			<?php } ?>
		</tr>
		<tr>
			<?php for ($i=0; $i < count($jenis); $i++) {
			$kat = array('Dek','Omb','Fill');
				foreach ($kat as $key) {?>
				<th><?= $key ?></th>
				<?php } ?>
			<th class="bg_color"></th>
			<th class="bg_color">30%</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody align="center">
		<?php $no = 1; foreach ($produk as $key): 
		$merek = $this->db->select('SUM(accept) as accept')->where('produk',$key)->get('qc')->row();
		if ($merek->accept == '') {
			$merek_ = 0;
		} else {
			$merek_ = $merek->accept;
		}
		
		?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $key ?></td>
			<td><?= $merek_ ?></td>
			<?php  
			for ($i=0; $i < count($jenis); $i++) { 
			?>
			<?php if ($kategori == '' || $kategori == 'DEKBLAD'): 
				$dek = $this->db->select('SUM(terpakai) as terpakai')->where(array('produk' => $key,'jenis' => $jenis[$i]))->where("tanggal BETWEEN '$awal' AND '$akhir' ")->get('wrapping')->row();
				$d = $dek->terpakai;
				if ($d == '') {
					$d = 0;
				}?>
				<td><?= $d ?></td>
			<?php endif ?>

			<?php if ($kategori == '' || $kategori == 'OMBLAD'): 
				$omb = $this->db->select('SUM(terpakai) as terpakai')->where(array('produk' => $key,'jenis' => $jenis[$i]))->where("tanggal BETWEEN '$awal' AND '$akhir' ")->get('binding')->row();
				$o = $omb->terpakai;
				if ($o == '') {
					$o = 0;
				}?>
				<td><?= $o ?></td>
			<?php endif ?>

			<?php if ($kategori == '' || $kategori == 'FILLER 1'): 
				$fill = $this->db->select('SUM(terpakai) as terpakai')->where(array('produk' => $key,'jenis' => $jenis[$i]))->where("tanggal BETWEEN '$awal' AND '$akhir' ")->get('filling')->row();
				if ($fill->terpakai == '') {
					$f = 0;
				} else{ $f = $fill->terpakai; }?>
				<td><?= $f ?></td>
			<?php endif ?>
			<?php $hs = @($f * 1000 / $merek_);

			if ($hs === false) {
				$hs_1 = 0;
			} else {
				$hs_1 = $hs;
			}
			$hs_30 = @($hs_1 * 0.3);
			$hs_70 = @($hs_1 - $hs_30); 
			if ($hs_30 === false) {$hs_30_1 = 0;}else{$hs_30_1 = $hs_30;}
			if ($hs_70 === false) {$hs_70_1 = 0;} else {$hs_70_1 = $hs_70;}
			?>
			<td class="bg_color"><?= number_format($hs_70_1, 2, '.', '') ?></td>
			<td class="bg_color"><?= number_format($hs_30_1, 2, '.', '') ?></td>
			<?php } ?>
		</tr>
		<?php $no++; endforeach ?>
	</tbody>
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