<!-- Filter Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="survey_add" aria-labelledby="offcanvasRightLabel">

    <!-- Filters -->
    <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Deal Filters</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="col-12">
            <div>
                <div class="modal-filters gap-2">
                    <!--<div class="me-4" style="min-width: 120px">-->
                    <!--    <label for="status" class="modal_label">Status</label>-->
                    <!--    <select name="status" class="form-control modal_input" data-trigger id="status">-->
                    <!--        <option value="">All Deals</option>-->
                    <!--        <option value="0">Open Deals</option>-->
                    <!--        <option value="1">Won Deals</option>-->
                    <!--        <option value="2">Lost Deals</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="filter-mobile mb-3">
                        <label for="account" class="modal_label">Account</label>
                        <select name="account" class="form-control modal_input" data-trigger id="account">
                            <?php if (isset($_GET['account']) && $_GET['account']) {
                                $selected_account = htmlspecialchars($_GET['account'], ENT_QUOTES);
                                $selected_account_name = array_filter($accounts_team_distinct, function($acc) use ($selected_account) {
                                    return $acc->displayid == $selected_account;
                                });
                                $selected_account_name = reset($selected_account_name);current_user_fullname
                                ?>
                                <option value="<?= $selected_account ?>" selected>
                                    Current: <?= $selected_account_name->accountname ?? 'Unknown Account' ?>
                                </option>
                                <option value="">All</option>
                            <?php } else { ?>
                                <option value="" selected>Select Account...</option>
                            <?php } ?>
                            <?php foreach ($accounts_team_distinct as $account) { ?>
                                <option value="<?= $account->displayid; ?>"><?= $account->accountname; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php
                    $table_proposals = $wpdb->prefix . 'pipeline_proposals';
                    $deal_creators = $wpdb->get_results("SELECT DISTINCT user_id FROM {$table_proposals} WHERE user_id IS NOT NULL ORDER BY user_id ASC");
                    ?>
                    <div class="filter-mobile mb-3">
                        <label for="creator" class="modal_label">Created By</label>
                        <select name="creator" class="form-control modal_input" data-trigger id="creator">
                            <?php
                            $selected_creator = isset($_GET['creator']) && $_GET['creator'] ? htmlspecialchars($_GET['creator'], ENT_QUOTES) : "";
                            if ($selected_creator !== "") {
                                $user = get_userdata($selected_creator);
                                ?>
                                <option value="<?= $selected_creator ?>" selected>
                                    Current: <?= $user ? esc_html($user->display_name) : 'Unknown User' ?>
                                </option>
                                <option value="">All</option>
                            <?php } else { ?>
                                <option value="" selected>Select Creator...</option>
                            <?php } ?>
                            <?php
                            if (!empty($deal_creators)) {
                                foreach ($deal_creators as $creator) {
                                    $user = get_userdata($creator->user_id);
                                    if ($user) {
                                        echo '<option value="' . esc_attr($creator->user_id) . '">' . esc_html($user->display_name) . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

<!--                Assignee Filter Details-->

                    <?php
                    $deal_assignees = $wpdb->get_results("SELECT DISTINCT assignee FROM {$table_proposals} WHERE assignee IS NOT NULL ORDER BY assignee ASC");
                    ?>
                    <div class="filter-mobile mb-3">
<!--                        --><?php //get_users_with_roles(); ?>
                        <label for="assignee" class="modal_label">Assigned To</label>
                        <select name="assignee" class="form-control modal_input" data-trigger id="assignee-filter">
                            <?php
                            $selected_assignee = isset($_GET['assignee']) && $_GET['assignee'] ? htmlspecialchars($_GET['assignee'], ENT_QUOTES) : "";
//                            $selected_assignee = isset($_GET['assignee']) ? (int) $_GET['assignee'] : "";
                            if ($selected_assignee !== "") {
                                $user = get_userdata($selected_assignee);
                                ?>
                                <option value="<?= $selected_assignee ?>" selected>
                                    Current: <?= $user ? esc_html($user->display_name) : "Unknown User" ?>
                                </option>
                                <option value="">All</option>
                            <?php } else { ?>
                                <option value="" selected>Select Assignee...</option>
                            <?php } ?>
                            <?php
                            if (!empty($deal_assignees) ) {
                                foreach ($deal_assignees as $assignee) {
                                    $user = get_userdata($assignee->assignee);
                                    if ($user) {
                                        echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
                                    }

                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Date Filters</h6>
                        </div>
                        <div class="filter-mobile mb-3">
                            <label for="start_date" class="modal_label">Created From</label>
                            <input name="start_date" value="<?= isset($_GET['created_from']) ? htmlspecialchars($_GET['created_from'], ENT_QUOTES) : ''; ?>" type="date" class="modal_input mb-0" id="created_from">
                        </div>
                        <div class="filter-mobile mb-3">
                            <label for="start_date" class="modal_label">Created To</label>
                            <input name="start_date" value="<?= isset($_GET['created_to']) ? htmlspecialchars($_GET['created_to'], ENT_QUOTES) : ''; ?>" type="date" class="modal_input mb-0" id="created_to">
                        </div>
                    </div>
                    <div class="modal-card">
                        <div class="modal-card-header">
                            <h6>Closed Date Filters</h6>
                        </div>
                        <?php
                        $selected_close_date = isset($_GET['close_date_filter']) && $_GET['close_date_filter'] ? htmlspecialchars($_GET['close_date_filter'], ENT_QUOTES) : "";
                        ?>
                        <div class="filter-mobile mb-3">
                            <label for="close_date_filter" class="modal_label">Close Date</label>
                            <select name="close_date_filter" class="form-control modal_input" data-trigger id="close_date_filter">
                                <?php if ($selected_close_date !== "") { ?>
                                    <option value="<?= $selected_close_date ?>" selected>
                                        Current: <?= ucwords(str_replace('_', ' ', $selected_close_date)) ?>
                                    </option>
                                    <option value="">All</option>
                                <?php } else { ?>
                                    <option selected>All</option>
                                <?php } ?>
                                <option value="overdue">Overdue</option>
                                <option value="not_due">Not Due</option>
                                <option value="not_set">Not Set</option>
                            </select>
                        </div>
                        <div class="filter-mobile mb-3">
                            <label for="closed_from" class="modal_label">Closed Date From</label>
                            <input name="closed_from" value="<?= isset($_GET['closed_from']) ? htmlspecialchars($_GET['closed_from'], ENT_QUOTES) : ''; ?>" type="date" class="modal_input mb-0" id="closed_from">
                        </div>
                        <div class="filter-mobile mb-3">
                            <label for="closed_to" class="modal_label">Closed Date To</label>
                            <input name="closed_to" value="<?= isset($_GET['closed_to']) ? htmlspecialchars($_GET['closed_to'], ENT_QUOTES) : ''; ?>" type="date" class="modal_input mb-0" id="closed_to">
                        </div>
                    </div>
                </div>

                <?php
                $deal_manufacturer = $wpdb->get_results("SELECT DISTINCT make FROM {$table_proposals} WHERE make IS NOT NULL ORDER BY make ASC");
                ?>
                <div class="filter-mobile mb-3">
                    <label for="dealmake" class="modal_label">Manufacturer</label>
                    <select name="dealmake" class="form-control modal_input" data-trigger id="dealmake">
                        <?php
                        $selected_make = isset($_GET['make']) && $_GET['make'] ? htmlspecialchars($_GET['make'], ENT_QUOTES) : "";

                        if ($selected_make !== "") {
                            $make = htmlspecialchars($selected_make);
                            ?>
                            <option value="<?= $selected_make ?>" selected>
                                Current: <?= $selected_make ?>
                            </option>
                            <option value="all">All</option>
                        <?php } else { ?>
                            <option value="all" selected>Select Manufacturer...</option>
                        <?php } ?>
                        <?php
                        if (!empty($deal_manufacturer) ) {
                            foreach ($deal_manufacturer as $manufacturer) {
//                                $make = get_userdata($manufacturer->make);
//                                if ($make) {
                                    echo '<option value="' . esc_attr($manufacturer->make) . '">' . esc_html($manufacturer->make) . '</option>';
//                                }
                            }
                        } ?>
                    </select>
                </div>

                    <div class="filter-mobile mb-3">
                        <label for="priority" class="modal_label">Priority</label>
                        <select name="priority" class="form-control modal_input" data-trigger id="priority">
                            <?php
                            if (isset($_GET['priority'])) {
                                $priority = htmlspecialchars($_GET['priority'], ENT_QUOTES);
                                $priorityNames = [
                                    '4' => 'Urgent',
                                    '3' => 'High',
                                    '2' => 'Medium',
                                    '1' => 'Low',
                                    '0' => 'None',
                                    'all' => 'All'
                                ];
                                $priorityName = isset($priorityNames[$priority]) ? $priorityNames[$priority] : 'Unknown';
                                ?>
                                <option selected value="<?= $priority ?>">Current: <?= $priorityName ?></option>
                            <?php } ?>
                            <option value="all">All</option>
                            <option value="4">Urgent</option>
                            <option value="3">High</option>
                            <option value="2">Medium</option>
                            <option value="1">Low</option>
                            <option value="0">None</option>
                        </select>
                    </div>
                    <div class="filter-mobile mb-3">
                        <label for="probability" class="modal_label">Probability</label>
                        <select name="probability" class="form-control modal_input" data-trigger id="probability">
                            <?php
                            if (isset($_GET['probability'])) {
                                $probability = htmlspecialchars($_GET['probability'], ENT_QUOTES);
                                $probabilityNames = [
                                    'all' => 'All',
                                    '0-50' => '50% and Under',
                                    '50-90' => '50% to 90%',
                                    '90-100' => '90% and Above',
                                ];
                                $probabilityName = isset($probabilityNames[$probability]) ? $probabilityNames[$probability] : 'Unknown';
                                ?>
                                <option selected value="<?= $probability ?>">Current: <?= $probabilityName ?></option>
                            <?php } ?>
                            <option value="all">All</option>
                            <option value="0-50">50% and Under</option>
                            <option value="50-90">50% to 90%</option>
                            <option value="90-100">90% and Above</option>
                        </select>
                    </div>
                    <div class="filter-mobile mb-3">
                        <label for="region" class="modal_label">Regions</label>
                        <select name="region" class="form-control modal_input" data-trigger id="region">
                            <?php
                            if (isset($_GET['region'])) {
                                $region = htmlspecialchars($_GET['region'], ENT_QUOTES);
                                $regionName = ($region === '0') ? 'Mainland UK' : (($region === '1') ? 'Ireland' : 'All');
                                ?>
                                <option selected value="<?= $region ?>">Current: <?= $regionName ?></option>
                            <?php } ?>
                            <option value="all">All</option>
                            <option value="0">Mainland UK</option>
                            <option value="1">Ireland</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-filter waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
                        <button class="btn btn-primary btn-filter" id="update-filter">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>