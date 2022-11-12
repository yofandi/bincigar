<?php 

  if (empty($_SESSION['email']) && empty($_SESSION['password'])) {

    redirect('index');

  }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <?php $datas = $this->db->get_where('users', array('id' => $_SESSION['id']))->row_array(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bin Cigar - Dashboard</title>
    <meta name="description" content="Bin Cigar - Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url('assets/'); ?>images/BIN.png">

    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/print.css"  media="print">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/screen.css"  media="screen">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugin/autocomplete') ?>/jquery.autocompleter.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugin/datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url()?>assest/assets/plug/datatables/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">
    <link href="<?php echo base_url('assets/') ?>assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="<?php echo base_url('assets/') ?>assets/js/vendor/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/assets/css/lib/datatable/dataTables.bootstrap.min.css') ?>">
    <link href="<?= base_url() ?>assets/plug/froala-editor/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plug/froala-editor/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/plug/bootstrap-multiselect/bootstrap-multiselect.css" type="text/css">
</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href=""><img src="<?php echo base_url('assets/') ?>images/BIN.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="<?php echo base_url('assets/') ?>images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    
                    <h3 class="menu-title">UTAMA</h3><!-- /.menu-title -->
                    <li class="active">
                        <a href="<?php echo base_url('Home') ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    

                    <?php 
                if ($_SESSION['level'] == 'Super Admin') {
                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Bahan Baku</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/index') ?>">Data Tembakau</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/cincin') ?>">Data Cincin</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/cukai') ?>">Data Cukai</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/kemasan') ?>">Data Kemasan</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/striker') ?>">Data Stiker</a></li>
                            
                        </ul>
                    </li>
                    <?php
                }elseif($_SESSION['level'] == 'Bahan Baku'){
                    ?>
                   <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-archive"></i>Bahan Baku</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/index') ?>">Data Tembakau</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/cincin') ?>">Data Cincin</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/cukai') ?>">Data Cukai</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/kemasan') ?>">Data Kemasan</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahan_pembantu/striker') ?>">Data Stiker</a></li>
                            
                        </ul>
                    </li>
                    <?php
                }else{ echo ""; }
                    ?>
                    

                    <?php 
                if ($_SESSION['level'] == 'Super Admin') {
                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>Proses Produksi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/filling') ?>">Filling</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/binding') ?>">Binding</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/pressing') ?>">Pressing</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/wrapping') ?>">Wrapping</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying') ?>">Drying</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/frezer') ?>">Frezer</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying2') ?>">Drying 2</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/fumigasi') ?>">Fumigasi</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/cool') ?>">Cool Storage</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying3') ?>">Drying 3</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/qc') ?>"> QC</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Marketing/rfs') ?>"> Packing</a>
                        </ul>
                        
                    </li>
                    <?php
                }elseif($_SESSION['level'] == 'Proses Produksi'){
                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-gears"></i>Proses Produksi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/filling') ?>">Filling</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/binding') ?>">Binding</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/pressing') ?>">Pressing</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/wrapping') ?>">Wrapping</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying') ?>">Drying</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/fumigasi') ?>">Fumigasi</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/frezer') ?>">Frezer</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying2') ?>">Drying 2</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/cool') ?>">Cool Storage</a></li>
                            <li><i class="fa fa-gear"></i><a href="<?php echo base_url('Proses_produksi/drying3') ?>">Drying 3</a></li>
                            <li><i class="ti-package"></i><a href="<?php echo base_url('Marketing/rfs') ?>"> Packing</a>
                        </ul>
                        
                    </li>

                    <?php
                }else{ echo ""; }
                    if ($_SESSION['level'] == 'Quality Control') { ?>
                    <li>
                        <a href="<?php echo base_url('Proses_produksi/qc') ?>"><i class="menu-icon fa fa-check-square-o"></i> QC</a>
                    </li>
                <?php } else { echo ""; } 
                if ($_SESSION['level'] == 'Super Admin') {
                    ?>
                    <li>
                        <a href="<?php echo base_url('Marketing/transaksi') ?>"><i class="menu-icon fa fa-credit-card"></i> Ready For Sale</a>
                    </li>
                    <?php
                }elseif($_SESSION['level'] == 'RFS'){
                    ?>
                    <li>
                        <a href="<?php echo base_url('Marketing/transaksi') ?>"> <i class="menu-icon fa fa-credit-card"></i> Ready For Sale</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Marketing/return_rfs') ?>"> <i class="menu-icon fa fa-share"></i> Return RFS</a>
                    </li>
                    <?php
                }else{ echo ""; }
                    ?>
                    <!-- order -->
                    <?php 
                if ($_SESSION['level'] == 'Super Admin') {
                    ?>
                    <li>
                        <a href="<?= base_url('Marketing/penjualan_1') ?>"> <i class="menu-icon fa fa-calculator"></i> Penjualan</a>
                    </li>
                    
                    <li>
                        <a href="<?= base_url('Marketing/piutang')?>"> <i class="menu-icon fa fa-credit-card-alt"></i> Piutang</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Marketing/order') ?>"> <i class="menu-icon fa fa-plus-circle"></i> Order </a>
                    </li>
                    <?php
                }

                if($_SESSION['level'] == 'AGENT' || $_SESSION['level'] == 'STORE' || $_SESSION['level'] == 'PHRI' || $_SESSION['level'] == 'NON PHRI' || $_SESSION['level'] == 'EXPORT'){
                    ?>
                    <li>
                        <a href="<?= base_url('Marketing/penjualan_1') ?>"> <i class="menu-icon fa fa-calculator"></i> Penjualan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('Marketing/return_bagan') ?>"> <i class="menu-icon fa fa-share"></i> Return Bagan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('Marketing/piutang')?>"> <i class="menu-icon fa fa-credit-card-alt"></i> Piutang</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Marketing/order') ?>"> <i class="menu-icon fa fa-plus-circle"></i> Order </a>
                    </li>
                    <?php
                }else{
                    echo "";
                }

                    ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Laporan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/laporan') ?>">Laporan Harian</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/laporan_stockbahan')?>">Laporan Tembakau</a></li>
                             <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/laporan_produksi') ?>">Laporan Produksi</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Marketing/hasil_laporan') ?>">Laporan Penjualan</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/rekapitulasi') ?>">Laporan Rekapitulasi</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/stock_cerutu') ?>">Laporan Stock</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/daftar_tagihan') ?>">Laporan Tagihan</a></li>
                            <li><i class="menu-icon ti-clipboard"></i><a href="<?= base_url('Home/rincian') ?>">Laporan Rincian</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">REFERENSI</h3><!-- /.menu-title -->

                    

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Profile</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-edit"></i><a href="<?php echo base_url('Home/edit_profile') ?>">Edit Profile</a></li>
                            <li><i class="menu-icon fa fa-upload"></i><a href="<?php echo base_url('Home/upload_foto') ?>">Upload Foto</a></li>
                            <li><i class="menu-icon fa fa-sign-in"></i><a href="<?php echo base_url('Home/edit_password') ?>">Edit Password</a></li>
                        </ul>
                    </li>

                    <?php 
                if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS') {
                    ?>
                    <?php if ($_SESSION['level'] == 'Super Admin'): ?>
                    <li class="menu-item-has-children dropdown">
                            
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-puzzle-piece"></i>Referensi</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-plus-circle"></i><a href="<?= base_url('Home/customer') ?>">Customer</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/jenis') ?>">Jenis Tembakau</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/kategori') ?>">Kategori</a></li>
                            <li><i class="fa fa-plus-circle"></i><a href="<?php echo base_url('Marketing/bagan_store') ?>">Bagan Produksi</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/stock_cincin') ?>">Cincin</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/stock_cukai') ?>">Cukai</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/stock_stiker') ?>">Stiker</a></li>
                            <li><i class="fa fa-puzzle-piece"></i><a href="<?php echo base_url('Bahanbaku/stock_kemasan') ?>">Kemasan</a></li>
                        </ul>
                    </li>
                    <?php endif ?>
                    <?php if ($_SESSION['level'] == 'Super Admin' || $_SESSION['level'] == 'RFS'): ?>
                    <li>
                        <a href="<?php echo base_url('Home/tambah_user') ?>"> <i class="menu-icon fa fa-users"></i> Management User </a>
                    </li>
                    <?php endif ?>
                    <?php if ($_SESSION['level'] == 'Super Admin'): ?>
                    <li>
                        <a href="<?php echo base_url('Merek') ?>"> <i class="menu-icon fa fa-plus-circle"></i> Produk </a>
                    </li>
                    <?php endif ?>
                    <?php if ($_SESSION['level'] == 'Super Admin'): ?>
                    <li>
                        <a href="<?php echo base_url('Home/option') ?>"> <i class="menu-icon fa fa-gear"></i> Options </a>
                    </li>
                    <?php endif ?>
                    <?php
                } elseif ($_SESSION['level'] == 'AGENT' || $_SESSION['level'] == 'STORE' || $_SESSION['level'] == 'PHRI' || $_SESSION['level'] == 'NON PHRI' || $_SESSION['level'] == 'EXPORT') {?>
                    <li>
                        <a href="<?= base_url('Home/customer') ?>"><i class="menu-icon fa fa-plus-circle"></i> Customer</a>
                    </li>
                <?php } ?>

                    
                    
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <!-- PESAN -->
                        <?php 
                        // ambil data dan num rows
                    $pesan = $this->db->get_where('pesan', array('status' => 0));
                    if ($_SESSION['level'] == 'Super Admin') {
                        ?>

                    <?php
                    }elseif($_SESSION['level'] == 'Proses Produksi'){
                        ?>
                        <div class="dropdown for-message">
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-email"></i>
                            <span class="count bg-primary"><?php echo $pesan->num_rows(); ?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">Anda Memiliki <?php echo $pesan->num_rows(); ?> Pesan</p>
                            <?php foreach ($pesan->result_array() as $keys): ?>
                                <?php $profile = $this->db->get_where('users', array('username' => $keys['author']))->row_array(); ?>
                                <a class="dropdown-item media bg-info-color-1" href="<?php echo base_url('Home/notif_accept/'.$keys['id']) ?>">
                                    <span class="photo media-left"><img alt="avatar" src="<?php echo base_url('assets/') ?>images/<?php echo $profile['upload_foto'] ?>"></span>
                                    <span class="message media-body">
                                        <span class="name float-left"><?php echo $profile['username'] ?></span>
                                        <span class="time float-right"><?php echo $keys['tanggal'] ?></span>
                                            <p><?php echo $keys['pesan'] ?></p>
                                    </span>
                                </a>
                            <?php endforeach ?>
                          </div>
                        </div>
                        <?php
                    } elseif ($_SESSION['level'] == 'RFS') {?>

                    <?php $order = $this->db->get_where('order', array('status' => 0)); ?>
                        <div class="dropdown for-message">
                          <button title="Order" class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-mobile"></i>
                            <span class="count bg-primary"><?php echo $order->num_rows(); ?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red"><?php echo $order->num_rows(); ?> Pesan</p>
                            <?php foreach ($order->result_array() as $keys): ?>
                                <?php $profile = $this->db->get_where('users', array('username' => $keys['author']))->row_array(); ?>
                                <a class="dropdown-item media bg-info-color-1" href="<?php echo base_url('Marketing/notif_accept_order/'.$keys['id']) ?>">
                                    <span class="photo media-left"><img alt="avatar" src="<?php echo base_url('assets/') ?>images/<?php echo $profile['upload_foto'] ?>"></span>
                                    <span class="message media-body">
                                        <span class="name float-left"><?php echo $profile['username'] ?></span>
                                        <span class="time float-right"><?php echo $keys['tanggal'] ?></span>
                                            <p><?php echo $keys['ket'] ?></p>
                                    </span>
                                </a>
                            <?php endforeach ?>
                          </div>
                        </div>

                        <div class="dropdown for-message">
                          <button title="Order" class="btn btn-secondary dropdown-toggle" type="button"
                                id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-harddrive"></i>
                            <span class="count bg-success"><?php  $return_bagan = $this->db->where('status',0)->get('return_bagan'); echo $return_bagan->num_rows();
                            ?></span>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red"> <?= $return_bagan->num_rows() ?> Pesan</p>
                                <?php foreach ($return_bagan->result() as $rtn): 
                                    $show = $this->db->select('upload_foto')->where('username',$rtn->author)->get('users')->row();
                                    ?>
                                <a class="dropdown-item media bg-info-color-1" href="<?= base_url('Marketing/lihat_return_bagan/'.$rtn->id_return_bagan) ?>">
                                    <span class="photo media-left"><img src="<?= base_url('assets/images/'.$show->upload_foto) ?>"></span><!--  alt="avatar" -->
                                    <span class="message media-body">
                                        <span class="name float-left"><?= $rtn->author ?></span>
                                        <span class="time float-right"><?= $rtn->tanggal ?></span>
                                            <p><?= $rtn->keterangan ?></p>
                                    </span>
                                </a>
                                <?php endforeach ?>
                          </div>
                        </div>
                    <?php }
                        ?>
                        
                <?php $laporan=$this->db->get_where('laporan', array('tanggal' => date('Y-m-d')))->num_rows();  ?>
                        <div class="dropdown for-message">
                          <a href="<?php echo base_url('Home/laporan') ?>" class="btn btn-secondary dropdown-toggle" id="message" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger"><?php echo $laporan; ?></span>
                          </a>
                        </div>

                        <?php if ($_SESSION['level'] == 'Proses Produksi') { 
                            $rej = $this->db->select('id_reject')->where('status',0)->get('reject')->num_rows();
                        ?>
                        <div class="dropdown for-message">
                           <a href="<?= base_url('Home/lap_reject') ?>" class="btn btn-secondary dropdown-toggle" id="message" aria-haspopup="true" aria-expanded="false">
                             <i class="fa fa-inbox"></i>
                            <span class="count bg-primary"><?= $rej ?></span>
                          </a>
                        </div>
                        <?php } elseif ($_SESSION['level'] == 'Quality Control') {?>
                        <div class="dropdown for-message">
                           <a href="<?= base_url('Home/return_rfs') ?>" class="btn btn-secondary dropdown-toggle" id="message" aria-haspopup="true" aria-expanded="false">
                             <i class="ti-package"></i>
                            <span class="count bg-primary"><?php $db = $this->db->select('id_rtn')->where('status',0)->get('return_rfs')->num_rows(); echo $db;?></span>
                          </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?php echo base_url('assets/images/'.$datas['upload_foto']) ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="<?php echo base_url('Home/edit_profile') ?>"><i class="fa fa- user"></i>Edit Profile</a>

                                <a class="nav-link" href="<?php echo base_url('Home/upload_foto') ?>"><i class="fa fa- upload"></i>Upload Foto</a>

                                <a class="nav-link" href="<?php echo base_url('Home/edit_password') ?>"><i class="fa fa -logout"></i>Ganti Password</a>

                                <a class="nav-link" href="<?php echo base_url('Index/logout') ?>"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="content mt-3">