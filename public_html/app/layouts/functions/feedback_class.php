<?php
function feedback_class($value) {
    if ($value) {
        if ($value == 'Excellent') {
            echo 'feedback_5';
        } elseif ($value == 'Good') {
            echo 'feedback_4';
        } elseif ($value == 'Acceptable') {
            echo 'feedback_3';
        } elseif ($value == 'Not Acceptable') {
            echo 'feedback_2';
        } else {
            echo 'feedback_1';
        }
    }
}
function feedback_number($value) {
    if ($value == 'Excellent') {
        return '5';
    } elseif ($value == 'Good') {
        return '4';
    } elseif ($value == 'Acceptable') {
        return '3';
    } elseif ($value == 'Not Acceptable') {
        return '2';
    } else {
        return '1';
    }
}
function feedback_text($value) {
    if ($value == '5') {
        return 'Excellent';
    } elseif ($value == '4') {
        return 'Good';
    } elseif ($value == '3') {
        return 'Acceptable';
    } elseif ($value == '2') {
        return 'Not Acceptable';
    } else {
        return 'Unsure';
    }
}

?>