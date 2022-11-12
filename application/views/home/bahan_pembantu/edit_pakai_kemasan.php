<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<strong><i class="fa fa-home"></i> / Dashboard / Bahan Baku / Edit Cukai / <?php echo $datas['id']; ?></strong>
		</div>
	</div>
</div>

<div class="col-lg-12">
      <div class="card">
      	<div class="card-header bg-info text-light">
      		<b><i class="fa fa-edit"></i> Edit Bahan Cincin</b>
      	</div>
      	<div class="card-body">
         
        <form method="post" action="<?php echo base_url('Bahan_pembantu/update_pakai_kemasan/'.$datas['id']) ?>">
        <?php $swal = $this->db->where(array('produk' => $datas['produk'], 'nama_kemasan' => $datas['kemasan']))->get('stock_kemasan')->row_array(); ?>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Produk : </label>
              <input type="hidden" name="stockawl" value="<?= $swal['stock'] ?>">
             <!--  <select name="produk" class="form-control">
                <?php $data = $this->db->order_by('id', 'ASC')->get('produk')->result_array(); ?>
                <?php foreach ($data as $key): ?>
                  <option value="<?php echo $key['produk'] ?>"><?php echo $key['produk'] ?></option>
                <?php endforeach ?>
              </select> -->
              <input type="text" disabled="" class="form-control" value="<?php echo $datas['produk'] ?>">
              <input type="hidden" name="produk" value="<?php echo $datas['produk'] ?>">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
              <label>Kemasan : </label>
              <!-- <select name="kemasan" class="form-control">
                <?php $data = $this->db->order_by('id', 'ASC')->get('kemasan')->result_array(); ?>
                <?php foreach ($data as $key): ?>
                  <option value="<?php echo $key['nama'] ?>" <?php if ($datas['kemasan'] == $key['nama']): ?>
                    selected
                  <?php endif ?>><?php echo $key['nama'] ?></option>
                <?php endforeach ?>
              </select> -->
              <input type="text" class="form-control" name="kemasan" value="<?php echo $datas['kemasan'] ?>" readonly>
            </div>
          </div>

        
        <div class="col-lg-6">
          <div class="form-group">
            <label>Stock Awal : </label>
            <input type="hidden" value="<?php echo $datas['awal'] ?>">
            <input type="number" name="awal" class="form-control" value="<?php echo $datas['awal'] ?>" readonly>
          </div>
          <div class="form-group">
            <label>Masuk : </label>
            <input type="number" name="masuk" class="form-control" value="<?php echo $datas['masuk'] ?>">
            <input type="hidden" name="masuk_sb" value="<?php echo $datas['masuk'] ?>">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label>Terpakai : </label>
            <input type="number" name="terpakai" class="form-control" value="<?php echo $datas['terpakai'] ?>">
            <input type="hidden" name="terpakai_sb" value="<?php echo $datas['terpakai'] ?>">
          </div>
          <div class="form-group">
            <label>Afkir : </label>
            <input type="number" name="afkir" class="form-control" value="<?php echo $datas['afkir'] ?>">
            <input type="hidden" name="afkir_sb" value="<?php echo $datas['afkir'] ?>">
          </div>
        </div>
       
        </div>	
            <div class="card-footer">
                  <button type="submit" class="pull-right btn btn-danger">Update</button>
                  </form>
            </div>	
      </div>
</div>
