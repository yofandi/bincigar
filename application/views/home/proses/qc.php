<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / QC
			</strong>
		</div>
	</div>
</div>
<style>
  table {text-align: center;}
  table tr th {text-align: center; text-transform: uppercase;}
</style>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-info text-light">
			<b><i class="fa fa-plus-circle"></i> Tambah Quality Controll</b>
			<button type="button" class="btn btn-danger btn-sm pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
		</div>
		<div class="card-body" id="kk">
			<div class="hidd">
				 <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px">
				 <center>
				 	<b>LAPORAN PROSES PRODUKSI (DRYING 3) HARI INI</b>
				 	<br>Tanggal : <?php $bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' ); echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?></center>
				 	<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
			</div>
			<table class="table table-hover" id="table_ku">
				<thead class="thead-dark">
					<tr>
						<th rowspan="2">No</th>
						<th rowspan="2">Tanggal</th>
						<th rowspan="2">Produk</th>
						<th rowspan="2">Jenis</th>
						<th rowspan="2">Stock Awal</th>
						<th rowspan="2">Accept</th>
						<th class="action">Reject</th>
						<th class="hidd" colspan="3">Reject</th>
						<th rowspan="2">Ket</th>
						<th rowspan="2" class="action">Aksi</th>
						<!-- <th>No</th> -->
					</tr>
					<tr class="hidd">
						<th>Back Binding</th>
						<th>Back Wrapping</th>
						<th>Back FILLER 2</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($qc__ as $key): 
					$rjt = $key['binding_rej'] + $key['wrapping_rej'] + $key['rusak_rej'];?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $key['tanggal']; ?></td>
							<td><?php echo $key['produk']; ?></td>
							<td><?php echo $key['jenis']; ?></td>
							<td><?php echo $key['stock']; ?></td>
							<td><?php echo $key['accept']; ?></td>
							<td class="action"><?php echo $rjt; ?></td>
							<td class="hidd"><?php echo $key['binding_rej']; ?></td>
							<td class="hidd"><?php echo $key['wrapping_rej']; ?></td>
							<td class="hidd"><?php echo $key['rusak_rej']; ?></td>
							<td><?php echo $key['ket']; ?></td>
							<td class="action">
								<!-- <a title="Edit" class="btn btn-warning btn-sm" href="<?php echo base_url('Proses_produksi/edit_qc/'.$key['id']) ?>"><i class="fa fa-edit"></i></a> -->
								<a title="Hapus" class="btn btn-danger btn-sm" href="<?php echo base_url('Proses_produksi/hapus_qc/'.$key['id']) ?>"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php $no++; endforeach ?>
				</tbody>
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
		          (<u><?php echo $setting['qc'] ?></u>)<br>
		          Quality Control
		        </div>
		      </div>
		</div>
		<div class="card-footer">
			<button class="btn btn-info" onclick="printlayer('kk')"><i class="fa fa-print"></i> Print</button>
			<button class="btn btn-success" id="open"><i class="fa fa-bullhorn"></i> Beri Kabar</button>
		</div>
	</div>
</div>

