<div id="yoursettings" class="card tab-pane <?php if ($_GET['tab'] == 'yoursettings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-12 p-0">
                <form class="update_accounts" method="post" enctype="multipart/form-data">
                    <div class="form-highlight">
                        <h4>Your Settings</h4>
                        <p class="mb-4">Adjust your account settings here.</p>
                        <div class="form-block">
                            <h5 class="modal_label">Dashboard Colors</h5>
                            <label class="d-inline-block" style="margin-right:10px !important;width:fit-content;">Would you like to use Light Mode or Dark Mode for the menu? (Default is Dark Mode)</label>
                            <div class="d-inline-block flex-wrap gap-2" style="top: 16px;position: relative;">
                                <input name="menu_color" type="checkbox" id="switch1" switch="none" value="checked" <?php if ( !whitelabel_single(false) || whitelabel_single(false) == 'dark' ) { echo 'checked'; } ?>>
                                <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                            </div>
                            <div class="color-picker-block d-flex mt-4">
                                <div class="col_block col_block_1">
                                    <label for="example-color-input" class="form-label">Primary Color</label>
                                    <input type="color" name="menu_primary" class="form-control form-control-color" id="example-color-input" value="<?php if ( !$whitelabel_view->menuprimary ) { echo '#3695c5'; } else { echo $whitelabel_view->menuprimary; } ?>" title="Choose Your Color...">
                                </div>
                            </div>
                        </div>
                        <div class="form-block">
                            <h5 class="modal_label">Dashboard Branding</h5>
                            <label class="mb-4">Add your own branding to the dashboard by uploading it below (Must be file format PNG and no bigger than 500kb). Please refresh the page if the new logo does not appear straight away.</label>
                            <br>
                            <div class="form-6 mt-4">
                                <h6 class="modal_label">Dark Logo</h6>
                                <div class="upload-box" style="padding: 30px !important;">
                                    <div class="dz-message needsclick">
                                        <?php
                                        $logodark =  $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogodark-63726' . current_user_id() . '.png';
                                        if (file_exists($logodark)) {
                                            ?><div class="logo_example mb-5">
                                                <button type="submit" name="whitelabel_removedark" class="btn btn-primary waves-effect waves-light mt-4" style="display:block;">Remove</button>
                                                <img src="<?= '/app/layouts/public/logos/cooperlogodark-63726' . current_user_id() . '.png'; ?>" alt="" height="45"> <span class="logo-txt"></span>
                                            </div><?php
                                        }
                                        ?>
                                        <h6 class="mb-3">Drop your image below or click to 'choose file'.</h6>
                                    </div>
                                    <div class="fallback">
                                        <input name="menulogo_dark" type="file">
                                    </div>
                                </div>
                            </div>
                            <div class="form-6 lastchild mt-4">
                                <h6 class="modal_label">Light Logo</h6>
                                <div class="upload-box" style="padding: 30px !important;">
                                    <div class="dz-message needsclick">
                                        <?php
                                        $logolight =  $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogolight-63726' . current_user_id() . '.png';
                                        if (file_exists($logolight)) {
                                            ?><div class="logo_example mb-5">
                                                <button type="submit" name="whitelabel_removelight" class="btn btn-primary waves-effect waves-light mt-4" style="display:block;">Remove</button>
                                                <img src="<?= '/app/layouts/public/logos/cooperlogolight-63726' . current_user_id() . '.png'; ?>" alt="" height="45"> <span class="logo-txt"></span>
                                            </div><?php
                                        }
                                        ?>
                                        <h6 class="mb-3">Drop your image below or click to 'choose file'.</h6>
                                    </div>
                                    <div class="fallback">
                                        <input name="menulogo_light" type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="whitelabel_edit" class="btn btn-primary waves-effect waves-light mt-4" style="display:block;">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>