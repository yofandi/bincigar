<style>
  table {text-align: center;}
  thead{text-transform: uppercase;}
  table tr th {text-align: center;}
  #show {text-align: center;}
  select.multiselect,
  select.multiselect + div.btn-group,
  select.multiselect + div.btn-group button.multiselect,
  select.multiselect + div.btn-group.open .multiselect-container{
    width:100% !important;
  }
</style>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Ready For Sale</strong>
    </div>
  </div>
</div>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <b><i class="fa fa-book"></i> READY FOR SALE BULAN INI : <?php echo date('Y').' '.$bulan[date('m')] ?></b>
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus-circle"></i> Tambah Penjualan</button>
       <button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#pals"><i class="fa fa-print"></i> Laporan RFS</button>
    </div>
    <div class="card-body" id="print_isi2">
      <!-- <center><b>LAPORAN PENJUALAN BAGAN STORE HARI INI</b><br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?></center> -->
      <div class="table-responsive">
        <table class="table table-hover table-bordered" id="table_ku">
        <thead class="thead-dark">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Bagan</th>
            <th>Produk</th>
            <th>Kode</th>
            <th>Stock</th>
            <th>Keluar</th>
            <th>Sisa</th>
            <th>Untuk</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $data=$this->db->order_by('id', 'DESC')->like('tanggal', date('Y-m'))->get('penjualan')->result_array();
          $stok = 0;
          $keluar = 0;
          $sisa = 0;
          $total = 0;
           $no=1;foreach ($data as $key): 
          $stok += $key['stock'];
          $keluar += $key['keluar'];
          $sisa += $key['sisa'];
          ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $key['tanggal'] ?></td>
              <td><?php echo $key['bagan'] ?></td>
              <td><?php echo $key['subproduk'] ?></td>
              <td><?php echo $key['sub_kode'] ?></td>
              <td><?php echo $key['stock'] ?></td>
              <td><?php echo $key['keluar'] ?></td>
              <td><?php echo $key['sisa'] ?></td>
              <td><?= $key['for_user'] ?></td>
              <td>
                <a class="btn btn-warning btn-sm text-light" title="Edit" href="<?php echo base_url('Marketing/edit_penjualan/'.$key['id']) ?>"><i class="fa fa-edit"></i></a>
                <a class="btn btn-danger btn-sm text-light" title="Hapus" href="<?php echo base_url('Marketing/hapus_penjualan/'.$key['id']) ?>"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php $no++;endforeach ?>
        </tbody>
        <tfoot class="bg-success text-light">
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TOTAL</td>
            <td></td>
            <td><?= $stok ?></td>
            <td><?= $keluar ?></td>
            <td><?= $sisa ?></td>
            <td colspan="2"></td>
          </tr>
        </tfoot>
      </table>
      </div>
      <div class="col-lg-12 hidd">
        <div class="col-md-12 col-md-offset-12" align="right">
          Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        </div><br><br>
        <div class="col-md-3">
         Direktur Operasional<br><br><br>
        (<u><?php echo $setting['direktur'] ?></u>)
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
          Quality Control<br><br><br>
          (<u><?php echo $setting['qc'] ?></u>)
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label><i class="fa fa-plus"></i> Tambah Ready For Sale</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('Marketing/tambah_penjualan') ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal : </label>
            <input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo date('Y-m-d') ?>"><small>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="form-group">
            <select id="produk" name="produk" class="form-control">
              <?php $produk=$this->db->get('produk')->result_array(); ?>
              <?php foreach ($produk as $key): ?>
                <option value="<?php echo $key['id'] ?>"><?php echo $key['produk'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <button class="btn btn-primary" id="cari_sub"><i class="fa fa-search"></i> CARI</button>
          </div>
        </div>
        <div class="col-lg-8" id="muncul_subproduk">
          
        </div>
        <div class="col-lg-4" id="btn_filter">
          <button class="btn btn-primary" id="filter"><i class="fa fa-search"></i> FILTER</button>
        </div>

        <div id="muncul_semua">
          
        </div>
        <div id="bagan_muncul">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Bagan :</label>
            <select name="bagan" id="bagan1" class="form-control">
              <?php $bagan=$this->db->get('bagan_store')->result_array(); ?>
              <?php foreach ($bagan as $key): ?>
                <option value="<?php echo $key['nama'] ?>"><?php echo $key['nama'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <select id="ppap" name="for_user" class="form-control">

            </select>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Keterangan :</label>
            <textarea name="keterangan" class="form-control"></textarea>
          </div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button class="pull-right btn btn-success" type="submit">Tambah</button>
      </div></form>
     </div>
   </div>
  </div>
</div>
<div id="pals" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label><i class="fa fa-book"></i> Laporan RFS</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('Marketing/print_penjualan') ?>" method="post">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Produk :</label><br>
            <select id="chkveg" name="produk[]" multiple="multiple">
              <?php foreach ($sub_produk->result() as $alu): ?>
                <option value="<?= $alu->id ?>"><?= $alu->sub_produk.' || '.$alu->sub_kode ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-5">
           <input type="text" name="awal" id="we" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-lg-2" align="center">
          <h5>Sd.</h5>
        </div>
        <div class="col-lg-5">
           <input type="text" name="akhir" id="ak" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
      </div> 
      <div class="modal-footer">
        <button class="pull-right btn btn-info" type="submit">Tambah</button>
      </div>
      </form>
     </div>
   </div>
  </div>
</div>
<script>
  $('#btn_filter').hide();$('#bagan_muncul').hide();

  $('#cari_sub').on('click', function(event){
    event.preventDefault();
    var produk = $('#produk').val();
    $.ajax({
      url : '<?php echo base_url("Marketing/cari_subproduk2/") ?>'+produk,
      method : 'POST',
      dataType : 'JSON',
      success : function(data){
        $('#btn_filter').fadeIn();
        $('#muncul_subproduk').html(data);

        $('#filter').on('click', function(eventt){
          eventt.preventDefault();
          var sub_produk = $('#id_subproduk').val();
          // alert(sub_produk)
          $.ajax({
            url : '<?php echo base_url("Marketing/filter_penjualan/") ?>'+sub_produk,
            method : 'POST',
            dataType : 'JSON',
            success : function(data){
              console.log(data.pesan);
              if (data.pesan == 'salah') {
                alert('Tidak Dapat Di Pilih, Karena Tidak Ada Stock Keluar Dari Ready For Sale !');
              }else{
                // console.log(data)
                $('#muncul_semua').html(data.data);
                $('#bagan_muncul').fadeIn();
              }              
            }
          })
        })
      }
    })
  })
  $('#bagan1').change(function(event) {
    var bgn = $(this).val();
    $.ajax({
      url: '<?= base_url("Marketing/cari_name_user/") ?>'+bgn,
      type: 'POST',
      dataType: 'json',
      success : function(arg) {
        $('#ppap').html(arg);
       }
    })
  });

	$(document).ready(function(){
    jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#table_ku').DataTable({
        responsive: true
    });
  });

  function cari() {
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var bagan = $('#bagan_cari').val();
    $.ajax({
      url : '<?php echo base_url("Marketing/cari_penjualan") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, bagan:bagan},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);
        console.log();
        $.ajax({
          url : '<?php echo base_url("Marketing/total_penjualan") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, bagan:bagan},
          dataType : 'JSON',
          success : function(total) {
            $("#total_stock").html(total.stock);
            $("#total_terjual").html(total.terjual);
            $("#total_sisa").html(total.sisa);
            $("#total_mutasi").html(total.mutasi);
          }
        })

      }
    })
  }
  function printlayer(div) {
		var restorpage = document.body.innerHTML;
	    var printcontent = document.getElementById(div).innerHTML;
	    document.body.innerHTML = printcontent;
	    window.print();
	    document.body.innerHTML = restorpage;
	}
  $(document).ready(function(){
    jQuery("#chkveg").multiselect({includeSelectAllOption: true,buttonClass: 'form-control',buttonWidth: '100%'}); 
    jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#we').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#ak').datepicker({format : 'yyyy-mm-dd'});
  });
</script>