<?php

global $wpdb;

$today = date('Y-m-d');

$reminders_due_today = $wpdb->get_results($wpdb->prepare("
    SELECT * FROM `ae_notes`
    WHERE status = 0 AND reminder_date = %s
", $today));

//print_r($reminders_due_today);
$reminders_by_user = [];

foreach ($reminders_due_today as $reminder) {
    $reminders_by_user[$reminder->userid][] = $reminder;
}

foreach ($reminders_by_user as $userid => $reminders) {

    //print_r($reminders);

    $user_info = get_userdata($userid);
    if (!$user_info || empty($user_info->user_email)) {
        continue;
    }
    $user_email = $user_info->user_email;

    $countReminder = 0;

    $reminder_list_html = '<ul style="padding:0;">';
    foreach ($reminders as $reminder) {
        $users = get_users([
            'meta_query' => [
                [
                    'key' => 'displayid',
                    'value' => $reminder->displayid,
                    'compare' => '=',
                ]
            ]
        ]);
        //print_r( $reminders[0]->displayid );
        if ($reminder->reminder_time) {
            $reminder_time = $reminder->reminder_time;
        } else {
            $reminder_time = 'All Day';
        }
        $reminder_list_html .= '
            <li style="list-style: none;margin-left: 0;border-radius:10px;background-color:#f5f5f5; padding: 20px; margin-bottom:20px;">
                
                <h3 style="text-align:center; margin-bottom: 0px;margin-top:0px;"><strong> ' . $users[0]->display_name . '</strong></h3>
                <p style="text-align:center; margin-bottom: 0px;"><strong>Date:</strong> Today</p>
                <p style="text-align:center; margin-top: 0px;"><strong>Time:</strong> ' . $reminder_time . '</p>
                <p style="text-align:center; margin-bottom: 0px;">' . $reminder->note . '</p>
                <a href="https://portal.cooperhandling.com/app/page_view_users_view.php?displayid=' . $reminder->displayid . '" style="margin: 0px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 8px 14px; border-radius:5px; background-color: #151937; color: #fff; font-weight: bold;">
                    View Contact
                </a>
            </li>
        ';
        $countReminder++;
    }
    $reminder_list_html .= '</ul>';

//    if ($user_info->user_email == 'mattburns@tlhmarketing.co.uk') {
    echo 'Match, sent: ' . $user_email . ' (' . $countReminder . ')<br>';
    $email_body = "
        <html style='background-color:#f8f8f8;'>
            <head>
                <title>Daily Reminder(s) | Cooper Handling</title>
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
                                <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>Daily Reminder(s) Due</span>
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
                                                You have " . $countReminder . " reminder(s) due today. Please see your overview below...
                                                <br><br>
                                            </span>
                                            <span>
                                                {$reminder_list_html}
                                            </span>
                                            <span class='core' style='margin-top:0px;text-align:center;'>
                                                <br>
                                                Regards,
                                                <br>
                                                Cooper Handling.
                                                <a href='https://portal.cooperhandling.com/app/dashboard.php' style='margin: 22px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 15px 20px; border-radius:5px; background-color: #3695c5; color: #fff; font-weight: bold;'>View Reminders</a>
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
//    } else {
//        echo 'No match, not sent: ' . $user_email . ' (' . $countReminder .')<br>';
//    }

    wp_mail($user_email, 'Daily Reminders Due Today', $email_body, ['Content-Type: text/html; charset=UTF-8']);
}
?>
