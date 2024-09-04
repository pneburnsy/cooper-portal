<?php
function whitelabel_edit($print){

    if (isset($_POST['whitelabel_edit'])) {

        global $wpdb;
        global $table_name;
        $table = $table_name['whitelabel'];

        // ------ VARIABLES ------
        $userid = current_user_id();
        if ($_POST['menu_color'] || $_POST['menu_color'] == 'checked') {
            $menucolor = 'dark';
        } else {
            $menucolor = 'light';
        }
        $menuprimary = $_POST['menu_primary'];

        $rowexists = $wpdb->get_row("SELECT * FROM `$table` WHERE userid = '$userid'");

        // ------ POST/GET (SANITIZE) ------
        if ($rowexists->userid != current_user_id()) {
            $data = array(
                // Column => Value
                'userid' => current_user_id(),
                'menucolor' => safestring($menucolor),
                'menuprimary' => safestring($menuprimary),
            );
            $format = array(
                // Format
                '%d',
                '%s',
                '%s'
            );
            // ------ QUERY ------
            $whitelabel_action = $wpdb->insert($table, $data, $format);
        } else {
            $data = array(
                // Column => Value
                'menucolor' => safestring($menucolor),
                'menuprimary' => safestring($menuprimary),
            );
            $where = array(
                'userid' => current_user_id()
            );
            $format = array(
                // Format
                '%s',
                '%s'
            );
            // ------ QUERY ------
            $whitelabel_action = $wpdb->update($table, $data, $where, $format);

        }


        // ------ LOGO DARK ------
        if (isset($_FILES['menulogo_dark'])) {

            //echo 'Started... ';
            // ASSIGN VARIABLES
            $displayid = current_user_id();
            $userid = current_user_id();

            // UPLOAD PATH & VALIDATION
            $fileData = pathinfo(basename($_FILES["menulogo_dark"]["name"]));
            $fileName = 'cooperlogodark-63726' . $displayid . '.png';
            $target_path = ($_SERVER['DOCUMENT_ROOT'] . 'app/layouts/public/logos/' . $fileName);

            // FILE VALIDATION
            $file_type = $_FILES['menulogo_dark']['type'];
            $file_size = $_FILES['menulogo_dark']['size'];
            is_uploaded_file($_FILES['menulogo_dark']['tmp_name']);

            $allowed = array("image/png", "png");
            if (!in_array($file_type, $allowed) && $file_size) {
                $_SESSION["Dark Logo File"] = 'Only PNG files are allowed.';
                $uploadDarkOk = 0;
                //echo 'Only PNG files are allowed... ';
            }
            else if ($file_size > 1000000 && $file_size) {
                $_SESSION["Dark Logo Size"] = 'File size too big, 1MB max size.';
                $uploadDarkOk = 0;
                //echo 'File size too big, 1MB max size... ';
            } else {
                $uploadDarkOk = 1;
            }

            // UPLOAD FILE
            if ($uploadDarkOk == 0) {
                //echo 'Error, stopped... ';
            }
            else {
                // CHECK IF EXISTS (OVERWRITE)
                if (file_exists($target_path)) {
                    unlink($target_path);
                }
                if (move_uploaded_file($_FILES["menulogo_dark"]["tmp_name"], $target_path)) {
                    // DEBUGGING
                    if ($print == true) {
                        echo 'error: ';
                        print_r($_FILES);
                    }
                }
                else {
                    // DEBUGGING
                    if ($print == true) {
                        echo 'error: ';
                        print_r($_FILES);
                    }
                }
            }

        }


        // ------ LOGO LIGHT ------
        if (isset($_FILES['menulogo_light'])) {

            //echo 'Started... ';
            // ASSIGN VARIABLES
            $displayid = current_user_id();
            $userid = current_user_id();

            // UPLOAD PATH & VALIDATION
            $fileData = pathinfo(basename($_FILES["menulogo_light"]["name"]));
            $fileName = 'cooperlogolight-63726' . $displayid . '.png';
            $target_path = ($_SERVER['DOCUMENT_ROOT'] . 'app/layouts/public/logos/' . $fileName);

            // FILE VALIDATION
            $file_type = $_FILES['menulogo_light']['type'];
            $file_size = $_FILES['menulogo_light']['size'];
            is_uploaded_file($_FILES['menulogo_light']['tmp_name']);

            $allowed = array("image/png", "png");
            if (!in_array($file_type, $allowed) && $file_size) {
                $_SESSION["Light Logo File"] = 'Only PNG files are allowed.';
                $uploadDarkOk = 0;
                //echo 'Only PNG files are allowed... ';
            }
            else if ($file_size > 1000000 && $file_size) {
                $_SESSION["Light Logo Size"] = 'File size too big, 1MB max size.';
                $uploadDarkOk = 0;
                //echo 'File size too big, 1MB max size... ';
            } else {
                $uploadDarkOk = 1;
            }

            // UPLOAD FILE
            if ($uploadDarkOk == 0) {
                //echo 'Error, stopped... ';
            }
            else {
                // CHECK IF EXISTS (OVERWRITE)
                if (file_exists($target_path)) {
                    unlink($target_path);
                }
                if (move_uploaded_file($_FILES["menulogo_light"]["tmp_name"], $target_path)) {
                    // DEBUGGING
                    if ($print == true) {
                        echo 'error: ';
                        print_r($_FILES);
                    }
                }
                else {
                    // DEBUGGING
                    if ($print == true) {
                        echo 'error: ';
                        print_r($_FILES);
                    }
                }
            }

        }


        // ------ BUG CHECKING ------
        if ($print == true) {
            print_r($whitelabel_action);
        }

        // ------ MESSAGE/ACTION ------
        $_SESSION["Your Settings"] = 'Settings updated.';
        ?><script>window.location.href = "profile.php?tab=yoursettings";</script><?php

    }

    if (isset($_POST['whitelabel_removedark'])) {
        $darklocation = $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogodark-63726' . current_user_id() . '.png';
        //echo 'Running Dark Removal... ';
        unlink($darklocation);
    }

    if (isset($_POST['whitelabel_removelight'])) {
        $lightlocation = $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogolight-63726' . current_user_id() . '.png';
        //echo 'Running Light Removal... ';
        unlink($lightlocation);
    }

}