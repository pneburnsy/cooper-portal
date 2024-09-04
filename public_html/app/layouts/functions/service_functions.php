<?php

function hours_due_in($hours, $date) {
    global $renewal_date;
    $renewal_date = date('Y-m-d', strtotime($date));

    global $service_status;
    if ($hours <= 0 || $renewal_date <= date('Y-m-d', strtotime('0 days'))) {
        $service_status = array(
            'class' => 'overdue',
            'name' => 'Overdue',
            'name_service' => 'Service Overdue',
            'sort' => 1
        );
    } elseif ($hours <= 100 || $renewal_date < date('Y-m-d', strtotime('+30 days'))) {
        $service_status = array(
            'class' => 'duesoon',
            'name' => 'Due Soon',
            'name_service'  => 'Due Soon',
            'sort' => 2
        );
    } else {
        $service_status = array(
            'class' => 'notdue',
            'name' => 'Not Due',
            'name_service'  => 'Not Due',
            'sort' => 4
        );
    }
}

function hours_until_service($serviceduein, $start, $current) {
    $servicedueat = $start + $serviceduein;
    $servicehoursremaining = $servicedueat - $current;
    return $servicehoursremaining;
}

function postcode_city_convert($postcode) {
    $nospace_postcode = str_replace(' ', '', $postcode);
    $api_url = 'http://www.geonames.org/postalCodeLookupJSON?country=GB&postalcode=' . $nospace_postcode;

    global $this_postcode_data;
    $this_postcode_data = wp_remote_get($api_url);
    
    $convert_postcode_decode = json_decode($this_postcode_data['body']);
    $this_city = $convert_postcode_decode->postalcodes[0]->placeName;
    return $this_city;

}