<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Your Dashboard';
include 'layouts/header.php';

// IMPORT QUERIES
notes_week(false);
?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<div class="row dashboard">
    <?php include 'layouts/includes/dashboard/widget_carousel.php'; ?>
</div>

<div class="row dashboard">
    <?php include 'layouts/includes/dashboard/widget_appointments_calendar.php'; ?>
</div>

<div class="row dashboard">
    <?php if (doif_cooperonly_query()) { ?>
        <?php include 'layouts/includes/dashboard/widget_holiday.php'; ?>
    <?php } ?>
    <?php include 'layouts/includes/dashboard/widget_feedback_monthly.php'; ?>
    <?php include 'layouts/includes/dashboard/widget_feedback_quarter.php'; ?>
</div>

<div class="row dashboard">
    <?php if (doif_cooperonly_query()) { ?>
        <?php include 'layouts/includes/dashboard/widget_holiday_calendar.php'; ?>
    <?php } ?>
</div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
