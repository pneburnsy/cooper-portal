<?php

// $team_email = safeemail($_POST['team_email']);
// $team_firstname = safestring($_POST['team_firstname']);
// $team_lastname = safestring($_POST['team_lastname']);
// $team_fullname = safestring($team_firstname) . ' ' . safestring($team_lastname);
// $team_username = safestring($_POST['team_username']);
// $team_password = safestring($_POST['team_password']);
// $team_role = safeinteger($_POST['team_role']);

$other_name = other_user_firstname($this_userid);
$other_username = other_user_login($this_userid);
$other_password = $this_newpassword;
$other_email = other_user_email($this_userid);

$to = "$other_email";
$subject = "$other_name, Password Reset! | Cooper Handling";

$message = "
<html style='background-color:#f8f8f8;'>
    <head>
        <title>$current_name Invited You To Cooper Handling | Login Now!</title>
        <style> .header a { color: #fff; } .core a { color: #3695c5; } </style>
    </head>
    <body style='background-color:#f8f8f8;padding: 30px 30px;'>
        <div style='display:block;margin:auto;test-align:center;width:540px;margin:auto;'>
            <table style='width:540px;margin:auto;'>
                <tr style='width:200px; margin: auto 0px; text-align:center;'>
                    <td style='border-spacing:0;width:540px; color: #3695c5; font-family: arial; font-size: 13pt; line-height: 18px; text-align:center; font-weight:bold;'>
                        <img src='https://cooperportal.tlhdev.co.uk/app/assets/images/logo-lg.png' style='width:50px;margin: 30px auto;display:block;'  width='50'>
                    </td>
                </tr>
            </table>
        </div>
        <div style='border-spacing:0;background-color:#fff;border-radius:10px;border: 1px solid #ededed;max-width:540px;margin:auto;display:block;'>
            <table style='border-spacing:0;width:540px;margin:auto;'>
                <tr class='header' style='width:200px; margin: auto 0px; text-align:center;'>
                    <td style='border-spacing:0;background:#3695c5;display:block;padding:30px;width:480px;margin: auto 0px;text-align:center;border-radius: 10px 10px 0 0;'>
                        <span style='color: #fff; font-family: arial; display:block; margin-bottom: 10px;font-size: 9pt; line-height: 18px; text-align:center; font-weight:regular;'>Hi $other_name,</span>
                        <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>Password Reset!</span>
                    </td>
                </tr>
                <tr class='core' style='margin-bottom: 0px; padding:20px; display:block;'>
                    <td style='width:540px; font-family: arial; font-size: 12pt; line-height: 22px; text-align:center;'>
                        <span style='width:100%; text-align:center;'>
                            <span style='border-radius:10px; color:#1e283c; display:block; text-align:center;'>
                                <span style='display:block;font-size: 13px; line-height:20px; margin: 0 auto 10px auto; max-width: 300px; font-weight:500;'>
                                    Your password has been reset - if this wasn't you please check with your team owner or contact support immediately. Your new details are below...
                                </span>
                                <span style='display:block;font-size: 13px; line-height:20px; margin:0; font-weight:500;'>
                                    <strong>Username:</strong> $other_username <br>
                                    <strong>Password:</strong> $other_password <br>
                                </span>
                                <a href='https://devlog.uk/app/dashboard' style='margin: 22px auto 0 auto;display: block;width: fit-content;font-size:13px; text-transform: none; padding: 15px 20px; border-radius:5px; background-color: #3695c5; color: #fff; font-weight: bold;'>Login</a>
                            </span>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <table style='width:540px;margin:auto;'>
            <tr style='width:510px; margin-top: 15px; margin-bottom: 0px; border-radius:10px; display:block; padding:15px;'>
                <td style='width:540px; font-family: arial; font-size: 8pt; line-height: 16px; text-align:center;'>
                    <span style='color:#afafaf;width:100%;text-align:center;'>Cooper Handling will never ask you for your login information or payment details. If you want to unsubscribe from these emails, please edit the settings in your account. Visit your Cooper Handling Dashboard <a style='color: #3695c5' href='https://Cooper Handling.uk/app/dashboard'>here.</a></span>
                </td>
            </tr>
        </table>
    </body>
</html>
";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: Cooper Handling <noreply@portal.cooperhandling.com>' . "\r\n";
$headers .= 'Cc: admin@tlhmarketing.co.uk' . "\r\n";

wp_mail($to, $subject, $message, $headers);
