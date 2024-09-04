<div id="accounts_notes" class="card tab-pane <?php if ($_GET['tab'] == 'accounts_notes') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-12 p-0">
                <div class="border-bottom" style="padding:30px;">
                    <div class="row">
                        <form method="post">
                            <div class="col-md-8 d-inline-block">
                                <div class="position-relative">
                                    <input name="chatcomment" type="text" class="form-control border bg-soft-light" placeholder="Enter Message...">
                                </div>
                            </div>
                            <div class="col-auto d-inline-block">
                                <button name="chat_add" class="btn btn-primary chat-send w-md waves-effect waves-light">
                                    <span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send float-end"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="chat-conversation p-4 px-2" data-simplebar="init">
                    <div class="simplebar-wrapper">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" style="height: 100%; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                    <div class="simplebar-content">
                                        <ul class="list-unstyled mb-0" style="padding:0 6px;">
                                            <?php if ($accounts_team_view_notes) { ?>
                                                <?php for ($i = 0; $i < count($accounts_team_view_notes); $i++) { ?>
                                                    <li class="<?php if (current_user_id() == $accounts_team_view_notes[$i]->userid) { echo 'right '; } echo $accounts_team_view_notes[$i]->displayid; ?>">
                                                        <div class="conversation-list">
                                                            <div class="ctext-wrap">
                                                                <div class="ctext-wrap-content">
                                                                    <h5 class="conversation-name">
                                                                        <?php if (other_user_profile_picture($accounts_team_view_notes[$i]->userid)) { ?>
                                                                            <img class="chat_pp" src="<?= other_user_profile_picture($accounts_team_view_notes[$i]->userid); ?>" width="25" height="25">
                                                                        <?php } else { ?>
                                                                            <span class="chat_pp"><?= other_user_firstname($accounts_team_view_notes[$i]->userid)[0] . other_user_lastname($accounts_team_view_notes[$i]->userid)[0]; ?></span>
                                                                        <?php } ?>
                                                                        <p class="user-name"><?= other_user_fullname($accounts_team_view_notes[$i]->userid); ?></p>
                                                                        <span class="time"><?= formatted_date($accounts_team_view_notes[$i]->note_created) . ' at ' . formatted_time($accounts_team_view_notes[$i]->note_created); ?></span>
                                                                        <?php if (current_user_id() == $accounts_team_view_notes[$i]->userid || doif_adminonly()) { ?>
                                                                            <form method="post">
                                                                                <button name="chat_delete" value="<?= $accounts_team_view_notes[$i]->displayid; ?>" class="btn btn-chat chat-send w-md waves-effect waves-light">
                                                                                    Delete
                                                                                </button>
                                                                            </form>
                                                                        <?php } ?>
                                                                    </h5>
                                                                    <p class="mb-0"><?= $accounts_team_view_notes[$i]->note_comment; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            <?php } else {
                                                echo '<p class="text-center">There is currently no notes.</p>';
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-placeholder" style="width: auto; height: 824px;"></div>
                    </div>
                    <div class="chat-track chat-horizontal" style="visibility: hidden;">
                        <div class="chat-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div>
                    </div>
                    <div class="chat-track chat-vertical" style="visibility: visible;">
                        <div class="chat-scrollbar" style="height: 166px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


