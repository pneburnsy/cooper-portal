<?php
function survey_resend($print){

    if (isset($_POST['resendsurvey'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['survey'];
        // ------ VARIABLES ------
        $displayid = safestring($_POST['resendsurvey']);

        // ------ QUERY ------
        global $survey_single;
        $survey_single = $wpdb->get_results($wpdb->prepare("
            SELECT * FROM `$table`
            WHERE displayid = '%s'
        ",
            // ARGUMENTS
            $displayid
        ));

        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($survey_single);
        }

        //------ QUERY ------
        $data = array(
            'resenddate' => safestring(date('Y-m-d')),
        );
        $where = array(
            'displayid' => safestring($displayid),
        );
        $format = array(
            '%s',
        );

        // ------ QUERY ------
        $survey_resend_update = $wpdb->update($table, $data, $where, $format);

        // EMPLOTEE DETAILS
        $current_name = current_user_fullname();

        // CLIENT DETAILS
        $clientname = safestring($survey_single[0]->clientname);
        $clientemail = safeemail($survey_single[0]->clientemail);

        if ($survey_single[0]->emailtitle) {
            $clienttitle = safestring($survey_single[0]->emailtitle);
        } else {
            $clienttitle = 'Service Feedback Survey';
        }
        if ($survey_single[0]->emaildesc) {
            $clientdescription = '<br><br><span>' . safestring(stripslashes($survey_single[0]->emaildesc)) . '</span>';
        } else {
            $clientdescription = '';
        }

        $to = "$clientemail";
        $subject = "Service Feedback Survey | Cooper Handling";

        $message = "
        <html style='background-color:#f8f8f8;'>
            <head>
                <title>Service Feedback Survey | Cooper Handling</title>
                <style> .header a { color: #fff; } .core a { color: #3695c5; } </style>
            </head>
            <body style='background-color:#f8f8f8;padding: 30px 30px;'>
                <div style='display:block;margin:auto;test-align:center;width:540px;margin:auto;'>
                    <table style='width:540px;margin:auto;'>
                        <tr style='width:200px; margin: auto 0px; text-align:center;'>
                            <td style='border-spacing:0;width:540px; color: #3695c5; font-family: arial; font-size: 13pt; line-height: 18px; text-align:center; font-weight:bold;'>
                                <img src='https://portal.cooperhandling.com/app/assets/images/logo-lg.png' style='width:50px;margin: 30px auto;display:block;'  width='50'>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style='border-spacing:0;background-color:#fff;border-radius:10px;border: 1px solid #ededed;max-width:540px;margin:auto;display:block;'>
                    <table style='border-spacing:0;width:540px;margin:auto;'>
                        <tr class='header' style='width:200px; margin: auto 0px; text-align:center;'>
                            <td style='border-spacing:0;background:#3695c5;display:block;padding:30px;width:480px;margin: auto 0px;text-align:center;border-radius: 10px 10px 0 0;'>
                                <span style='color: #fff; font-family: arial; display:block; margin-bottom: 10px;font-size: 9pt; line-height: 18px; text-align:center; font-weight:regular;'>Cooper Handling</span>
                                <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>$clienttitle</span>
                            </td>
                        </tr>
                        <tr class='core' style='margin-bottom: 0px; padding:20px; display:block;'>
                            <td style='width:540px; font-family: arial; font-size: 12pt; line-height: 22px; text-align:center;'>
                                <span style='width:100%; text-align:center;'>
                                    <span style='border-radius:10px; color:#1e283c; display:block; text-align:center;'>
                                        <span style='display:block;font-size: 13px; line-height:20px; margin: 0 auto 10px auto; max-width: 300px; font-weight:500;'>
                                            Hi $clientname,
                                            <br><br>
                                            Don't forget to fill out your survey it'll help us improve!
                                            <br><br>
                                            $current_name has invited you to fill in a service feedback survey - please provide honest answers as this helps us to constantly improve our services.
                                            $clientdescription
                                            <br><br>
                                            Regards,
                                            <br>
                                            Cooper Handling.
                                        </span>
                                        <a href='https://portal.cooperhandling.com/app/page_survey_clientform?surveyid=$displayid' style='margin: 22px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 15px 20px; border-radius:5px; background-color: #3695c5; color: #fff; font-weight: bold;'>Submit Survey</a>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <table style='width:540px;margin:auto;'>
                    <tr style='width:510px; margin-top: 15px; margin-bottom: 0px; border-radius:10px; display:block; padding:15px;'>
                        <td style='width:540px; font-family: arial; font-size: 8pt; line-height: 16px; text-align:center;'>
                            <span style='color:#afafaf;width:100%;text-align:center;'>Cooper Handling will never ask you for your login information or payment details. If you want to unsubscribe from these emails, please edit the settings in your account. Visit your Cooper Handling Dashboard <a style='color: #3695c5' href='https://portal.cooperhandling.com/app/dashboard'>here.</a></span>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Cooper Handling <noreply@portal.cooperhandling.com>' . "\r\n";
        //$headers .= 'Cc: admin@tlhmarketing.co.uk' . "\r\n";

        wp_mail($to, $subject, $message, $headers);


        // ------ MESSAGE/ACTION ------
        $_SESSION["Survey"] = 'Survey resent.';
        ?><script>window.location.reload();</script><?php

    }

}