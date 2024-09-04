<?php

function clean_website_url($value) {
    $removeChar = ["https://", "http://", "/", "www."];
    $http_referer = str_replace($removeChar, "", $value);
    return $http_referer;
}