<style>
	table {text-align: center;}
	table tr th {text-align: center;}
  @media print {
    @page { size: A4 landscape; }
  }
</style>
 
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Striker</strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong>Daftar Bahan Pembantu ( Striker ) Hari ini : <?php echo date('Y-m-d') ?></strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
			<div class="col-lg-12">
        <table class="table table-hover" id="table_ku">
          <thead>
            <tr>
              <th colspan="2"></th>
              <th>Stiker Luar</th>
              <th colspan="3"></th>
              <th>Stiker Dalam</th>
              <th colspan="3"></th>
              <th>Jumlah</th>
              <th colspan="5"></th>
            </tr>
            <tr class="thead-dark table-bordered">
              <th>No</th>
              <th>Produk</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="table-bordered">
           <?php 
             $no=1; foreach ($stiker as $key) {
              ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $key['nama_produk'] ?></td>
              <td><?= $key['stock_l']; ?></td>
              <td><?= $key['masuk_l'] ?></td>
              <td><?= $key['pakai_l'] ?></td>
              <td><?= $key['hasil_l'] ?></td>
              <td><?= $key['stock_d']; ?></td>
              <td><?= $key['masuk_d'] ?></td>
              <td><?= $key['pakai_d'] ?></td>
              <td><?= $key['hasil_d'] ?></td>
              <td><?= $key['stock_j']; ?></td>
              <td><?= $key['masuk_j'] ?></td>
              <td><?= $key['pakai_j'] ?></td>
              <td><?= $key['hasil_j'] ?></td>
              <td><?= $key['tanggal'] ?></td>
              <td>
                <?php if ($this->session->userdata('level') == 'Super Admin') { ?>
                <a title="Edit" class="text-warning" href="<?php echo base_url('Bahan_pembantu/edit_stiker/'.$key['id']) ?>"><i class="fa fa-edit"></i></a>
                <a title="Hapus" class="text-danger" href="<?php echo base_url('Bahan_pembantu/hapus_stiker/'.$key['id']) ?>"><i class="fa fa-trash"></i></a>
                <? } ?>
              </td>
            </tr>
            <?php $no++;
            } ?>
          </tbody> 
        </table>
      </div>
		</div>
    <div class="card-footer">
      <a href="<?php echo base_url("Bahan_pembantu/print_stiker") ?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
    </div>
	</div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-info text-light">
      <strong>Semua Daftar Bahan Pembantu ( Striker )</strong>
      <div class="pull-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> FILTER DATA</button>
      </div>
    </div>
    <div class="card-body" id="print_isi">
      <div class="col-lg-12">
      <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
        <center>
          <b>LAPORAN STOCK BAHAN PEMBANTU PRODUKSI ( STIKER )</b><br>
          Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b>
        </center>
      </div>
      <div class="col-lg-12">
        <table class="table table-hover" id="table_ku">
          <thead>
            <tr>
              <td></td><td></td>
              <td>Stiker Luar</td><td></td>
              <td></td><td></td>
              <td>Stiker Dalam</td><td></td>
              <td></td><td></td>
              <td>Jumlah</td><td></td>
              <td></td><td></td><td></td>
            </tr>
          </thead>
          <thead class="thead-dark table-bordered">
            <tr>
              <th>No</th>
              <th>Produk</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Stock</th>
              <th>Masuk</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="isi_table"></tbody>
          <tfoot class="bg-danger text-light">
            <tr>
              <td></td><td>JUMLAH</td><td></td>
              <td id="stock_l"></td>
              <td id="masuk_l"></td>
              <td id="pakai_l"></td>
              <td id="hasil_l"></td>
              <td id="stock_d"></td>
              <td id="masuk_d"></td>
              <td id="pakai_d"></td>
              <td id="hasil_d"></td>
              <td id="stock_j"></td>
              <td id="masuk_j"></td>
              <td id="pakai_j"></td>
              <td id="hasil_j"></td>
            </tr>
          </tfoot>
        </table>
        <div class="col-lg-12 hidd" id="show">
          <?php $bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
              $setting = $this->db->get_where('setting', array('id' => 1))->row_array();
            ?>
          <div class="col-md-12 col-md-offset-12" align="right">
            Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
          </div><br><br>
          <div class="col-md-3">
            (<u><?php echo $setting['direktur'] ?></u>)<br><br><br>
            Direktur Operasional
          </div>
          <div class="col-md-3"></div>
          <div class="col-md-3"></div>
          <div class="col-md-3">
            (<u><?php echo $setting['qc'] ?></u>)<br><br><br>
            Quality Control
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-info" onclick="printlayer('print_isi')"><i class="fa fa-print"></i> Print</button>
    </div>
  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label><i class="fa fa-search"></i> FILTER DATA</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="col-lg-12">
          <div class="form-group">
            <select id="produks" class="form-control">
              <option value="">--- PRODUK/MEREK ---</option>
              <?php $as = $this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
              <?php foreach ($as as $keys){ ?>
                <option value="<?php echo $keys['produk'] ?>"><?php echo $keys['produk'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <input type="text" id="awal_in" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-lg-1">
          Sd.
        </div>
        <div class="col-lg-4">
          <input type="text" id="akhir_in" class="form-control" value="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="col-lg-2">
         <button class="btn btn-danger" onclick="cari()"><i class="fa fa-search"></i> Cari</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
      </div>
    </div></form>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b>Tambah Bahan Pembantu ( Striker )</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div><form  method="post" action="<?php echo base_url('Bahan_pembantu/tambah_stiker') ?>">
      <div class="modal-body">
        <div class="col-lg-12">
          <div class="col-lg-4">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="text" id="tanggalan" name="tanggal" class="form-control" value="<?php echo date('Y-m-d') ?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
              <label>Produk/Merek</label>
              <select class="form-control" id="produk" name="produk">
                <?php $produk =$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
                <?php foreach ($produk as $key){ ?>
                  <option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="col-lg-2">
           <div class="form-group"><label>Filter Stock</label>
            <button class="btn btn-danger" id="filter"><i class="fa fa-search"></i> Filter</button>
           </div>
        </div>
        </div>
        <div class="col-lg-6" id="tampil1">
          <b><i class="fa fa-plus-circle"></i> Stiker Luar</b>
          <div class="form-group">
            <label>Stock Awal :</label>
            <input type="text" disabled="" id="stock_l3" class="form-control">
            <input type="hidden" name="stock_l" id="stock_l2">
          </div>
          <div class="form-group">
            <label>Masuk :</label>
            <input type="number" name="masuk_l" class="form-control">
          </div>
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="number" name="pakai_l" class="form-control">
          </div>
        </div>
        <div class="col-lg-6" id="tampil2">
          <b><i class="fa fa-plus-circle"></i> Stiker Dalam</b>
          <div class="form-group">
            <label>Stock Awal :</label>
            <input type="text" id="stock_d3" disabled="" class="form-control">
            <input type="hidden" name="stock_d" id="stock_d2">
          </div>
          <div class="form-group">
            <label>Masuk :</label>
            <input type="number" name="masuk_d" class="form-control">
          </div>
          <div class="form-group">
            <label>Terpakai :</label>
            <input type="number" name="pakai_d" class="form-control">
          </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
        
      </div>
    </div></form>

  </div>
</div>

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b>Edit Bahan Pembantu ( Striker )</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form  method="post" action="<?php echo base_url('Bahan_pembantu/tambah_stiker') ?>">
        	
        	<div class="form-group">
        		<label>Nama Produk :</label>
        		<input type="text" id="nama2" name="nama2" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Jumlah :</label>
        		<input type="number" id="jumlah2" name="jumlah2" class="form-control">
        	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
        
      </div>
    </div></form>

  </div>
</div>

<script>
  $('#tampil1').hide();$('#tampil2').hide();
  // filter
  $('#filter').on('click', function(event){
    event.preventDefault();
    var produk = $('#produk').val();
    $.ajax({
      url : '<?php echo base_url("Bahan_pembantu/filter_stock_stiker/") ?>',
      method : 'POST',
      data : {produk:produk},
      dataType : 'JSON',
      success : function(data){
        // console.log(data);
        $('#stock_l3').val(data.stock_luar);
        $('#stock_l2').val(data.stock_luar);
        $('#stock_d3').val(data.stock_dalam);
        $('#stock_d2').val(data.stock_dalam);
        $('#tampil2').fadeIn();$('#tampil1').fadeIn();
      }
    })
  })
 function printlayer(div) {
  var restorpage = document.body.innerHTML;
    var printcontent = document.getElementById(div).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorpage;
    reload.location();
}

$(document).ready(function(){
    jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
  });
	function edit(id) {
		$.ajax({
      url : '<?php echo base_url("Bahan_pembantu/edit_stiker/") ?>'+id,
      method : 'POST',
      dataType : 'JSON',
      success : function(data){

        $('#nama2').val(data.nama_produk);
        $('#jumlah2').val(data.jumlah);
        $('#id_stiker').val(data.id);

        $('#update').on('click', function(event){
          event.preventDefault();

          var nama_produk = $('#nama2').val();
          var jumlah =  $('#jumlah2').val();

          $.ajax({
            url : '<?php echo base_url("Bahan_pembantu/update_stiker/") ?>'+id,
            method : 'POST',
            data : {nama_produk:nama_produk, jumlah:jumlah},
            success : function(data){
              alert(data);
              location.reload();
            }
          })
        })

      }
    })
	}

  $(document).ready(function(){
    jQuery('#awal_in').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir_in').datepicker({format : 'yyyy-mm-dd'});
  });

  function cari(argument) {
    var awal = $('#awal_in').val();
    var akhir = $('#akhir_in').val();
    var produk = $('#produks').val();
    $.ajax({
      url : '<?php echo base_url("Bahan_pembantu/cari_stiker") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, produk:produk},
      dataType : 'JSON',
      success : function(data){
        // console.log(data);
        $("#isi_table").html(data);

        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Bahan_pembantu/total_stiker") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, produk:produk},
          dataType : 'JSON',
          success : function(total) {
            $("#stock_l").html(total.stock_l);
            $("#masuk_l").html(total.masuk_l);
            $("#pakai_l").html(total.pakai_l);
            $("#hasil_l").html(total.hasil_l);

            $("#stock_d").html(total.stock_d);
            $("#masuk_d").html(total.masuk_d);
            $("#pakai_d").html(total.pakai_d);
            $("#hasil_d").html(total.hasil_d);

            $("#stock_j").html(total.stock_j);
            $("#masuk_j").html(total.masuk_j);
            $("#pakai_j").html(total.pakai_j);
            $("#hasil_j").html(total.hasil_j);

            // $('.modal-backdrop').hide(); // for black background
            // $('#myModal2').modal('hide');
          }
        })

      }
    })
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
  });

</script>