<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bin Cigar - Login Application</title>
    <meta name="description" content="Bin Cigar - Login Application">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body class="bg-dark">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="<?php echo base_url('assets/') ?>images/BIN.png" alt="" width="auto" height="150">
                    </a>
                </div>
                <div class="login-form">
                    <form method="post" action="<?php echo base_url('Index/login') ?>">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="text" class="form-control" name="email" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo base_url('assets/') ?>assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url('assets/') ?>assets/js/main.js"></script>


</body>
</html>
