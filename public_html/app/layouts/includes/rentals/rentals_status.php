<div id="renewal_status" class="card tab-pane <?php if ($_GET['tab'] == 'renewal_status') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Contract Status</h4>
                    <p class="mb-4">'Complete' the current contract to record its details historically for future reference. Alternatively, 'reset' the current contract to prepare the truck for another rental but without recording this data historically.</p>
                    <div class="d-inline-block">
                        <?php if ($rentals_view[0]->clientaccount) { ?>
                            <form class="form-inline" method="post">
                                <button type="submit" name="rentals_complete" class="btn btn-edit waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Complete - This will reset the equipment and log the current contract historically.">
                                    <i class="mdi mdi-check d-block font-size-16"></i> Complete
                                </button>
                            </form>
                        <?php } ?>
                        <form class="form-inline" method="post">
                            <button type="submit" name="rentals_reset" class="btn btn-warning waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset - This will reset the equipment and not log the current contract historically.">
                                <i class="mdi mdi-restore d-block font-size-16"></i> Reset
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>