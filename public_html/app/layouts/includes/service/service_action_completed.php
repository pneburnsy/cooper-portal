<?php if (doif_coopereditoronly_query()) { ?>
    <form method="post" class="form-inline">
        <button class="btn btn-edit waves-effect waves-light" type="submit" name="service_uncomplete" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-restore d-block font-size-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Uncomplete"></i>
        </button>
    </form>
<?php } ?>
<?php if ( current_user_can('administrator') ) { ?>
    <form method="post" class="form-inline">
        <button class="btn btn-danger waves-effect waves-light" type="submit" name="service_bin" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-trash-can d-block font-size-16" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
        </button>
    </form>
<?php } ?>