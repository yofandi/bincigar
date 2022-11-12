<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
	<title>Laporan Harian</title>
</head>
<style type="text/css">
    @page {
      size: A4;
      margin: 0;
    }
    table {text-align: center;}
    table tr th {text-align: center;}
    body{
      font-family: "Times New Roman", Times, serif;
    }
</style>
<body id="print">

<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
  
	
  <?php $data=$this->db->order_by('id', 'DESC')->get('laporan')->row_array(); ?>

      <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
      <br>
      <div class="col-12">
        Kepada Yth.: <br>
      Direksi BIN <br><br>

      Dengan hormat, <br>
      Bersama ini kami melaporkan kegiatan Cigar Store tanggal <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?> sbb : <br><br>
      

      *1. Pengamatan lingkungan:* <br>
    - Curah hujan         : <?php echo $data['cerah_hujan'] ?><br>

    - Suhu dan kelembahan : <br>
         Pagi  :  <?php echo $data['pagi'] ?> <br>

         Siang :  <?php echo $data['siang'] ?> <br>

         Sore  :  <?php echo $data['sore'] ?> <br>

         <br>
      *2. Tangkapan Lasio:* <br>
      - Bak air              : <?php echo $data['bak_air'] ?> <br>
      - Lasiotrap di ruangan : <?php echo $data['lasiotrap_ruangan'] ?> <br>

      - Lasiotrap di lemari  : <?php echo $data['lasiotrap_lemari'] ?> <br>

      <br>
      *3. Catatan Penjualan* <br>
      - Ds     : <?php echo 'Rp.'.number_format($data['ds'],2,',','.'); ?> <br> 

      - Store  : <?php echo 'Rp.'.number_format($data['store'],2,',','.'); ?> <br>

      - Agent  : <?php echo 'Rp.'.number_format($data['agent'],2,',','.'); ?> <br>

                    
      <br>
      *4. Laporan DS* <br>
      - Call            : <?php echo $data['call'] ?> <br>

      - Efektif Call.   : <?php echo $data['efektif_call'] ?> <br>

      - Noo.            : <?php echo $data['noo'] ?> <br>

      <br>
      *5. Catatan Direksi* <br>
       <?php echo $data['direksi'] ?>

      *6. Kesulitan <br>
       <?php echo $data['kesulitan'] ?> 
      Demikian laporan kami, selanjutnya mohon petunjuk dan instruksi lebih lanjut. Terimakasih.  
      <br>
      Hormat kami,
      <br>
      Store
      </div>
  <!-- </pre> -->

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