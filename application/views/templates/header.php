
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title ?></title>
        <link rel="icon" href="<?= base_url()?>assets/image/logo.png" />
        <link href="<?= base_url() ?>assets/DataTables/DataTables-1.12.1/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= base_url()?>assets/DataTables/datatables.min.css" rel="stylesheet" />
        <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' crossorigin='anonymous'>        <script src="<?php echo base_url()?>assets/bootstrap-5/js/bootstrap.min.js"></script>
        <script src="<?= base_url()?>assets/dist/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url()?>assets/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url()?>assets/DataTables/datatables.min.js"></script>
        <script src="<?php echo base_url()?>assets/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="sb-nav-fixed">

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">SIAKAD</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('dashboard/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        