<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'View Account';
include 'layouts/header.php';

// IMPORT QUERIES
$thisuser_account = get_user_meta($current_user->ID, 'account', true);
if ($_GET['displayid'] != $thisuser_account) {
    doif_cooperadminonly(true, 'accounts');
}

accounts_team_view(false);
accounts_team_edit(false);
accounts_team_delete(false);
accounts_team_distinct(false);
accounts_team_user(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php
if (!$accounts_team_view[0]->displayid) {
    include 'layouts/security/security_access_to_page.php';
} else {
?>
    <?php if (doif_coopereditoronly_query()) {
        view_page_back('Accounts', '/app/page_accounts.php');
    } ?>
    <div class="card card-top section-block-mb2 section-block-p0 mb-4">
        <div class="card-body ">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                        <div class="flex-shrink-0">
                            <div class="avatar-xl me-3">
                                <span class="profile-image-big" style="background-color:rgba( <?= $accounts_team_view[0]->accountarray; ?> , 0.5)"><?= $accounts_team_view[0]->accountname[0]; ?></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1"><?= $accounts_team_view[0]->accountname; ?></h5>
                                <div class="account-details d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                    <div>
                                        <strong style="margin-right: 5px;">Phone: </strong>
                                        <?php if ( !$accounts_team_view[0]->accountphone ) { ?>
                                            <?php if (doif_cooperonly_query()) { ?>
                                                <a class="text-light account-add-details placeholder" href="/app/page_accounts_view.php?tab=accounts_settings&displayid=<?= $accounts_team_view[0]->displayid; ?>">
                                                    <span><i class="mdi mdi-pencil d-block font-size-14 mr-1"></i> Add Phone +</span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-light">N/A</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a class="text-light account-add-details" href="tel: <?= $accounts_team_view[0]->accountphone; ?>">
                                                <span> <?= $accounts_team_view[0]->accountphone; ?> </span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div>
                                        <strong style="margin-right: 5px;">Email: </strong>
                                        <?php if ( !$accounts_team_view[0]->accountemail ) { ?>
                                            <?php if (doif_cooperonly_query()) { ?>
                                                <a class="text-light account-add-details placeholder" href="/app/page_accounts_view.php?tab=accounts_settings&displayid=<?= $accounts_team_view[0]->displayid; ?>">
                                                    <span><i class="mdi mdi-pencil d-block font-size-14 mr-1"></i> Add Email +</span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-light">N/A</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a class="text-light account-add-details" href="mailto: <?= $accounts_team_view[0]->accountemail; ?>">
                                                <span> <?= $accounts_team_view[0]->accountemail; ?> </span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div>
                                        <strong style="margin-right: 5px;">Website: </strong>
                                        <?php if ( !$accounts_team_view[0]->accountwebsite ) { ?>
                                            <?php if (doif_cooperonly_query()) { ?>
                                                <a class="text-light account-add-details placeholder" href="/app/page_accounts_view.php?tab=accounts_settings&displayid=<?= $accounts_team_view[0]->displayid; ?>">
                                                    <span><i class="mdi mdi-pencil d-block font-size-14 mr-1"></i> Add Website +</span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-light">N/A</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a class="text-light account-add-details" href="http://<?= $accounts_team_view[0]->accountwebsite; ?>">
                                                <span> <?= $accounts_team_view[0]->accountwebsite; ?> </span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div>
                                        <strong style="margin-right: 5px;">Fleet Manager: </strong>
                                        <?php if ( !$accounts_team_view[0]->fleetmanager ) { ?>
                                            <?php if (doif_cooperonly_query()) { ?>
                                                <a class="text-light account-add-details placeholder" href="/app/page_accounts_view.php?tab=accounts_settings&displayid=<?= $accounts_team_view[0]->displayid; ?>">
                                                    <span><i class="mdi mdi-pencil d-block font-size-14 mr-1"></i> Add Fleet Manager +</span>
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-light">N/A</span>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <a class="text-light account-add-details" href="mailto:<?= $accounts_team_view[0]->fleetmanager; ?>">
                                                <span> <?= other_user_fullname(other_convert_displayid($accounts_team_view[0]->fleetmanager)) ?> </span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                    <div style="margin:auto;"></div>
                                    <div>
                                        <?php if ($accounts_team_view[0]->displayid != 'd872f682e8b2ebe862c09ad6ab78764e' && $accounts_team_view[0]->displayid != 'afee0185a38e00ad4180f29674140ba9') {
                                            if ( current_user_can( 'administrator' ) ) {
                                                include 'layouts/includes/accounts/modal/accounts_team_delete.php';
                                            }
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                <?php if (doif_cooperonly_query()) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'account_user') { echo 'active'; } ?>" data-bs-toggle="tab" href="#user" role="tab">
                            <i data-feather="user"></i>Contacts (<?= accounts_team_users_count( $_GET['displayid'], false ); ?>)
                        </a>
                    </li>
                <?php } ?>
                <?php if (doif_cooperonly_query()) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if (!$_GET['tab']) { echo 'active'; } ?>" data-bs-toggle="tab" href="#overview" role="tab">
                            <i data-feather="check-square"></i>Surveys (<?= accounts_team_survey_count( $_GET['displayid'], false ); ?>)
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'account_maintenance') { echo 'active'; } ?>" data-bs-toggle="tab" href="#maintenance" role="tab">
                        <i data-feather="list"></i>Maintenance (<?= accounts_team_maintenance_count( $_GET['displayid'], false ); ?>)
                    </a>
                </li>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'account_rentals') { echo 'active'; } ?>" data-bs-toggle="tab" href="#rentals" role="tab">
                        <i data-feather="list"></i>Rentals (<?= accounts_team_rentals_count( $_GET['displayid'], false ); ?>)
                    </a>
                </li>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'account_exam') { echo 'active'; } ?>" data-bs-toggle="tab" href="#exam" role="tab">
                        <i data-feather="list"></i>Thorough Examinations (<?= accounts_team_exam_count( $_GET['displayid'], false ); ?>)
                    </a>
                </li>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'account_service') { echo 'active'; } ?>" data-bs-toggle="tab" href="#service" role="tab">
                            <i data-feather="book"></i>Service Contract (<?= accounts_team_service_contracts_count( $_GET['displayid'], false ); ?>)
                        </a>
                    </li>
                <?php } ?>
                <?php if (doif_cooperonly_query()) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'accounts_settings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#accounts_settings" role="tab">
                            <i data-feather="settings"></i>Settings
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php if (doif_cooperonly_query()) { ?>
            <?php include 'layouts/includes/accounts/accounts_user.php'; ?>
        <?php } ?>
        <?php if (doif_cooperonly_query()) { ?>
            <?php include 'layouts/includes/accounts/accounts_overview.php'; ?>
        <?php } ?>
        <?php include 'layouts/includes/accounts/accounts_maintenance.php'; ?>
        <?php include 'layouts/includes/accounts/accounts_rentals.php'; ?>
        <?php include 'layouts/includes/accounts/accounts_exam.php'; ?>
        <?php if ( current_user_can( 'administrator' ) ) { ?>
            <?php include 'layouts/includes/accounts/accounts_service.php'; ?>
        <?php } ?>
        <?php if (doif_cooperonly_query()) { ?>
            <?php include 'layouts/includes/accounts/accounts_settings.php'; ?>
        <?php } ?>
    </div>
<?php
}
?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
