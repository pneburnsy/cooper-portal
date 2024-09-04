<?php

/*
 * @DOCUMENT
 *
 * @FUNCTIONS
 * renewal_due_check()
 * renewal_due_check_advanced()
 * renewal_is_uncompleted()
 * renewal_is_completed()
 * renewal_is_bin()
 * 
 */

function renewal_due_check($date) {
    if ($date <= date('Y-m-d', strtotime('0 days'))) {
        return array(
            'class' => 'overdue',
            'name' => 'Overdue',
            'name_rentals' => 'Hire Ended',
            'sort' => 1
        );
    } elseif ($date < date('Y-m-d', strtotime('+30 days'))) {
        return array(
            'class' => 'duesoon',
            'name' => 'Due Soon',
            'name_rentals'  => 'Ending Soon',
            'sort' => 2
        );
    } else {
        return array(
            'class' => 'notdue',
            'name' => 'Not Due',
            'name_rentals'  => 'On-Hire',
            'sort' => 4
        );
    }
}

function renewal_due_check_advanced($startDate, $endDate) {
    if ($startDate && !$endDate) {
        return array(
            'class' => 'duesoon',
            'name' => 'Attention',
            'name_rentals' => 'Attention',
            'sort' => 2
        );
    }
    if ($startDate <= date('Y-m-d')) {
        if ($endDate > date('Y-m-d', strtotime('+30 days'))) {
            return array(
                'class' => 'notdue',
                'name' => 'Not Due',
                'name_rentals' => 'On-Hire',
                'sort' => 4
            );
        } elseif ($endDate <= date('Y-m-d')) {
            return array(
                'class' => 'overdue',
                'name' => 'Overdue',
                'name_rentals' => 'Hire Ended',
                'sort' => 1
            );
        } else {
            return array(
                'class' => 'duesoon',
                'name' => 'Due Soon',
                'name_rentals' => 'Ending Soon',
                'sort' => 3
            );
        }
    } else {
        return array(
            'class' => 'notstarted',
            'name' => 'Scheduled',
            'name_rentals' => 'Scheduled',
            'sort' => 5
        );
    }
}


function renewal_is_uncompleted() {
    if (isset($_GET['page']) == false) {
        return true;
    } else {
        return false;
    }
}

function renewal_is_completed() {
    if (isset($_GET['page']) == true) {
        if ($_GET['page'] == 'completed') {
            return true;
        } else {
            return false;
        }
    }
}

function renewal_is_bin() {
    if (isset($_GET['page']) == true) {
        if ($_GET['page'] == 'bin') {
            return true;
        } else {
            return false;
        }
    }
}