<?php

//Includes
include 'qrapi_generate_call.php';

if (isset($_GET['data'])) {

    $apicall = generate_qr_api_call();

    ?><img width="500" height="500" src="<?= $apicall ?>"><?php
    echo $apicall;

} else {
    echo 'Nope!';
}