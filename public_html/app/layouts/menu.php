z<header id="page-topbar" class="<?= whitelabel_single(false) ?>">

    <div class="navbar-header">

        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <?php if ( whitelabel_single(false) == 'light' ) { ?>
                    <a href="/app/dashboard.php" class="logo">
                        <span>
                            <?php
                            $logodark =  $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogodark-63726' . current_user_id() . '.png';
                            if (file_exists($logodark)) {
                                ?><img src="<?= '/app/layouts/public/logos/cooperlogodark-63726' . current_user_id() . '.png'; ?>" alt="" height="45"> <span class="logo-txt"></span><?php
                            } else {
                                ?><img src="/app/assets/images/logo-lg-drk.svg" alt="" height="45"> <span class="logo-txt"></span><?php
                            }
                            ?>
                        </span>
                    </a>
                <?php } else { ?>
                    <a href="/app/dashboard.php" class="logo">
                        <span>
                            <?php
                            $logolight =  $_SERVER['DOCUMENT_ROOT'] . '/app/layouts/public/logos/cooperlogolight-63726' . current_user_id() . '.png';
                            if (file_exists($logolight)) {
                                ?><img src="<?= '/app/layouts/public/logos/cooperlogolight-63726' . current_user_id() . '.png'; ?>" alt="" height="45"> <span class="logo-txt"></span><?php
                            } else {
                                ?><img src="/app/assets/images/logo-lg-lgt.svg" alt="" height="45"> <span class="logo-txt"></span><?php
                            }
                            ?>
                        </span>
                    </a>
                <?php } ?>
            </div>
            <!-- BURGER MENU -->
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <!-- PROFILE -->
        <div class="d-flex help-menu">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <!--<a class="btn header-item" target="_blank" style="vertical-align:middle;display:contents;" href="https://cooperhandling.com/">-->
                <!--    <i data-feather="home" class="icon-lg"></i>-->
                <!--</a>-->
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="help-circle" class="icon-lg"></i><span style="font-weight: bold;font-size: 12px;margin-left: 5px;top: 1px;position: relative;">Help</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="page_faq.php">
                                    <img src="assets/images/faq.svg" alt="App FAQ">
                                    <span>Portal FAQ's</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="page_report_bug">
                                    <img width="100" src="assets/images/bug.svg" alt="Report a Bug">
                                    <span>Report a Bug</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="profile-image"><?php echo $current_user->first_name[0] . $current_user->last_name[0]; ?></span>
                    <span class=" d-xl-inline-block ms-1 fw-medium"><?php $users_name = $current_user->first_name . ' ' . $current_user->last_name; echo $users_name; ?></span>
                    <i class="mdi mdi-chevron-down d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end profile-menu">
                    <a class="dropdown-item" href="/app/profile.php"><i data-feather="edit" style="width:16px;margin-right:4px;"></i> Your Profile</a>
                    <a class="dropdown-item" href="/app/profile.php?tab=yoursettings"><i data-feather="user" style="width:16px;margin-right:4px;"></i> Your Settings</a>
                    <a class="dropdown-item" href="<?= wp_logout_url() ?>"><i data-feather="log-out" style="width:16px;margin-right:4px;"></i> Logout</a>
                </div>
            </div>
        </div>

    </div>

</header>


