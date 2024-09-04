<!-- CALENDAR CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/ical.js/1.4.0/ical.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/icalendar@5.5.1/main.global.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var calendarEl = document.getElementById("holiday_calendar");
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            events: [
                <?php
                for ($x = 0; $x < count($holidaysfinal['holidays']); $x++) {
                    $daytype = 'full_day';
                    if ($holidaysfinal['holidays'][$x]['startType'] == $holidaysfinal['holidays'][$x]['endType']) {
                        $daytype = 'half_day';
                    }
                    $additional =  ' (' . $holidaysfinal['holidays'][$x]['leaveType'] . ' - ' . $holidaysfinal['holidays'][$x]['startType'] . ' Until ' . $holidaysfinal['holidays'][$x]['endType'] . ')';
                    $endDateAdjusted = date('Y-m-d', strtotime($holidaysfinal['holidays'][$x]['endDate'] . ' +1 day')); // Adjust the end date
                    echo "{ 
                        title: '" . $holidaysfinal['holidays'][$x]['userName'] . $additional . "', 
                        start: '" . $holidaysfinal['holidays'][$x]['startDate'] . "', 
                        end: '" . $endDateAdjusted . "', 
                        editable: 'false',
                        allDay: 'true',
                        classNames: '$daytype',
                        startStr: '" . $holidaysfinal['holidays'][$x]['startType'] . "',
                        endStr: '" . $holidaysfinal['holidays'][$x]['endType'] . "'                                                   
                    },";
                }
                ?>
            ],
            eventClick: function (info) {
                alert("Event Title: " + info.event.title + "")
            }
        });
        calendar.render();
    });
</script>