<style>
	table {text-align: center;}
	table tr th {text-align: center;}
  #show {text-align: center;}
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Cukai</strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-info text-light">
      <b><i class="fa fa-book"></i> Laporan Cukai Hari Ini</b>
      <div class="pull-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-hover" id="table_ku">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Kode</th>
            <th>Cukai Lama</th>
            <th>Cukai Baru</th>
            <th>Jumlah Stock</th>
            <th>Cukai Lama Terpakai</th>
            <th>Cukai Baru Terpakai</th>
            <th>Stock Akhir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($cukai as $key){
            $ja = $key['lama'] + $key['baru'];
          ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $key['subproduk'] ?></td>
              <td><?php echo $key['sub_kode'] ?></td>
              <td><?php echo $key['lama'] ?></td>
              <td><?php echo $key['baru'] ?></td>
              <td><?= $ja ?></td>
              <td><?php echo $key['semua'] ?></td>
              <td><?php echo $key['masing'] ?></td>
              <td><?php echo $key['jumlah'] ?></td>
              <td>
                <?php if ($this->session->userdata('level') == 'Super Admin') { ?>
                <a title="Edit" href="<?php echo base_url('Bahan_pembantu/edit_cukai/'.$key['id']) ?>" class="text-warning"><i class="fa fa-edit"></i></a>    
                <a title="Hapus" href="<?php echo base_url('Bahan_pembantu/hapus_cukai/'.$key['id']) ?>" class="text-danger"><i class="fa fa-trash"></i></a>    
                <? } ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <a href="<?php echo base_url('Bahan_pembantu/print_cukai'); ?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
    </div>
  </div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <strong>Semua Daftar Bahan Pembantu ( CUKAI )</strong>
      <div class="pull-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> Cari Tanggal</button>
      </div>
    </div>
    <div class="card-body" id="print_isi">
      <div class="col-lg-12">
        <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
        <center>
          <b>LAPORAN STOCK BAHAN PEMBANTU PRODUKSI ( CUKAI )</b><br>
          Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b>
        </center>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Kode</th>
            <th>Isi</th>
            <th>HJE</th>
            <th>Tarif</th>
            <th>Cukai Lama</th>
            <th>Cukai Baru</th>
            <th>Jumlah Stock</th>
            <th>Cukai Lama Terpakai</th>
            <th>Cukai Baru Terpakai</th>
            <th>Stock Akhir</th>
          </tr>
        </thead>
        <tbody id="isi_table"></tbody>
        <tfoot class="bg-primary text-light">
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>TOTAL</th>
            <th>:</th>
            <th id="lama"></th>
            <th id="baru"></th>
            <th id="akhirs"></th>
            <th id="semua"></th>
            <th id="masing"></th>
            <th id="jumlah"></th>
          </tr>
        </tfoot>
      </table>
      <div class="col-lg-12" id="show">
        <?php  $bulan = 
        array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
        $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
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
            <select id="sub_produks" class="form-control">
              <option value="">--- PRODUK/MEREK ---</option>
              <?php $as = $this->db->order_by('id','ASC')->get('sub_produk')->result_array(); ?>
              <?php foreach ($as as $keys){ ?>
                <option value="<?php echo $keys['sub_produk'] ?>"><?php echo $keys['sub_produk'].' | '.$keys['sub_kode'] ?></option>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <label><i class="fa fa-gear"></i> Bahan Pendukung Cukai</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url('Bahan_pembantu/add_cukai') ?>">
        <div class="col-lg-8">
          <div class="form-group">
            <input type="hidden" id="produk-hidd" name="produk-hidd">
              <?php $produk = $this->db->order_by('id', 'ASC')->get('produk')->result_array(); ?>
              <select id="produk" name="produk" class="form-control">
                <?php foreach ($produk as $key){ ?>
                  <option value="<?php echo $key['id'] ?>"><?php echo $key['produk'] ?></option>
                <?php } ?>
              </select>
            </div>
        </div>
        <div class="col-lg-4">
          <button class="btn btn-danger" id="filter"><i class="fa fa-search"></i> FILTER</button>
        </div>
        <div class="col-lg-8" id="tampil_sub">
          
        </div>
        <div class="col-lg-4" id="hide2">
          <button class="btn btn-danger" id="filter2"><i class="fa fa-search"></i> FILTER</button>
        </div>
        <div class="col-lg-12" id="hide">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Tanggal : </label>
              <input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo date('Y-m-d') ?>"><small>
            </div>
            <div class="form-group">
              <label>Cukai Lama : </label>
              <input type="number" id="lama2" class="form-control" disabled="">
              <input type="hidden" name="lama" id="lama3">
            </div>
            <div class="form-group">
              <label>Cukai Baru : </label>
              <input type="number" name="baru" class="form-control">
            </div>
            <!-- <div class="form-group">
              <label>Stock Akhir : </label>
              <input type="number" name="akhir" class="form-control">
            </div> -->
          </div>
          <div class="col-lg-6">
            <!-- <div class="form-group">
              <label>Masuk : </label>
              <input type="number" name="masuk" class="form-control">
            </div> -->
            <h4>CUKAI YG TERPAKAI</h4>
            <hr>
            <div class="form-group">
              <label>Terpakai Cukai Lama : </label>
              <input type="number" name="semua" class="form-control">
            </div>
            <div class="form-group">
              <label>Terpakai Cukai Baru : </label>
              <input type="number" name="masing" class="form-control">
            </div>
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

<script>
  $('#hide').hide();$('#hide2').hide();
  $('#filter').on('click', function(event){
    event.preventDefault();

      var produk = $('#produk').val();
      $.ajax({
        url : '<?php echo base_url("Bahanbaku/cari_sub1") ?>',
        method : 'POST',
        data : {produk :produk},
        dataType : 'JSON',
        success : function(data){
          // console.log(data);
          $('#produk-hidd').val(data.name_produk);
          $('#tampil_sub').html(data.select);
          $('#hide2').fadeIn();

          $('#filter2').on('click', function(events){
            events.preventDefault();
            var sub_produk = $('#sub_produk_in').val();
            $.ajax({
              url : '<?php echo base_url("Bahan_pembantu/cari_cukai_sub/") ?>'+sub_produk,
              method : 'POST',
              dataType : 'JSON',
              success : function(datas){
                // console.log(datas)
                $('#lama2').val(datas);
                $('#lama3').val(datas);
                // $('#hide').fadeIn();
                $('#hide').fadeIn();
              }
            })
          });          
        }
      })
  });

  function printlayer(div) {
    var restorpage = document.body.innerHTML;
      var printcontent = document.getElementById(div).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorpage;
  }

  $(document).ready(function(){
    jQuery('#awal_in').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir_in').datepicker({format : 'yyyy-mm-dd'});
  });

  function cari(argument) {
    var awal = $('#awal_in').val();
    var akhir = $('#akhir_in').val();
    var sub_produk = $('#sub_produks').val();
    $.ajax({
      url : '<?php echo base_url("Bahan_pembantu/cari_cukai") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, sub_produk:sub_produk},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data.table);
        console.log(data);

        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);
        $("#akhirs").html(data.stockjml);

        $.ajax({
          url : '<?php echo base_url("Bahan_pembantu/total_cukai") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, sub_produk:sub_produk},
          dataType : 'JSON',
          success : function(total) {
            $("#lama").html(total.lama);
            $("#baru").html(total.baru);
            $("#jumlah").html(total.jumlah);
            $("#semua").html(total.semua);
            $("#masing").html(total.masing);
            
            // $('.modal-backdrop').hide(); // for black background
            // $('#myModal2').modal('hide'); 
          }
        })

      }
    })
  }
  
$(document).ready(function(){
    jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
  });
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
