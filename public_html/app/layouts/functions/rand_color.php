<?php

function rand_color_part() {
    return mt_rand( 0, 255 );
}
function rand_color() {
    return rand_color_part() . ', ' . rand_color_part() . ', '. rand_color_part();
}