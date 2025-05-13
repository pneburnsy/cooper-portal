<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Pipeline';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
pipeline_all(false);
pipeline_move(false);
pipeline_add(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

    <!-- Kanban -->
    <div class="mb-6">
        <?php pipeline_table($pipeline_id); ?>
    </div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php
// FOOTER
include 'layouts/footer.php';
?>

<!--<div class="col-xl-8 col-md-12"></div>-->
