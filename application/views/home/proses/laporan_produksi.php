<style>
  table {text-align: center;}
  table tr th {text-align: center;}
</style> 
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<?php $setting = $this->db->get_where('setting', array('id' => 1))->row_array(); ?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Proses Produksi / Laporan Produksi</strong>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<strong><i class="fa fa-plus"></i> Tambah Laporan Produksi dan Bahan Produk  | Tanggal : <?php echo date('Y-m-d') ?></strong>
			<div class="pull-right">
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
          	<th>No</th>
          	<th>Produk/Merek</th>
          	<th>Jumlah</th>
          	<th>Jenis</th>
          	<th>Dek</th>
          	<th>Omb</th>
          	<th>Fill</th>
          	<th>Aksi</th>
          </tr>
        </thead>
       	<tbody>
       		<?php $data = $this->db->order_by('id', 'ASC')->get('laporan_produksi')->result_array(); ?>
       		<?php $no=1; foreach ($data as $key): ?>
       			<tr>
       				<td><?php echo $no ?></td>
       				<td><?php echo $key['produk'] ?></td>
       				<td><?php echo $key['jumlah'] ?></td>
       				<td><?php echo $key['jenis'] ?></td>
       				<td><?php echo $key['dek'] ?></td>
       				<td><?php echo $key['omb'] ?></td>
       				<td><?php echo $key['dek'] ?></td>
       				<td>
       					<a title="Edit" href="<?php echo base_url('proses_produksi/edit_laporan_produksi/'.$key['id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
       					<a title="hapus" href="<?php echo base_url('proses_produksi/hapus_laporan_produksi/'.$key['id']) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
       				</td>
       			</tr>
       		<?php $no++; endforeach ?>
       	</tbody>
      </table>
    </div>
    <div class="card-footer">
    	<button class="btn btn-primary" onclick="window.open('<?php echo base_url("Proses_produksi/print_laporan_produksi") ?>')"><i class="fa fa-print"></i> Print</button>
    </div>
	</div>
</div>

<div class="col-lg-12">
  <div class="card">
    <div class="card-header bg-danger text-light">
      <b><i class="fa fa-book"></i> Semua Laporan Fumigasi</b>
      <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-search"></i> Cari tanggal</button>
    </div>
    <div class="card-body" id="print_isi">
      <center>LAPORAN PRODUKSI DAN BAHAN PRODUK<br>
      Tanggal : <b id="tanggal_awal"></b> Sd. <b id="tanggal_akhir"></b></center>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
          	<th>No</th>
          	<th>Produk/Merek</th>
          	<th>Jumlah</th>
          	<th>Jenis</th>
          	<th>Dek</th>
          	<th>Omb</th>
          	<th>Fill</th>
          	<th>Aksi</th>
          </tr>
        </thead>
        <tbody id="isi_table"></tbody>
      </table>
       
      <div class="col-lg-12">
          <div style="margin-left: 600px">Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?></div><br><br>
          (<u><?php echo $setting['direktur'] ?></u>)<b style="margin-right: 300px"></b>(<u><?php echo $setting['qc'] ?></u>)
          <br>Direktur Operasional<b style="margin-right: 300px"></b>Quality Control     
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
          <div class="col-lg-4">
            <input type="text" id="awal" class="form-control">
          </div>
          <div class="col-lg-1">
            Sd.
          </div>
          <div class="col-lg-4">
            <input type="text" id="akhir" class="form-control">
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<label><i class="fa fa-gear"></i> Proses Fumigasi</label>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<form method="post" action="<?php echo base_url('Proses_produksi/add_laporan_produksi') ?>">
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Produk/Merek :</label>
      			<select class="form-control" name="produk">
      				<?php $merek = $this->db->order_by('id','ASC')->get('produk')->result_array(); ?>
      				<?php foreach ($merek as $produk): ?>
      					<option value="<?php echo $produk['produk'] ?>"><?php echo $produk['produk'] ?></option>
      				<?php endforeach ?>
      			</select>
      		</div>
      		<div class="form-group">
      			<label>Jumlah :</label>
      			<input type="text" name="jumlah" class="form-control">
      		</div>
      	</div>
      	<div class="col-lg-6">
      		<div class="form-group">
      			<label>Jenis Tembakau :</label>
      			<select class="form-control" name="jenis">
      				<?php $jenis = $this->db->order_by('id','ASC')->get('jenis')->result_array(); ?>
      				<?php foreach ($jenis as $jeniss): ?>
      					<option value="<?php echo $jeniss['jenis'] ?>"><?php echo $jeniss['jenis'] ?></option>
      				<?php endforeach ?>
      			</select>
      		</div>
      		<div class="form-group">
      			<label>Dekblad :</label>
      			<input type="text" name="dek" class="form-control">
      		</div>
      		<div class="form-group">
      			<label>Omblad :</label>
      			<input type="text" name="omb" class="form-control">
      		</div>
      		<div class="form-group">
      			<label>Fillter :</label>
      			<input type="text" name="fill" class="form-control">
      		</div>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Tambah</button>
      </div>
    </div></form>
  </div>
</div>

<script>

  $(document).ready(function(){
    var options = {
      url: "<?php echo base_url('Proses_produksi/semua_subproduk') ?>", // DATA JSON
      getValue: "sub_produk",
      template: {
        type: "description",
        fields: {
          description: "sub_kode"
        }
      },
      list: { 
        match: {
          enabled: true
        }
      },
      theme: "square"
    };
    jQuery("#hasil_sub").easyAutocomplete(options);
  });

  $(document).ready(function(){
    jQuery('#awal').datepicker({format : 'yyyy-mm-dd'});
    jQuery('#akhir').datepicker({format : 'yyyy-mm-dd'});
  });

  function cari(argument) {
    var awal = $('#awal').val();
    var akhir = $('#akhir').val();

    $.ajax({
      url : '<?php echo base_url("proses_produksi/cari_laporan_produksi") ?>',
      method : 'POST',
      data : {awal:awal, akhir:akhir},
      dataType : 'JSON',
      success : function(data){
        $("#isi_table").html(data);
        $('#tanggal_awal').html(awal);
        $('#tanggal_akhir').html(akhir);

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
</script>