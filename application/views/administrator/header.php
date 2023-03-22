<?php
if (!isset($authPage)) {
    $authPage = FALSE;
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $pageTitle; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/sufee/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/sufee/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/sufee/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pace-style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dropify/css/dropify.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/sufee/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/responsive.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <style>
        #dataTable_filter input {
            margin-left: -17px;
        }
    </style>

</head>

<body<?php if ($authPage) {
            echo " class='bg-light'";
        } ?>>

    <script src="<?= base_url(); ?>assets/jquery.js"></script>
    <script src="<?= base_url(); ?>assets/sufee/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/sufee/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/sufee/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/sufee/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/jqueryvalidate/jquery.validate.js"></script>
    <script src="<?= base_url(); ?>assets/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="<?= base_url(); ?>assets/sufee/vendors/chart.js/dist/Chart.min.js"></script>
    <script src="<?= base_url(); ?>assets/fullcalendar/index.global.min.js"></script>
    <script src="<?= base_url(); ?>assets/dropify/js/dropify.min.js"></script>
    <script src="<?= base_url(); ?>assets/pdfextractor/pdf.js"></script>
    <script src="<?= base_url(); ?>assets/pdfextractor/pdf-table-extractor.js"></script>
    <script src="<?= base_url(); ?>assets/docx2html/docx2html.min.js"></script>
    <script>
        paceOptions = {
            restartOnRequestAfter: 5,
            ajax: {
                trackMethods: ['GET', 'POST', 'PUT', 'DELETE', 'REMOVE']
            }
        }
    </script>
    <script src="<?= base_url(); ?>assets/pace.min.js"></script>

    <?php
    if (!$authPage) {
    ?>

        <!-- Left Panel -->

        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">

                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?= base_url(); ?>"><?= $this->company_info->get_company_name(); ?></a>
                    <a class="navbar-brand hidden" href="<?= base_url(); ?>">B</a>
                </div>

                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php echo ($pageTitle == 'Dashboard') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("dashboard"); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        <h3 class="menu-title">Master Data</h3>
                        <li <?php echo ($pageTitle == 'Agenda') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("agenda"); ?>"> <i class="menu-icon fa fa-calendar"></i>Data Agenda </a>
                        </li>
                        <li <?php echo ($pageTitle == 'Minutes') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("minutes"); ?>"> <i class="menu-icon fa fa-file"></i>Data Notulen </a>
                        </li>
                        <li <?php echo ($pageTitle == 'Invitation') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("invitation"); ?>"> <i class="menu-icon fa fa-envelope"></i>Data Undangan </a>
                        </li>
                        <li <?php echo ($pageTitle == 'Attendant') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("attendant"); ?>"> <i class="menu-icon fa fa-group"></i>Data Hadirin </a>
                        </li>
                        <li <?php echo ($pageTitle == 'Users') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("users"); ?>"> <i class="menu-icon fa fa-user"></i>Data User </a>
                        </li>
                        <h3 class="menu-title">Master Laporan</h3>
                        <li <?php echo ($pageTitle == 'Report') ? "class='active'" : ""; ?>>
                            <a href="<?= base_url("agenda/report"); ?>" target="_blank"> <i class="menu-icon fa fa-file-pdf-o"></i>Laporan Agenda </a>
                        </li>
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
                        <div class="header-left">
                            <div style="height:41px; display:flex; align-items:center;">
                                <h5></h5>
                                <p><?php echo $dataAdmin->role; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($dataAdmin->photo == '') { ?>
                                    <img class="user-avatar rounded-circle" src="<?= base_url("assets/avatar-1.png"); ?>" alt="User Avatar">
                                <?php } else { ?>
                                    <img class="user-avatar rounded-circle" src="<?= base_url('img/' . $dataAdmin->photo); ?>" alt="User Avatar">
                                <?php } ?>
                            </a>

                            <div class="user-menu dropdown-menu">

                                <a class="nav-link" href="<?= base_url("setting/change_password"); ?>"><i class="fa fa-key mr-1"></i>Ganti Password</a>
                                <?php if ($dataAdmin->role == 'admin') { ?>
                                    <a class="nav-link" href="<?= base_url("setting/company_info"); ?>"><i class="fa fa-cog mr-1"></i>Pengaturan</a>
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= base_url("setting/profile"); ?>"><i class="fa fa-user mr-1"></i>Profil</a>
                                <?php } ?>
                                <a class="nav-link" href="<?= base_url("auth/logout"); ?>"><i class="fa fa-power-off mr-1"></i>Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

            </header><!-- /header -->
            <!-- Header-->

        <?php } ?>