<!DOCTYPE html>
<html class="no-js" lang="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Bin Cigar - Dashboard">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="<?php echo base_url('assets/'); ?>images/BIN.png">
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print"> -->
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
  <style type="text/css">
    @page {
      size: A4;
    }
    @media print {
      html, body {
        width: 210mm;
        height: 297mm;
      }
    }
  </style>
</head>
<body id="print">
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
<div class="row">
  <div class="col-xs-5">
  	<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 200px">
  </div>
  <div class="col-xs-7">
  	<h5>BOSS IMAGE NUSANTARA</h5><br>
  	<table style="font-size: 8px;">
  		<tr>
  			<td>Office</td>
  			<td>:</td>
  			<td>Brawijaya Street No.5 Jubung, Jember 68151, East Java, Indonesia</td>
  		</tr>
  		<tr>
  			<td>Phone Office</td>
  			<td>:</td>
  			<td>+62 331 487 135</td>
  		</tr>
  		<tr>
  			<td>Fax Office</td>
  			<td>:</td>
  			<td>+62 331 481 085</td>
  		</tr>
  		<tr>
  			<td>Email</td>
  			<td>:</td>
  			<td>info@bincigar.com - marketing@bincigar.com</td>
  		</tr>
  		<tr>
  			<td>Website</td>
  			<td>:</td>
  			<td>www.bincigar.com</td>
  		</tr>
  	</table>
  </div>
  <hr width="100%">
  <div class="col-sm-12">
  	<h6><u>INVOICE,,,,</u></h6>
    <div class="table-responsive">
    	<table class="table table-bordered table-sm" style="font-size: 14px;">
    		<thead>
    			<tr>
    				<th rowspan="2" colspan="2">HS CODE: </th>
    				<th align="center" rowspan="2">Invoice No. : <?= $penjualan_cerutu->no_invoice ?></th>
    				<th align="center" colspan="4">Date:</th>
    			</tr>
    			<tr>
    				<th align="center" colspan="6"><?= $penjualan_cerutu->tanggal ?></th>
    			</tr>
          <tr>
            <td rowspan="2" colspan="2" align="center"><b>EXPORTER <br> BOSS IMAGE NUSANTARA</b></td>
            <td colspan="6"></td>
          </tr>
          <tr>
            <td colspan="6">Buyer's Order No. : <?= $penjualan_cerutu->id_penjualan_bagan ?></td>
          </tr>
    			<tr>
    				<td rowspan="2" colspan="2">For Account and risk of Messrs : <?= $penjualan_cerutu->nama_customer ?></td>
    				<td colspan="6">Departure date  :<?= $penjualan_cerutu->departure_date ?></td>
    			</tr>
    			<tr>
    				<td colspan="6">Vessel : <?= $penjualan_cerutu->vessel ?></td>
    			</tr>
    			<tr>
    				<td align="center" rowspan="2" colspan="2"><?= $penjualan_cerutu->lokasi_kirim ?></td>
    				<td colspan="6">Port of Loading : <?= $penjualan_cerutu->port_of_loading ?></td>
    			</tr>
    			<tr>
    				<td colspan="6">Port of Destination : <?= $penjualan_cerutu->port_of_destination ?></td>
    			</tr>
    			<tr align="center">
    				<th>NO.</th>
    				<th>Kind Of Goods</th>
    				<th>Quantity (Pack)</th>
    				<th>Price/Pack (Rp.)</th>
    				<th>Amount (Rp.)</th>
    				<th>Discount (..%)</th>
    				<th>Amount (Rp)</th>
    			</tr>
    		</thead>
    		<tbody>
          <?php
          $no = 1; 
          $jml_qty = 0;
          $tot_jml = 0;
          $total_jml = 0;
          foreach ($data_terbeli->result() as $value): 
          $tot = $value->jml * $value->hje;
          $jml_qty += $value->jml;
          $tot_jml += $tot;
          $total_jml += $value->total;
          ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $value->sub_kode.'||'.$value->sub_produk ?></td>
            <td align="center"><?= $value->jml ?></td>
            <td align="right"><?= number_format($value->hje,2,',','.') ?></td>
            <td align="right"><?= number_format($tot,2,',','.') ?></td>
            <td align="center"><?= $value->diskon_cerutu_terjual ?></td>
            <td align="right"><?= number_format($value->total,2,',','.') ?></td>
          </tr>
          <?php $no++; endforeach ?>
    		</tbody>
    		<tfoot>
    			<tr>
    				<td></td>
    				<td align="center">Total</td>
    				<td align="center"><?= $jml_qty ?></td>
    				<td align="right"></td>
    				<td align="right"><?= number_format($tot_jml,2,',','.') ?></td>
    				<td align="center"></td>
    				<td align="right"><?= number_format($total_jml,2,',','.') ?></td>
    			</tr>
          <tr>
            <td colspan="6" align="center">Postal fee</td>
            <td align="right"><?= number_format($penjualan_cerutu->ongkos,2,',','.') ?></td>
          </tr>
          <tr>
            <td colspan="6" align="center">Payment Discount (<?= $penjualan_cerutu->diskon ?>%)</td>
            <td align="right"><?= number_format($penjualan_cerutu->total,2,',','.') ?></td>
          </tr>
    		</tfoot>
    	</table>
    </div>
  </div>
  <div class="col-sm-12">
  	<p style="font-size: 11px; line-height: 1.2em;">
  	Note : <br> 
    Payment by Teleraphics Transfer (T/T) 100% <br>
    Please Transfer to our company bank account as folow : <br>
    &nbsp &nbsp 1. Bank name : Bank Mandiri Jember-Indonesia <br>
    &nbsp &nbsp &nbsp &nbsp Account Number : 14300666177778 <br>
    &nbsp &nbsp &nbsp &nbsp Owner Name : PT. BOS IMAGE NUSANTARA <br>
    &nbsp &nbsp 2. Bank Name : Bank Central Asia Cabang Jember <br>
    &nbsp &nbsp &nbsp &nbsp Account Number : 024 4665558 <br>
    &nbsp &nbsp &nbsp &nbsp Owner Name : BOSS IMAGE NUSANGTARA
  	</p>
  </div>
  <div class="col-sm-4"></div>
  <div class="col-sm-4 offset-sm-4" align="center" style="font-size: 12px;">
  	Yours Faithfully, <br>
  	BOSS IMAGE NUSANTARA <br><br><br><br>
  	<u><?= $setting['rfs'] ?></u> <br>
  	Ready For Sale
  </div>
</div>	
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