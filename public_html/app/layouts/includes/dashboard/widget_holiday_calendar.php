<div class="col-xl-12 col-md-12">
    <div class="card  calendar">
        <div class="card-header">
            <strong>Team Holiday Calendar</strong>
        </div>
        <div class="card-body">
            <?php
            // INCLUDE CAL JS, CSS AND CALL
            include 'layouts/includes/holidays/holidays_list_apicall.php';
            include 'layouts/functions/holiday_calendar.php';
            //print_r($holidaysfinal['holidays']);
            ?>
            <div id='holiday_calendar' class="calendar_style"></div>
            <p class="disclaimer">This calendar can take some time to update, please check back later if any recent holiday requests aren't showing yet.</p>
        </div>
    </div>
</div>