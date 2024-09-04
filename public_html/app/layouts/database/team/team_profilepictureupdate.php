<?php

function team_profilepictureupdate($print) {

    // VARIABLES
    global $wpdb;

    if (isset($_POST['team_profilepictureupdate'])) {

        // ASSIGN VARIABLES
        $displayid = $_POST['team_profilepictureupdate'];
        $userid = other_convert_displayid($displayid);

        // UPLOAD PATH & VALIDATION
        $fileData = pathinfo(basename($_FILES["team_profilepictureupdate"]["name"]));
        $fileName = $displayid . '.jpeg';
        $target_path = ($_SERVER['DOCUMENT_ROOT'] . 'app/layouts/public/profilepictures/' . $fileName);
        $uploadOk = 1;

        // FILE VALIDATION
        $file_type = $_FILES['team_profilepicture']['type'];
        $file_size = $_FILES['team_profilepicture']['size'];
        is_uploaded_file($_FILES['team_profilepicture']['tmp_name']);

        // CHECK FILE TYPE
        $allowed = array("image/jpeg", "image/jpg", "image/png");
        if (!in_array($file_type, $allowed)) {
            $_SESSION["Team"] = 'Only JPEG files are allowed.';
            $uploadOk = 0;
        }
        // CHECK FILE SIZE
        if ($file_size > 1000000) {
            $_SESSION["Team"] = 'File size too big, 1MB max size.';
            $uploadOk = 0;
        }

        // UPLOAD FILE
        if ($uploadOk == 0) {
            ?><script>window.location.href = "profile.php";</script><?php
        }
        else {
            // CHECK IF EXISTS (OVERWRITE)
            if (file_exists($target_path)) {
                unlink($target_path);
            }
            if (move_uploaded_file($_FILES["team_profilepicture"]["tmp_name"], $target_path)) {
                // DEBUGGING
                if ($print == true) {
                    echo 'error: ';
                    print_r($_FILES);
                }
                $_SESSION["Team"] = 'Profile picture updated.';
            }
            else {
                // DEBUGGING
                if ($print == true) {
                    echo 'error: ';
                    print_r($_FILES);
                }
                $_SESSION["Team"] = 'Sorry, there was an error uploading your file.';
            }
        }

        // LINK IMAGE TO USER
        $metas = array(
        'profile_picture_url' => $target_path
        );
        foreach($metas as $key => $value) {
            update_user_meta( $userid, $key, $value );
        }

        ?><script>window.location.href = "profile.php";</script><?php

    }

}