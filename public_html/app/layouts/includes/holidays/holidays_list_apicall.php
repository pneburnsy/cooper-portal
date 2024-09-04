<?php

// --- API START ---

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://app.timetastic.co.uk/api/holidays");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
$headers = [
    "Authorization: Bearer d82ed028-0b6f-4715-8c07-0d880a961a9d"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$holidaysfinal = json_decode($result, true);
curl_close($ch);

for ($q = 2; $q < 6; $q++) {

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://app.timetastic.co.uk/api/holidays?pagenumber=" . $q++);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    $headers = [
        "Authorization: Bearer d82ed028-0b6f-4715-8c07-0d880a961a9d"
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    $nextpageholidays = json_decode($result, true);
    $holidaysfinal['holidays'] = array_merge($holidaysfinal['holidays'], $nextpageholidays['holidays']);

    if (!$nextpageholidays['nextPageLink']) {
        //echo 'int' . $q;
        $q = 5;
    }

    curl_close($ch);

}

// --- API END ---

/*
?><pre><?php
print_r( $resultfinal );
?></pre><?php
*/