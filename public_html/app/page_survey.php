<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Survey Tool';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
doif_cooperonly(true, 'surveys');

survey_all(false);
survey_send(false);
survey_resend(false);
survey_count(false);
accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<div class="row align-items-center table-header-block section-block mb-4">
    <div class="col-md-4">
        <div>
            <h5 class="card-title">Survey List <span class="text-muted fw-normal ms-2">(<?= $survey_count ?>)</span></h5>
        </div>
    </div>
    <div class="col-md-8">
        <div class="button-group-mobile d-flex flex-wrap align-items-center justify-content-end gap-2">
            <?php form_clear_storage(); ?>
            <?php include 'layouts/includes/survey/modal/survey_add.php'; ?>
        </div>
    </div>
</div>

<?php survey_table($survey_all); ?>

<div class="row dashboard" style="margin-top:20px;">
    <?php include 'layouts/includes/dashboard/widget_feedback_monthly.php'; ?>
    <?php include 'layouts/includes/dashboard/widget_feedback_quarter.php'; ?>
    <?php include 'layouts/includes/dashboard/widget_feedback_all.php'; ?>
</div>

<?php /*
<div class="row mt-4">

    <div class="col-xl-5 col-md-12">
        <div class="card card-top section-block-p0">

            <div class="card-body faq-block">
                <p class="name">
                    <span class="top">Hi <?= $current_user->first_name . ' ' . $current_user->last_name ?>,</span>
                    <span class="bottom">Want To Send a Survey?</span>
                </p>
                <p style="text-align: center;">Send an email to your chosen client below. They will receive an email with a unique link to the Cooper Survey. <strong>All submissions can be tracked.</strong></p>
                <form class="submit_survey" method="post">

                    <div class="form-6 mb-3">
                        <label for="your-name" class="modal_label">Clients Name *</label>
                        <input name="your-name" type="text" class="modal_input" id="your-name" placeholder="Full Name..." required>
                    </div>

                    <div class="form-6 lastchild mb-3">
                        <label for="your-email" class="modal_label">Clients Email *</label>
                        <input name="your-email" type="email" class="modal_input" id="your-email" placeholder="Email Address..." required>
                    </div>

                    <div class="modal-card">

                        <div class="modal-card-header">
                            <h6>Client Account</h6>
                        </div>

                        <div class="form-12 mb-3">
                            <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                                <option value="" selected>Select Account...</option>
                                <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                    ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                } ?>
                            </select>
                        </div>

                    </div>

                    <div class="mb-3" style="display:none;">
                        <input name="displayid" value="<?= guid() ?>" type="text" class="modal_input" id="your-email" required>
                    </div>

                    <button type="submit" name="submitsurvey" class="btn btn-primary waves-effect waves-light">Send Survey</button>

                    <?php if(isset($_POST['submitsurvey']) || $_POST['submitsurvey']) { echo '<div class="contact_sent">The survey has been sent, thank you.</div>'; }?>

                </form>
            </div>

        </div>
    </div>

<!--    <div class="col-xl-4 col-md-12">-->
<!--        <div class="card card-top section-block-p0">-->
<!--            <div class="card-header">-->
<!--                <h4 class="card-title" style="color:#fff;">Recent Sends</h4>-->
<!--            </div>-->
<!--            <div class="card-body faq-block">-->
<!---->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

</div>
*/ ?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
