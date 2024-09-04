<div id="teammembers" class="card tab-pane <?php if ($_GET['tab'] == 'teammembers') { echo 'active'; } ?>" role="tabpanel">

    <div class="row">
        <div class="card card-top mb-4 col-12 <?php if ( doif_adminonly() ) { echo 'col-md-9'; } else { echo 'col-md-12'; } ?>">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">
                    <div class="modals">
                        <?php
                        for ($x = 0; $x < count($current_team_member); $x++) {
                            include 'modal/team_password_reset.php';
                            include 'modal/team_member_delete.php';
                        }
                        ?>
                    </div>
                    <div class="table-responsive mb-4">

                        <table class="table align-middle datatable dt-responsive table-check nowrap" class="team_members">
                            <thead>
                                <tr>
                                    <th scope="col" class="pr-0"></th>
                                    <th scope="col" class="pl-0">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col" class="hide-sorting form_actions">Action</th>
                                </tr>
                            </head>
                            <tbody>
                            <?php for ($i = 0; $i < count($current_team_member); $i++) { ?>
                                <tr class="<?= $current_team_member[$i]->displayid; ?>">
                                    <td class="pr-0">
                                        <?php $online_date = online_status_date($current_team_member[$i]->displayid); ?>
                                        <?php $online_status = online_status_true($current_team_member[$i]->displayid); ?>
                                        <span class="table-image" data-bs-toggle="tooltip" data-bs-placement="top" title="Last Logged In: <?= $online_date ?>">
                                            <?php if (other_user_profile_picture($current_team_member[$i]->id)) { ?>
                                                <img height="22" width="22" class="profile-image-active-tiny" src="<?= other_user_profile_picture($current_team_member[$i]->id); ?>">
                                            <?php } ?>
                                        </span>
                                        <span class="online_status <?php if ( $online_status == 2 ) { echo 'online'; } elseif ( $online_status == 1 ) { echo 'away'; } else { echo 'offline'; } ?>"></span>
                                    </td>
                                    <td class="pl-0"><?= $current_team_member[$i]->display_name; ?> (<?php display_role($current_team_member[$i]->teamrole); ?>)</td>
                                    <td><?= $current_team_member[$i]->user_email;?></td>
                                    <td><?= $current_team_member[$i]->user_login; ?></td>
                                    <td class="form_actions">
                                        <?php if ($current_team_member[$i]->teamrole != 3 && doif_adminonly()) { ?>
                                            <button data-bs-toggle="modal" data-bs-target="#profilePasswordReset_<?= $i; ?>" class="btn btn-primary waves-effect waves-light d-inline-block">
                                                <i data-bs-toggle="tooltip" data-bs-placement="top" title="Password Reset" class="mdi mdi-key d-block font-size-14"></i>
                                            </button>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#profileTeamDelete_<?= $i; ?>" aria-controls="offcanvasRight">
                                                <i data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Team Member" class="mdi mdi-trash-can d-block font-size-14 mr-1"></i>
                                            </button>
                                        <?php } elseif ($current_team_member[$i]->teamrole == 3 ) { echo 'Cannot Edit Owner.'; } else  { echo 'Admin Only.'; }?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>

        <?php if ( doif_adminonly() ) { ?>
        <div class="card card-top mb-4 col-12 col-md-3">
            <div class="card-body" style="background:#fff;border-radius:10px;padding:0;">
                <div class="form-highlight vh-80">
                    <?= file_get_contents( 'assets/images/svg/new_team_member.svg' ); ?>
                    <h5>Invite Your Team!</h5>
                    <p>Collaborate by inviting team members. We'll email their login details once you're done.</p>
                    <p class="small"><strong>Important:</strong> Invited team members may be able to create, update and delete items and users on your account depending on what user role is chosen.</p>
                    <form class="add_accounts" method="post">
                        <label class="modal_label">Team Members Details</label>
                        <input type="email" name="team_email" class="modal_input" placeholder="Email *" required>
                        <input type="text" name="team_firstname" class="modal_input" placeholder="First Name *" required>
                        <input type="text" name="team_lastname" class="modal_input" placeholder="Last Name *" required>
                        <label class="modal_label">Login Details</label>
                        <input type="text" name="team_username" class="modal_input" placeholder="Username *" required>
                        <input type="password" name="team_password" class="modal_input" placeholder="Password *" required>
                        <select name="team_role" class="form-control modal_input" data-trigger name="choices-single-default" id="contactcompany">
                            <?php include 'dropdowns/user_roles.php'; ?>
                        </select>
                        <div class="form-title">
                            <label class="modal_label">Email Login Details</label>
                            <p class="mb-1">Should we email this users login details to them? <strong>Please note:</strong> This password will be sent in plain text.</p>
                            <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                <input type="checkbox" name="team_emailcheck" class="form-check-input" id="customSwitchsizelg" value="checked" checked>
                            </div>
                        </div>
                        <input type="hidden" name="redirect" class="modal_input" value="teammembers">
                        <button type="submit" name="team_add" class="btn btn-primary waves-effect waves-light">Create User</button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
</div>