<div id="contacts_locations" class="card tab-pane <?php if ($_GET['tab'] == 'contacts_locations') { echo 'active'; } ?>" role="tabpanel">
    <?php
    $street = $contacts_view['user_meta']['address_street'][0] ?? '';
    $city = $contacts_view['user_meta']['address_city'][0] ?? '';
    $postcode = $contacts_view['user_meta']['address_postcode'][0] ?? '';
    ?>
    <div class="row">
        <div class="col-12 col-md-12 col-xl-12">
            <div class="card-body note_block mb-4" style="background:#fff;border-radius:10px;">
                <h4 class="col-12 mb-4">Contact Location</h4>
                <div class="mb-2" style="padding-bottom: 40px">
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
                <?php if ($street || $city || $postcode) { ?>
                <div style="display:block;width:100%;border-radius: 10px;overflow: hidden;border: 0; margin-top: 20px;">
                    <iframe src="https://maps.google.co.uk/maps?&q=<?php echo $postcode;?>&aq=&g=<?php echo $postcode;?>&ie=UTF8&hq=&hnear=<?php echo $postcode;?>&z=13&output=embed" width="100%" height="800" style="border-radius:10px;overflow:hidden;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>