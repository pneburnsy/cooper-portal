<?php if (doif_cooperonly_query()) { ?>
    <a  class="text-light" href="page_service_contract_view?displayid=<?= $variable[$i]->displayid; ?>">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="btn btn-primary waves-effect waves-light" type="submit">
            <i class="mdi mdi-eye d-inline-block font-size-16"></i>
        </button>
    </a>
<?php } ?>
<?php if (doif_coopereditoronly_query()) { ?>
    <a class="text-light" href="page_service_contract_view?tab=service_settings&displayid=<?= $variable[$i]->displayid; ?>">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
            <i class="mdi mdi-pencil d-block font-size-16"></i>
        </button>
    </a>
    <a class="text-light" href="page_service_contract_view?tab=service_submissions&displayid=<?= $variable[$i]->displayid; ?>">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Record Service" class="btn btn-edit waves-effect waves-light" type="submit">
            <i class="mdi mdi-progress-wrench d-block font-size-16"></i>
        </button>
    </a>
<?php } ?>
<?php if ( current_user_can('administrator') ) { ?>
    <form method="post" class="form-inline">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Complete (Complete if this service contract is complete and no longer required, otherwise 'record service' instead)." class="btn btn-edit waves-effect waves-light" type="submit" name="service_complete" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-archive-outline d-block font-size-16"></i>
        </button>
    </form>
    <form method="post" class="form-inline">
        <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="service_bin" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-trash-can d-block font-size-16"></i>
        </button>
    </form>
<?php } ?>