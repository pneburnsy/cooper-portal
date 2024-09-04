<?php

$fmt = new NumberFormatter('en_GB', NumberFormatter::CURRENCY);

function form_currency($value) {
    ?><span class="<?php if ($value <= 0) { echo 'negative'; } else { echo 'positive'; }?>"><?php
        echo '£' . number_format($value, 2, '.', ',');
    ?></span><?php
}
function form_number($value) {
    ?><span class="value"><?php
        echo '£' . number_format($value, 2, '.', ',');
    ?></span><?php
}

// || $value.amount <= 0.00