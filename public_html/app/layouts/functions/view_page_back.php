<?php

function view_page_back($name, $link) {
    ?><div class="d-block mb-3 relative" style="height: 35px;">
        <a href="<?= $link ?>" class="absolute btn btn-primary btn-backto waves-effect waves-light" style="right:0px;">
            <i data-feather="arrow-left"></i> Back to <?= $name ?>
        </a>
    </div><?php
}