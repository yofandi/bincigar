<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Tambah Penjualan</strong>
    </div>
  </div>
</div>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-danger text-light">
			<b><i class="fa fa-plus"></i> Tambah Penjualan</b>
		</div>
		<div class="card-body">
		<form action="<?= base_url('Marketing/add_penjualan_1') ?>" method="POST" accept-charset="utf-8">
			<div class="col-lg-12">
	      		<div class="form-group">
	      			<label>Tanggal</label>
	      			<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
	      		</div>
	      	</div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>Daftar Barang</label>
	        	</div>
	        	<table class="table" id="table_ku">
	        		<thead>
	        			<tr>
	        				<th>No.</th>
	        				<th>Bagan</th>
	        				<th>User</th>
	        				<th>Merk</th>
	        				<th>Harga</th>
	        				<th>Stok</th>
	        				<th>Dibeli</th>
	        				<th>Diskon perMerk</th>
	        				<th></th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php $no=1; foreach ($barang_show->result() as $barang): ?>
	        			<tr>
	        				<td><?= $no ?><input type="hidden" id="id<?= $barang->id?>" value="<?= $barang->id ?>"></td>
	        				<td><?= $barang->level ?></td>
	        				<td><?= $barang->username ?></td>
	        				<td><?= $barang->sub_produk.' || '.$barang->sub_kode ?><input type="hidden" id="nama<?= $barang->id?>" value="<?= $barang->sub_produk.' - '.$barang->sub_kode ?>"></td>
	        				<td><?= $barang->hje ?><input type="hidden" id="harga<?= $barang->id?>" value="<?= $barang->hje ?>"></td>
	        				<td><?= $barang->stock ?><input type="hidden" id="stokawl<?= $barang->id?>" value="<?= $barang->stock ?>"></td>
	        				<td><input type="number" id="qtybarang<?= $barang->id?>" value="1" placeholder="QTY"></td>
	        				<td><input type="number" id="diskonbarang<?= $barang->id?>" value="0"></td>
	        				<td>
	        					<button type="button" class="btn btn-danger btn-sm" onclick="add_to_cart<?= $barang->id?>()"><b>Add</b></button>
	        					<script>
	        						function add_to_cart<?= $barang->id?>(argument) {
	        							var id = $('#id<?= $barang->id?>').val();
	        							var nama = $('#nama<?= $barang->id?>').val();
	        							var harga = parseInt($('#harga<?= $barang->id?>').val());
	        							var jml = parseInt($('#qtybarang<?= $barang->id?>').val()); 
	        							var stokaw = parseInt($('#stokawl<?= $barang->id?>').val());
	        							var diskon = parseInt($('#diskonbarang<?= $barang->id?>').val());

	        							var harga_set = harga * jml;
	        							var set_diskon = harga_set * diskon / 100;
	        							var harga_now = harga_set - set_diskon;
	        							$.ajax({
	        								url: '<?= base_url('Marketing/add_to_cart') ?>',
	        								type: 'POST',
	        								data: {id:id,nama:nama,harga:harga,jml:jml,stokaw:stokaw,diskon:diskon,harga_now:harga_now},
	        								success : function (data) {
	        									$('#qtybarang<?= $barang->id?>').val('');
												$('#diskonbarang<?= $barang->id?>').val('');
	        									load_data();
	        								}
	        							})
	        						}
	        					</script>
	        				</td>
	        			</tr>
	        			<?php $no++; endforeach ?>
	        		</tbody>
	        	</table>
	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>Daftar Beli</label>
	        	</div>
	        	<table class="table">
	        		<thead>
	        			<tr>
	        				<th>No.</th>
	        				<th>Merk</th>
	        				<th>Jumlah</th>
	        				<th>Diskon</th>
	        				<th class="center">Total</th>
	        				<th></th>
	        			</tr>
	        		</thead>
	        		<tbody id="isi_cart">
	        		</tbody>
	        	</table>
	        </div>
	        <div class="col-lg-12">
	        <?php 
	        if ($_SESSION['level'] == 'Super Admin') {?>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>Bagan :</label>
	        		<select name="bagan" id="bagan1234" class="form-control">
	        			<option value="">--- Pilih Bagan ---</option>
	        			<?php foreach ($bagan->result() as $lue): ?>
	        			<option value="<?= $lue->nama ?>"><?= $lue->nama ?></option>
	        			<?php endforeach ?>
	        		</select>
	        	</div>
	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>User : </label>
	  			    <select name="user" class="form-control" id="user">
	  			    </select>
	        	</div>
	        </div>
	        <div class="col-lg-12">
	          <div class="form-group">
	            <label>Customer : </label>
	            <select name="customer" class="form-control" id="customer">
	            </select>
	          </div>
	        </div>
	        <?php } else { ?>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>Bagan :</label>
	        		<input type="text" class="form-control" name="bagan" id="bagan1234" value="<?= $_SESSION['level'] ?>" readonly>
	        	</div>
	        </div>
	        <div class="col-lg-6">
	        	<div class="form-group">
	        		<label>User : </label>
	        		<input type="text" class="form-control" value="<?= $_SESSION['username'] ?>" readonly>
	        		<input type="hidden" class="form-control" name="user" id="user" value="<?= $_SESSION['id'] ?>">
	        	</div>
	        </div>
	        <div class="col-lg-12">
	          <div class="form-group">
	            <label>Customer : </label>
	            <select name="customer" class="form-control">
	              <option value="">--- Pilih Customer ---</option>
	              <?php foreach ($customer->result() as $app): ?>
	              <option value="<?= $app->id_customer ?>"><?= $app->nama_customer ?></option>
	              <?php endforeach ?>
	            </select>
	          </div>
	        </div>
	        <?php } ?>
	        	<div class="col-lg-3">
		        	<div class="form-group">
		        		<label>Total :</label>
		        		<input type="text" class="form-control" name="" id="tot_show" readonly>
		        		<input type="hidden" class="form-control" name="harga_semua_cerutu" id="tot_hidd">
		        		<!-- <input type="number" class="form-control" name="tol_st" id="total">
		        		<input type="hidden" class="form-control" name="total" id="total1"> -->
		        	</div>
		        </div>
		        <div class="col-lg-2">
		        	<div class="form-group">
		        		<label>Diskon (%) :</label>
		        		<input type="number" class="form-control" name="diskon" id="diskon" value="0">
		        	</div>
		        </div>
		        <div class="col-lg-3">
		        	<div class="form-group">
		        		<label>Ongkos Kiriml (Rp.) : </label>
					    <input type="number" name="ongkos" id="ongkos" class="form-control" value="0">
					    <small>Masukan Nominal, contoh  : 30000, 50000</small>
		        	</div>
		        </div>
		        <div class="col-lg-1">
		        	<div class="form-group">
		        		<label>&nbsp</label><br>
		        		<button type="button" class="btn btn-danger btn-sm" onclick="hitung()">Hitung</button>
		        	</div>
		        </div>
		        <div class="col-lg-3">
		        	<div class="form-group">
		        		<label>Total Semua :</label>
					    <input type="text" id="tot_all" class="form-control" readonly>
					    <input type="number" name="tot_all" id="tot_all_1" class="form-control hidd" readonly>
		        	</div>
		        </div>
		        <div class="col-lg-6">
		        	<div class="form-group">
		        		<label>Yang Di bayar (Rp.) :</label>
		        		<input type="number" id="yang_dibayarken" class="form-control" name="yangdibayar">
		        	</div>
		        </div>
		        <div class="col-lg-6">
		        	<div class="form-group">
		        		<label>Kembali (Rp.) :</label>
		        		<input type="text" id="kembalian" class="form-control">
		        	</div>
		        </div>
		        <div class="col-lg-12">
		        	<div class="form-group">
		        		<label>Sistem Pembayaran :</label>
			            <select name="sistem" class="form-control">
			              <?php  
			                foreach ($sistem as $qwr): ?>
			              <option value="<?= $qwr ?>"><?= $qwr ?></option>
			              <?php endforeach ?>
			            </select>
		        	</div>
		        </div>
		        <div class="col-lg-12">
		           <div class="form-group">
		           	<label>No. Invoice :</label>
		           	<input type="text" class="form-control" name="no_invoice" placeholder="Contoh : 145/EXP/VI/2018" value="<?= $invoice_sam ?>" readonly>
		           </div>
		        </div>
		        <div class="col-lg-6">
		           <div class="form-group">
		           	<label>Tanggal Pengiriman (Departure Date) :</label>
		           	<input type="text" class="form-control" name="tanggal_pengiriman" id="tanggal_departure" value="<?= date('Y-m-d') ?>" placeholder="yy-mm-dd">
		           </div>
		        </div>
		        <div class="col-lg-6">
		           <div class="form-group">
		           	<label>Pelabuhan (Vessel) :</label>
		           	<input type="text" name="pelabuhan" class="form-control" placeholder="Pelabuhan (Vessel)">
		           </div>
		        </div>
		        <div class="col-lg-6">
		           <div class="form-group">
		           	<label>Port of Loading (Pelabuhan Pemuatan) :</label>
		           	<input type="text" name="port_loading" class="form-control" placeholder="Port of Loading (Pelabuhan Pemuatan)">
		           </div>
		        </div>
		        <div class="col-lg-6">
		           <div class="form-group">
		           	<label>Port of Destination (Pelabuhan Tujuan) :</label>
		           	<input type="text" name="port_destination" class="form-control" placeholder="Port of Destination (Pelabuhan Tujuan)">
		           </div>
		        </div>
		        <div class="col-lg-12">
		           <div class="form-group">
		        	 <label>Alamat Kirim :</label>
		        	 <textarea name="alamat_kirim" class="form-control" placeholder="Alamat Barang Kirim"></textarea>
		           </div>
		        </div>
		        <div class="col-lg-12">
		          <div class="form-group">
		            <label>Keterangan : </label>
		            <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
		          </div>
		        </div>
	        </div>
		</div>
		<div class="card-footer">
			<div class="col-lg-12">
				<div class="form-group">
					<button type="submit" class="btn btn-info"><i class="fa fa-save"></i> SAVE</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){
		jQuery('#tanggal_departure').datepicker({format : 'yyyy-mm-dd'});
    	jQuery('#tanggal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#table_ku').DataTable({
			responsive: true,
			"scrollY": "200px",
			"scrollX": true,
        	"scrollCollapse": true,
        	"paging": false,
        	"bInfo" : false
		});
	});
	$('#bagan1234').change(function(event) {
		var bagan = $(this).val();

		$.ajax({
			url: '<?= base_url("Marketing/pilih_user/") ?>'+bagan,
			type: 'POST',
			dataType: 'json',
			success : function (isi) {
				$('#user').html(isi);
			}
		})
	});

  $('#user').change(function(event) {
    var user = $(this).val();

    $.ajax({
      url: '<?= base_url("Home/show_customer/") ?>'+user,
      type: 'POST',
      dataType: 'json',
      success : function (argument) {
        $('#customer').html(argument);
      }
    })
  });

  load_data();
  function load_data() {
	  $.ajax({
		  url: '<?= base_url('Marketing/show_cart') ?>',
		  type: 'POST',
		  dataType: 'json',
		  success : function (data) {
		  	  $('#isi_cart').html(data.table);
			  $('#tot_show').val(accounting.formatMoney(data.tot_blanja));
			  $('#tot_hidd').val(data.tot_blanja);
		  }
	  })
  }

  function hitung(argument) {
  	var tot_hidd = parseInt($('#tot_hidd').val());
  	var diskon = $('#diskon').val();
  	var ongkos = parseInt($('#ongkos').val());

  	if (diskon == 0) {
  		var hasil = tot_hidd;
  	} else {
  		var total_diskon = (tot_hidd * diskon) / 100;
  		var hasil = tot_hidd - total_diskon;
  	}
  	var hitung = hasil + ongkos;
  	$('#tot_all').val(accounting.formatMoney(hitung));
  	$('#tot_all_1').val(parseInt(hitung));
  }

  $('#yang_dibayarken').keyup(function(event) {
  	var bayar = parseInt($(this).val());
  	var harga = parseInt($('#tot_all_1').val());

  	c = bayar - harga;
  	console.log(c);
  	$('#kembalian').val(accounting.formatMoney(c));
  });
</script>