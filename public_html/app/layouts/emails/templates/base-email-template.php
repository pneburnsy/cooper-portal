<?php

/*
 * Basic Template
 *
 * Ran on request.
 *
 * */

// Get Loop Data
$loopdata = $wpdb->get_results( "SELECT * FROM `packages` WHERE uid = $id AND userid = $userid" );
// Get User Data
$userdata = $wpdb->get_results( "SELECT * FROM `07_users` WHERE ID = $userid" );

// print_r($loopdata);

// Message Variables
$name = $userdata[0]->display_name;
$sendemail = $userdata[0]->user_email;
$completed = $loopdata[0]->packagearchiveddate;
$renewalname = $loopdata[0]->packagename;
$renewalaccount = $loopdata[0]->packageaccount;
$renewalcategory = $loopdata[0]->packagecategory;
$renewalcategory = $loopdata[0]->packagecategory;
$renewalinvoicedstatus = $loopdata[0]->packageinvoiced;
$renewalinvoiceddate = $loopdata[0]->packageinvoiceddate;

$renewalcompleted = date('d/m/Y', strtotime($completed));
$renewalinvoiceddatefinal = date('d/m/Y', strtotime($renewalinvoiceddate));


if ($renewalinvoicedstatus = 1 && $renewalinvoiceddate) {
    $renewalinvoiced = "Invoiced ($renewalinvoiceddatefinal)";
} else {
    $renewalinvoiced = "Not Invoiced";
}

$date = date('l');

$to = "$email";
$subject = "$renewalname Completed | Devlog";

$message = "
    <html style='background-color:#f8f8f8;'>
        <head>
            <title>Renewal Completed</title>
            <style> .header a { color: #fff; } .core a { color: #686cbc; } </style>
        </head>
        <body style='background-color:#f8f8f8;padding: 30px 30px;'>
            <div style='display:block;margin:auto;test-align:center;width:540px;margin:auto;'>
                <table style='width:540px;margin:auto;'>
                    <tr style='width:200px; margin: auto 0px; text-align:center;'>
                        <td style='border-spacing:0;width:540px; color: #686cbc; font-family: arial; font-size: 13pt; line-height: 18px; text-align:center; font-weight:bold;'>
                            <img src='http://devlog.uk/wp-content/uploads/2022/07/logo-lg.png' style='width:200px;margin: 30px auto;display:block;'  width='200'>
                        </td>
                    </tr>
                </table>
            </div>
            <div style='border-spacing:0;background-color:#fff;border-radius:10px;border: 1px solid #ededed;max-width:540px;margin:auto;display:block;'>
                <table style='border-spacing:0;width:540px;margin:auto;'> 
                    <tr class='header' style='width:200px; margin: auto 0px; text-align:center;'>
                        <td style='border-spacing:0;background:#686cbc;display:block;padding:30px;width:480px;margin: auto 0px;text-align:center;border-radius: 10px 10px 0 0;'>
                            <span style='color: #fff; font-family: arial; display:block; margin-bottom: 10px;font-size: 9pt; line-height: 18px; text-align:center; font-weight:regular;'>Renewal Completed</span>
                            <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>$renewalname</span>
                        </td>
                    </tr>
                    <tr class='core' style='margin-bottom: 0px; padding:20px; display:block;'>
                        <td style='width:540px; font-family: arial; font-size: 12pt; line-height: 22px; text-align:center;'>
                            <span style='width:100%; text-align:center;'>
                                <span style='border-radius:10px; color:#1e283c; display:block; text-align:center;'>
                                    <span style='display:block;font-size: 13px; line-height:20px; margin:0; font-weight:500;'>
                                        <strong>Renewal Name:</strong> $renewalname <br>
                                        <strong>Account:</strong> $renewalaccount <br>
                                        <strong>Package:</strong> $renewalcategory <br>
                                        <strong>Invoiced:</strong> $renewalinvoiced <br>
                                        <strong>Completed:</strong> $renewalcompleted <br>
                                    </span>
                                    <a href='https://devlog.uk/app/dashboard' style='margin: 22px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 15px 20px; border-radius:5px; background-color: #686cbc; color: #fff; font-weight: bold;'>View Dashboard</a>
                                </span>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
            <table style='width:540px;margin:auto;'>
                <tr style='width:510px; margin-top: 15px; margin-bottom: 0px; border-radius:10px; display:block; padding:15px;'>
                    <td style='width:540px; font-family: arial; font-size: 8pt; line-height: 16px; text-align:center;'>
                        <span style='color:#afafaf;width:100%;text-align:center;'>Devlog will never ask you for your login information or payment details. If you want to unsubscribe from these emails, please edit the settings in your account. Visit your Devlog Dashboard <a style='color: #686cbc' href='https://devlog.uk/app/dashboard'>here.</a></span>
                    </td>
                </tr>
            </table>
        </body>
    </html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: Devlog <noreply@devlog.uk>' . "\r\n";
//$headers .= 'Cc: admin@tlhmarketing.co.uk' . "\r\n";

wp_mail($sendemail, $subject, $message, $headers);
