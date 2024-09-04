<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// BYPASS FORCE REDIRECT FOR SURVEY SUBMISSIONS
function my_forcelogin_bypass( $bypass, $visited_url ) {
    if ( is_page('my-page') ) {
        $bypass = true;
    }
    return $bypass;
}
add_filter( 'v_forcelogin_bypass', 'my_forcelogin_bypass', 10, 2 );

// QUERIES INCLUDES
include 'layouts/functions/sanitize.php';

// QUERIES
function survey_security() {
    global $wpdb;
    global $table_name;
    $table = $wpdb->prefix . 'survey';
    // ------ VARIABLES ------
    $currentsubmission = safestring($_GET['surveyid']);
    // ------ QUERY ------
    global $survey_check;
    $survey_check = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table` WHERE displayid = '%s'", $currentsubmission));
    // ------ MESSAGE/ACTION ------
    if ($survey_check) {
        return true;
    } else {
        return false;
    }
}
survey_security();
function survey_clientaccount($clientaccount) {
    global $wpdb;
    global $table_name;
    $table = $wpdb->prefix . 'accounts';
    // ------ VARIABLES ------
    $currentaccount = safestring($clientaccount);
    // ------ QUERY ------
    global $survey_account;
    $survey_account = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$table` WHERE displayid = '%s'", $currentaccount));
    // ------ MESSAGE/ACTION ------
    if ($survey_account) {
        return true;
    } else {
        return false;
    }
}
survey_clientaccount($survey_check->clientaccount);

// IMPORT QUERIES
?>

<head>
    <title>Service Feedback Survey | Cooper Handling</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Cooper 1.0 Theme" name="description"/>
    <meta content="Cooper" name="author"/>
    <link rel="icon" href="assets/images/logo-lg.ico">
    <link rel="shortcut icon" href="assets/images/logo-lg.ico">
    <link rel="stylesheet" type="text/css" href="assets/css/devlog_form_page.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/devlog.css">
</head>

