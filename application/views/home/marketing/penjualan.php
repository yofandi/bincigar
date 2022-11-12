<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <strong><i class="fa fa-home"></i> / Dashboard / Marketing / Penjualan</strong>
    </div>
  </div>
</div>
<?php 
  $bulan = 
  array('01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', '05' => 'Mei', '06' => 'juni', '07' => 'Juli', '08' => 'Agustus', '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember' );
?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-header bg-success text-light">
			<b><i class="fa fa-book"></i> TRANSAKSI PENJUALAN BULAN INI : <?php echo date('Y').' '.$bulan[date('m')] ?></b>
			<a href="<?= base_url('Marketing/view_tambah_penjualan_1') ?>" class="btn btn-danger btn-sm pull-right"><i class="fa fa-plus-circle"></i> Tambah Penjualan</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover table-bordered table-sm" id="table_ku">
					<thead>
						<tr>
							<th align="center">No.</th>
              <th align="center">ID Transaksi</th>
							<th align="center">User</th>
							<th align="center">Bagan</th>
              <th align="center">Customer</th>
              <th align="center">Total Cerutu (Rp.)</th>
							<th align="center">Diskon (%)</th>
							<th align="center">Sistem</th>
							<th align="center">Ongkos (Rp.)</th>
              <th align="center">Total Semua (Rp)</th>
              <th align="center">Yang Dibayar (Rp)</th>
							<th align="center">Tanggal</th>
							<th align="center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  
						$no = 1;
            $total = 0;
						$ongkos = 0;
            $pay = 0;
						foreach ($penjualan->result() as $key):
							$ongkos += $key->ongkos;
              $total += $key->total;
              $pay += $key->pay;
						?>
						<tr>
							<th><?= $no ?></th>
              <td align="center"><?= $key->id_bagan ?></td>
							<td><?= $key->username ?></td>
							<td><?= $key->bagan ?></td>
              <td align="center"><?= $key->nama_customer ?></td>
              <td align="right"><?= number_format($key->hr_all,0,',','.') ?></td>
							<td align="center"><?= $key->diskon ?></td>
							<td align="center"><?= $key->sistem ?></td>
							<td align="right"><?= number_format($key->ongkos,0,',','.') ?></td>
              <td align="right"><?= number_format($key->total,0,',','.') ?></td>
              <td align="right"><?= number_format($key->pay,0,',','.') ?></td>
							<td><?= $key->tanggal ?></td>
							<td>
                <a href="<?= base_url('Marketing/print_invoice/'.$key->id_bagan) ?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
                <a href="#" title="edit" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal<?= $key->id_bagan ?>"><i class="fa fa-pencil-square-o"></i></a>
                <a href="<?= base_url('Marketing/delete_penjualan1/'.$key->id_bagan) ?>" title="hapus" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>

                <div id="myModal<?= $key->id_bagan ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <label><i class="fa fa-pencil-square-o"></i> Edit Penjualan</label>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <form action="<?= base_url('Marketing/update_penjualan1/'.$key->id_bagan) ?>" method="post">
                      <div class="modal-body">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>Harga Cerutu Keseluruhan :</label>
                            <input type="text" class="form-control" value="<?= number_format($key->hr_all,0,',','.') ?>" readonly>
                            <input type="number" class="hidd" name="id_hrall_modal" id="id_hrall_modal<?= $key->id_bagan ?>" value="<?= $key->hr_all ?>">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label>Diskon (%) :</label>
                            <input type="number" class="form-control" name="dis_modal" id="dis_modal<?= $key->id_bagan ?>" value="<?= $key->diskon ?>">
                          </div>
                        </div>
                        <div class="col-lg-3">
                          <div class="form-group">
                            <label>Ongkos Kirim :</label>
                            <input type="number" class="form-control" name="ong_modal" id="ong_modal<?= $key->id_bagan ?>" value="<?= $key->ongkos ?>">
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="form-group">
                            <label>&nbsp</label><br>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hitung<?= $key->id_bagan ?>()">Hitung</button>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Total :</label>
                            <input type="text" class="form-control" id="tot_modal<?= $key->id_bagan ?>" value="">
                            <input type="number" class="hidd" name="tot_modal" id="tot_modal_hidd<?= $key->id_bagan ?>" value="<?= $key->total ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Yang Dibayar :</label>
                            <input type="number" class="form-control" id="yang_dibayar<?= $key->id_bagan ?>" name="pay_modal" value="<?= $key->pay ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Kembalian :</label>
                            <input type="text" class="form-control" id="kembalian<?= $key->id_bagan ?>">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>Sistem Pembayaran :</label>
                              <select name="sistem" class="form-control">
                                <?php  
                                  foreach ($sistem as $qwr): ?>
                                <option value="<?= $qwr ?>"
                                  <?php if ($qwr == $key->sistem): ?>
                                    selected="selected"
                                  <?php endif ?>
                                  ><?= $qwr ?></option>
                                <?php endforeach ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                            <label>No. Invoice :</label>
                            <input type="text" class="form-control" name="no_invoice" placeholder="Contoh : 145/EXP/VI/2018" value="<?= $key->no_invoice ?>">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                            <label>Tanggal Pengiriman (Departure Date) :</label>
                            <input type="text" class="form-control" name="tanggal_departure" id="tanggal_departure<?= $key->id_bagan ?>" value="<?= $key->departure_date ?>">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                            <label>Pelabuhan (Vessel) : <br> &nbsp</label>
                            <input type="text" name="pelabuhan" class="form-control" placeholder="Pelabuhan (Vessel)" value="<?= $key->vessel ?>">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                            <label>Port of Loading (Pelabuhan Pemuatan) :</label>
                            <input type="text" name="port_loading" class="form-control" placeholder="Port of Loading (Pelabuhan Pemuatan)" value="<?= $key->port_of_loading ?>">
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="form-group">
                            <label>Port of Destination (Pelabuhan Tujuan) :</label>
                            <input type="text" name="port_destination" class="form-control" placeholder="Port of Destination (Pelabuhan Tujuan)" value="<?= $key->port_of_destination ?>">
                           </div>
                        </div>
                        <div class="col-lg-12">
                           <div class="form-group">
                           <label>Alamat Kirim :</label>
                           <textarea name="alamat_kirim" class="form-control" placeholder="Alamat Barang Kirim"><?= $key->lokasi_kirim ?></textarea>
                           </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label>Keterangan : </label>
                            <textarea name="keterangan" class="form-control"><?= $key->keterangan ?></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-danger" type="submit">Save</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <script src="<?php echo base_url('assets/') ?>plugin/datepicker/js/bootstrap-datepicker.min.js"></script>
                <script>
                  function hitung<?= $key->id_bagan ?>(argument) {
                    var id_hrall_modal = parseInt($('#id_hrall_modal<?= $key->id_bagan ?>').val());
                    var dis_modal = parseInt($('#dis_modal<?= $key->id_bagan ?>').val());
                    var ong_modal = parseInt($('#ong_modal<?= $key->id_bagan ?>').val());

                    var hasil_diskon = (id_hrall_modal * dis_modal) / 100;
                    var jml_dis = id_hrall_modal - hasil_diskon;
                    var tot_mod = jml_dis + ong_modal;
                    $('#tot_modal<?= $key->id_bagan ?>').val(accounting.formatMoney(tot_mod));
                    $('#tot_modal_hidd<?= $key->id_bagan ?>').val(tot_mod);
                  }
                  $('#tanggal_departure<?= $key->id_bagan ?>').datepicker({format : 'yyyy-mm-dd'});
                  $('#yang_dibayar<?= $key->id_bagan ?>').keyup(function(event) {
                    var bayar = parseInt($(this).val());
                    var total_harga = parseInt($('#tot_modal_hidd<?= $key->id_bagan ?>').val());

                    var kembalian = bayar - total_harga;
                    $('#kembalian<?= $key->id_bagan ?>').val(accounting.formatMoney(kembalian));
                  });
                </script>
              </td>
						</tr>
						<?php $no++; endforeach ?>
					</tbody>
					<tfoot class="bg-danger text-light">
						<tr>
							<td colspan="5"></td>
							<!-- <td align="center"><?= $terjual ?></td> -->
							<td></td>
							<td></td>
							<!-- <td align="right"><?= number_format($total,0,',','.') ?></td> -->
							<td></td>
							<td align="right"><?= number_format($ongkos,2,',','.') ?></td>
							<td align="right"><?= number_format($total,0,',','.') ?></td>
              <td align="right"><?= number_format($pay,0,',','.') ?></td>
              <td colspan="2"></td>
						</tr>
					</tfoot>
				</table>
			</div>
      		<div class="col-lg-12" id="show" align="center">
        		<div class="col-md-12 col-md-offset-12" align="right">
          		Jember, <?php echo date('d').' '.$bulan[date('m')].' '.date('Y'); ?>
        		</div><br><br>
        		<div class="col-md-3">
         		Direktur Operasional<br><br><br>
        		(<u><?php echo $setting->direktur; ?></u>)
        		</div>
        		<div class="col-md-3"></div>
        		<div class="col-md-3"></div>
        		<div class="col-md-3">
          		Quality Control<br><br><br>
          		(<u><?php echo $setting->qc; ?></u>)
        		</div>
      		</div>
		</div>
		<div class="card-footer">
			<button type="button" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
		</div>
	</div>
