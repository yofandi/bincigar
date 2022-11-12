<div class="row">
    <div class="col-lg-12">
    	<div class="card">
    		<div class="card-body">
    			<strong><i class="fa fa-home"></i> / Dashboard / <?php date_default_timezone_set('Asia/Jakarta'); echo date("Y-m-d H:i A"); ?></strong><div class="pull-right">Selamat Datang <b><?php echo $_SESSION['username'] ?> !</b></div>
    		</div>
    	</div>
    </div>
    <?php if ($this->session->userdata('level') == 'Super Admin' || $this->session->userdata('level') == 'Bahan Baku' || $this->session->userdata('level') == 'Proses Produksi' || $this->session->userdata('level') == 'Quality Control'): ?>
    <?php 
        $dekblad = $this->db->select('SUM(hs_sblm) as hs_sblm')->get_where('data_stock_tmp', array('kategori_tmp' => 'DEKBLAD'))->row_array();
         $omblad = $this->db->select('SUM(hs_sblm) as hs_sblm')->get_where('data_stock_tmp', array('kategori_tmp' => 'OMBLAD'))->row_array();
         $filter_1 = $this->db->select('SUM(hs_sblm) as hs_sblm')->get_where('data_stock_tmp', array('kategori_tmp' => 'FILLER 1'))->row();
         $filter_2 = $this->db->select('SUM(hs_sblm) as hs_sblm')->get_where('data_stock_tmp', array('kategori_tmp' => 'FILLER 2'))->row();
    ?>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-archive bg-flat-color-5 p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-secondary mb-0 mt-1"><?php echo $dekblad['hs_sblm'] ?> .Kg</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small"> Dekblad</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="<?php echo base_url('Bahanbaku/index') ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-archive bg-info p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-secondary mb-0 mt-1"><?php echo $omblad['hs_sblm'] ?> .Kg</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">OMBLAD</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="<?php echo base_url('Bahanbaku/index') ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <i class="fa fa-bell bg-danger p-3 font-2xl mr-3 float-left text-light"></i>
                    <div class="h5 text-secondary mb-0 mt-1"><?php $filler = $filter_1->hs_sblm + $filter_2->hs_sblm; echo $filler; ?> .Kg</div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs small">FILTER</div>
                </div>
                <div class="b-b-1 pt-3"></div>
                <hr>
                <div class="more-info pt-2" style="margin-bottom:-10px;">
                    <a class="font-weight-bold font-xs btn-block text-muted small" href="<?php echo base_url('Bahanbaku/index') ?>">View More <i class="fa fa-angle-right float-right font-lg"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if ($this->session->userdata('level') == 'Super Admin' || $this->session->userdata('level') == 'RFS'): ?>
    <div class="col-lg-12">
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-1">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->where('tanggal',date('Y-m-d'))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transaksi Hari Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-4">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->like('tanggal',date('Y-m'))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transaksi Bulan Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-3">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->like('tanggal',date('Y'))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transkasi Tahun Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->session->userdata('level') == 'Super Admin'): ?>

    <?php endif ?>
    <?php if ($this->session->userdata('level') == 'Super Admin' || $this->session->userdata('level') == 'Bahan Baku'): ?>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-white bg-flat-color-1">
                <h4 class="mb-0">
                    <span class="">CINCIN</span>
                </h4>
                <p class="text-light">Stock Cincin</p>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table" id="table_ku">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>JML</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cincin->result() as $hcincin): ?>
                            <tr>
                                <td><?= $hcincin->produk ?></td>
                                <td><?= $hcincin->stock ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-white bg-flat-color-2">
                <h4 class="mb-0">
                    <span class="">Cukai</span>
                </h4>
                <p class="text-light">Stock Cukai</p>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table" id="table_ku_2">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Sub Produk</th>
                                <th>JML</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cukai->result() as $hcukai): ?>
                            <tr>
                                <td><?= $hcukai->produk ?></td>
                                <td><?= $hcukai->sub_kode.'||'.$hcukai->sub_produk ?></td>
                                <td><?= $hcukai->stock ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-white bg-flat-color-3">
                <h4 class="mb-0">
                    <span class="">Stiker</span>
                </h4>
                <p class="text-light">Stock Stiker</p>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table" id="table_ku_3">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Luar</th>
                                <th>Dalam</th>
                                <th>JML</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($stiker->result() as $hstiker): 
                                $jml_sam = $hstiker->stock_luar + $hstiker->stock_dalam;
                            ?>
                            <tr>
                                <td><?= $hstiker->produk ?></td>
                                <td><?= $hstiker->stock_luar ?></td>
                                <td><?= $hstiker->stock_dalam ?></td>
                                <td><?= $jml_sam ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header text-white bg-flat-color-4">
                <h4 class="mb-0">
                    <span class="">Kemasan</span>
                </h4>
                <p class="text-light">Stock Kemasan</p>
            </div>
            <div class="card-body pb-0">
                <div class="table-responsive">
                    <table class="table" id="table_ku_4">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kemasan</th>
                                <th>JML</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kemasan->result() as $hkemasan): ?>
                            <tr>
                                <td><?= $hkemasan->produk ?></td>
                                <td><?= $hkemasan->nama_kemasan ?></td>
                                <td><?= $hkemasan->stock ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if ($this->session->userdata('level') == 'Super Admin' || $this->session->userdata('level') == 'Proses Produksi'): ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-white bg-flat-color-4">
                <h4 class="mb-0">
                    <span class="">Packing</span>
                </h4>
                <p class="text-light">Stock Packing</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="table_ku_pro">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Produk</th>
                                <th>Sub Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($packing->result() as $packing): ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td align="center"><?= $packing->produk ?></td>
                                <td align="center"><?= $packing->sub_kode.'||'.$packing->sub_produk ?></td>
                                <td align="right"><?= $packing->stock ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if ($this->session->userdata('level') == 'Super Admin' || $this->session->userdata('level') == 'RFS'): ?>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-white bg-danger">
                <h4 class="mb-0">
                    <span class="">RFS</span>
                </h4>
                <p class="text-light">Stock RFS</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="table_ku_rfs">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Produk</th>
                                <th>Sub Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($ready_for_sale->result() as $rfs): ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td align="center"><?= $rfs->produk ?></td>
                                <td align="center"><?= $rfs->sub_kode.'||'.$rfs->sub_produk ?></td>
                                <td align="right"><?= $rfs->stock_keluar ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>

    <?php if ($this->session->userdata('level') == 'Super Admin'): ?>
    <?php elseif ($this->session->userdata('level') == 'Quality Control'): ?>
    <?php elseif ($this->session->userdata('level') == 'STORE' || $this->session->userdata('level') == 'AGENT' || $this->session->userdata('level') == 'PHRI' || $this->session->userdata('level') == 'EXPORT'): ?>
    <div class="col-lg-12">
        <?php $id_penj = $this->db->select('username')->where(array('id' => $this->session->userdata('id')))->get('users')->row(); ?>
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-1">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->where(array('tanggal' => date('Y-m-d'),'author' => $id_penj->username))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transaksi Hari Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-4">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->where(array('author' => $id_penj->username))->like('tanggal',date('Y-m'))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transaksi Bulan Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
        <div class="card col-lg-4 col-md-6 no-padding bg-flat-color-3">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4">
                    <i class="fa fa-dollar text-light"></i>
                </div>

                <div class="h4 mb-0 text-light">
                    <span class="count"><?php echo 'Rp.'.number_format($this->db->where(array('author' => $id_penj->username))->like('tanggal',date('Y'))->select('SUM(total) as total')->get('penjualan_cerutu')->row()->total,2,',','.') ?></span>
                </div>
                <small class="text-uppercase font-weight-bold text-light">Transkasi Tahun Ini</small>
                <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-white bg-danger">
                <h4 class="mb-0">
                    <span class="">Bagan <?= $this->session->userdata('level').' - '.$this->session->userdata('username') ?></span>
                </h4>
                <p class="text-light">Stock Bagan <?= $this->session->userdata('level').' - '.$this->session->userdata('username') ?></p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm" id="table_ku_rfs">
                        <thead>
                            <tr align="center">
                                <th>#</th>
                                <th>Produk</th>
                                <th>Sub Produk</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $this->db->select('produk.produk,sub_produk.sub_produk,sub_produk.sub_kode,stock_bagan.stock_barang');
                            $this->db->from('stock_bagan');
                            $this->db->join('users', 'stock_bagan.id_users = users.id', 'inner');
                            $this->db->join('sub_produk', 'stock_bagan.id_subproduk = sub_produk.id', 'inner');
                            $this->db->join('produk', 'sub_produk.id_produk = produk.id', 'inner');
                            $this->db->where('stock_bagan.id_users', $this->session->userdata('id'));
                            $penjual_perbagan = $this->db->get();
                            $no = 1; foreach ($penjual_perbagan->result() as $rfs): ?>
                            <tr>
                                <td align="center"><?= $no++ ?></td>
                                <td align="center"><?= $rfs->produk ?></td>
                                <td align="center"><?= $rfs->sub_kode.'||'.$rfs->sub_produk ?></td>
                                <td align="right"><?= $rfs->stock_barang ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>
<script>
    $(document).ready(function(){
        jQuery('#table_ku').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
        jQuery('#table_ku_2').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
        jQuery('#table_ku_3').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
        jQuery('#table_ku_4').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
        jQuery('#table_ku_pro').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
        jQuery('#table_ku_rfs').DataTable({'bInfo' : false,
            "lengthMenu": [[3,5,10, 25, 50, -1], [3,5,10, 25, 50, "All"]]});
    });
</script>
