<?php
function user_table($variable, $all = false) {
global $total_filtered_users;

$per_page = isset($_GET['perpage']) ? intval($_GET['perpage']) : 100;
$current_page = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;

    function render_pagination($total_users, $current_page, $per_page = 100) {
        $total_pages = ceil($total_users / $per_page);
        $search_value = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
        $active_tags = isset($_GET['tags']) ? (array)$_GET['tags'] : [];

        // Fetch all unique tags for dropdown filter
        $all_tags = [];
        $users_with_tags = get_users(['meta_key' => 'contact_tags', 'meta_compare' => 'EXISTS']);
        foreach ($users_with_tags as $user) {
            $tags = get_user_meta($user->ID, 'contact_tags', true);
            if (is_array($tags)) {
                foreach ($tags as $tag) {
                    if (!in_array($tag, $all_tags) && !empty($tag)) {
                        $all_tags[] = $tag;
                    }
                }
            }
        }
        
        echo '<div class="dataTables_paginate paging_simple_numbers custom-pagination" id="datatable-buttons-contacts_paginate">';
        ?>
        <div class="row">
            <div class="col-md-6 col-12">
                <form id="paginationSearchForm" style="display:flex; gap: 10px;" method="GET" action="">
                    <input class="form-control form-control-sm" style="width: 250px;border-radius: 4px;" type="text" name="search" placeholder="Search contacts" value="<?php echo esc_attr($search_value); ?>" />
                    <select class="form-control modal_input mb-0" style="border-radius: 4px;width: 250px;" id="contacts_role" name="tags[]" style="width: 200px;">
                        <option value="" disabled selected>Select Tags...</option>
                        <?php
                        foreach ($all_tags as $tag) {
                            $selected = in_array($tag, $active_tags) ? 'selected' : '';
                            echo "<option value=\"{$tag}\">{$tag}</option>";
                        }
                        ?>
                    </select>

                    <button class="btn btn-primary ms-2" type="submit">Search</button>

                    <div id="activeTagsContainer" style="display: flex; flex-wrap: wrap; gap: 5px; margin-left: 10px;">
                        <?php foreach ($active_tags as $tag) { ?>
                            <div class="active-tag" style="display: flex; align-items: center; background-color: #e0e0e0; padding: 5px; border-radius: 3px;">
                                <span><?php echo htmlspecialchars($tag); ?></span>
                                <button type="button" class="remove-tag-btn" data-tag="<?php echo htmlspecialchars($tag); ?>" style="background: none; border: none; cursor: pointer; margin-left: 5px;">x</button>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>
            <div class="col-md-6 col-12">
                <ul class="pagination">
                    <?php
                    $base_url = '?pagenum=';
                    $search_value = isset($_GET['search']) ? urlencode($search_value) : '';
                    $tag_params = '';

                    if (!empty($active_tags)) {
                        foreach ($active_tags as $tag) {
                            $tag_params .= '&tags[]=' . urlencode($tag);
                        }
                    }

                    if ($current_page > 1) {
                        echo '<li class="paginate_button page-item previous" id="datatable-buttons-contacts_previous">';
                        echo '<a href="' . $base_url . ($current_page - 1) . '&search=' . $search_value . $tag_params . '" aria-controls="datatable-buttons-contacts" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="paginate_button page-item previous disabled" id="datatable-buttons-contacts_previous">';
                        echo '<a href="#" aria-controls="datatable-buttons-contacts" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>';
                        echo '</li>';
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo '<li class="paginate_button page-item active">';
                            echo '<a href="' . $base_url . $i . '&search=' . $search_value . $tag_params . '" aria-controls="datatable-buttons-contacts" data-dt-idx="' . $i . '" tabindex="0" class="page-link">' . $i . '</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="paginate_button page-item">';
                            echo '<a href="' . $base_url . $i . '&search=' . $search_value . $tag_params . '" aria-controls="datatable-buttons-contacts" data-dt-idx="' . $i . '" tabindex="0" class="page-link">' . $i . '</a>';
                            echo '</li>';
                        }
                    }

                    if ($current_page < $total_pages) {
                        echo '<li class="paginate_button page-item next" id="datatable-buttons-contacts_next">';
                        echo '<a href="' . $base_url . ($current_page + 1) . '&search=' . $search_value . $tag_params . '" aria-controls="datatable-buttons-contacts" data-dt-idx="' . ($current_page + 1) . '" tabindex="0" class="page-link">Next</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="paginate_button page-item next disabled" id="datatable-buttons-contacts_next">';
                        echo '<a href="#" aria-controls="datatable-buttons-contacts" data-dt-idx="' . ($current_page + 1) . '" tabindex="0" class="page-link">Next</a>';
                        echo '</li>';
                    }
                    ?>
                </ul>

            </div>
        </div>
        <?php
        echo '</div>';
    } ?>

    <div class="top-block"><?php render_pagination($total_filtered_users, $current_page, $per_page); ?></div>

    <div class="table-responsive section-block surveys custom-contact" style="border-radius: 0 !important;">
        <table id="datatable-buttons-contacts" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
            <thead>
            <tr>
                <th>Portal Login</th>
                <th scope="col">Region</th>
                <th scope="col">Full Name</th>
                <th scope="col">Job Title</th>
                <?php if ($all) { ?><th scope="col">Account</th><?php } ?>
                <th scope="col">Email</th>
                <th scope="col">Office</th>
                <th scope="col">Mobile</th>
                <th scope="col">Address</th>
                <th scope="col">Tags</th>
                <th scope="col">Portal Activity</th>
                <th scope="col">Portal User Role</th>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th scope="col">Region Permissions</th>
                    <th scope="col">Sector Permissions</th>
                <?php } ?>
                <th scope="col">Contact Created</th>
                <?php if ( current_user_can( 'administrator' ) ) { ?>
                    <th class="hide-sorting form_actions">Actions</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($variable); $i++) { ?>
                <tr class="<?= $variable[$i]->id;  ?>">

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td class="contacts_status">
                    <span class="notdue">
                        <span class="renewal">Active</span>
                    </span>
                        </td>
                    <?php } else { ?>
                        <td class="contacts_status">
                    <span class="overdue">
                        <span class="renewal">Not Active</span>
                    </span>
                        </td>
                    <?php } ?>

                    <td class="form_name" data-sort="<?= $variable[$i]->region; ?>">
                        <?= get_region_flag($variable[$i]->region); ?>
                    </td>

                    <td>
                        <a href="/app/page_view_users_view.php?displayid=<?= $variable[$i]->displayid ?>">
                            <span><?= $variable[$i]->first_name . ' ' . $variable[$i]->last_name;  ?></span>
                        </a>
                    </td>

                    <td>
                        <?php
                        if ($variable[$i]->title) {
                            echo $variable[$i]->title;
                        } else {
                            echo '-';
                        }
                        ?>
                    </td>

                    <?php if ($all) { ?>
                        <?php
                        global $accounts_team_single;
                        accounts_team_single( $variable[$i]->account, false);
                        ?>
                        <td class="form_name">
                            <?php if ($variable[$i]->account) { ?>
                                <a class="account_icon_full" style="background-color:rgba(<?= $accounts_team_single[0]->accountarray; ?>, 0.3)"
                                   href="page_accounts_view.php?displayid=<?= $accounts_team_single[0]->displayid; ?>">
                                    <?= $accounts_team_single[0]->accountname; ?>
                                </a>
                            <?php } else { ?>
                                <span>-</span>
                            <?php } ?>
                        </td>
                    <?php } ?>

                    <td>
                        <a href="mailto:<?= $variable[$i]->user_email; ?>"><?= $variable[$i]->user_email; ?></a>
                    </td>

                    <td>
                        <a href="tel:<?= $variable[$i]->office_phone; ?>"><?php if ( $variable[$i]->office_phone ) { echo $variable[$i]->office_phone; } else { echo '<span>-</span>'; } ?></a>
                    </td>

                    <td>
                        <a href="tel:<?= $variable[$i]->mobile_phone; ?>"><?php if ( $variable[$i]->mobile_phone ) { echo $variable[$i]->mobile_phone; } else { echo '<span>-</span>'; } ?></a>
                    </td>

                    <td class="geo">
                        <?php
                        $currentGeo = get_user_meta( $variable[$i]->id, 'geo', true );
                        $street = $variable[$i]->address_street ?? '';
                        $street_2 = $variable[$i]->address_street_2 ?? '';
                        $city = $variable[$i]->address_city ?? '';
                        $postcode = $variable[$i]->address_postcode ?? '';
                        $country = $variable[$i]->address_country ?? '';
                        $address_parts = array_filter([$street, $street_2, $city, $postcode, $country]);
                        $full_address = implode(', ', $address_parts);
                        if ( !empty($full_address) ) {
                            if ( $currentGeo ) {
                                echo '<span class="d-inline-block status_green"></span>';
                            } else {
                                echo '<span class="d-inline-block status_red"></span>';
                            }
                            $maps_url = "https://www.google.com/maps/search/$street,+$street_2,+$city,+$postcode,+$country/";
                            echo '<span><a class="text-dark" href="' . $maps_url .'">' . $full_address . '</a></span>';
                        } else {
                            ?><span>-</span><?php
                        }
                        ?>
                    </td>

                    <td>
                        <?php
                        $tags = $variable[$i]->contact_tags;

                        if ($tags) {
                            // Limit to show only 2 tags
                            $displayTags = array_slice($tags, 0, 3);
                            $extraTags = array_slice($tags, 3);

                            // Display the first 2 tags
                            foreach ($displayTags as $tag) {
                                echo '<div class="tag-block">' . $tag . '</div>';
                            }

                            // If there are extra tags, show "+N more"
                            if (count($extraTags) > 0) {
                                $countMore = count($extraTags);
                                $extraTagsString = implode(', ', $extraTags);
                                echo '<div class="tag-block">';
                                echo '<span class="more-tags" ';
                                echo 'data-bs-toggle="tooltip" ';
                                echo 'data-bs-placement="top" ';
                                echo 'title="' . htmlspecialchars($extraTagsString) . '">';
                                echo '+ ' . $countMore . ' more';
                                echo '</span>';
                                echo '</div>';
                            }
                        } else {
                            echo '<span style="text-transform:capitalize">-</span>';
                        }
                        ?>
                    </td>


                    <?php $current_status = online_status_true($variable[$i]->ID); ?>

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td class="archived_date online-column" class="table-image">
                            <div class="user-list" data-bs-toggle="tooltip" data-bs-placement="top" title="Currently: <?= $current_status[1] ?>"><?= online_status_date($variable[$i]->ID); ?></div>
                            <span class="online_status <?php if ( $current_status[0] == 2 ) { echo 'online'; } elseif ( $current_status[0] == 1 ) { echo 'away'; } else { echo 'offline'; } ?>"></span>
                        </td>
                    <?php } else { ?>
                        <td class="archived_date online-column" class="table-image">
                            <span>-</span>
                        </td>
                    <?php } ?>

                    <?php if ( $variable[$i]->user_active == 1 ) { ?>
                        <td><span style="text-transform:capitalize"><?= str_replace("_"," ",$variable[$i]->roles[0]);  ?></span></td>
                    <?php } else { ?>
                        <td><span style="text-transform:capitalize">-</span></td>
                    <?php } ?>

                    <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <td>
                            <?php $regions = permissions_regions_single($variable[$i]->displayid, false);
                            if ($regions[0]->mainland == 1) {
                                ?><span class="regionFlag d-inline-block" style="margin-right:5px;background-image: url(/app/assets/images/uk.png)"></span><?php
                            }
                            if ($regions[0]->ireland == 1) {
                                ?><span class="regionFlag d-inline-block" style="margin-right:5px;background-image: url(/app/assets/images/ireland.png)"></span><?php
                            } ?>
                        </td>
                        <td>
                            <div class="permission">
                                <?php
                                $permissions = permissions_single($variable[$i]->displayid, false);
                                foreach ($permissions as $permission) {
                                    ?>
                                    <span class="<?php
                                    if ($permission->value == 'granted') {
                                        echo 'status_green';
                                    } elseif ($permission->value == 'blocked') {
                                        echo 'status_red';
                                    } else {
                                        echo 'status_none';
                                    }
                                    ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= ucwords($permission->type) ?>"></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    <?php } ?>

                    <td class="archived_date"><div><?= formatted_renewal_date($variable[$i]->user_registered);  ?></div></td>

                    <td class="form_actions" style="text-align: right;">
                        <a class="text-light" href="/app/page_view_users_view.php?displayid=<?= $variable[$i]->displayid ?>">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                <i class="mdi mdi-eye d-inline-block font-size-16"></i>
                            </button>
                        </a>

                        <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <a class="text-light" href="page_view_users_view?tab=contacts_permissions&displayid=<?= $variable[$i]->displayid; ?>">
                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                <i class="mdi mdi-security d-block font-size-16"></i>
                            </button>
                        </a>
                        <?php } ?>

                        <?php if ( current_user_can( 'employee_editor' ) || current_user_can( 'administrator' ) ) { ?>
                        <a class="text-light" href="page_view_users_view?tab=contacts_settings&displayid=<?= $variable[$i]->displayid; ?>">
                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" class="btn btn-edit waves-effect waves-light" type="submit">
                                <i class="mdi mdi-pencil d-block font-size-16"></i>
                            </button>
                        </a>
                        <?php } ?>

                        <?php if ( current_user_can( 'administrator' ) ) { ?>
                        <form method="post" class="form-inline">
                            <button <?php if (is_email_super_admin($variable[$i]->displayid)) { echo 'disabled'; } ?> data-bs-toggle="tooltip" data-bs-placement="top" title="<?php if ($variable[$i]->user_active == 0) { echo 'Enable'; } else { echo 'Disable'; } ?>" class="btn <?php if ($variable[$i]->user_active == 1) { echo 'btn-danger'; } else { echo 'btn-success'; } ?> waves-effect waves-light" type="submit" name="contacts_status" value="<?= $variable[$i]->displayid; ?>">
                                <?php if ($variable[$i]->user_active == 0) {
                                    echo '<i class="mdi mdi-account-check d-block font-size-16"></i>';
                                } else {
                                    echo '<i class="mdi mdi-account-cancel d-block font-size-16"></i>';
                                } ?>
                            </button>
                        </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="bottom-block"><?php render_pagination($total_filtered_users, $current_page, $per_page); ?></div>

    <script>
        document.querySelectorAll('.remove-tag-btn').forEach(button => {
            button.addEventListener('click', () => {
                const tagToRemove = button.getAttribute('data-tag');
                const searchParams = new URLSearchParams(window.location.search);
                let tags = searchParams.getAll('tags[]');

                tags = tags.filter(tag => tag !== tagToRemove);
                searchParams.delete('tags[]');
                tags.forEach(tag => searchParams.append('tags[]', tag));

                window.location.search = searchParams.toString();
            });
        });

        document.querySelector('form').addEventListener('submit', function(event) {
            const searchValue = document.querySelector('[name="search"]').value;
            const selectedTags = Array.from(document.querySelector('[name="tags[]"]').selectedOptions)
                .map(option => option.value);

            const searchParams = new URLSearchParams(window.location.search);
            searchParams.set('search', searchValue);
            searchParams.delete('tags[]');
            selectedTags.forEach(tag => searchParams.append('tags[]', tag));

            document.querySelector('#paginationSearchForm').addEventListener('submit', function(event) {
                event.preventDefault();
            });
            window.location.search = searchParams.toString();
        });
    </script>

<?php } ?>
