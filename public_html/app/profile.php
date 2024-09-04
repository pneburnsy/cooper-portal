<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");
// SECURITY
include 'layouts/security.php';
// HEADER
$page = 'Profile';
include 'layouts/header.php';

// IMPORT QUERIES
team_view(false);
team_add(false);
team_delete(false);
team_passwordreset(true);
team_profileupdate(false);
team_activestatus(false);
team_profilepictureupdate(false);
whitelabel_edit(false);
?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<div class="card card-top section-block-p0 mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-sm order-2 order-sm-1">
                <div class="d-flex align-items-start mt-3 mt-sm-0">
                    <div class="flex-shrink-0">
                        <div class="avatar-xl me-3">
                            <span class="profile-image-big"><?php echo $current_user->first_name[0] . $current_user->last_name[0]; ?></span>
                            <?php /* <button class="profile_image_button" data-bs-toggle="modal" data-bs-target="#profile_picture">Upload New</button>
                            <?php include 'layouts/includes/profile/modal/team_profile_picture_add.php'; ?> */ ?>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div>
                            <h5 class="font-size-16 mb-1"><?php echo current_user_fullname(); ?></h5>
                            <p class="text-muted font-size-13"><?php echo display_role(current_user_teamrole()); ?></p>
                            <div class="account-details d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13">
                                <div>
                                    <strong style="margin-right: 5px;">Email: </strong>
                                    <?php if ( !current_user_email() ) { ?>
                                        <a class="text-light account-add-details" href="page_accounts_update.php?updateid=11">
                                            <span><i class="mdi mdi-pencil d-block font-size-14 mr-1"></i> Add Email</span>
                                        </a>
                                    <?php } else { ?>
                                        <a class="text-light account-add-details" href="mailto: <?php echo current_user_email(); ?>">
                                            <span> <?php echo current_user_email(); ?> </span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
            <li class="nav-item account-icon">
                <a class="nav-link px-3 <?php if (!$_GET['tab']) { echo 'active'; } ?>" data-bs-toggle="tab" href="#yourprofile" role="tab">
                    <i data-feather="edit"></i>Your Profile
                </a>
            </li>
            <li class="nav-item account-icon">
                <a class="nav-link px-3 <?php if ($_GET['tab'] == 'yoursettings') { echo 'active'; } ?>" data-bs-toggle="tab" href="#yoursettings" role="tab">
                    <i data-feather="user"></i>Your Settings
                </a>
            </li>
            <?php /*
            <li class="nav-item account-icon">
                <a class="nav-link px-3 <?php if ($_GET['tab'] == 'teammembers') { echo 'active'; } ?>" data-bs-toggle="tab" href="#teammembers" role="tab">
                    <i data-feather="user"></i>Team Management
                </a>
            </li>
            */ ?>
        </ul>
    </div>
</div>

<div class="tab-content my-account-page section-block-p0 mb-4">
    <?php include 'layouts/includes/profile/team_your_profile.php'; ?>
    <?php include 'layouts/includes/profile/your_settings.php'; ?>
    <?php /* include 'layouts/includes/profile/team_members.php'; */ ?>
</div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

  // FOOTER
  include 'layouts/footer.php';

?>
