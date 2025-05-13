<?php

$users = get_users(array(
    'meta_key' => 'contact_tags',
    'meta_compare' => 'EXISTS'
));
$unique_tags = array();

foreach ($users as $user) {
    $tags = get_user_meta($user->ID, 'contact_tags', true);
    if (is_array($tags)) {
        foreach ($tags as $tag) {
            if (!in_array($tag, $unique_tags) && !empty($tag)) {
                $unique_tags[] = $tag;
            }
        }
    }
}
$all_tags_json = json_encode($unique_tags);

?>

<style>
    .tag-dropdown-container {
        position: relative;
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 5px;
        display: inline-flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .tag-input {
        border: none;
        outline: none;
        flex: 1;
        min-width: 100px;
        margin: 5px 0;
    }

    .tag-dropdown-list {
        position: absolute;
        top: 95%;
        left: -1px;
        right: 0;
        max-height: 150px;
        overflow-y: auto;
        border: 1px solid #ccc;
        border-top: none;
        background: white;
        list-style: none;
        padding: 0;
        margin: 0;
        display: none;
        z-index: 100;
        width: calc(100% + 2px);
    }

    .tag-dropdown-item {
        padding: 10px;
        cursor: pointer;
    }

    .tag-dropdown-item:hover {
        background: #f0f0f0;
    }

    .tag-item {
        background: #e0e0e0;
        border-radius: 3px;
        padding: 5px;
        margin: 3px;
        display: flex;
        align-items: center;
    }

    .tag-remove-btn {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: 5px;
    }

    .tag-dropdown-container.focus .tag-dropdown-list {
        display: block;
    }
</style>
<script>
    const allTags = <?php echo $all_tags_json; ?>;

    window.addEventListener('DOMContentLoaded', () => {
        const hiddenTagsInput = document.getElementById('hiddenTagsInput');
        const userTags = hiddenTagsInput ? hiddenTagsInput.value : '[]';
        const contactTags = userTags ? JSON.parse(userTags) : [];
        const tagDropdown = new TagDropdown(contactTags, allTags, 'tagDropdownContainer', 'hiddenTagsInput');
    });

    class TagDropdown {
        constructor(contactTags, allTags, containerId, hiddenInputId) {
            this.contactTags = contactTags || [];
            this.allTags = allTags || [];
            this.container = document.getElementById(containerId);
            this.hiddenInput = document.getElementById(hiddenInputId);

            if (this.container) {
                this.init();
            } else {
                console.error('Container element not found');
            }
        }

        init() {
            this.container.classList.add('tag-dropdown-container');

            this.input = document.createElement('input');
            this.input.setAttribute('placeholder', 'Add a tag...');
            this.input.classList.add('tag-input');
            this.container.appendChild(this.input);

            this.dropdown = document.createElement('ul');
            this.dropdown.classList.add('tag-dropdown-list');
            this.container.appendChild(this.dropdown);

            this.input.addEventListener('input', () => this.onInputChange());
            this.input.addEventListener('keydown', (e) => this.onInputKeyDown(e));
            this.input.addEventListener('focus', () => this.showDropdown());
            this.input.addEventListener('blur', () => setTimeout(() => this.hideDropdown(), 200));

            this.contactTags.forEach(tag => this.createTagElement(tag));

            this.updateHiddenInput();
        }

        updateHiddenInput() {
            if (this.hiddenInput) {
                this.hiddenInput.value = JSON.stringify(this.contactTags);
            }
        }

        createTagElement(tag) {
            if (this.container.querySelector(`[data-tag="${tag}"]`)) return;

            const tagElement = document.createElement('span');
            tagElement.classList.add('tag-item');
            tagElement.setAttribute('data-tag', tag);
            tagElement.textContent = tag;

            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'x';
            removeBtn.classList.add('tag-remove-btn');
            removeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.removeTag(tag);
            });

            tagElement.appendChild(removeBtn);
            this.container.insertBefore(tagElement, this.input);

            if (!this.contactTags.includes(tag)) {
                this.contactTags.push(tag);
                this.updateHiddenInput();
            }
        }

        onInputChange() {
            const searchValue = this.input.value.trim().toLowerCase();
            this.dropdown.innerHTML = '';
            if (searchValue) {
                const matchedTags = this.allTags.filter(tag => tag.toLowerCase().includes(searchValue) && !this.contactTags.includes(tag));
                matchedTags.forEach(tag => this.createDropdownItem(tag));
            }
            this.showDropdown();
        }

        onInputKeyDown(e) {
            if (e.key === 'Enter' && this.input.value.trim()) {
                e.preventDefault();
                const newTag = this.input.value.trim();
                if (!this.contactTags.includes(newTag)) {
                    this.createTagElement(newTag);
                }
                this.input.value = '';
                this.hideDropdown();
            } else if (e.key === 'Backspace' && this.input.value === '' && this.contactTags.length > 0) {
                this.removeTag(this.contactTags[this.contactTags.length - 1]);
            }
        }

        createDropdownItem(tag) {
            const listItem = document.createElement('li');
            listItem.textContent = tag;
            listItem.classList.add('tag-dropdown-item');
            listItem.addEventListener('click', () => {
                this.createTagElement(tag);
                this.input.value = '';
                this.hideDropdown();
            });
            this.dropdown.appendChild(listItem);
        }

        removeTag(tag) {
            this.contactTags = this.contactTags.filter(t => t !== tag);
            this.updateHiddenInput();

            const tagElement = this.container.querySelector(`[data-tag="${tag}"]`);
            if (tagElement) {
                this.container.removeChild(tagElement);
            }
        }

        showDropdown() {
            if (this.dropdown.innerHTML !== '') {
                this.dropdown.style.display = 'block';
            }
        }

        hideDropdown() {
            this.dropdown.style.display = 'none';
        }

        getTags() {
            return this.contactTags;
        }
    }
