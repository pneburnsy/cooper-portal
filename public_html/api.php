<?php

// API

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://app.timetastic.co.uk/api/users");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);

$headers = [
  "Authorization: Bearer d82ed028-0b6f-4715-8c07-0d880a961a9d"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);

curl_close($ch);

echo $result;
