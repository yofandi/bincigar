<style>
  table {text-align: center;}
  table tr th {text-align: center;}
  #show {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Laporan Filling</strong>
		</div>
	</div>
</div>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <strong><i class="fa fa-gear"></i> Proses Filling | Hari Ini : <?php echo date('Y-m-d') ?></strong>
      <div class="pull-right">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover" id="table_ku">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jenis</th>
            <th>Stock</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th class="bg-info text-light">Jumlah Batang</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1;foreach ($fill as $key): ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $key['tanggal'] ?></td>
              <td><?php echo $key['produk'] ?></td>
              <td><?php echo $key['jenis'] ?></td>
              <td><?php echo $key['stock'] ?></td>
              <td><?php echo $key['terpakai'] ?></td>
              <td><?php echo $key['sisa'] ?></td>
              <td><?php echo $key['hasil'] ?></td>
              <td>
                <a class="btn btn-warning" href="<?php echo base_url('Proses_produksi/edit_filling/'.$key['id']) ?>"><i class="fa fa-edit"></i></a>
                 <a class="btn btn-danger" href="<?php echo base_url('Proses_produksi/del_filling/'.$key['id']) ?>"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php $no++;endforeach ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <a href="<?php echo base_url("Proses_produksi/print_filling") ?>" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
<!--     <?php /*$filing = $this->db->order_by('id','DESC')->get_where('data_stock', array('kategori' => 'Fillter' ))->row_array();*/?> -->
    <div class="modal-content">
      <div class="modal-header">
        <label><i class="fa fa-gear"></i> Proses Filing</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('Proses_produksi/add_filling') ?>">
        <div class="col-lg-12">
          <div class="form-group">
            <label>Tanggal :</label>
            <input type="text" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>" class="form-control">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Jenis :</label>
            <select class="form-control" name="jenis" id="jenis">
              <?php $isi=$this->db->select('id,jenis')->get('jenis')->result_array(); ?>
              <?php foreach ($isi as $key): ?>
                <option value="<?php echo $key['jenis'] ?>"><?php echo $key['jenis'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Produk :</label>
            <select class="form-control" name="produk">
              <?php $data=$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
              <?php foreach ($data as $key): ?>
                <option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Stock :</label>
            <input type="text" class="form-control" name="stock" step="any" id="kok" value="" readonly>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="number" name="terpakai" id="terpakai" step="any" class="form-control">
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            <label>Batang Cerutu Yang Di Hasilkan :</label>
            <input type="number" name="hasil" id="hasil" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="tambah" class="btn btn-success">Tambah</button>
      </div>
    </div></form>
  </div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <b><i class="fa fa-book"></i> Semua Laporan Filling</b>
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> FILTER DATA</button>
    </div>
    <div class="card-body" id="print_isi">
    <img src="<?php echo base_url('assets/images/BIN.png') ?>" class="hidd" style="width: 70px">
      <center>LAPORAN PROSES PRODUKSI (FILLING)<br>
      Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b></center>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Jenis</th>
            <th>Stock</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th class="bg-info text-light">Jumlah Batang</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody id="isi_table">
        </tbody>
        <tfoot class="bg-success text-light">
          <tr>
              <td></td><td>JUMLAH</td><td></td>
              <td id="stock"></td><td id="terpakai"></td><td id="sisa"></td><td id="hasil"></td><td></td>
            </tr>
        </tfoot>
      </table>
      
      <div class="col-lg-12" id="show">
        <div class="col-md-12 col-md-offset-12" align="right">
          Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        </div><br><br><br><br>
        <div class="col-md-3">
          (<u><?php echo $setting['direktur'] ?></u>)<br>
          Direktur Operasional
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
          (<u><?php echo $setting['kabag'] ?></u>)<br>
          Kabag. Produksi
        </div>
      </div>
    </div>
    <div class="card-footer">
        <button onclick="printlayer('print_isi')" class="btn btn-info"><i class="fa fa-print"></i> Print</button> 
    </div>
  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<label><i class="fa fa-search"></i> Cari Tanggal</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <div class="col-lg-12">
            <div class="form-group">
              <select id="produks" class="form-control">
                <option value="">--- PRODUK/MEREK ---</option>
                <?php $as = $this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
                <?php foreach ($as as $keys): ?>
                  <option value="<?php echo $keys['produk'] ?>"><?php echo $keys['produk'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-lg-4">
            <input type="text" id="awal" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-lg-1">
            Sd.
          </div>
          <div class="col-lg-4">
            <input type="text" id="akhir" class="form-control" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-lg-2">
           <button class="btn btn-danger" onclick="cari()"><i class="fa fa-search"></i> Cari</button>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn" data-dismiss="modal">Close</button>
        
      </div>
    </div></form>
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
  $(document).ready(function(){
    jQuery('#table_ku').DataTable({
      responsive: {
        breakpoints: [
          {name: 'bigdesktop', width: Infinity},
          {name: 'meddesktop', width: 1480},
          {name: 'smalldesktop', width: 1280},
          {name: 'medium', width: 1188},
          {name: 'tabletl', width: 1024},
          {name: 'btwtabllandp', width: 848},
          {name: 'tabletp', width: 768},
          {name: 'mobilel', width: 480},
          {name: 'mobilep', width: 320}
        ]
      }
    });
    jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
  });
	$('#cari_subproduk').on('click', function(event){
		event.preventDefault();

		var id = $('#produk').val();
		// alert(id);
		$.ajax({
			url : '<?php echo base_url("Proses_produksi/cari_sub/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#tampil_sub').html(data);

			}
		})
	});

  $(document).ready(function(){
    jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
  });
  
  function cari(argument) {
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var produk = $('#produks').val();
    $.ajax({
      url : '<?php echo base_url("Proses_produksi/cari_Filling") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, produk:produk},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Proses_produksi/total_Filling") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, produk:produk},
          dataType : 'JSON',
          success : function(total) {
            $("#stock").html(total.stock);
            $("#terpakai").html(total.terpakai);
            $("#sisa").html(total.sisa);
            $("#hasil").html(total.hasil);

            $('.modal-backdrop').hide(); // for black background
            $('#myModal2').modal('hide'); 
          }
        })

      }
    })
  }

  $('#jenis').change(function () {
    var jenis = $(this).val();
    $.ajax({
      url : '<?php echo base_url("Proses_produksi/drw_tk") ?>',
      method : 'POST',
      data : {jenis:jenis},
      dataType : 'JSON',
      success : function(isi) {
        $("#kok").val(isi);
      }
    })
  });
</script>