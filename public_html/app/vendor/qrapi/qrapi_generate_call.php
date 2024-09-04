<?php

/*
 *
 * QR Hub - QR Generation API
 * @link https://goqr.me/api/
 *
 * @param 'action' optional
 * @example 'create/read' - Two possible values, defaults to create.
 *
 * @param 'data' mandatory
 * @example 'https://www.theurl.co.uk/thisurl/' - The content/url you want to turn into a QR code.
 *
 * @param 'size' optional
 * @example '150x150' - Height and width dimensions accepted, defaults to 1000x1000.
 *
 * @param 'color' optional
 * @example '000000' - HEX Color of the QR code generated, defaults to black.
 *
 * @param 'bgcolor' optional
 * @example '000000' - HEX Background color of the qr code, defaults to white.
 *
 * @param 'margin' optional
 * @example '10' - Sets a border around the QR code, always stays the same color as 'bgcolor', defaults to 0.
 * @param 'format' optional
 * @example 'png/gif/jpeg/jpg/svg/eps' - Selects file format, defaults to PNG.
 *
 */

function generate_qr_api_call() {

    if (isset($_GET['data'])) {

        // Action parameter
        if ($_GET['action'] == 'read') {
            $qrapicall = 'https://api.qrserver.com/v1/read-qr-code/?';
        } else {
            $qrapicall = 'https://api.qrserver.com/v1/create-qr-code/?';
        }

        // Data Paramenter - mandatory
        $qrapicall .= 'data=' . $_GET['data'] . '&charset-target=UTF-8&ecc=L';

        // Size parameter
        if ($_GET['size']) {
            $qrapicall .= '&size=' . $_GET['size'];
        } else {
            $qrapicall .= '&size=1000x1000';
        }

        // Color parameter
        if (isset($_GET['color'])) {
            $qrapicall .= '&color=' . $_GET['color'];
        }

        // Background Color parameter
        if ($_GET['bgcolor']) {
            $qrapicall .= '&bgcolor=' . $_GET['bgcolor'];
        }

        // Margin parameter
        if ($_GET['margin']) {
            $qrapicall .= '&margin=' . $_GET['margin'];
        }

        // Format parameter
        if ($_GET['format']) {
            $qrapicall .= '&format=' . $_GET['format'];
        }

        return $qrapicall;

    } else {

        return 'Invalid: Please try again.';

    }

}