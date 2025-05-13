<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'View Contact';
$breadcrumbtitle = 'View Contact';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperadminonly(true, 'contacts');

contacts_view(false);
contacts_edit(false);

notes_view(false);
notes_add(false);
notes_reminder_add(false);
notes_delete(false);
notes_complete(false);

permission_edit(false);
permission_regions_edit(false);
permissions_all(false);
permissions_regions_all(false);

accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php

if (!$contacts_view['user_meta']['displayid'][0]) {
    include 'layouts/security/security_access_to_page.php';
} else {
    ?>
    <?= view_page_back('View Contacts', '/app/page_view_users.php'); ?>
    <?php accounts_team_single($contacts_view['user_meta']['account'][0], false); ?>
    <div class="card card-top section-block-mb2 section-block-p0 mb-4">
        <div class="card-body ">
            <div class="row">
                <div class="col-sm order-2 order-sm-1">
                    <div class="d-flex align-items-start mt-3 mt-sm-0">
                        <div class="flex-shrink-0">
                            <div class="avatar-xl me-3">
                                <span class="profile-image-big"><?= $contacts_view['display_name'][0]; ?></span>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div>
                                <h5 class="font-size-16 mb-1"><?= $contacts_view['display_name']; ?> <?php if ($contacts_view['user_meta']['title'][0]) { echo ' (' . $contacts_view['user_meta']['title'][0] . ')'; } ?></h5>
                                <p class="text-muted font-size-13">
                                    <?php if ( $contacts_view['user_meta']['account'][0] ) { ?>
                                        <div class="account_popup_container d-block mb-2" style="margin-right: 12px;">
                                            <strong>Account: </strong>
                                            <a href="/app/page_accounts_view?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                                <span class="d-inline-block account_icon_full text-muted font-size-13" style="margin-left: 3px; background-color:rgba( <?= $accounts_team_single[0]->accountarray; ?> , 0.5)"><?= $accounts_team_single[0]->accountname; ?></span>
                                            </a>
                                        </div>
                                    <?php } ?>
                                    <span style="position:relative;top:2px;">
                                        <strong>Email:</strong> <a class="text-dark" href="mailto:<?= $contacts_view['user_email'] ?>"><?= $contacts_view['user_email'] ?></a>
                                    </span>
                                    <br>
                                    <span style="position:relative;top:2px;">
                                        <strong>Office Phone:</strong> <a class="text-dark" href="tel:<?= $contacts_view['user_meta']['office_phone'][0] ?>"><?= $contacts_view['user_meta']['office_phone'][0] ?></a>
                                    </span>
                                    <br>
                                    <span style="position:relative;top:2px;">
                                        <strong>Mobile Phone:</strong> <a class="text-dark" href="tel:<?= $contacts_view['user_meta']['mobile_phone'][0] ?>"><?= $contacts_view['user_meta']['mobile_phone'][0] ?></a>
                                    </span>
                                    <?php if ( $contacts_view['user_meta']['account'][0] ) { ?>
                                        <div class="account_popup_container d-block mb-2 mt-1" style="margin-right: 12px;">
                                            <strong>Website:</strong> <a class="text-dark" href="mailto:<?= $accounts_team_single[0]->accountwebsite; ?>"><?= $accounts_team_single[0]->accountwebsite; ?></a>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    $street = $contacts_view['user_meta']['address_street'][0] ?? '';
                                    $street_2 = $contacts_view['user_meta']['address_street_2'][0] ?? '';
                                    $city = $contacts_view['user_meta']['address_city'][0] ?? '';
                                    $postcode = $contacts_view['user_meta']['address_postcode'][0] ?? '';
                                    $country = $contacts_view['user_meta']['address_country'][0] ?? '';

                                    $address_parts = array_filter([$street, $street_2, $city, $postcode, $country]);
                                    $full_address = implode(', ', $address_parts);

                                    $geo_data = unserialize($contacts_view['user_meta']['geo'][0] );
                              
                                    $latitude = $geo_data['lat'];
                                    $longitude = $geo_data['lon'];

                                    if (!empty($full_address)) {
                                        $maps_url = "https://www.google.com/maps/search/$street,+$street_2,+$city,+$postcode,+$country/";
                                        echo "<div class='d-block text-dark'><strong>Address: </strong> <a class='text-dark' href='{$maps_url}' target='_blank'>{$full_address} ($latitude $longitude)</a></div>";
                                    } else {
                                        echo '<div class="d-block text-dark"><strong>Address: </strong> <span>No Address</span></div>';
                                    }
                                    ?>
                                </p>
                                <div class="d-inline-block" style="margin-right: 12px;">
                                    <strong>Status: </strong>
                                    <?php if ( $contacts_view['user_meta']['user_active'][0] ) { ?>
                                        <span class="notdue">
                                            <span class="renewal">Active</span>
                                        </span>
                                    <?php } else { ?>
                                        <span class="overdue">
                                            <span class="renewal">Not Active</span>
                                        </span>
                                    <?php } ?>
                                </div>
                                <div class="region_profile d-inline-block" style="margin-right: 12px;">
                                    <strong>Region: </strong>
                                    <?= get_region_flag($contacts_view['user_meta']['region'][0]) ?>
                                </div>
                                <div class="account_popup_container d-inline-block">
                                    <strong>Created By: </strong>
                                    <?php $online_date = online_status_true($contacts_view['user_meta']['createdby'][0]); ?>
                                    <span class="table-image d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                          title="<?= other_user_fullname($contacts_view['user_meta']['createdby'][0]); ?> (Currently: <?= $online_date[1] ?>)">
                                        <?php if (other_user_profile_picture($contacts_view['user_meta']['createdby'][0])) { ?>
                                            <img height="22" width="22" class="profile-image-active-tiny"
                                                 src="<?= other_user_profile_picture($contacts_view['user_meta']['createdby'][0]); ?>">
                                        <?php } else {
                                            ?><span class="table-name d-inline-block"><?php
                                            echo other_user_firstname($contacts_view['user_meta']['createdby'][0])[0] . other_user_lastname($contacts_view['user_meta']['createdby'][0])[0];
                                            ?></span><?php
                                        } ?>
                                    </span>
                                    <span class="d-inline-block"><?= other_user_fullname($contacts_view['user_meta']['createdby'][0]); ?></span>
                                </div>
                            </div>
                        </div>
<!--                        --><?php //if ( current_user_can('administrator') ) { ?>
<!--                            <form method="post" class="form-inline">-->
<!--                                <button  data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="btn btn-danger waves-effect waves-light" type="submit" name="service_bin" value="--><?php //= $contacts_view[0]->displayid; ?><!--">-->
<!--                                    <i class="mdi mdi-trash-can d-block font-size-16"></i>-->
<!--                                </button>-->
<!--                            </form>-->
<!--                        --><?php //} ?>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if (!$_GET['tab']) { echo 'active'; } ?>" data-bs-toggle="tab" href="#overview" role="tab">
                        <i data-feather="eye"></i>Overview
                    </a>
                </li>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'contacts_locations') { echo 'active'; } ?>" data-bs-toggle="tab" href="#contacts_locations" role="tab">
                        <i data-feather="map"></i>Location
                    </a>
                </li>
                <?php if (doif_coopereditoronly_query()) { ?>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'contacts_files') { echo 'active'; } ?>" data-bs-toggle="tab" href="#contacts_files" role="tab">
                        <i data-feather="file"></i>Sales Files
                    </a>
                </li>
                <?php } ?>
                <?php if (doif_cooperadminonly_query('pipeline_1')) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3" href="/app/page_pipeline.php?pipeline_id=1&account=<?= $contacts_view['user_meta']['account'][0] ?>">
                            <i data-feather="book"></i>Specialised Pipeline
                        </a>
                    </li>
                <?php } ?>
                <?php if (doif_cooperadminonly_query('pipeline_2')) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3" href="/app/page_pipeline.php?pipeline_id=2&account=<?= $contacts_view['user_meta']['account'][0] ?>">
                            <i data-feather="book"></i>Solutions Pipeline
                        </a>
                    </li>
                <?php } ?>
                <?php if (doif_cooperadminonly_query('pipeline_3')) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3" href="/app/page_pipeline.php?pipeline_id=3&account=<?= $contacts_view['user_meta']['account'][0] ?>">
                            <i data-feather="book"></i>Rentals Pipeline
                        </a>
                    </li>
                <?php } ?>
                <?php if ( current_user_can( 'administrator' ) && is_coopers_member(other_convert_displayid($contacts_view['user_meta']['displayid'][0])) ) { ?>
                    <li class="nav-item account-icon">
                        <a class="nav-link px-3 <?php if ($_GET['tab'] == 'contacts_permissions') { echo 'active'; } ?>" data-bs-toggle="tab" href="#contacts_permissions" role="tab">
                            <i data-feather="list"></i>Permissions
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item account-icon">
                    <a class="nav-link px-3 <?php if ($_GET['tab'] == 'contacts_settings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#contacts_settings" role="tab">
                        <i data-feather="settings"></i>Contact Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content my-account-page section-block-p0 mb-4">
        <?php include 'layouts/includes/contacts/contacts_overview.php'; ?>
        <?php include 'layouts/includes/contacts/contacts_locations.php'; ?>
        <?php if (doif_coopereditoronly_query()) { ?>
            <?php include 'layouts/includes/contacts/contacts_files.php'; ?>
        <?php } ?>
        <?php if ( current_user_can( 'administrator' ) && is_coopers_member(other_convert_displayid($contacts_view['user_meta']['displayid'][0])) ) { ?>
            <?php include 'layouts/includes/contacts/contacts_permissions.php'; ?>
        <?php } ?>
        <?php include 'layouts/includes/contacts/contacts_settings.php'; ?>
    </div>

    <?php
    
}
?>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';


?>