<div class="col-lg-12" id="pesan">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-comment"></i> Beri Kabar, Bahwa Proses Produksi Telah Selesai</b>
		</div>
		<div class="card-body">
			<div class="alert alert-info"><b>Quality Control Untuk Produk ini !!!</b></div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Produk/Merek : </label>
					<input type="text" class="form-control" id="produk_tampil" disabled="">
				</div>
				<div class="form-group">
					<label>Accept : </label>
					<input type="text" class="form-control" id="accept_tampil" disabled="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>Jenis Tembakau : </label>
					<input type="text" class="form-control" id="jenis_tampil" disabled="">
				</div>
				<input type="hidden" id="bind">
				<input type="hidden" id="wrap">
				<input type="hidden" id="rsk">
				<input type="hidden" id="qc">
				<div class="form-group">
					<label>Reject : </label>
					<input type="text" class="form-control" id="reject_tampil" disabled="">
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>Pesan : </label>
					<textarea id="text" class="form-control" rows="5"></textarea>
					<input type="hidden" id="id_qc" value="">
				</div>
				<div class="form-group">
					<button class="btn btn-info pull-right" style="margin-left: 10px" id="kirim"><i class="fa fa-envelope"></i> Kirim Pesan</button>
					<button class="btn btn-flat pull-right" id="back"><i class="fa fa-reply"></i> Kembali</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<label><i class="fa fa-plus-circle"></i> Quality Controll</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<form  method="post" action="<?php echo base_url('Proses_produksi/tambah_qc') ?>">
      	<div class="col-lg-12">
      		<div class="form-group">
      			<label>Tanggal : </label>
      			<input type="text" id="tanggalan" name="tanggal" class="form-control" value="<?php echo date('Y-m-d') ?>">
      		</div>
      	</div>
      	<div class="col-lg-5">
          <div class="form-group">
            <label>Jenis Tembakau :</label>
            <select name="jenis" id="jenis" class="form-control">
              <?php $bd = $this->db->select('jenis')->get('jenis')->result(); 
              foreach ($bd as $lue): ?>
                <option value="<?= $lue->jenis ?>"><?= $lue->jenis ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
      	<div class="col-lg-5">
      		<div class="form-group">
      			<label>Produk : </label>
      			<select class="form-control" name="produk" id="produk" name="produk">
      				<?php $produk=$this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
      				<?php foreach ($produk as $key): ?>
      					<option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
      				<?php endforeach ?>
      			</select>
      		</div>
      	</div>
      	<div class="col-lg-2">
      		<div class="form-group">
      			<label>FILTER</label><br>
      			<button id="filter" class="btn btn-info"><i class="fa fa-search"></i> FILTER</button>
      		</div>
      	</div>
      	<div id="tampil_data">
      		<div class="col-lg-12">
				<div class="form-group">
					<label> Stock Awal : </label>
					<input type="number" name="stock" id="ppap" class="form-control" readonly>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label> Accept : </label>
					<input type="number" class="form-control" name="accept">
				</div>
			</div>
			<div class="col-lg-12">
	        <label> Reject : </label>
	    	</div>
	        <div id="importFrm">
	            <div class="form-group">
	            	<div class="col-lg-4">
	            	    <input type="number" class="form-control" name="binding" value="0">
	            	    <small>*binding</small>
	                </div>
	                <div class="col-lg-4">
	            	    <input type="number" class="form-control" name="wrapping" value="0">
	            	    <small>*wrapping</small>
	                </div>
	                <div class="col-lg-4">
	            	    <input type="number" class="form-control" name="buang" value="0">
	            	    <small>*filler 2</small>
	                </div>
	            </div>
	        </div>
			<div class="col-lg-12">
				<div class="form-group">
					<label> Keterangan : </label>
					<textarea class="form-control" name="ket"></textarea>
				</div>
			</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info" value="Tambah">
        
      </div>
    </div></form>

  </div>
</div>
<script>
$('#tampil_data').hide();
$(document).ready(function(){
	jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
});
function printlayer(div) {
    var restorpage = document.body.innerHTML;
    var printcontent = document.getElementById(div).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorpage;
    location.reload();
  }
$('#filter').on('click', function(event){
	event.preventDefault();
	var produk = $('#produk').val();
	var jenis = $('#jenis').val();
	$.ajax({
		url : '<?php echo base_url("Proses_produksi/filter_qc/") ?>',
		method : "POST",
		dataType : 'JSON',
		data :{produk:produk,jenis:jenis},
		success : function(data){
			// console.log(data);
			// $('#tampil_data').html(data);	
			$('#ppap').val(data.hasil_today);
			$('#tampil_data').fadeIn();
		}
	})
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

$('#pesan').hide();

$('#open').on('click', function(event){
	event.preventDefault();
	$.ajax({
		url : '<?php echo base_url("Proses_produksi/ambil_qc") ?>',
		method : 'POST',
		dataType : 'JSON',
		success : function(data){
			$('#produk_tampil').val(data.produk);
			$('#jenis_tampil').val(data.jenis);
			$('#accept_tampil').val(data.accept);

			$('#bind').val(data.binding_rej);
			$('#wrap').val(data.wrapping_rej);
			$('#rsk').val(data.rusak_rej);

			var bind = parseInt($('#bind').val());
			var wrap = parseInt($('#wrap').val());
			var fil2 = parseInt($('#rsk').val());

			rej = bind + wrap + fil2;

			$('#reject_tampil').val(rej);
			$('#id_qc').val(data.id);
			$('#pesan').fadeIn();

			$('#back').on('click', function(eventt){
				eventt.preventDefault();
				$('#pesan').fadeOut();
			})

			$('#kirim').on('click', function(eventtt){
				eventtt.preventDefault();
				var pesan = $('#text').val();
				var id = $('#id_qc').val();

				$.ajax({
					url : '<?php echo base_url("Proses_produksi/kirim_pesan") ?>',
					method : 'POST',
					data : {id:id, pesan:pesan},
					success : function(data){
						alert(data);
						$('#pesan').fadeOut();
					}
				})
			})
		} 
	})
});
</script>