<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Your Applications';
include 'layouts/header.php';

// IMPORT QUERIES
menu_applications_all(false);
menu_applications_add(false);
menu_applications_edit(false);
menu_applications_delete(false);

doif_cooperonly(true);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<?php if ( current_user_can( 'administrator' ) ) { ?>
    <div class="row">
        <?php include 'layouts/includes/menu/applications/applications_management.php'; ?>
    </div>
<?php } else { ?>
    <div class="cooper_access_denied">
        <span class="disabled text-center">You are not an admin you cannot access this page.</span>
    </div>
<?php } ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
