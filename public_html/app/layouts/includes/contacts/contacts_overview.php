<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">

    <?php
    $street = $contacts_view['user_meta']['address_street'][0] ?? '';
    $city = $contacts_view['user_meta']['address_city'][0] ?? '';
    $postcode = $contacts_view['user_meta']['address_postcode'][0] ?? '';
    ?>

    <?php if ($street || $city || $postcode) { ?>
        <div class="row">
            <div class="col-12 col-md-12 col-xl-12">
                <div class="card-body note_block mb-4" style="background:#fff;border-radius:10px;">
                    <h4 class="col-12 mb-4">Contact Location</h4>
                    <div style="border-radius: 10px;overflow: hidden;border: 0;">
                        <iframe src="https://maps.google.co.uk/maps?&q=<?php echo $postcode;?>&aq=&g=<?php echo $postcode;?>&ie=UTF8&hq=&hnear=<?php echo $postcode;?>&z=13&output=embed" width="100%" height="350" style="border-radius:10px;overflow:hidden;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <?php
                    $street = $contacts_view['user_meta']['address_street'][0] ?? '';
                    $city = $contacts_view['user_meta']['address_city'][0] ?? '';
                    $postcode = $contacts_view['user_meta']['address_postcode'][0] ?? '';

                    $address_parts = array_filter([$street, $city, $postcode]);
                    $full_address = implode(', ', $address_parts);

                    $geo_data = unserialize($contacts_view['user_meta']['geo'][0] );

                    $latitude = $geo_data['lat'];
                    $longitude = $geo_data['lon'];

                    ?>
                    <div class="mt-2">
                        <a class="d-inline-block float-start btn btn-primary " href="/app/page_view_users_travel.php">Plan a Journey</a>
                        <?php
                        if (!empty($full_address)) {
                            $maps_url = "https://www.google.com/maps/search/$street,+$city,+$postcode/";
                            echo "<div class='d-inline-block float-end mt-2 text-dark'><strong>Address: </strong> <a class='text-dark' href='{$maps_url}' target='_blank'>{$full_address} ($latitude $longitude)</a></div>";
                        } else {
                            echo '<div class="d-inline-block float-end mt-2 text-dark"><strong>Address: </strong> <span>No Address</span></div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-12 col-md-8 col-xl-8">
            <div class="card-body note_block mb-4" style="background:#fff;border-radius:10px;">
                <h4 class="col-12 mb-4">Feed</h4>
                <? include 'dropdowns/notes_filters.php'; ?>
                <div class="note_parent"><?php
                    for($i = 0; $i < count($notes_view); $i++) {
                        switch ($notes_view[$i]->type) {
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
                        } ?>
                        <div class="note <?= $note_class ?>">
                            <span class="note_meta">
                                <span class="note_type">
                                    <span class="note-notification <?= $note_class ?>">
                                        <i class="mdi <?= $note_icon ?> font-size-16 ml-2" style="margin-right: 4px;"></i> <?= $note_name ?>
                                    </span>
                                </span>
                                <form method="POST" class="note-delete-form">
                                    <button type="submit" id="notes_delete" name="notes_delete" value="<?= $notes_view[$i]->uid ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                        <i class="mdi mdi-trash-can font-size-16"></i>
                                    </button>
                                </form>
                            </span>
                            <span class="note_message">
                                <?php if ($notes_view[$i]->type == 9) {
                                    switch ($notes_view[$i]->reminder_type) {
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
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-calendar-search font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Type:</strong> <?= $reminder_name ?>
                                    </span>
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-calendar font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Date:</strong> <?= formatted_renewal_date($notes_view[$i]->reminder_date) ?>
                                    </span>
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-clock-outline font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Time:</strong> <?php if ($notes_view[$i]->reminder_time) { echo $notes_view[$i]->reminder_time; } else { echo 'All Day'; } ?>
                                    </span>
                                    <?php if (daysUntilDate($notes_view[$i]->reminder_date) > 0) { ?>
                                        <span class="reminder-block <?= $note_class ?>">
                                            <i class="mdi mdi-calendar-clock font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Due In:</strong> <?= daysUntilDate($notes_view[$i]->reminder_date) ?> Days
                                        </span>
                                    <?php } ?>
                                <?php } ?>
                                <?= $notes_view[$i]->note; ?>
                            </span>
                            <span class="note_posted text-dark">
                                <?= timeAgo($notes_view[$i]->creation_date) ?>
                                <a class="text-dark" style="padding-left: 2px;" href="/app/page_view_users_view.php?displayid=<?= other_user_displayid($notes_view[$i]->userid) ?>">
                                    <span>(<?= formatted_date_time($notes_view[$i]->creation_date) ?>)</span>, <?= other_user_fullname($notes_view[$i]->userid); ?>
                                </a>
                            </span>
                        </div>
                    <?php } ?>
                    <div class="note all">
                        <span class="note_meta">
                            <span class="note_type">
                                <span class="note-notification normal">
                                    <i class="mdi mdi-account-outline font-size-16 ml-2" style="margin-right: 4px;"></i> New Contact
                                </span>
                            </span>
                        </span>
                        <span class="note_message">
                            <p>A new contact has been created.</p>
                        </span>
                        <span class="note_posted text-dark">
                            <a class="text-dark" href="/app/page_view_users_view.php?displayid=<?= other_user_displayid($notes_view[$i]->userid) ?>">
                                <span>Created (<?= formatted_date_time($contacts_view['user_registered']) ?>)</span>
                            </a>
                        </span>
                    </div>
                    <div class="closing_circle"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-xl-4">
            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
            <div class="card-body mb-4" style="background:#fff;border-radius:10px;">
                <h4 class="col-12 mb-4">Add Reminder</h4>
                <form method="POST">
                    <label for="reminder_type" class="modal_label">Reminder Type *</label>
                    <select class="form-control modal_input" name="reminder_type" data-trigger>
                        <?php include 'dropdowns/notes_reminder_type.php'; ?>
                    </select>

                    <label for="reminder_date" class="modal_label">Reminder Time</label>
                    <input name="reminder_time" type="time" class="modal_input" id="reminder_time" required>

                    <label for="reminder_date" class="modal_label">Reminder Date *</label>
                    <input name="reminder_date" type="date" class="modal_input" id="reminder_date" required>
                    <div class="button-group mt-1 mb-4">
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(1)">+ 1 Day</button>
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(7)">+ 1 Week</button>
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(30)">+ 1 Month</button>
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(90)">+ 3 Months</button>
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(180)">+ 6 Months</button>
                        <button type="button" class="btn btn-label-secondary" onclick="setReminderDate(365)">+ 12 Months</button>
                    </div>

                    <label for="reminder_note" class="modal_label">Message * </label>
                    <textarea id="ckeditor-classic-reminder" class="mb-0" name="reminder_note"></textarea>

                    <button type="submit" id="notes_reminder_add" name="notes_reminder_add" class="mt-4 btn btn-primary waves-effect waves-light">Set Reminder</button>
                </form>
            </div>
            <div class="card-body mb-4" style="background:#fff;border-radius:10px;">
                <h4 class="col-12 mb-4">Add Note</h4>
                <form method="POST">
                    <label for="note_type" class="modal_label">Note Type *</label>
                    <select class="form-control modal_input" name="note_type" data-trigger>
                        <?php include 'dropdowns/notes_type.php'; ?>
                    </select>

                    <label for="note" class="modal_label">Message * </label>
                    <textarea id="ckeditor-classic" class="mb-0" name="note"></textarea>

                    <button type="submit" id="notes_add" name="notes_add" class="mt-4 btn btn-primary waves-effect waves-light">Submit</button>
                </form>
            </div>
            <script>
                function setReminderDate(days) {
                    const dateInput = document.getElementById('reminder_date');
                    const currentDate = new Date();
                    currentDate.setDate(currentDate.getDate() + days);
                    const year = currentDate.getFullYear();
                    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
                    const day = String(currentDate.getDate()).padStart(2, '0');
                    dateInput.value = `${year}-${month}-${day}`;
                }
                let noteEditor, reminderEditor;
                ClassicEditor.create(document.querySelector('#ckeditor-classic'), {
                    toolbar: [
                        'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'undo', 'redo'
                    ]
                })
                .then(newEditor => {
                    noteEditor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
                ClassicEditor.create(document.querySelector('#ckeditor-classic-reminder'), {
                    toolbar: [
                        'bold', 'italic', 'underline', '|',
                        'bulletedList', 'numberedList', '|',
                        'undo', 'redo'
                    ]
                })
                .then(newEditor => {
                    reminderEditor = newEditor;
                })
                .catch(error => {
                    console.error(error);
                });
                document.querySelector('form').addEventListener('submit', function(e) {
                    if (e.target.querySelector('#ckeditor-classic')) {
                        document.getElementById('ckeditor-classic').value = noteEditor.getData();
                    }
                });
                document.querySelector('form').addEventListener('submit', function(e) {
                    if (e.target.querySelector('#ckeditor-classic-reminder')) {
                        document.getElementById('ckeditor-classic-reminder').value = reminderEditor.getData();
                    }
                });
            </script>
        </div>
    </div>

</div>