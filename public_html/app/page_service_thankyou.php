<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// PAGE

// HEADER
$page = 'ODO Readings Successfully Updated';
$breadcrumbtitle = 'Service Contracts';
$breadcrumbchild = 'ODO Readings Successfully Updated';
include 'layouts/header.php';
include 'layouts/page_title.php';

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<style>
    .inactive_account_inner {
        width: fit-content;
        height: fit-content;
        vertical-align: middle;
        display: grid;
        margin: auto;
    }
    .inactive_account h3 {
        text-align: center;
        margin: auto;
        width: 300px;
        font-size: 20px;
        line-height: 30px;
        font-family: sans-serif;
        margin-bottom: 10px;
    }
    .inactive_account p {
        text-align: center;
        margin: auto;
        width: 300px;
        font-size: 16px;
        line-height: 24px;
        font-family: sans-serif;
    }
    .inactive_account .image {
        width: 200px;
        margin: auto;
        display: block;
        text-align: center;
        margin-bottom: 30px;
    }
</style>

<div class="card card-top section-block-mb2 section-block-p0 mb-4">
    <div class="card-body ">
        <div class="row">
            <div class="col-sm-12">
                <div class="inactive_account">
                    <div class="inactive_account_inner">
                        <h4 style="text-align: center;padding-top: 30px;margin-bottom: 0;">ODO Readings Successfully Updated</h4>
                        <div class='cooper_access_denied'><span>Thank you for submitting your ODO readings. <a href="/app/dashboard">Return to Dashboard.</a></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
