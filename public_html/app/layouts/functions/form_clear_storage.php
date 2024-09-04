<?php

function form_clear_storage(){
    echo '
    <div>
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Clear any saved searches or filters applied to this table." class="btn btn-light waves-effect waves-light" onclick="clearDataState()"> 
            Reset Search / Filters 
        </button >
        <script src="assets/js/cleardatasave.js"></script>
    </div> 
    ';
}