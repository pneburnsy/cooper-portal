<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Bug Report';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php

include 'layouts/emails/bugreport.php';

?>

    <div class="row">

        <div class="col-xl-5 col-md-12">
            <div class="card card-form-size holidays">
                <div class="card-body">
                    <div class="team_member">
                        <p class="name">
                            <span class="top">Hi <?= $current_user->first_name . ' ' . $current_user->last_name ?>,</span>
                            <span class="bottom">Have You Found a Bug?</span>
                        </p>
                        <p style="text-align: center;">We're constantly striving to improve our portal so if you ever encounter any issues please report them! If you have any questions view our <a href="page_faq.php">FAQ area here.</a> <strong>Fill out the form below.</strong></p>
                        <form class="submit_question" method="post">

                            <label for="your-name" class="modal_label">Your Name *</label>
                            <input name="your-name" type="text" class="modal_input" id="your-name" placeholder="Full Name..." required>

                            <label for="your-email" class="modal_label">Your Email *</label>
                            <input name="your-email" type="email" class="modal_input" id="your-email" placeholder="Email Address..." required>

                            <label for="bug_location" class="modal_label">Bug Location</label>
                            <select name="bug_location" class="form-control modal_input" data-trigger name="choices-single-default" id="bug_location">
                                <option value="">Location...</option>
                                <?php include 'dropdowns/bug_locations.php';?>
                            </select>

                            <label for="your-bug" class="modal_label">Describe the bug... *</label>
                            <textarea name="your-bug" type="textarea" class="modal_input last-list" id="your-bug" placeholder="Please describe the bug in as much detail as possible..."></textarea>

                            <button type="submit" name="submitbug" class="btn btn-primary waves-effect waves-light">Submit Bug</button>

                            <?php if(isset($_POST['submitbug'])) { echo '<div class="contact_sent">Your bug has been submitted, thank you.</div>'; }?>

                        </form>
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