<?php if (doif_cooperonly_query()) { ?>
    <a  class="text-light" href="page_thorough_examinations_view?displayid=<?= $variable[$i]->displayid; ?>">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="View" class="btn btn-primary waves-effect waves-light" type="submit">
            <i class="mdi mdi-eye d-inline-block font-size-16"></i>
        </button>
    </a>
<?php } ?>
<?php if (doif_coopereditoronly_query()) { ?>
    <a class="text-light" href="page_thorough_examinations_view?tab=renewal_settings&displayid=<?= $variable[$i]->displayid; ?>">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
            <i class="mdi mdi-pencil d-block font-size-16"></i>
        </button>
    </a>
    <form method="post" class="form-inline">
        <button data-bs-toggle="tooltip" data-bs-placement="top" title="Complete" class="btn btn-edit waves-effect waves-light" type="submit" name="exam_complete" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-check d-block font-size-16"></i>
        </button>
    </form>
<?php } ?>
<?php if ( current_user_can('administrator') ) { ?>
    <form method="post" class="form-inline">
        <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="exam_bin" value="<?= $variable[$i]->displayid; ?>">
            <i class="mdi mdi-trash-can d-block font-size-16"></i>
        </button>
    </form>
<?php } ?>