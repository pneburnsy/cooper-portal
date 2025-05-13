<div class="col-xl-12 col-md-12 col-12">
    <div class="card mb-3">
        <div class="card-body bg-white" style="border-radius:10px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <?php
                // Existing PHP code for handling dates and user parameters
                $current_url_date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
                $date_object = DateTime::createFromFormat('Y-m-d', $current_url_date);
                if (!$date_object) {
                    $date_object = new DateTime();
                }
                $past_week = clone $date_object;
                $past_week->modify('-7 days');
                $past_week_url = $past_week->format('Y-m-d');
                $future_week = clone $date_object;
                $future_week->modify('+7 days');
                $future_week_url = $future_week->format('Y-m-d');
                $start_of_week = clone $date_object;
                $start_of_week->modify('monday this week');
                $end_of_week = clone $start_of_week;
                $end_of_week->modify('sunday this week');
                $current_week_display = $start_of_week->format('d M Y') . ' - ' . $end_of_week->format('d M Y');
                $monday_display = $start_of_week->format('jS F Y');
                $is_admin = current_user_can('administrator');
                $user_param = '';
                if ($is_admin && isset($_GET['user'])) {
                    $user_param = '&user=' . urlencode(sanitize_text_field($_GET['user']));
                }
                ?>
                <div>
                    <span>Week Commencing</span>
                    <h5 class="mb-0 mt-1 d-block"><?= "Monday " . htmlspecialchars($monday_display, ENT_QUOTES, 'UTF-8') ?></h5>
                </div>
                <div class="calendar-buttons">
                    <form method="get" action="" class="d-inline-block">
                        <div class="me-4 d-inline-block" style="position: relative; top:4px;">
                            <div class="d-inline-block me-2" style="position: relative; top:1px;">
                                <label for="select_date" class="mb-0 d-block form-label">Select a Date:</label>
                            </div>
                            <div class="d-inline-block me-2" style="position: relative; top:1px;">
                                <input name="date" type="date" class="mb-0 d-inline-block modal_input" id="select_date" value="<?= htmlspecialchars($current_url_date, ENT_QUOTES, 'UTF-8') ?>" required>
                                <?php if ($is_admin && isset($_GET['user'])) { ?>
                                    <input type="hidden" name="user" value="<?= htmlspecialchars($_GET['user'], ENT_QUOTES, 'UTF-8') ?>">
                                <?php } ?>
                            </div>
                            <button type="submit" class="d-inline-block btn btn-primary">Go to Week</button>
                        </div>
                    </form>
                    <a href="?date=<?= htmlspecialchars($past_week_url, ENT_QUOTES, 'UTF-8') . $user_param ?>" class="btn btn-primary mt-2 me-2">
                        <i class="mdi mdi-arrow-left-thick"></i>
                    </a>
                    <a href="?date=<?= htmlspecialchars(date('Y-m-d'), ENT_QUOTES, 'UTF-8') . $user_param ?>" class="btn btn-primary mt-2 me-2">Current Week</a>
                    <a href="?date=<?= htmlspecialchars($future_week_url, ENT_QUOTES, 'UTF-8') . $user_param ?>" class="btn btn-primary mt-2">
                        <i class="mdi mdi-arrow-right-thick"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card dashboard_crm full-crm">
        <div class="card-body p-0" style="border-radius:10px;overflow:hidden;">
            <div class="note_widget" style="display: flex; flex-wrap: wrap; gap: 0px;">
                <?php
                // Existing PHP code to prepare week notes
                $url_date = isset($_GET['date']) ? sanitize_text_field($_GET['date']) : date('Y-m-d');
                $start_of_week = date('Y-m-d', strtotime('monday this week', strtotime($url_date)));
                $end_of_week = date('Y-m-d', strtotime('sunday this week', strtotime($url_date)));
                $week_notes = array_fill(0, 7, []);
                $week_dates = [];
                for ($day = 0; $day < 7; $day++) {
                    $week_dates[$day] = date('Y-m-d', strtotime($start_of_week . "+$day day"));
                }
                foreach ($notes_weekly_select as $note) {
                    $reminder_date = date('Y-m-d', strtotime($note->reminder_date));
                    $day_index = array_search($reminder_date, $week_dates);
                    if ($day_index !== false) {
                        $week_notes[$day_index][] = $note;
                    }
                }

                // **New Code: Sort notes within each day so that status=0 comes first**
                for ($day = 0; $day < 7; $day++) {
                    if (!empty($week_notes[$day])) {
                        usort($week_notes[$day], function($a, $b) {
                            // Assuming 'status' is an integer where 0 should come first
                            if ($a->status == $b->status) {
                                return 0;
                            }
                            return ($a->status < $b->status) ? -1 : 1;
                        });
                    }
                }
                ?>

                <?php
                // Continue with existing code to display each day's notes
                for ($day = 0; $day < 7; $day++) {
                    $current_date_formatted = date('l jS F', strtotime($week_dates[$day]));
                    $is_today = (date('Y-m-d') === $week_dates[$day]) ? 'active' : '';
                    ?>
                    <div class="note-column <?= htmlspecialchars($is_today, ENT_QUOTES, 'UTF-8') ?>" style="flex: 1; min-width: 100px; background: #fff; border-radius: 10px; padding: 20px; box-sizing: border-box;">
                        <div class="mb-4 d-block"><strong><?= htmlspecialchars($current_date_formatted, ENT_QUOTES, 'UTF-8') . ' (' . count($week_notes[$day]) . ')' ?></strong></div>
                        <div class="note_parent">
                            <?php if (!empty($week_notes[$day])): ?>
                                <?php foreach ($week_notes[$day] as $note):
                                    // Determine note properties based on type
                                    switch ($note->type) {
                                        case 9:
                                            $note_icon = 'mdi-calendar-alert';
                                            $note_name = 'Reminder';
                                            $note_class = 'danger';
                                            break;
                                        case 1:
                                            $note_icon = 'mdi-bell-alert-outline';
                                            $note_name = 'Important';
                                            $note_class = 'error';
                                            break;
                                        default:
                                            $note_icon = 'mdi-text';
                                            $note_name = 'Note';
                                            $note_class = 'normal';
                                            break;
                                    }
                                    $notes_users_data = get_users(['meta_key' => 'displayid', 'meta_value' => $note->displayid]);
                                    ?>
                                    <div class="note <?= htmlspecialchars($note_class, ENT_QUOTES, 'UTF-8') ?> <?php if (isset($note->status) && $note->status == 1) { echo 'completed'; } ?>">
                                        <div class="note-delete-form widget">
                                            <?php if ($note->location == 2) { ?>
                                                <a href="/app/page_pipeline_view.php?displayid=<?= htmlspecialchars($note->displayid, ENT_QUOTES, 'UTF-8') ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                                    <i class="mdi mdi-eye font-size-16"></i>
                                                </a>
                                            <?php } else { ?>
                                                <a href="/app/page_view_users_view.php?displayid=<?= htmlspecialchars($note->displayid, ENT_QUOTES, 'UTF-8') ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                                    <i class="mdi mdi-eye font-size-16"></i>
                                                </a>
                                            <?php } ?>
                                            <?php if ($note->status != 1) { ?>
                                                <form method="POST" class="d-inline-block">
                                                    <button type="submit" id="notes_complete" name="notes_complete" value="<?= $note->uid ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                                        <i class="mdi mdi-check font-size-16"></i>
                                                    </button>
                                                </form>
                                            <?php } ?>
                                            <form method="POST" class="d-inline-block">
                                                <button type="submit" id="notes_delete" name="notes_delete" value="<?= $note->uid ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <span class="note_message">
                                            <?php if ($note->type == 9): ?>
                                                <?php
                                                switch ($note->reminder_type) {
                                                    case 1:
                                                        $reminder_name = 'Catch Up';
                                                        break;
                                                    case 2:
                                                        $reminder_name = 'Meeting';
                                                        break;
                                                    case 3:
                                                        $reminder_name = 'Deadline';
                                                        break;
                                                    case 4:
                                                        $reminder_name = 'Call';
                                                        break;
                                                    case 5:
                                                        $reminder_name = 'Email';
                                                        break;
                                                    default:
                                                        $reminder_name = 'General Reminder';
                                                        break;
                                                }
                                                ?>
                                                <span class="note_meta">
                                                    <span class="note_type">
                                                        <span class="note-notification <?= htmlspecialchars($note_class, ENT_QUOTES, 'UTF-8') ?>">
                                                            <i class="mdi <?= htmlspecialchars($note_icon, ENT_QUOTES, 'UTF-8') ?> font-size-16 ml-2" style="margin-right: 4px;"></i> <?= htmlspecialchars($reminder_name, ENT_QUOTES, 'UTF-8') ?>
                                                            <?php if ($note->location == 2) { ?>
                                                                (Deal)
                                                            <?php } else { ?>
                                                                (Contact)
                                                            <?php } ?>
                                                        </span>
                                                    </span>
                                                </span>
                                            <?php endif; ?>
                                            <div class="text-dark">
                                                <?php if ($note->location == 2) {
                                                    $deal_name = $wpdb->get_var($wpdb->prepare("SELECT name FROM {$wpdb->prefix}pipeline_proposals WHERE displayid = %s", $note->displayid));
                                                    echo '<strong>'.$deal_name.'</strong>';
                                                } else { ?>
                                                    <strong><?= htmlspecialchars($notes_users_data[0]->display_name ?? 'Unknown', ENT_QUOTES, 'UTF-8') ?></strong>
                                                <?php } ?>
                                            </div>
                                            <div class="mt-2 mb-0 reminder-block <?= htmlspecialchars($note_class, ENT_QUOTES, 'UTF-8') ?>">
                                                <i class="mdi mdi-clock-outline font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Time:</strong> <?= htmlspecialchars($note->reminder_time ? $note->reminder_time : 'All Day', ENT_QUOTES, 'UTF-8') ?>
                                            </div>
                                            <?php if ($note->note) { ?>
                                                <div class="notes_content truncate-two-lines mb-3 mt-1 text-dark">
                                                    <?= $note->note ?>
                                                </div>
                                            <?php } ?>
                                        </span>
                                        <div class="assigned"><a class="text-dark" href="/app/page_view_users_view.php?displayid=<?= htmlspecialchars(other_user_displayid($note->userid), ENT_QUOTES, 'UTF-8') ?>">Assigned To: <?= htmlspecialchars(other_user_fullname($note->userid), ENT_QUOTES, 'UTF-8') ?></a></div>

                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="tiny_date text-muted fs-sm">No reminders today.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
