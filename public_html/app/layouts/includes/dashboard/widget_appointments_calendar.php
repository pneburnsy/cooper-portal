<div class="col-xl-12 col-md-12 col-12">
    <div class="card dashboard_crm">
        <div class="card-header">
            <strong>Your Reminders</strong>
        </div>
        <div class="card-body p-0">
            <div class="note_widget" style="display: flex; flex-wrap: wrap; gap: 0px;">
                <?php
                notes_week(false);

                $week_notes = array_fill(0, 7, []);

                $week_dates = [];
                for ($day = 0; $day < 7; $day++) {
                    $week_dates[$day] = date('Y-m-d', strtotime("+$day day"));
                }

                foreach ($notes_week as $note) {
                    $reminder_date = date('Y-m-d', strtotime($note->reminder_date));
                    $day_index = array_search($reminder_date, $week_dates);
                    if ($day_index !== false) {
                        $week_notes[$day_index][] = $note;
                    }
                }

                for ($day = 0; $day < 7; $day++) {
                    $current_date_formatted = date('l jS F', strtotime($week_dates[$day]));
                    ?>
                    <div class="note-column" style="flex: 1; min-width: 100px; background: #fff; border-radius: 10px; padding: 20px; box-sizing: border-box;">
                        <div class="mb-4 d-block"><strong><?= $current_date_formatted . ' (' . count($week_notes[$day]) . ')' ?></strong></div>
                        <div class="note_parent">
                            <?php if (!empty($week_notes[$day])): ?>
                                <?php foreach ($week_notes[$day] as $note):
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
                                    //print_r($notes_users_data);
                                    ?>
                                    <a href="/app/page_view_users_view.php?displayid=<?= $note->displayid ?>" class="note <?= $note_class ?> <?php if ( $note->status == 1 ) { echo 'completed'; } ?>">
                                        <span class="note_message" style="border-radius: 5px !important; overflow: hidden;">
                                            <?php if ($note->type == 9) {
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
                                                } ?>
                                                <span class="note_meta">
                                                    <span class="note_type">
                                                        <span class="note-notification <?= $note_class ?>">
                                                            <i class="mdi <?= $note_icon ?> font-size-16 ml-2" style="margin-right: 4px;"></i> <?= $reminder_name ?>
                                                        </span>
                                                    </span>
                                                </span>
                                            <?php } ?>
                                            <div class="text-dark">
                                                <strong><?= $notes_users_data[0]->display_name ?></strong>
                                            </div>
                                            <div class="mt-2 mb-0 reminder-block <?= $note_class ?>">
                                                <i class="mdi mdi-clock-outline font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Time:</strong> <?php if ($note->reminder_time) { echo $note->reminder_time; } else { echo 'All Day'; } ?>
                                            </div>
                                            <div class="notes_content truncate-two-lines mb-3 mt-1 text-dark">
                                                <?= $note->note; ?>
                                            </div>
                                        </span>
                                    </a>
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