</div>
<script>
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

	$('#produk').change(function(event) {
		var id_produk = $(this).val();
		$.ajax({
			url: '<?= base_url("Marketing/c_p/") ?>'+id_produk,
			type: 'POST',
			dataType: 'json',
			success : function (data) {
				$('#sub_produk').html(data);
			}
		})
	});

	$('#sub_produk').change(function(event) {
		var sub_p = $(this).val();
		var user = $('#user').val();
		$.ajax({
			url: '<?= base_url("Marketing/search_hje/") ?>'+sub_p+'/'+user,
			type: 'POST',
			dataType: 'json',
			success : function (arg) {
				$('#hje1').val(arg.hje);
				$('#hje').val(accounting.formatMoney(arg.hje));
				$('#stock_ini').val(arg.stok);
							// console.log(arg);
			}
		})
	});

	function hitung(argument) {
		var hje1 = parseInt($('#hje1').val());
		var terjual = $('#terjual').val();
		var diskon = $('#diskon').val();

		var jumlah = terjual * hje1;
		var diskon1 = (jumlah * diskon) / 100;

		var total = jumlah - diskon1;

		$('#total').val(total);
		$('#total1').val(total);
	}

	$(document).ready(function(){
    	jQuery('#tanggal').datepicker({format : 'yyyy-mm-dd'});
		jQuery('#table_ku').DataTable({
			responsive: true
		});
	});
</script>