<?php

if(isset($_POST['submitbug'])) {

    $current_name = current_user_fullname();

    $user_name = $_POST['your-name'];
    $user_email = $_POST['your-email'];
    $location = $_POST['bug_location'];
    $bugreport = $_POST['your-bug'];

    $to = $adminemail;
    $subject = "Bug Report From $current_name | Cooper Handling Portal";

    $message = "
        <html style='background-color:#f8f8f8;'>
            <head>
                <title>Bug Report | Cooper Handling Portal</title>
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
                                <span style='color: #fff; font-family: arial; display:block; margin-bottom: 10px;font-size: 9pt; line-height: 18px; text-align:center; font-weight:regular;'>A user has submitted a new...</span>
                                <span style='color: #fff; font-family: arial; display:block; font-size: 14pt; line-height: 18px; text-align:center; font-weight:bold;'>Bug Report!</span>
                            </td>
                        </tr>
                        <tr class='core' style='margin-bottom: 0px; padding:20px; display:block;'>
                            <td style='width:540px; font-family: arial; font-size: 12pt; line-height: 22px; text-align:center;'>
                                <span style='width:100%; text-align:center;'>
                                    <span style='border-radius:10px; color:#1e283c; display:block; text-align:center;'>
                                        <span style='display:block;font-size: 13px; line-height:20px; margin: 0 auto 10px auto; max-width: 300px; font-weight:500;'>
                                            $current_name has submitted a question on the portals FAQ, please see below.
                                        </span>
                                        <span style='display:block;font-size: 13px; line-height:20px; margin:0; font-weight:500;'>
                                            <strong>Name:</strong> $user_name <br>
                                            <strong>Email:</strong> $user_email <br>
                                            <strong>Location:</strong> $location <br>
                                            <strong>Description:</strong> $bugreport <br>
                                        </span>
                                    </span>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <table style='width:540px;margin:auto;'>
                    <tr style='width:510px; margin-top: 15px; margin-bottom: 0px; border-radius:10px; display:block; padding:15px;'>
                        <td style='width:540px; font-family: arial; font-size: 8pt; line-height: 16px; text-align:center;'>
                            <span style='color:#afafaf;width:100%;text-align:center;'>Cooper Handling will never ask you for your login information or payment details. If you want to unsubscribe from these emails, please edit the settings in your account. Visit your Cooper Handling Dashboard <a style='color: #3695c5' href='https://portal.cooperhandling.com/app/dashboard.php'>here.</a></span>
                        </td>
                    </tr>
                </table>
            </body>
        </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Cooper Handling <noreply@cooperhandling.com>' . "\r\n";
    $headers .= 'Cc: admin@tlhmarketing.co.uk' . "\r\n";

    wp_mail($to, $subject, $message, $headers);

}










