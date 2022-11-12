<style>
	table {text-align: center;}
	table tr th {text-align: center;}
  #show {text-align: center;}
  }
</style>

<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku</strong>
		</div>
	</div>
</div>
<?php 
  $bulan = array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong>Stock Bahan ( Tembakau ) Hari Ini : <?php echo date('Y-m-d') ?></strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
		<div class="card-body">
      <div class="table-responsive">
  			<table class="table table-hover table-stripped table-sm" id="table_ku">
  				<thead>
  					<tr>
  						<th>No</th>
  						<th>Tanggal</th>
              <th>Asal</th>
  						<th>Jenis</th>
  						<th>Kategori</th>
  						<th>Masuk</th>
  						<th>DiTerima</th>
  						<th>DiProduksi</th>
  						<th>Stok Sisa</th>
  						<th>Ket</th>
  						<th>Opsi</th>
  					</tr>
  				</thead>
  				<tbody>
  					<?php $no=1; foreach ($stock as $keysss) {
  						?>
  					<tr>
  						<td><?php echo $no; ?></td>
  						<td><?php echo $keysss['tanggal'] ?></td>
              <td><?php echo $keysss['asal'] ?></td>
  						<td><?php echo $keysss['jenis'] ?></td>
  						<td><?php echo $keysss['kategori'] ?></td>
  						<td><?php echo $keysss['stock_masuk'] ?></td>
  						<td><?php echo $keysss['diterima'] ?></td>
  						<td><?php echo $keysss['diproduksi'] ?></td>
  						<td><?php echo $keysss['hari_ini'] ?></td>
  						<td><?php echo $keysss['ket'] ?></td>
  						<td>
                <?php if ($this->session->userdata('level') == 'Super Admin') { ?>
                <a href="<?php echo base_url('Bahanbaku/edit_stock/'.$keysss['id']) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a><!-- target="_blank" title="Edit"  -->
                <button title="Hapus" onclick="hapus(<?php echo $keysss['id'] ?>)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
	        <a href="<?php echo base_url("Bahanbaku/print_stock_bahan") ?>" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
	    </div>
	</div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-info text-light">
      <b><i class="fa fa-book"></i> Daftar Laporan Stock Bahan</b>
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> FILTER</button>
    </div>
    <div class="card-body" id="print_isi">
      <img src="<?php echo base_url('assets/images/BIN.png') ?>" style="width: 70px" class="hidd">
      <center>LAPORAN STOCK BAHAN<br>
      Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b></center>
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm">
          <thead>
      			<tr>
      				<th>No</th>
      				<th>Tanggal</th>
              <th>Asal</th>
      				<th class="bg-danger text-light">Jenis</th>
      				<th>Kategori</th>
      				<th>Masuk</th>
      				<th>DiTerima</th>
      				<th>DiProduksi</th>
      				<th>Stok Sisa</th>
      				<th>Ket</th>
      			</tr>
      		</thead>
          <tbody id="isi_table"></tbody>
          <tfoot class="bg-success text-light">
          	<tr>
          		<th></th>
          		<th></th>
              <th></th>
          		<th></th>
          		<th>TOTAL</th>
          		<th id="total_masuk"></th>
          		<th id="total_terima"></th>
          		<th id="total_produksi"></th>
          		<th id="total_hari_ini"></th>
          		<th></th>
          	</tr>
          </tfoot>
        </table>
      </div>
       
      <div class="col-lg-12" id="show">
        <div class="col-md-12 col-md-offset-12" align="right">
          Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        </div><br><br><br><br>
        <div class="col-md-3">
          (<u><?php echo $setting['direktur'] ?></u>)<br>
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
        	<div class="form-group">
	        	<select class="form-control" id="jenis">
	        		<option value="">-- Jenis Tembakau --</option>
	        		<?php foreach ($jenis as $key) {
	        			echo "<option value='".$key['jenis']."'>".$key['jenis']."</option>";
	        		} ?>
	        	</select>
        	</div>
        </div>
        <div class="col-lg-6">
        	<div class="form-group">
        		<input type="text" id="awal" class="form-control" value="<?php echo date('Y-m-d') ?>">
        	</div>

        </div>
        <div class="col-lg-6">
        	<div class="form-group">
        		<input type="text" id="akhir" class="form-control" value="<?php echo date('Y-m-d') ?>">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <button class="btn btn-danger" onclick="cari()"><i class="fa fa-search"></i> Cari</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<b><i class="fa fa-plus-circle"></i> Tambah Bahan Baku ( Tembakau )</b>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <form method="post" action="<?php echo base_url('Bahanbaku/add_stock') ?>">
      <div class="modal-body">
        <div class="col-lg-12">
        	<div class="col-lg-6">
        	<div class="form-group">
        		<label>Tanggal : </label>
        		<input type="text" name="tanggal" id="tanggalan" class="form-control" value="<?php echo date('Y-m-d') ?>">
        	</div>
        	<div class="form-group">
        		<label>Jenis Tembakau : </label>
	        	<select class="form-control" name="jenis">
	        		<?php foreach ($jenis as $key) {
	        			echo "<option value='".$key['jenis']."'>".$key['jenis']."</option>";
	        		} ?>
	        	</select>
        	</div>
        	<div class="form-group">
        		<label>Kategori Tembakau : </label>
	        	<select class="form-control" name="kategori">
	        		<?php foreach ($kategori as $keya) {
	        			echo "<option value='".$keya['kategori']."'>".$keya['kategori']."</option>";
	        		} ?>
	        	</select>
        	</div>
          <div class="form-group">
            <label>Asal : </label>
            <select class="form-control" name="asal">
              <option value="Tanam Sendiri">Tanam Sendiri</option>
              <option value="Beli Exsternal">Beli Exsternal</option>
            </select>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Stok Masuk : </label>
            <input type="number" step="any" name="masuk" class="form-control">
          </div>
        	<div class="form-group">
        		<label>Stok Di Terima : </label>
        		<input type="number"step="any" name="diterima" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Stock Di Produksi : </label>
        		<input type="number"step="any" name="produksi" class="form-control">
        	</div>
        	<!-- <div class="form-group">
        		<label>Stock Hari Ini : </label>
        		<input type="number" name="hariini" class="form-control">
        	</div> -->
        	<div class="form-group">
        		<label>Keterangan : </label>
        		<textarea name="ket" class="form-control" placeholder="Keterangan..."></textarea>
        	</div>
        </div>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="tambah" class="btn btn-info">
      </div></form>		
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
  }
	$(document).ready(function(){
    jQuery('#table_ku').DataTable();
		jQuery('#tanggalan').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
	});

	function hapus(id) {
		$.ajax({
			url : '<?php echo base_url("Bahanbaku/hapus_stock/") ?>'+id,
			method : 'POST',
			success : function(data){
				alert(data);
				location.reload();
			}
		})
	}
	function cari(argument) {
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();
    var jenis = $('#jenis').val();
    $.ajax({
      url : '<?php echo base_url("Bahanbaku/cari_stock_bahan") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir, jenis:jenis},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

        $.ajax({
          url : '<?php echo base_url("Bahanbaku/total_stock_bahan") ?>',
          method : 'POST',
          data : {awal:awal, akhir:akhir, jenis:jenis},
          dataType : 'JSON',
          success : function(total) {
            $("#total_masuk").html(total.masuk);
            $("#total_produksi").html(total.diproduksi);
            $("#total_terima").html(total.diterima);
            $("#total_hari_ini").html(total.hari_ini);

            // $('#myModal2').modal('hide');
            $('.modal-backdrop').hide(); // for black background
            $('#myModal2').modal('hide'); 
          }
        })

      }
    })
  }
</script>
