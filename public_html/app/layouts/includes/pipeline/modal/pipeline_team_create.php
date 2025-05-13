<?php global $all_cooper_users; ?> <!-- Call Global Variable from Function -->
<?php if (doif_coopereditoronly_query()) { ?>
    <button class="btn btn-primary btn-create mb-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#pipeline_add" aria-controls="offcanvasRight">Add Deal +</button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="pipeline_add" aria-labelledby="offcanvasRightLabel">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add Deal</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="add_accounts" method="post">
                <div class="modal-top">

                    <label for="name" class="modal_label mb-2">Name *</label>
                    <input name="name" maxlength="80" type="text" class="modal_input" id="name" placeholder="Name Deal..." required>

                    <label for="desc" class="modal_label mb-2">Description</label>
                    <textarea name="desc" class="modal_input" id="desc" placeholder="More information on this deal..."></textarea>

                    <!--<div class="form-12 mb-3">-->
                    <!--    <label for="category" class="model_label">Category *</label>-->
                    <!--    <select name="category" class="form-control modal_input" data-trigger id="category">-->
                    <!--        --><?php //include 'dropdowns/pipeline_categories.php'; ?>
                    <!--    </select>-->
                    <!--</div>-->

                    <div class="form-12 mb-3">
                        <?php get_users_with_roles(); ?>
                        <label for="assignee" class="modal_label">Assigned To</label>
                        <select name="assignee" class="form-control modal_input" data-trigger id="assignee"><option value="<?= current_user_id() ?>">Myself: <?= current_user_fullname(); ?></option>
                            <?php foreach($all_cooper_users as $user) {
                                ?><option value="<?= $user->ID ?>"><?= $user->display_name ?></option><?php
                            } ?>
                        </select>
                    </div>

                    <div class="form-12 mb-3">
                        <label for="make" class="modal_label">Manufacturer</label>
                        <select name="make" class="form-control modal_input" data-trigger id="make">
                            <option value="" selected>None</option>
                            <?php include 'dropdowns/manufacturers.php'; ?>
                        </select>
                    </div>
                    
                    <div class="form-12 mb-3">
                        <label for="region" class="model_label">Region *</label>
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
                        <div class="form-12 mb-3">
                            <label for="priority" class="model_label">Priority</label>
                            <select name="priority" class="form-control modal_input" data-trigger id="priority">
                                <option value="0">None</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                                <option value="4">Urgent</option>
                            </select>
                        </div>
                        <div class="form-12 lastchild mb-3">
                            <label for="percentage" class="modal_label mb-2">Probability (%) *</label>
                            <input name="percentage" max="100" min="0" step="5" value="50" type="number" class="modal_input" id="percentage" placeholder="50" required>
                        </div>
                    </div>

                    <div class="form-12 lastchild mb-3">
                        <label for="total_quote" class="modal_label mb-2">Total Quote *</label>
                        <input name="total_quote" min="0" step="0.01" type="number" class="modal_input" id="total_quote" placeholder="£1,000,000,00" required>
                    </div>

                    <div class="form-12 lastchild">
                        <label for="close_date" class="modal_label">Close Date *</label>
                        <input name="close_date" type="date" class="modal_input" id="close_date" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                    <button type="submit" name="pipeline_add" class="btn btn-primary waves-effect waves-light">Add Deal</button>
                </div>

            </form>
        </div>
    </div>
<?php } ?>