<div id="overview" class="card dashboard tab-pane <?php if (!$_GET['tab']) { echo 'active'; } ?>" role="tabpanel">
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
                        <div class="note <?= $note_class ?> <?php if ( $notes_view[$i]->status == 1 ) { echo 'completed'; } ?>">
                            <span class="note_meta">
                                <span class="note_type">
                                    <span class="note-notification <?= $note_class ?>">
                                        <i class="mdi <?= $note_icon ?> font-size-16 ml-2" style="margin-right: 4px;"></i> <?= $note_name ?>
                                    </span>
                                </span>
                                <div class="note-delete-form">
                                    <?if ($notes_view[$i]->status != 1) { ?>
                                        <form method="POST" class="d-inline-block">
                                            <button type="submit" id="notes_complete" name="notes_complete" value="<?= $notes_view[$i]->uid ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                                <i class="mdi mdi-check font-size-16"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                    <form method="POST" class="d-inline-block">
                                        <button type="submit" id="notes_delete" name="notes_delete" value="<?= $notes_view[$i]->uid ?>" class="mt-4 btn btn-label-secondary waves-effect waves-light">
                                            <i class="mdi mdi-trash-can font-size-16"></i>
                                        </button>
                                    </form>
                                </div>
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
                                        case 6:
                                            $reminder_name = 'To Do';
                                            break;
                                        default:
                                            $reminder_name = 'General Reminder';
                                            break;
                                    } ?>
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-account font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Person:</strong> <?= other_user_fullname($notes_view[$i]->userid); ?>
                                    </span>
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-calendar-search font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Type:</strong> <?= $reminder_name ?>
                                    </span>
                                    <span class="reminder-block <?= $note_class ?>">
                                        <i class="mdi mdi-calendar font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Date:</strong> <?= formatted_renewal_date($notes_view[$i]->reminder_date) ?> (<?php if ($notes_view[$i]->reminder_time) { echo $notes_view[$i]->reminder_time; } else { echo 'All Day'; } ?>)
                                    </span>

                                    <?php if ( $notes_view[$i]->status == 1 ) {
                                        ?> <span class="reminder-block <?= $note_class ?>">
                                            <i class="mdi mdi-check font-size-16 ml-2" style="margin-right: 4px;"></i><strong>Completed:</strong> <?= other_user_fullname($notes_view[$i]->status_userid) . ' (' .  formatted_renewal_date($notes_view[$i]->status_date) . ')' ?>
                                        </span> <?php
                                    } ?>
                                <?php } ?>
                                <?= $notes_view[$i]->note; ?>
                            </span>
                            <span class="note_posted text-dark">
                                <?= timeAgo($notes_view[$i]->creation_date) ?>
                                <a class="text-dark" style="padding-left: 2px;" href="/app/page_view_users_view.php?displayid=<?= other_user_displayid($notes_view[$i]->creation_userid) ?>">
                                    <span>(<?= formatted_date_time($notes_view[$i]->creation_date) ?>)</span>, <?= other_user_fullname($notes_view[$i]->creation_userid); ?>
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

                    <?php get_users_with_roles(); ?>
                    <label for="reminder_userid" class="modal_label">Who is this reminder for? *</label>
                    <select class="form-control modal_input" name="reminder_userid" data-trigger>
                        <option value="<?= current_user_id() ?>">Myself: <?= current_user_fullname(); ?></option>
                        <?php foreach($all_cooper_users as $user) {
                            ?><option value="<?= $user->ID ?>"><?= $user->display_name ?></option>'<?php
                        } ?>
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