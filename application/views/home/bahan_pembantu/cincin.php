<style>
	table {text-align: center;}
	table tr th {text-align: center;}
	#show { text-align: center; }
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Cincin</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong><i class="fa fa-plus"></i> Tambah Bahan Pembantu ( Cincin )</strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
		<div class="card-body">
			<div class="col-lg-12" id="print_isi">
			  <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
				<center>
					<b>LAPORAN STOCK BAHAN PEMBANTU (CINCIN) HARI INI</b>
					<br>Tanggal : <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
				</center>
				<table class="table table-hover table-bordered" id="table_ku">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Produk</th>
							<th>Awal Stock</th>
							<th>Masuk</th>
							<th>Terpakai</th>
							<th>Afkir</th>
							<th>Sisa Stock</th>
							<th>Tanggal</th>
							<th class="action">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  ?>
						<?php $no=1; foreach ($cincin as $key){ ?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $key['nama_produk'] ?></td>
								<td><?= $key['awal'] ?></td>
								<td><?= $key['masuk'] ?></td>
								<td><?= $key['terpakai'] ?></td>
								<td><?= $key['afkir'] ?></td>
								<td><?= $key['stock'] ?></td>
								<td><?= $key['tanggal'] ?></td>
								<td class="action">
									<?php if ($this->session->userdata('level') == 'Super Admin') { ?>
									<a class="btn btn-warning btn-sm" title="Edit" href="<?php echo base_url('Bahan_pembantu/edit_cincin/'.$key['id']) ?>"><i class="fa fa-edit"></i></a>
									<a class="btn btn-danger btn-sm" title="Hapus" href="<?php echo base_url('Bahan_pembantu/hapus_cincin/'.$key['id']) ?>"><i class="fa fa-trash"></i></a>
									<? } ?>
								</td>
							</tr>
						<?php $no++; } ?>
					</tbody>
					<tfoot class="bg-success text-light">
						<?php 
					$this->db->where('tanggal', date('Y-m-d'));
				    $this->db->select('SUM(awal) as total_awal');
				    $this->db->from('cincin');
				    $total_awal = $this->db->get()->row()->total_awal;
				    $this->db->where('tanggal', date('Y-m-d'));
				    $this->db->select('SUM(masuk) as total_masuk');
				    $this->db->from('cincin');
				    $total_masuk = $this->db->get()->row()->total_masuk;
				    $this->db->where('tanggal', date('Y-m-d'));
				    $this->db->select('SUM(terpakai) as total_terpakai');
				    $this->db->from('cincin');
				    $total_terpakai = $this->db->get()->row()->total_terpakai;
				    $this->db->where('tanggal', date('Y-m-d'));
				    $this->db->select('SUM(afkir) as total_afkir');
				    $this->db->from('cincin');
				    $total_afkir = $this->db->get()->row()->total_afkir;
				    $this->db->where('tanggal', date('Y-m-d'));
				    $this->db->select('SUM(stock) as total_stock');
				    $this->db->from('cincin');
				    $total_stock = $this->db->get()->row()->total_stock;
						?>
						<tr>
							<td></td>
							<td>TOTAL</td>
							<td><?php echo $total_awal ?></td>
							<td><?php echo $total_masuk ?></td>
							<td><?php echo $total_terpakai ?></td>
							<td><?php echo $total_afkir ?></td>
							<td><?php echo $total_stock ?></td>
							<td colspan="2" class="action"></td>
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
			<button class="btn btn-info" onclick="printlayer('print_isi')"><i class="fa fa-print"></i> Print</button>	
		</div>
	</div>
</div>

<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> FILTER DATA</button>
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
							<th>Nama Produk</th>
							<th>Awal Stock</th>
							<th>Masuk</th>
							<th>Terpakai</th>
							<th>Afkir</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody id="isi_table"></tbody>
					<tfoot class="bg-success text-light">
						<tr>
							<td></td>
							<td>TOTAL</td>
							<td></td>
							<td id="awal"></td>
							<td id="masuk"></td>
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
	        <input type="text" id="awal_in" class="form-control" value="<?php echo date('Y-m-d') ?>">
	      </div>
	      <div class="col-lg-1">
	        Sd.
	      </div>
	      <div class="col-lg-4">
	        <input type="text" id="akhir_in" class="form-control" value="<?php echo date('Y-m-d') ?>">
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
      	<b>Tambah Bahan Pembantu ( Cincin )</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      		<form method="post" action="<?php echo base_url('Bahan_pembantu/add_cincin') ?>">
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
  			<div class="form-group">
  				<label>Stock Awal : </label>
  				<input type="number" class="form-control" id="stock_awal" disabled="">
  				<input type="hidden" name="stock_awal" id="hidden_stock">
  			</div>
  			<div class="form-group">
  				<label>Stock Masuk : </label>
  				<input type="number" class="form-control" name="masuk" value="0">
  			</div>
  		</div>
  		<div class="col-lg-6" id="tampil2">
  			<div class="form-group">
  				<label>Stock Terpakai : </label>
  				<input type="number" class="form-control" name="terpakai" value="0">
  			</div>
  			<div class="form-group">
  				<label>Stock Afkir : </label>
  				<input type="number" class="form-control" name="afkir" value="0">
  			</div>
  		</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Tambah</button></form>
      </div>
    </div>

  </div>
</div>

<script>
	$('#tampil1').hide();$('#tampil2').hide();
	// filter
	$('#filter').on('click', function(event){
		event.preventDefault();
		var produk = $('#produk').val();
		$.ajax({
			url : '<?php echo base_url("Bahan_pembantu/filter_stock_cincin/") ?>',
			method : 'POST',
			data : {produk:produk},
			dataType : 'JSON',
			success : function(data){
				// console.log(data);
				$('#stock_awal').val(data);
				$('#hidden_stock').val(data);
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
	}
   

  function cari(argument) {
    var awal = $('#awal_in').val();
    var akhir = $('#akhir_in').val();
    var produk = $('#produks').val();
    $.ajax({
      url : '<?php echo base_url("Bahan_pembantu/cari_cincin") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, produk:produk},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Bahan_pembantu/total_cincin") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, produk:produk},
          dataType : 'JSON',
          success : function(total) {
            $("#awal").html(total.awal);
            $("#masuk").html(total.masuk);
            $("#terpakai").html(total.terpakai);
            $("#afkir").html(total.afkir);
            $("#stock").html(total.stock);

            // $('.modal-backdrop').hide(); // for black background
            // $('#myModal2').modal('hide'); 
          }
        })

      }
    })
  }
  $(document).ready(function(){
    jQuery('#awal_in').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir_in').datepicker({format : 'yyyy-mm-dd'});
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
  $(document).ready(function(){
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
	});
</script>