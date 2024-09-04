<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Frequently Asked Questions';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php

include 'layouts/emails/contactform.php';

$cooper_contact = $adminall;

?>

<div class="row">

    <div class="col-xl-8 col-md-12">
        <div class="card increase-br card-top section-block-p0 mb-4">
            <div class="card-header">
                <h4 class="card-title" style="color:#fff;">File Manager</h4>
                <p class="card-title-desc" style="color:#fff;">For the most popular questions regarding the file manager, please see the below.</p>
            </div>
            <div class="card-body faq-block increase-br">
                <div class="row">
                    <div>
                        <div class="accordion" id="acc_file">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fp-3" aria-expanded="true" aria-controls="fp-3">
                                        My file manager says 'Access Denied', why is this?
                                    </button>
                                </h2>
                                <div id="fp-3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#acc_file">
                                    <div class="accordion-body">
                                        <div class="text-muted">
                                            <p><strong class="text-dark">If you don't have access to any folders this message will show. Also, by default new users don't have access to anything on the file manager.</strong> If you think you should have access to a certain folder then please contact the portal administrator <?= $cooper_contact; ?>.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fp-1" aria-expanded="true" aria-controls="fp-1">
                                        Some folders and files are hidden in my file manager, why is this?
                                    </button>
                                </h2>
                                <div id="fp-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acc_file">
                                    <div class="accordion-body">
                                        <div class="text-muted">
                                            <p><strong class="text-dark">The portal admins have the ability to select what folders you can and can't see.</strong> If you can't see a file or folder and believe you should have access to it, please contact your department manager or the portal administrator <?= $cooper_contact; ?>.</p>
                                            <p>If you believe you shouldn't have access to a certain folder please inform the portal administrator <?= $cooper_contact; ?> straight away, thank you.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#fp-2" aria-expanded="false" aria-controls="fp-2">
                                        I have editor permissions on the portal but when I open files on Google I can't edit them?
                                    </button>
                                </h2>
                                <div id="fp-2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acc_file">
                                    <div class="accordion-body">
                                        <div class="text-muted">
                                            <p><strong class="text-dark">Certain users will have editor permissions on the portals file manager. If this applies to you, you will be able to move, edit and delete files in the areas you have access to.</strong> It's important to note, this will allow you to edit items within the portal only - if you open a file (for example a spreadsheet) within Google, the portal permissions will no longer apply. Editor permissions will need to be given to whatever Gmail email you're logged into, please contact your department manager or the portal administrator <?= $cooper_contact; ?> if you need editor permissions for a certain folder or file.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (doif_cooperonly_query()) { ?>
            <div class="card increase-br card-top section-block-p0 mb-4">
                <div class="card-header">
                    <h4 class="card-title" style="color:#fff;">Survey</h4>
                    <p class="card-title-desc" style="color:#fff;">For the most popular questions regarding the survey tool, please see the below.</p>
                </div>
                <div class="card-body faq-block increase-br">
                    <div class="row">
                        <div>
                            <div class="accordion" id="acc_survey">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#st-1" aria-expanded="true" aria-controls="st-1">
                                            I can't see my clients account in when trying to send a survey?
                                        </button>
                                    </h2>
                                    <div id="st-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acc_survey">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <p><strong class="text-dark">If you can't see the account you're looking for it may not have been added to the portal yet. You can add new accounts on the 'accounts' option on the menu. </strong> If you need help please contact the portal administrator <?= $cooper_contact; ?>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#st-2" aria-expanded="true" aria-controls="st-2">
                                            I've sent a survey to a client and they haven't received it?
                                        </button>
                                    </h2>
                                    <div id="st-2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acc_survey">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <p><strong class="text-dark">First, please ensure you have entered the correct email address. Sometimes, despite our best efforts, the survey emails can go into spam folders. Please check and see if the client has got this email in their spam. </strong> If not, please contact the portal administrator <?= $cooper_contact; ?>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (doif_cooperonly_query()) { ?>
            <div class="card increase-br card-top section-block-p0 mb-4">
                <div class="card-header">
                    <h4 class="card-title" style="color:#fff;">Holidays</h4>
                    <p class="card-title-desc" style="color:#fff;">For the most popular questions regarding the holidays system, please see the below.</p>
                </div>
                <div class="card-body faq-block increase-br">
                    <div class="row">
                        <div>
                            <div class="accordion" id="acc_holidays">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#h-1" aria-expanded="true" aria-controls="h-1">
                                            The holidays area says there isn't a Timetastic account linked to this user, what do I do?
                                        </button>
                                    </h2>
                                    <div id="h-1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acc_holidays">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <p><strong class="text-dark">The portal uses an external holiday manager to manage our staff holidays.</strong> If you're Cooper email doesn't have an account setup on Timetastic, it won't link through to the portal. To fix this, please contact your department manager or the portal administrator <?= $cooper_contact; ?>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#h-2" aria-expanded="false" aria-controls="h-2">
                                            My holiday allowance is wrong, what do I do?
                                        </button>
                                    </h2>
                                    <div id="h-2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#acc_holidays">
                                        <div class="accordion-body">
                                            <div class="text-muted">
                                                <p>If this is the case please contact your department manager or the portal administrator <?= $cooper_contact; ?> and we will look into this for you.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="col-xl-4 col-md-12">
        <div class="card card-form-size profile">
            <div class="team-body">
                <div class="team_member">
                    <p class="name">
                        <span class="top">Hi <?= $current_user->first_name . ' ' . $current_user->last_name ?>,</span>
                        <span class="bottom">Submit a Question...</span>
                    </p>
                    <p style="text-align: center;">We have FAQs for all sections of the portal here, please see if your question has already been answered before submitting a contact form. <strong>Still have an unanswered question? Fill out the form below.</strong></p>
                    <form class="submit_question" method="post">

                        <label for="your-name" class="modal_label">Your Name *</label>
                        <input name="your-name" type="text" class="modal_input" id="your-name" placeholder="Full Name..." required>

                        <label for="your-email" class="modal_label">Your Email *</label>
                        <input name="your-email" type="email" class="modal_input" id="your-email" placeholder="Email Address..." required>

                        <label for="your-section" class="modal_label">Question Type</label>
                        <select name="your-section" class="form-control modal_input" data-trigger name="choices-single-default" id="your-section">
                            <option value="">Question Type...</option>
                            <?php include 'dropdowns/sections.php';?>
                        </select>

                        <label for="your-question" class="modal_label">Your Question *</label>
                        <textarea name="your-question" type="textarea" class="modal_input last-list" id="your-question" placeholder="Question..."></textarea>

                        <button type="submit" name="submitquestion" class="btn btn-primary waves-effect waves-light">Submit Question</button>

                        <?php if(isset($_POST['submitquestion'])) { echo '<div class="contact_sent">Your question has been submitted, thank you.</div>'; }?>

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