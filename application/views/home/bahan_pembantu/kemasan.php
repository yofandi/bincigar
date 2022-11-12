<style>
	table {text-align: center;}
	table tr th {text-align: center;}
	#show {text-align: center;}
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Kemasan</strong>
		</div>
	</div>
</div>



<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-plus-circle"></i> Laporan Stock Kemasan Hari Ini : <?php echo date('Y-m-d') ?></b>
			<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i> Tambah Stock Pemakaian</button>
		</div>
		<div class="card-body">
			<table class="table table-hover table-bordered" id="table_ku">
				<thead>
					<tr>
						<th>No</th>
						<th>Produk</th>
						<th>Kemasan</th>
						<th>Stock Awal</th>
						<th>Masuk</th>
						<th>Sisa Stock</th>
						<th>Terpakai</th>
						<th>Afkir</th>
						<th>Stock</th>
						<th>Tanggal</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($pakai_kemasan as $key){ ?>
						<tr>
							<td><?= $no ?></td>
							<td><?= $key['produk'] ?></td>
							<td><?= $key['kemasan'] ?></td>
							<td><?= $key['awal'] ?></td>
							<td><?= $key['masuk'] ?></td>
							<td><?= $key['sisa'] ?></td>
							<td><?= $key['terpakai'] ?></td>
							<td><?= $key['afkir'] ?></td>
							<td><?= $key['stock'] ?></td>
							<td><?= $key['tanggal'] ?></td>
							<td>
								<?php if ($this->session->userdata('level') == 'Super Admin') { ?>
								<a title="Edit" href="<?php echo base_url('Bahan_pembantu/edit_pakai_kemasan/'.$key['id']) ?>" class="text-warning"><i class="fa fa-edit"></i></a>    
				                <a title="Hapus" href="<?php echo base_url('Bahan_pembantu/hapus_pakai_kemasan/'.$key['id']) ?>" class="text-danger"><i class="fa fa-trash"></i></a> 
								<? } ?>
							</td>
						</tr>
					<?php $no++; } ?>
				</tbody>
			</table>
		</div>
		<div class="card-footer">
			<a href="<?php echo base_url("Bahan_pembantu/print_pakai_kemasan") ?>" class=" btn btn-info"><i class="fa fa-print"></i> Print</a>
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
			<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal3"><i class="fa fa-search"></i> FILTER DATA</button>
		</div>
		<div class="card-body" id="print_isi2">
			<div class="col-lg-12" id="print_isi">
			  <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
				<center>
					<b>LAPORAN STOCK BAHAN PEMBANTU (CINCIN)</b>
					<br>Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b>
				</center>
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Produk</th>
							<th class="bg-danger text-light">Kemasan</th>
							<th>Stock Awal</th>
							<th>Masuk</th>
							<th>Sisa Stock</th>
							<th>Terpakai</th>
							<th>Afkir</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody id="isi_table"></tbody>
					<tfoot class="bg-success text-light">
						<tr>
							<td></td>
							<td></td>
							<td>TOTAL</td>
							<td>:</td>
							<td id="awal"></td>
							<td id="masuk"></td>
							<td id="sisa"></td>
							<td id="terpakai"></td>
							<td id="afkir"></td>
							<td id="stock"></td>
						</tr>
					</tfoot>
				</table>
				<div class="col-lg-12" id="show">
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
			<button class="btn btn-info" onclick="printlayer('print_isi2')"><i class="fa fa-print"></i> Print</button>
		</div>
	</div>
</div>

<div id="myModal3" class="modal fade" role="dialog">
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
      	<form method="post" action="<?php echo base_url('Bahan_pembantu/add_kemasan') ?>">
      		<div class="col-lg-12">
      			<div class="form-group">
	        		<label>Tanggal : </label>
	        		<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo date('Y-m-d') ?>"><small>
	        	</div>
      		</div>
      		<div class="col-lg-4">
      			<div class="form-group">
	      			<label>Produk : </label>
	      			<select name="produk" id="produk" class="form-control">
		      			<?php $data = $this->db->order_by('id', 'ASC')->get('produk')->result_array(); ?>
		      			<?php foreach ($data as $key){ ?>
		      				<option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
		      			<?php } ?>
		      		</select>
	      		</div>
      		</div>
      		<div class="col-lg-4">
      			<div class="form-group">
	      			<label>Kemasan : </label>
	      			<select name="kemasan" id="kemasan" class="form-control">
		      			<?php $data = $this->db->order_by('id', 'ASC')->get('kemasan')->result_array(); ?>
		      			<?php foreach ($data as $key){ ?>
		      				<option value="<?php echo $key['nama'] ?>"><?php echo $key['nama'] ?></option>
		      			<?php } ?>
		      		</select>
	      		</div>
      		</div>
      		<div class="col-lg-4">
      			<div class="form-group">
      				<label>FILTER</label><br>
      				<button id="filter" class="btn btn-info"><i class="fa fa-search"></i> FILTER</button>
      			</div>
      		</div>

	      	<div class="col-lg-6" id="tampil1">
	      		<div class="form-group">
	      			<label>Stock Awal : </label>
	      			<input type="number" disabled="" id="awal2" class="form-control">
	      			<input type="hidden" name="awal" id="awal3">
	      		</div>
	      		<div class="form-group">
	      			<label>Masuk : </label>
	      			<input type="number" name="masuk" class="form-control" value="0">
	      		</div>
	      	</div>
	      	<div class="col-lg-6" id="tampil2">
	      		<div class="form-group">
	      			<label>Terpakai : </label>
	      			<input type="number" name="terpakai" class="form-control" value="0">
	      		</div>
	      		<div class="form-group">
	      			<label>Afkir : </label>
	      			<input type="number" name="afkir" class="form-control" value="0">
	      		</div>
	      	</div>
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-danger">Tambah</button>
        <button type="button" class="btn" data-dismiss="modal">Close</button>
      </div>
    </div></form>
  </div>
</div>

<script>
	$('#tampil1').hide();$('#tampil2').hide();
	$('#filter').on('click', function(event){
		event.preventDefault();
		var produk = $('#produk').val();
		var kemasan = $('#kemasan').val();
		$.ajax({
			url : '<?php echo base_url("Bahan_pembantu/filter_stock_kemasan") ?>',
			method : 'POST',
			dataType : 'JSON',
			data : {produk:produk, kemasan:kemasan},
			success : function(data){
				$('#awal2').val(data);
				$('#awal3').val(data);
				$('#tampil1').fadeIn();$('#tampil2').fadeIn();
			}
		})
	})
  function cari() {
    var awal = $('#awal_in').val();
    var akhir = $('#akhir_in').val();
    var produk = $('#produks').val();
    $.ajax({
  url : '<?php echo base_url("Bahan_pembantu/cari_kemasan") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, produk:produk},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Bahan_pembantu/total_kemasan") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, produk:produk},
          dataType : 'JSON',
          success : function(total) {
            $("#awal").html(total.awal);
            $("#masuk").html(total.masuk);
            $("#sisa").html(total.sisa);
            $("#terpakai").html(total.terpakai);
            $("#afkir").html(total.afkir);
            $("#stock").html(total.stock);
            console.log(total);

            // $('.modal-backdrop').hide(); // for black background
            // $('#myModal3').modal('hide'); 
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
  $(document).ready(function(){
    jQuery('#awal_in').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir_in').datepicker({format : 'yyyy-mm-dd'});
  });

  function printlayer(div) {
	var restorpage = document.body.innerHTML;
    var printcontent = document.getElementById(div).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorpage;
}
</script>