<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="/app/dashboard.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/cooper-file-manager-base/">
                        <i data-feather="file"></i>
                        <span data-key="t-emails">File Manager</span>
                    </a>
                </li>


                <?php if (doif_cooperonly_query()) { ?>
                    <li class="menu-title" data-key="t-menu">Employee Tools</li>
                <?php } ?>

                <?php if (doif_cooperadminonly_query('contacts') && !doif_cooperadminonly_query('contacts_travel')) { ?>
                    <li>
                        <a href="/app/page_view_users.php">
                            <i data-feather="user"></i>
                            <span data-key="t-contacts">Contacts</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (!doif_cooperadminonly_query('contacts') && doif_cooperadminonly_query('contacts_travel')) { ?>
                    <li>
                        <a href="/app/page_view_users_travel.php">
                            <i data-feather="map"></i>
                            <span data-key="t-map">Contacts Locations</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (doif_cooperadminonly_query('contacts') && doif_cooperadminonly_query('contacts_travel')) { ?>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-contacts">Contacts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="/app/page_view_users.php">
                                    <span data-key="t-contacts">All Contacts</span>
                                </a>
                            </li>
                            <li>
                                <a href="/app/page_view_users_travel.php">
                                    <span data-key="t-map">Contacts Locations</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if (doif_cooperadminonly_query('accounts')) { ?>
                    <li>
                        <a href="/app/page_accounts.php">
                            <i data-feather="home"></i>
                            <span data-key="t-accounts">Accounts</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <?php if (!doif_cooperonly_query()) { ?>
                        <?php $thisuser_account = get_user_meta($current_user->ID, 'account', true); ?>
                        <li>
                            <a href="/app/page_accounts_view.php?tab=account_maintenance&displayid=<?= $thisuser_account ?>">
                                <i data-feather="user"></i>
                                <span data-key="t-accounts">Your Account</span>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>

                <?php if (doif_cooperonly_query()) { ?>

                    <?php if (doif_cooperonly_query('surveys')) { ?>
                        <li>
                            <a href="/app/page_survey.php">
                                <i data-feather="thumbs-up"></i>
                                <span data-key="t-surveys">Surveys</span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (doif_cooperonly_query('maintenance')) { ?>
                        <?php // Result
                        maintenance_overdue_count();
                        ?>
                        <li>
                            <a href="/app/page_maintenance_contracts.php">
                                <i data-feather="list"></i>
                                <span data-key="t-maintenance">Maintenance Contracts</span>
                                <span class="badge rounded-pill bg-soft-danger text-danger float-end <?php if (!$maintenance_overdue_count[0]->total) { echo 'complete'; } else { echo 'uncomplete'; }?>"><?php if ($maintenance_overdue_count[0]->total) { echo $maintenance_overdue_count[0]->total; } else { echo '✔'; } ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (doif_cooperonly_query('rental')) { ?>
                        <?php // Result
                        rentals_overdue_count();
                        ?>
                        <li>
                            <a href="/app/page_rental_equipment.php">
                                <i data-feather="calendar"></i>
                                <span data-key="t-rental">Rental Equipment</span>
                                <span class="badge rounded-pill bg-soft-danger text-danger float-end <?php if (!$rentals_overdue_count[0]->total) { echo 'complete'; } else { echo 'uncomplete'; }?>"><?php if ($rentals_overdue_count[0]->total) { echo $rentals_overdue_count[0]->total; } else { echo '✔'; } ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (doif_cooperonly_query('examinations')) { ?>
                        <?php // Result
                        exam_overdue_count();
                        ?>
                        <li>
                            <a href="/app/page_thorough_examinations.php">
                                <i data-feather="tool"></i>
                                <span data-key="t-examinations">Thorough Examinations</span>
                                <span class="badge rounded-pill bg-soft-danger text-danger float-end <?php if (!$exam_overdue_count[0]->total) { echo 'complete'; } else { echo 'uncomplete'; }?>"><?php if ($exam_overdue_count[0]->total) { echo $exam_overdue_count[0]->total; } else { echo '✔'; } ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <?php if ( doif_cooperonly_query('service') ) { ?>
                        <?php // Result
                        service_overdue_count();
                        ?>
                        <li>
                            <a href="/app/page_service_contract.php">
                                <i data-feather="book"></i>
                                <span data-key="t-service">Service Planner</span>
                                <span class="badge rounded-pill bg-soft-danger text-danger float-end <?php if (!$service_overdue_count[0]->total) { echo 'complete'; } else { echo 'uncomplete'; }?>"><?php if ($service_overdue_count[0]->total) { echo $service_overdue_count[0]->total; } else { echo '✔'; } ?></span>
                            </a>
                        </li>
                    <?php } ?>

                    <li>
                        <a href="/app/page_emarketing.php">
                            <i data-feather="mail"></i>
                            <span data-key="t-emails">Email Marketing</span>
                        </a>
                    </li>

                    <!--<li>-->
                    <!--    <a href="javascript: void(0);" class="has-arrow">-->
                    <!--        <i data-feather="pie-chart"></i>-->
                    <!--        <span data-key="t-surveys">Reports</span>-->
                    <!--    </a>-->
                    <!--    <ul class="sub-menu" aria-expanded="false">-->
                    <!--        <li>-->
                    <!--            <a href="/app/page_reports_survey.php">-->
                    <!--                <span data-key="t-app-manage">Survey Reports</span>-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>-->

                    <li class="menu-title" data-key="t-menu">Employee Options</li>

                    <li>
                        <a href="/app/page_holidays.php">
                            <i data-feather="sun"></i>
                            <span data-key="t-holidays">Holidays</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="grid"></i>
                            <span data-key="t-deal">Applications</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <?php menu_applications_all(false); ?>
                            <?php for ($x = 0; $x < count($menu_applications_all); $x++ ) { ?>
                                <li class="menu_item_<?= $x ?>">
                                    <a target="_blank" href="<?= $menu_applications_all[$x]->menuurl ?>" >
                                        <span data-key="t-app-<?= $x ?>"><?= $menu_applications_all[$x]->menuname ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if ( current_user_can( 'administrator' ) ) { ?>
                                <li>
                                    <a href="menu_applications.php">
                                        <span data-key="t-app-manage">Manage Applications + </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php } ?>

                <?php if (current_user_fleet_manager(current_user_displayid(), current_user_account()) || current_user_fleet_contact(current_user_id(), current_user_account(), current_user_email())) { ?>
                    <li class="menu-title" data-key="t-menu">Fleet Manager Options</li>
                    <li>
                        <a href="/app/page_service_account_submission.php">
                            <i data-feather="edit-3"></i>
                            <span data-key="t-accounts">ODO Submissions</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if ( current_user_can( 'administrator' ) ) { ?>

                    <li class="menu-title" data-key="t-menu">Admin Options</li>


                    <li>
                        <a href="/app/page_view_users.php">
                            <i data-feather="user"></i>
                            <span data-key="t-user-man">User Management</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="/wp-admin/admin.php?page=integrate-google-drive-private-files">
                            <i data-feather="file"></i>
                            <span data-key="t-file">File Share Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="/app/page_admin_options.php">
                            <i data-feather="sliders"></i>
                            <span data-key="t-admin">Admin Settings</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="/wp-admin">
                            <i data-feather="settings"></i>
                            <span data-key="t-settings">Backend Settings</span>
                        </a>
                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</div>

<?php
/*
    <li>
        <a href="javascript: void(0);" class="has-arrow">
            <i data-feather="user"></i>
            <span data-key="t-deal">Manage Users</span>
        </a>
        <ul class="sub-menu" aria-expanded="false">
            <li>
                <a href="/app/page_documents.php" >
                    <span data-key="t-my-deals">View Users</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">View Categories</a>
                <ul class="sub-menu" aria-expanded="true">
                    <?php menu_renewals_all(false); ?>
                    <?php for ($q = 0; $q < count($menu_documents_all); $q++) { ?>
                        <li>
                            <a href="/app/page_renewals.php?package=<?= $menu_documents_all[$q]->displayid ?>">
                                <span data-key="t-calendar"><?= $menu_documents_all[$q]->menuname ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                </a>
            </li>
            <li>
                <a href="/app/menu_documents_categories.php">
                    <span data-key="t-calendar">Manage Categories</span>
                </a>
            </li>
        </ul>
    </li>
*/