<body id="minimised-menu" data-sidebar-size="lg">

    <div class="container">
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6 col-md-12 align-self-center">
                <img class="logo_center" width="100" src="assets/images/logo-lg.svg"/>
                <div class="card card-top section-block-p0">
                    <?php
                    //print_r($survey_check);
                    if ( $survey_check ) {
                        // VALID SURVEYID, FORM SUBMISSION ENABLED
                        if ( !$survey_check->q2 || !$survey_check->q3 || !$survey_check->q4 || !$survey_check->q5 ) {
                            // NOT SUBMITTED YET, FORM SUBMISSION ENABLED

                            // SEND IF POST READY
                            function survey_submit($print){
                                if (isset($_POST['survey_submit'])) {
                                    global $wpdb;
                                    $table = $wpdb->prefix . 'survey';
                                    // VARIABLES
                                    $engineers = implode( ';' , $_POST['q1'] );
                                    // ------ POST/GET (SANITIZE) ------
                                    $data = array(
                                        // Column => Value
                                        'q1' => safestring($engineers),
                                        'q2' => safestring($_POST['q2']),
                                        'q3' => safestring($_POST['q3']),
                                        'q4' => safestring($_POST['q4']),
                                        'q5' => safestring($_POST['q5']),
                                        'q6' => safestring($_POST['q6']),
                                        'q7' => safestring($_POST['q7']),
                                        'q8' => safestring($_POST['q8']),
                                        'q9' => safestring($_POST['q9']),
                                        'q10' => safestring($_POST['q10']),
                                        'yourfeedback' => safestring($_POST['your-feedback']),
                                        'submitted' => date('Y-m-d H:i:s'),
                                    );
                                    $where = array(
                                        'displayid' => safestring($_POST['displayid']),
                                    );
                                    $format = array(
                                        // Format
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s',
                                        '%s'
                                    );
                                    // ------ QUERY ------
                                    $survey_submit = $wpdb->update($table, $data, $where, $format);
                                    // ------ BUG CHECKING ------
                                    if ($print == true) {
                                        echo $wpdb->last_error;
                                        echo $wpdb->last_query;
                                        print_r($survey_submit);
                                    }
                                    ?><script type="text/javascript">location.reload();</script><?php
                                }
                            }
                            survey_submit(false);

                            ?>
                            <div class="card-header">
                                <h4 class="title-block top" style="color:#fff;"><?= 'Hi ' . $survey_check->clientname . ', ' ?></h4>
                                <h3 class="title-block bottom" style="color:#fff;">Service Feedback Survey<?php if ( $survey_check->clientaccount ) { echo ' For ' . $survey_account->accountname; } ?>.</h3>
                            </div>
                            <div class="card-body faq-block">
                                <div class="mb-2">You've been invited you to fill in a service feedback survey - please provide honest answers as this helps us to constantly improve our services.</div>
                                <form class="submit_full_survey" method="post">

                                    <?php
                                    //print_r($_POST);
                                    ?>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Names Of The Engineers In Attendance</label>

                                        <div> <input type="checkbox" id="1" name="q1[]" value="Dan Capper"> <label for="1">Dan Capper</label> </div>
                                        <div> <input type="checkbox" id="2" name="q1[]" value="Denis Irish"> <label for="2">Denis Irish</label> </div>
                                        <div> <input type="checkbox" id="3" name="q1[]" value="Glen Page"> <label for="3">Glen Page</label> </div>
                                        <div> <input type="checkbox" id="4" name="q1[]" value="Istvan Tulkan"> <label for="4">Istvan Tulkan</label> </div>
                                        <div> <input type="checkbox" id="5" name="q1[]" value="John Hunt"> <label for="5">John Hunt</label> </div>
                                        <div> <input type="checkbox" id="6" name="q1[]" value="Leszek Kaluzny"> <label for="6">Leszek Kaluzny</label> </div>
                                        <div> <input type="checkbox" id="7" name="q1[]" value="Lewis Clark"> <label for="7">Lewis Clark</label> </div>
                                        <div> <input type="checkbox" id="8" name="q1[]" value="Lewis Mann"> <label for="8">Lewis Mann</label> </div>
                                        <div> <input type="checkbox" id="9" name="q1[]" value="Noel Gottsch"> <label for="9">Noel Gottsch</label> </div>
                                        <div> <input type="checkbox" id="10" name="q1[]" value="Rob Willis"> <label for="10">Rob Willis</label> </div>
                                        <div> <input type="checkbox" id="11" name="q1[]" value="Stan Zawodnik"> <label for="11">Stan Zawodnik</label> </div>
                                        <div> <input type="checkbox" id="12" name="q1[]" value="Wayne Greenard"> <label for="12">Wayne Greenard</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Ease Of Contacting Us *</label>
                                        <div> <input type="radio" id="1" name="q2" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q2" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q2" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q2" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q2" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Customer Service Experience *</label>
                                        <div> <input type="radio" id="1" name="q3" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q3" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q3" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q3" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q3" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Response Time For Attendance *</label>
                                        <div> <input type="radio" id="1" name="q4" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q4" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q4" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q4" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q4" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Engineer Fully Aware Of Reason For Attendance *</label>
                                        <div> <input type="radio" id="1" name="q5" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q5" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q5" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q5" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q5" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Technical Knowledge & Capabilities Of Engineer Who Attended *</label>
                                        <div> <input type="radio" id="1" name="q6" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q6" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q6" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q6" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q6" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Quality Of Service Provided *</label>
                                        <div> <input type="radio" id="1" name="q7" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q7" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q7" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q7" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q7" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Accuracy Of Paperwork *</label>
                                        <div> <input type="radio" id="1" name="q8" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q8" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q8" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q8" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q8" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Lead Time For Parts *</label>
                                        <div> <input type="radio" id="1" name="q9" value="Excellent" required> <label for="1">Excellent</label> </div>
                                        <div> <input type="radio" id="2" name="q9" value="Good"> <label for="2">Good</label> </div>
                                        <div> <input type="radio" id="3" name="q9" value="Acceptable"> <label for="3">Acceptable</label> </div>
                                        <div> <input type="radio" id="4" name="q9" value="Not Acceptable"> <label for="4">Not Acceptable</label> </div>
                                        <div> <input type="radio" id="5" name="q9" value="Unsure"> <label for="5">Unsure</label> </div>
                                    </div>

                                    <div class="modal-card">
                                        <label class="modal_label bold">Have We Identified Any Additional Follow Up Work Required? *</label>
                                        <div> <input type="radio" id="1" name="q10" value="Yes" required> <label for="1">Yes</label> </div>
                                        <div> <input type="radio" id="2" name="q10" value="No"> <label for="2">No</label> </div>
                                    </div>

                                    <label for="your-feedback" class="modal_label bold">How Can We Improve Our Service To You? Please Use The Box Below To Provide Any Additional Comments Or Suggestions To Help Us Improve (Max 500 Characters) *</label>
                                    <input name="your-feedback" max="500" type="textarea" class="modal_input mb-4" id="your-feedback" placeholder="Your feedback..." required>

                                    <input name="displayid" value="<?= $survey_check->displayid ?>" type="text" style="display:none!important;visibility:hidden!important;">

                                    <button type="submit" name="survey_submit" class="btn btn-primary waves-effect waves-light">Submit Survey</button>

                                </form>
                            </div>
                            <?php
                        } else {
                            // FORM ALREADY SUBMITTED, STOP FORM SUBMISSION
                            ?><div class="card-header">
                                <h4 class="title-block top" style="color:#fff;"><?= 'Hi ' . $survey_check->clientname . ', ' ?></h4>
                                <h3 class="title-block bottom" style="color:#fff;">Service Feedback Survey<?php if ( $survey_check->clientaccount ) { echo ' For ' . $survey_account->accountname; } ?>.</h3>
                            </div>
                            <div class="card-body faq-block" style="text-align:center;">
                                <div class="mb-2">Thank you for your honest feedback, we will review your feedback carefully.</div>
                                <div class="mt-2">Regards</div>
                                <div>Cooper Handling</div>
                            </div><?php
                        }
                    } else {
                        // INVALID SURVEYID, STOP FORM SUBMISSION
                        ?><div class="card-header">
                        <h4 class="title-block top" style="color:#fff;"><?= 'Hi There, ' ?></h4>
                        <h3 class="title-block bottom" style="color:#fff;">Service Feedback Survey Error.</h3>
                        </div>
                        <div class="card-body faq-block" style="text-align:center;">
                            <div class="mb-2">Unfortunately this is not a valid survey ID, if you think this is an error, please contact Cooper Handling directly. We apologise for any inconvenience caused.</div>
                            <div class="mt-2">Regards</div>
                            <div>Cooper Handling</div>
                        </div><?php
                    }
                    ?>
                </div>
            </div>
            <span>

            </span>
        </div>
    </div>

</body>
