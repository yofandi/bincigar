<style>
	table {text-align: center;}
	table tr th {text-align: center;}
	#show {text-align: center;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Packing</strong>
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
			<strong><i class="fa fa-list"></i> PACKING | <?php echo date('Y-m-d') ?></strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body" id="print_isi">
			<img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px" class="hidd">
			<center><b>LAPORAN PACKING HARI INI</b><br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?></center>
			<table class="table table-hover" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Kemasan</th>
						<th>Isi</th>
						<th>Stock</th>
						<th>Masuk</th>
						<th>Keluar</th>
						<th>Sisa</th>
						<th>Ket</th>
						<th id="aksi">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php $no=1; foreach ($pack as $key): 
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $key['sub_produk'] ?></td>
						<td><?php echo $key['kemasan'] ?></td>
						<td><?php echo $key['isi'] ?></td>
						<td><?php echo $key['stock'] ?></td>
						<td><?php echo $key['masuk'] ?></td>
						<td><?php echo $key['keluar'] ?></td>
						<td><?php echo $key['sisa'] ?></td>
						<td><?php echo $key['ket'] ?></td>
						<td id="aksi2">
							<a href="<?php echo base_url('Marketing/edit_rfs/'.$key['id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
							<a href="<?php echo base_url('Marketing/hapus_rfs/'.$key['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php $no++; endforeach ?>
				</tbody>
				<tfoot class="bg-success text-light">
					<?php 
			            $this->db->where('tanggal', date('Y-m-d'));
			            $this->db->select('SUM(masuk) as total_masuk');
			            $this->db->from('rfs');
			            $total_masuk = $this->db->get()->row()->total_masuk;

			           $this->db->where('tanggal', date('Y-m-d'));
			            $this->db->select('SUM(keluar) as total_keluar');
			            $this->db->from('rfs');
			            $total_keluar = $this->db->get()->row()->total_keluar;

			            $this->db->where('tanggal', date('Y-m-d'));
			            $this->db->select('SUM(sisa) as total_sisa');
			            $this->db->from('rfs');
			            $total_sisa = $this->db->get()->row()->total_sisa;

			            $this->db->where('tanggal', date('Y-m-d'));
			            $this->db->select('SUM(stock) as total_stock');
			            $this->db->from('rfs');
			            $total_stock = $this->db->get()->row()->total_stock;

			            echo "
			            <tr>
			              <td></td><td></td><td>TOTAL</td><td></td><td>".$total_stock."</td>
			              <td>".$total_masuk."</td><td>".$total_keluar."</td><td>".$total_sisa."</td><td></td><td></td>
			            </tr>
			            ";
			          ?>
				</tfoot>
			</table>
		</div>
		<div class="card-footer">
	        <a href="<?php echo base_url("Marketing/print_rfs") ?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a> 
	    </div>
	</div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <b><i class="fa fa-book"></i> Semua Laporan PACKING</b>
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> FILTER DATA</button>
    </div>
    <div class="card-body" id="print_isi2">
      <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px" class="hidd">
      <center>LAPORAN PACKING<br>
      Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b></center>
      <table class="table table-hover table-bordered">
        <thead>
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Produk</th>
				<th>Kemasan</th>
				<th>Isi</th>
				<th>Stock</th>
				<th>Masuk</th>
				<th>Keluar</th>
				<th>Sisa</th>
				<th>Ket</th>
			</tr>
		</thead>
		<tbody id="isi_table2"></tbody>
		<tfoot class="bg-success text-light">
	      	<tr>
	          <td></td><td></td><td>TOTAL</td><td></td><td></td><td id="total_stock"></td>
	          <td id="total_masuk"></td><td id="total_keluar"></td><td id="total_sisa"></td><td></td>
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
        <button onclick="printlayer('print_isi2')" class="btn btn-info"><i class="fa fa-print"></i> Print</button> 
    </div>
  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus-circle"></i> PACKING</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      <form method="post" action="<?php echo base_url('Marketing/tambah_rfs') ?>">
      <?php $data=$this->db->order_by('id','DESC')->get('qc')->row_array(); ?>
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Tanggal</label>
      			<input type="text" class="form-control" name="tanggal" id="tanggalan" value="<?php echo date('Y-m-d') ?>">
      		</div>
      	</div>
      	<div class="col-lg-8">
      		<div class="form-group">
      			<label>Produk : </label>
      			<select class="form-control" name="produk" id="produklp" name="produk">
      				<?php $produk=$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
      				<?php foreach ($produk as $key): ?>
      					<option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
      				<?php endforeach ?>
      			</select>
      		</div>
      	</div>
      	<div class="col-lg-4">
      		<div class="form-group">
      			<label>FILTER SUB PRODUK </label>
      			<button class="btn btn-info" id="filter1"><i class="fa fa-search"></i> FILTER</button>	
      		</div>	
      	</div>
      	<div class="col-lg-8" id="data_muncul">
      		
      	</div>
      	<div class="col-lg-4" id="muncul_filter2">
      		<div class="form-group">
      			<label>Check Data</label><br>
      			<button id="check" class="btn btn-info"><i class="fa fa-search"></i> CHECK</button>
      		</div>
      	</div>
      	<div id="tampil_semua">
      		
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Tambah</button>
      </div>
    </div></form>
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
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
      </div>
    </div></form>
  </div>
