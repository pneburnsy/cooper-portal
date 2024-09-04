<?php
function get_date_time() {
    $date = date('Y-m-d H:i:s');
    return $date;
}
function formatted_date($value) {
    $date = date('d/m/Y', strtotime($value));
    return $date;
}
function formatted_time($value) {
    $date = date('H:i', strtotime($value));
    return $date;
}
function formatted_date_time($value) {
    $date = date('d/m/Y H:i', strtotime($value));
    return $date;
}
function formatted_renewal_date($value) {
    $date = date('d F Y', strtotime($value));
    return $date;
}
function formatted_renewal_date_day($value) {
    $date = date('l dS F Y', strtotime($value));
    return $date;
}
function daydiff($date1, $date2) {
    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / 86400));
}
function getStartAndEndDateOfWeek($weekYear) {
    list($weekNumber, $year) = explode(' ', $weekYear);
    $startOfWeek = new DateTime();
    $startOfWeek->setISODate($year, $weekNumber);
    $endOfWeek = clone $startOfWeek;
    $endOfWeek->modify('+6 days');
    $startDate = $startOfWeek->format('Y-m-d');
    $endDate = $endOfWeek->format('Y-m-d');
    return array(
        'start_date' => $startDate,
        'end_date' => $endDate,
    );
}
function timeAgo($datetime) {
    $time = strtotime($datetime);
    $time_difference = time() - $time;
    if ($time_difference < 1) {
        return 'Just Now';
    }
    $condition = array(
        12 * 30 * 24 * 60 * 60 => 'Year',
        30 * 24 * 60 * 60 => 'Month',
        7 * 24 * 60 * 60 => 'Week',
        24 * 60 * 60 => 'Day',
        60 * 60 => 'Hour',
        60 => 'Minute',
        1 => 'Second'
    );
    foreach ($condition as $secs => $str) {
        $d = $time_difference / $secs;
        if ($d >= 1) {
            $t = floor($d);
            return $t . ' ' . $str . ($t > 1 ? 's' : '') . ' Ago';
        }
    }
}
function daysUntilDate($endDate) {
    $today = new DateTime();
    $end = new DateTime($endDate);
    $interval = $today->diff($end);
    if ($end < $today) {
        return -$interval->days;
    } else {
        return $interval->days;
    }
}