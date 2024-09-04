<?php
// SECURITY
include 'layouts/security.php';
// RUN REST
include 'global.php';
?>

<head>

    <title><?php echo $site_title; ?> | <?php echo $page; ?></title>
    
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cooper 1.0 Theme" name="description"/>
    <meta content="Cooper" name="author"/>
    <link rel="icon" href="assets/images/logo-lg.ico">
    <link rel="shortcut icon" href="assets/images/logo-lg.ico">
    
    <?php /* ---- START - HEAD SCRIPTS ---- */ ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script> <?php // STOP FORM REFRESH ?> if ( window.history.replaceState ) { window.history.replaceState( null, null, window.location.href ); } </script>
    <?php /* ---- END - HEAD SCRIPTS ---- */ ?>

    <?php /* ---- START - HEAD LINK ---- */ ?>
        <!-- CORE CSS -->
        <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- CHOICES CSS -->
        <link href="assets/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
        <!-- COLOR PICKER CSS -->
        <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" />
        <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" />
        <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" />
        <!-- CHARTS CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
        <!-- DATEPICKER CSS -->
        <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css">
        <!-- PRELOADER CSS -->
        <link rel="stylesheet" href="assets/css/preloader.min.css" type="text/css" />
        <!-- BOOTSTRAP CSS -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- ICON CSS -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- APP CSS -->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <!-- FILE UPLOAD WIZARD CSS -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <!-- WIZARD CSS -->
        <link rel="stylesheet" href="assets/libs/twitter-bootstrap-wizard/prettify.css">
        <!-- DATATABLES CSS -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.2.1/css/fixedHeader.dataTables.css">
        <!-- DEVLOG CSS-->
        <?php

        whitelabel_view(false);

        $hex = $whitelabel_view->menuprimary;
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

        if (whitelabel_single(false) == 'dark') {
            ?><style>
                :root{
                    --cooper-primary: <?php if ( !$whitelabel_view->menuprimary ) { echo '#3695c5'; } else { echo $whitelabel_view->menuprimary; }?>;
                    --cooper-primary-light: rgba(<?php echo $r . ', ' . $g . ', ' . $b . ', 0.05'; ?>);
                    --cooper-primary-light-darker: rgba(<?php echo $r . ', ' . $g . ', ' . $b . ', 0.2'; ?>);
                    --cooper-primary-dark: <?php echo adjustBrightness($whitelabel_view->menuprimary, 0.3) ?>;
                    --cooper-secondary:#151937;
                    --cooper-highlight:#edf7ff;
                    --cooper-background:#f5f5f5;
                    --cooper-header-core:#151937;
                    --cooper-header-dark-core:#090d2a;
                    --cooper-header-text:#fff;
                    --cooper-header-text-hover: <?php if ( !$whitelabel_view->menuprimary ) { echo '#3695c5'; } else { echo $whitelabel_view->menuprimary; }?>;
                }
            </style><?php
        } else if (whitelabel_single(false) == 'light') {
            ?><style>
                :root{
                    --cooper-primary: <?php if ( !$whitelabel_view->menuprimary ) { echo '#3695c5'; } else { echo $whitelabel_view->menuprimary; }?>;
                    --cooper-primary-light: rgba(<?php echo $r . ', ' . $g . ', ' . $b . ', 0.05'; ?>);
                    --cooper-primary-light-darker: rgba(<?php echo $r . ', ' . $g . ', ' . $b . ', 0.2'; ?>);
                    --cooper-primary-dark: <?php echo adjustBrightness($whitelabel_view->menuprimary, 0.3) ?>;
                    --cooper-secondary:#151937;
                    --cooper-highlight:#edf7ff;
                    --cooper-background:#f5f5f5;
                    --cooper-header-core:#fff;
                    --cooper-header-dark-core:#090d2a;
                    --cooper-header-text:#151937;
                    --cooper-header-text-hover: <?php if ( !$whitelabel_view->menuprimary ) { echo '#3695c5'; } else { echo $whitelabel_view->menuprimary; }?>;
                }
            </style><?php
        } else {
            ?><style>
                :root{
                    --cooper-primary: #3695c6;
                    --cooper-primary-light: rgba(54, 149, 197, 0.1);
                    --cooper-primary-dark: #df2323;
                    --cooper-secondary:#151937;
                    --cooper-highlight:#edf7ff;
                    --cooper-background:#f5f5f5;
                    --cooper-header-core:#151937;
                    --cooper-header-dark-core:#edf7ff;
                    --cooper-header-text:#fff;
                    --cooper-header-text-hover: #3695c6;
                }
            </style><?php
        }
        ?>

        <link href="assets/css/devlog.css" rel="stylesheet" type="text/css" />
    <?php /* ---- END - HEAD LINK ---- */ ?>

</head>

<body id="minimised-menu" data-sidebar-size="lg" class="<?= whitelabel_single(false) ?>">

<div id="layout-wrapper">

<?php include 'layouts/menu.php'; ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
                <!-- CONTINUED... -->