</div>

<script>
	$('#muncul_filter2').hide();
	$('#filter1').on('click', function(event){
		event.preventDefault();
		var produk = $('#produklp').val();
		$.ajax({
			url : '<?php echo base_url("Marketing/cari_subproduk") ?>',
			dataType : 'JSON',
			data : {produk:produk},
			method : 'POST',
			success : function(data){
				$('#data_muncul').html(data);
				$('#muncul_filter2').fadeIn();

				$('#check').on('click', function(eventt){
					eventt.preventDefault();
					var id_sub = $('#id_sub').val();

					$.ajax({
						url : '<?php echo base_url("Marketing/cek_stock_sub_produk/") ?>',
						method : 'POST',
						dataType : 'JSON',
						data : {id_sub:id_sub,produk:produk},
						success : function(datas){
							$('#tampil_semua').html(datas);
						}
					})
				})
			}
		})
	})


	$('#cari_subproduk').on('click', function(event){
		event.preventDefault();

		var id = $('#produk').val();
		// alert(id);
		$.ajax({
			url : '<?php echo base_url("Marketing/cari_sub/") ?>'+id,
			method : 'POST',
			dataType : 'JSON',
			success : function(data){
				$('#tampil_sub').html(data);


			}
		})
	});

	// $('#tambah').on('click', function(event){
	// 	event.preventDefault();

	// 	var id = $('#id_sub').val();
	// 	var stock = $('#stock').val();
	// 	var masuk = $('#masuk').val();
	// 	var keluar = $('#keluar').val();
	// 	var ket = $('#ket').val();
	// 	var tanggal = $('#tanggalan').val();
	// 	$.ajax({
	// 		url : '<?php echo base_url("Marketing/tambah_rfs") ?>',
	// 		method : 'POST',
	// 		data : {id:id,stock:stock,masuk:masuk,keluar:keluar,ket:ket, tanggal:tanggal},
	// 		success : function(data){
	// 			alert(data);
	// 			location.reload();
	// 		}
	// 	})
	// })
	function printlayer(div) {
		$('#aksi').hide();
		$('#aksi2').hide();
	    var restorpage = document.body.innerHTML;
	    var printcontent = document.getElementById(div).innerHTML;
	    document.body.innerHTML = printcontent;
	    window.print();
	    document.body.innerHTML = restorpage;
	    $('#aksi').show();
		$('#aksi2').show();
	  }

	$(document).ready(function(){
    jQuery('#table_ku').DataTable();
    jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
  });

  function cari(argument) {
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var produk = $('#produks').val();
    $.ajax({
      url : '<?php echo base_url("Marketing/cari_rfs") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, produk :produk},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table2").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Marketing/total_rfs") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, produk:produk},
          dataType : 'JSON',
          success : function(total) {
            $("#total_masuk").html(total.masuk);
            $("#total_keluar").html(total.keluar);
            $("#total_sisa").html(total.sisa);
            $("#total_stock").html(total.stock);

            $('.modal-backdrop').hide(); // for black background
            $('#myModal2').modal('hide');
          }
        })

      }
    })
  }
  $(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});
</script>