<style>
  table {text-align: center;}
  table tr th {text-align: center;}
</style>
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Home / View Laporan / <?php echo $data['id'] ?></strong>
    </div>
  </div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-dark text-light">
      <b><i class="fa fa-list"></i> View Laporan ID : <?php echo $data['id'] ?> | <i class="fa fa-user"></i> Author : <?php echo $data['author'] ?> | Tanggal : <?php echo $data['tanggal'] ?></b>

      <button onclick="printlayer('print_isi')" class="btn btn-danger pull-right btn-sm"><i class="fa fa-print"></i> Print</button>
    </div>
    <div class="card-body" id="print_isi">
      <?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>

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
    </div>
  </div>
</div>

<script>
  function printlayer(div) {
    var restorpage = document.body.innerHTML;
    var printcontent = document.getElementById(div).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorpage;
    location.reload();
  }
</script>