</script>

<div id="contacts_settings" class="card tab-pane <?php if ($_GET['tab'] == 'contacts_settings') { echo 'active'; } ?>" role="tabpanel">
    <div class="card-body p-0" style="background:#fff;border-radius:10px;padding:0;">
        <div class="row bs-0">
            <div class="col-md-6 p-0">
                <div class="form-highlight">
                    <h4>Contact Settings</h4>
                    <p class="mb-4">You can update this contacts settings below.</p>
                    <form class="edit_accounts" method="post">
                        <div class="modal-top">

                            <div class="form-6 mb-2">
                                <label for="contacts_first_name" class="modal_label">First Name *</label>
                                <input name="contacts_first_name" value="<?= $contacts_view['user_meta']['first_name'][0] ?>" type="text" class="modal_input" id="contacts_first_name" placeholder="Natasha" autocomplete="off" required>
                            </div>

                            <div class="form-6 lastchild mb-2">
                                <label for="contacts_last_name" class="modal_label">Last Name *</label>
                                <input name="contacts_last_name" value="<?= $contacts_view['user_meta']['last_name'][0] ?>" type="text" class="modal_input" id="contacts_last_name" placeholder="Barnes" autocomplete="off" required>
                            </div>

                            <div class="form-12 mb-2">
                                <label for="contacts_title" class="modal_label">Job Title</label>
                                <input name="contacts_title" value="<?= $contacts_view['user_meta']['title'][0] ?>" type="text" class="modal_input" id="contacts_title" placeholder="Director" autocomplete="off">
                            </div>

                            <div class="form-6 mb-2">
                                <label for="contacts_office_phone" class="modal_label">Office Phone</label>
                                <input name="contacts_office_phone" value="<?= $contacts_view['user_meta']['office_phone'][0] ?>" type="number" class="modal_input" id="contacts_office_phone">
                            </div>

                            <div class="form-6 lastchild mb-2">
                                <label for="contacts_mobile_phone" class="modal_label">Mobile Phone</label>
                                <input name="contacts_mobile_phone" value="<?= $contacts_view['user_meta']['mobile_phone'][0] ?>" type="number" class="modal_input" id="contacts_mobile_phone">
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Address</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <div class="form-12 mb-2">
                                        <label for="address_street" class="modal_label">Street Address 1</label>
                                        <input name="address_street" value="<?= $contacts_view['user_meta']['address_street'][0] ?>" type="text" maxlength="160" class="modal_input" id="address_street">
                                    </div>

                                    <div class="form-12 mb-2">
                                        <label for="address_street_2" class="modal_label">Street Address 2</label>
                                        <input name="address_street_2" value="<?= $contacts_view['user_meta']['address_street_2'][0] ?>" type="text" class="modal_input" maxlength="160" id="address_street_2" placeholder="Honiley Kenilworth">
                                    </div>

                                    <div class="form-6 mb-2">
                                        <label for="address_city" class="modal_label">City</label>
                                        <input name="address_city" value="<?= $contacts_view['user_meta']['address_city'][0] ?>" type="text" maxlength="160" class="modal_input" id="address_city">
                                    </div>

                                    <div class="form-6 lastchild mb-2">
                                        <label for="address_postcode" class="modal_label">Postcode</label>
                                        <input name="address_postcode" value="<?= $contacts_view['user_meta']['address_postcode'][0] ?>" type="text" maxlength="20" class="modal_input" id="address_postcode">
                                    </div>

                                    <div class="form-12">
                                        <label for="address_country" class="modal_label">Country</label>
                                        <select name="address_country" class="form-control modal_input" data-trigger id="address_country">
                                            <?php if ($contacts_view['user_meta']['address_country'][0]) { ?>
                                                <option value="<?= $contacts_view['user_meta']['address_country'][0]; ?>" selected>Current: <?= $contacts_view['user_meta']['address_country'][0]; ?></option>
                                            <?php } ?>
                                            <?php include 'dropdowns/countries.php'?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Account</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <select name="contacts_account" class="form-control modal_input" data-trigger id="contacts_account">
                                        <?php if ($contacts_view['user_meta']['account'][0]) { ?>
                                            <option value="<?= $accounts_team_single[0]->displayid; ?>" selected>Current: <?= $accounts_team_single[0]->accountname; ?></option>
                                        <?php } else { ?>
                                            <option value="" selected>Select Account...</option>
                                        <?php } ?>
                                        <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                                            ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-card">
                                <div class="modal-card-header">
                                    <h6>Contact Region</h6>
                                </div>
                                <div class="form-12 mt-4">
                                    <select name="contacts_region" class="form-control modal_input" data-trigger id="contacts_region">
                                        <?php if ($contacts_view['user_meta']['region'][0] !== '') { ?>
                                            <option value="<?= $contacts_view['user_meta']['region'][0] ?>">
                                                Current: <?php
                                                switch($contacts_view['user_meta']['region'][0]) {
                                                    case '0':
                                                        echo 'Mainland UK';
                                                        break;
                                                    case '1':
                                                        echo "Ireland";
                                                        break;
                                                    default:
                                                        echo "Unknown Region"; }
                                                ?></option>
                                        <?php } ?>
                                        <?php include 'dropdowns/regions.php'; ?>
                                    </select>
                                </div>
                            </div>

                            <?php if (current_user_can('administrator') && other_convert_displayid($contacts_view['user_meta']['displayid'][0]) != get_current_user_id()) { ?>
                                <div class="modal-card">
                                    <div class="modal-card-header">
                                        <h6>Portal Access</h6>
                                    </div>
                                    <div class="form-12 mb-3">

                                        <div class="d-inline-block mt-2" style="margin-right: 12px;">
                                            <strong>Current Status: </strong>
                                            <?php if ( $contacts_view['user_meta']['user_active'][0] == 1) { ?>
                                                <span class="notdue">
                                                <span class="renewal">Active</span>
                                            </span>
                                            <?php } else { ?>
                                                <span class="overdue">
                                                <span class="renewal">Not Active</span>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <?php if ( $contacts_view['user_meta']['user_active'][0] == 0 ) { ?>
                                            <div class="mt-2">
                                                <p>To make this user active, please set the current status to active, select a user role and enter a password below.</p>
                                            </div>
                                        <?php } ?>

                                        <label class="modal_label">User Status</label>
                                        <select name="contacts_status" class="form-control modal_input" data-trigger id="contacts_status">
                                            <?php if ($contacts_view['user_meta']['user_active'][0] == 0) {
                                                echo '<option value="' . $contacts_view['user_meta']['user_active'][0] . '">Currently: Not Active</option>';
                                            } else {
                                                echo '<option value="' . $contacts_view['user_meta']['user_active'][0] . '">Currently: Active</option>';
                                            } ?>
                                            <?php include 'dropdowns/user_status.php'; ?>
                                        </select>

                                        <?php
                                        $current_roles_serialized = $contacts_view['user_meta']['ae_capabilities'][0];
                                        $current_roles = unserialize($current_roles_serialized);
                                        $current_role = key($current_roles);

                                        $role_hierarchy = array(
                                            'administrator' => 4,
                                            'employee_editor' => 3,
                                            'employee' => 2,
                                            'customer' => 1,
                                        );

                                        $most_senior_role = 'customer'; // Default role
                                        foreach ($current_roles as $role => $enabled) {
                                            if ($enabled && $role_hierarchy[$role] > $role_hierarchy[$most_senior_role]) {
                                                $most_senior_role = $role;
                                            }
                                        }
                                        ?>

                                        <?php if (!is_email_super_admin($contacts_view['user_meta']['displayid'][0])) { ?>
                                            <label class="modal_label">User Role</label>
                                            <select name="contacts_role" class="form-control modal_input" data-trigger id="contacts_role">
                                                <option value="<?= esc_attr($most_senior_role); ?>">
                                                    Current: <?php
                                                    switch($most_senior_role) {
                                                        case 'administrator':
                                                            echo "Admin";
                                                            break;
                                                        case 'employee_editor':
                                                            echo "Staff Editor";
                                                            break;
                                                        case 'employee':
                                                            echo 'Staff Member';
                                                            break;
                                                        case 'customer':
                                                            echo 'Customer';
                                                            break;
                                                        default:
                                                            echo "Unknown Role";
                                                    } ?>
                                                </option>
                                                <?php include 'dropdowns/user_roles.php'; ?>
                                            </select>
                                        <?php } else { ?>
                                            <input type="text" style="display:none !important;" value="administrator" name="contacts_role">
                                        <?php } ?>

                                        <div class="form-6 mb-2">
                                            <label for="contacts_email" class="modal_label">Email (Username) *</label>
                                            <input name="contacts_email" value="<?= $contacts_view['user_email'] ?>" type="email" class="modal_input" id="contacts_email" placeholder="natasha@cooperhandling.com" autocomplete="off" required>
                                        </div>

                                        <div class="form-6 lastchild mb-2">
                                            <label class="modal_label">Set Password (Minimum 8 Characters)</label>
                                            <input name="contacts_p" type="password" class="modal_input" id="contacts_p" placeholder="**************" min="8" autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- Contact Tags -->
                            <div class="form-12 mb-4">
                                <label for="tags" class="modal_label">Contact Tag(s)</label>
                                <div style="display: inline-block;" class="mb-4">
                                    <p style="display: inline-block;">To add a new tag, press enter after entering your text and then save the page. The new tag should look like this:</p>
                                    <span class="tag-item" style="width: fit-content; display: inline-block;" data-tag="Used">Example<button type="button" class="tag-remove-btn">x</button></span>
                                </div>
                                <div id="tagDropdownContainer" class="w-full"></div>
                                <input type="hidden" id="hiddenTagsInput" name="tags" value='<?= isset($contacts_view['user_meta']['contact_tags'][0]) ? json_encode(unserialize($contacts_view['user_meta']['contact_tags'][0])) : '[]' ?>'>
                            </div>
                        </div>
                        <button type="submit" name="contacts_edit" value="<?= $contacts_view['user_meta']['displayid'][0] ?>" class="btn btn-primary waves-effect waves-light">Update Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



