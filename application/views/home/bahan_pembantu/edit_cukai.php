<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Edit Cukai / <?php echo $data['id']; ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
      <div class="card">
      	<div class="card-header bg-info text-light">
      		<b><i class="fa fa-edit"></i> Edit Bahan Cincin</b>
      	</div>
      	<div class="card-body">
                  
        <form method="post" action="<?php echo base_url('Bahan_pembantu/uodate_cukai/'.$data['id']) ?>">
        <div class="col-lg-12">
          <?php $get_id = $this->db->select('id')->where('sub_produk',$data['subproduk'])->get('sub_produk')->row_array(); ?>
          <input type="hidden" name="id_subproduk" value="<?= $get_id['id'] ?>">
              <label><b><?php echo 'Produk : '.$data['subproduk'].' | Kode : '.$data['sub_kode']; ?></b></label>
        </div>
        <div class="col-lg-12">
          <div class="col-lg-6">
            <div class="form-group">
              <label>Cukai Lama : </label>
              <input type="number" name="lama" class="form-control" value="<?php echo $data['lama'] ?>" readonly>
            </div>
            <div class="form-group">
              <label>Cukai Baru : </label>
              <input type="number" name="baru" class="form-control" value="<?php echo $data['baru'] ?>">
              <input type="hidden" name="baru_hd" value="<?php echo $data['baru'] ?>">
            </div>
            <!-- <div class="form-group">
              <label>Stock Akhir : </label>
              <input type="number" name="akhir" class="form-control" value="<?php echo $data['akhir'] ?>">
            </div> -->
          </div>
          <div class="col-lg-6">
            <!-- <div class="form-group">
              <label>Masuk : </label>
              <input type="number" name="masuk" class="form-control" value="<?php echo $data['masuk'] ?>">
            </div> -->
            <div class="form-group">
              <label>Terpakai Semua : </label>
              <input type="number" name="semua" class="form-control" value="<?php echo $data['semua'] ?>">
              <input type="hidden" name="semua_hd" value="<?php echo $data['semua'] ?>">
            </div>
            <div class="form-group">
              <label>Terpakai Masing2 : </label>
              <input type="number" name="masing" class="form-control" value="<?php echo $data['masing'] ?>">
              <input type="hidden" name="masing_hd" value="<?php echo $data['masing'] ?>">
            </div>
          </div>
        </div>
      
            </div>	
            <div class="card-footer">
                  <button type="submit" class="pull-right btn btn-danger">Update</button>
                  </form>
            </div>	
      </div>
</div>
