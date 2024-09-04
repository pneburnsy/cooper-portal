<?php

function admin_outstanding($current_email, $reminders) {

    global $wpdb;

    $to = "$current_email";
    $subject = "Weekly Overdue Update | Cooper Handling";

    $overdue_message = 'Looking good! You have no contracts that are currently overdue.';
    for ($j = 0; $j < count($reminders); $j++) {
        if ($reminders[$j] > 0) {
            // True
            $overdue_status[$j] = "background-color:rgba(253,98,94,.25)!important;color:#fd6460;";
            $overdue_message = 'You have some contracts that are overdue.';
        } else {
            // False
            $overdue_status[$j] = "background-color:rgb(40 168 29 / 25%)!important;color:#54a963;";
        }
    }

    $message = "
    <html style='background-color:#f8f8f8;'>
        <head>
            <title>Weekly Overdue Update | Cooper Handling</title>
            <style> .header a { color: #fff; } .core a { color: #3695c5; } </style>
        </head>
        <body style='background-color:#f8f8f8;padding: 30px 30px;'>
            <div style='display:block;margin:auto;text-align:center;width:540px;max-width:100%;margin:auto;'>
                <table style='width:540px;max-width:100%;margin:auto;'>
                    <tr style='width:500px;max-width:100%; padding:20px; margin: auto; text-align:center;'>
                        <td style='border-spacing:0;color: #3695c5; font-family: arial; font-size: 13pt; line-height: 18px; text-align:center; font-weight:bold;'>
                            <img src='https://portal.cooperhandling.com/app/assets/images/logo-lg.png' style='width:50px;auto;display:block;margin:30px auto;'  width='50'>
                        </td>
                    </tr>
                </table>
            </div>
            <span style='border-spacing:0;background-color:#fff;border-radius:10px;border: 1px solid #ededed;margin:auto;width:540px;max-width:100%;max-width:100%;min-width: fit-content !important;display:block;'>
                <table style='border-spacing:0;width:540px;max-width:100%;'>
                    <tr class='header' style='text-align:center;'>
                        <td style='border-spacing:0;background:#3695c5;display:block;padding:30px;width:480px;margin: auto 0px;text-align:center;border-radius: 10px 10px 0 0;'>
                            <span style='color: #fff; font-family: arial; display:block; margin-bottom: 10px;font-size: 9pt; line-height: 18px; text-align:center; font-weight:regular;'>Cooper Handling</span>
                            <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>Weekly Overdue Update </span>
                        </td>
                    </tr>
                    <tr class='core' style='margin-bottom: 0px; display:block; padding: 20px;'>
                        <td style='width:540px;max-width:100%; font-family: arial; font-size: 12pt; line-height: 22px; text-align:center;'>
                            <span style='width:100%; text-align:center;'>
                                <span style='border-radius:10px; color:#1e283c; display:block; text-align:center;'>
                                    <span style='display:block;font-size: 13px; line-height:20px; margin: 0 auto 10px auto; font-weight:500;'>
                                        <span class='core' style='text-align:center;'>
                                            Hi There,
                                            <br><br>
                                            {$overdue_message} Take a look below...
                                            <br><br>
                                        </span>
                                        <span class='core' style='text-align:center;'>
                                            <span style='max-width:300px;margin:0 auto 10px auto;padding:20px;{$overdue_status[0]}border-radius:10px;display:block;'>
                                                <span style='text-align:center;display:block;font-size:10px;'>{$reminders[0]['label']}</span>
                                                <span style='text-align:center;display:block;font-size:16px;font-weight:bold;'>{$reminders[0]['value']} Overdue</span>
                                            </span>
                                        </span>
                                        <span class='core' style='text-align:center;'>
                                            <span style='max-width:300px;margin:0 auto 10px auto;padding:20px;{$overdue_status[1]}border-radius:10px;display:block;'>
                                                <span style='text-align:center;display:block;font-size:10px;'>{$reminders[1]['label']}</span>
                                                <span style='text-align:center;display:block;font-size:16px;font-weight:bold;'>{$reminders[1]['value']} Overdue</span>
                                            </span>
                                        </span>
                                        <span class='core' style='text-align:center;'>
                                            <span style='max-width:300px;margin:0 auto 10px auto;padding:20px;{$overdue_status[2]}border-radius:10px;display:block;'>
                                                <span style='text-align:center;display:block;font-size:10px;'>{$reminders[2]['label']}</span>
                                                <span style='text-align:center;display:block;font-size:16px;font-weight:bold;'>{$reminders[2]['value']} Overdue</span>
                                            </span>
                                        </span>
                                        <span class='core' style='text-align:center;'>
                                            <span style='max-width:300px;margin:0 auto 10px auto;padding:20px;{$overdue_status[3]}border-radius:10px;display:block;'>
                                                <span style='text-align:center;display:block;font-size:10px;'>{$reminders[3]['label']}</span>
                                                <span style='text-align:center;display:block;font-size:16px;font-weight:bold;'>{$reminders[3]['value']} Overdue</span>
                                            </span>
                                        </span>
                                        <span class='core' style='text-align:center;'>
                                            <br>
                                            Regards,
                                            <br>
                                            Cooper Handling.
                                            <a href='https://portal.cooperhandling.com/app/page_survey_clientform?surveyid=$displayid' style='margin: 22px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 15px 20px; border-radius:5px; background-color: #3695c5; color: #fff; font-weight: bold;'>Submit Survey</a>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </td>
                    </tr>
                </table>
            </span>
            <table style='width:540px;max-width:100%;margin:auto;'>
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
    //$headers .= 'Cc: admin@tlhmarketing.co.uk, pne.burnsy1@hotmail.com' . "\r\n";

    wp_mail($to, $subject, $message, $headers);

    echo '<br>Email Sent: ' . $current_email;

}