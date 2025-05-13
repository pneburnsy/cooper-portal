<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Your Reminders';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
doif_cooperadminonly(true, 'contacts');

// IMPORT QUERIES
notes_delete(false);
notes_complete(false);
notes_weekly_select(false);
?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<div class="row">
    <?php include 'layouts/includes/calendar/user_calendar.php'; ?>
</div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>