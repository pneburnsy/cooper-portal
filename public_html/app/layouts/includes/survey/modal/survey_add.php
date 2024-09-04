<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#survey_add" aria-controls="offcanvasRight">Send Survey +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="survey_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">New Survey</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <span class="d-block mb-4">Send an email to your chosen client below. They will receive an email with a unique link to the Cooper Survey. <strong>All submissions can be tracked.</strong></span>
            <form class="submit_survey" method="post">
                <div class="form-6">
                    <label for="your-name" class="modal_label">Clients Name *</label>
                    <input name="your-name" type="text" class="modal_input" id="your-name" placeholder="Full Name..." required>
                </div>
                <div class="form-6 lastchild">
                    <label for="your-email" class="modal_label">Clients Email *</label>
                    <input name="your-email" type="email" class="modal_input" id="your-email" placeholder="Email Address..." required>
                </div>
                <div class="form-12 mb-3">
                    <label for="region" class="modal_label">Region *</label>
                    <select name="region" class="form-control modal_input" data-trigger id="region">
                        <?php include 'dropdowns/regions.php'; ?>
                    </select>
                </div>
                <div class="modal-card">
                    <div class="modal-card-header">
                        <h6>Client Account</h6>
                    </div>
                    <div class="form-12 mb-3">
                        <select name="your-company" class="form-control modal_input" data-trigger id="your-company">
                            <option value="" selected>Select Account...</option>
                            <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-card">
                    <div class="modal-card-header">
                        <h6>Survey Email</h6>
                    </div>
                    <span class="d-block mb-4">Add some context to the email your customer will receive. It's important for your customer to know what you want feedback on.</span>
                    <div class="form-12 mb-3">
                        <label for="emailtitle" class="modal_label">Email Title</label>
                        <input name="emailtitle" type="text" class="modal_input" id="emailtitle" placeholder="Email Title..." maxlength="100">
                    </div>
                    <div class="form-12 mb-3">
                        <label for="emaildesc" class="modal_label mb-3">Email Description</label>
                        <span style="display:block; background-color: #fff; padding: 20px; border-radius: 4px;">
                            Hi [client_name],
                            <br><br>
                            [your_name] has invited you to fill in a service feedback survey - please provide honest answers as this helps us to constantly improve our services.
                            <br><br>
                            <textarea name="emaildesc" class="modal_input" id="emaildesc" placeholder="Your message..." maxlength="500"></textarea>
                        </span>

                    </div>
                </div>
                <div class="mb-3" style="display:none;">
                    <input name="displayid" value="<?= guid() ?>" type="text" class="modal_input" id="your-email" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="submitsurvey" class="btn btn-primary waves-effect waves-light">Send Survey</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>