<?php

function safestring($value) {
  return strip_tags(filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW));
}

function safeinteger($value) {
  return strip_tags(preg_replace('/[^0-9]/', '', $value));
}

function safefloat($value) {
  return strip_tags(filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
}

function safeemail($value) {
  return strip_tags(filter_var($value, FILTER_VALIDATE_EMAIL));
}

function safeurl($value) {
  return strip_tags(filter_var($value, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED));
}

function safe($value){
  return htmlspecialchars($value);
}
