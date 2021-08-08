<!DOCTYPE html>
<html lang='en'>
<?php
$connect = mysqli_connect("localhost", "root", "", "calendar-test");

$optionQuery = "SELECT * FROM usercalendar WHERE `UserId` = 1";
$eventIds = array();
$events = array();
$dailyEvents = array();

$optionResult = mysqli_query($connect, $optionQuery);
if (mysqli_num_rows($optionResult) > 0) {
    while ($row = mysqli_fetch_array($optionResult)) {
        array_push($eventIds, $row["CalendarEventID"]);
    }
    $optionQuery2 = "SELECT * FROM calendarevents WHERE `Id` IN (" . implode(",", $eventIds) . ")";

    $calendarResult = mysqli_query($connect, $optionQuery2);
    if (mysqli_num_rows($calendarResult) > 0) {
        while ($row2 = mysqli_fetch_array($calendarResult)) {
            array_push($events, (object)[
                'id' => $row2["Id"],
                'title' => $row2["Title"],
                'start' => $row2["Start"],
                'end' => $row2["End"],
                'backgroundColor' => $row2['Backgroundcolor'],
                'description' => $row2["Description"],
            ]);
        }

        //echo "<script>console.log('" . json_encode($events) . "');</script>";
    }
}

?>
<head>
    <style>
        .fc td,
        .fc th {
            /*border-style: none !important;*/
        }

        .fc-day-today {
            background-color: #ffffff26;
        }

        a.fc-event {
            border-radius: 10px;
            /* round edges */
            width: 15px;
            /* fixed width */
            color: transparent;
            /* hide text */
        }

        /* inline the tr's for events */
        div.fc-content-skeleton>table>tbody>tr {
            display: inline-block;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
            position: relative;
            z-index: 10;
            padding: 20px;
        }


        #calendar {
            max-width: 100%;
            margin: 0 auto;
            height: 100vh;
        }
    </style>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var testarr = <?php echo json_encode($events) ?>;
            var calendarEl = document.getElementById('calendar');
            var previousEvent;
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: false,
                events: testarr,
                eventClick: function(info) {
                    var evnt = calendar.getEventById(info.event.id)
                    $('#eventInfo').html(
                        `<p>` + info.event.title + `</p>` +
                        `<p>` + info.event.start + `</p>` +
                        `<p>` + info.event.end + `</p>` +
                        `<p>` + info.event.extendedProps.description + `</p>`
                    );
                },
                datesSet: ({
                    view
                }) => {
                    let str
                    switch (view.type) {
                        case 'timeGridDay':
                            str = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                weekday: 'long'
                            }).format(view.activeStart)
                            break
                        case 'timeGridWeek':
                            str = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: 'long'
                            }).format(view.activeStart)
                            break
                        case 'dayGridMonth':
                            str = new Intl.DateTimeFormat('en-US', {
                                year: 'numeric',
                                month: 'long'
                            }).format(view.activeStart)
                            break
                    }
                    document.querySelector('#title').innerHTML = str;
                },
                dateClick: function(info) {
                    // alert('Clicked on: ' + info.dateStr);

                    if (previousEvent) {
                        previousEvent.dayEl.style.backgroundColor = '#ffffff26';
                        previousEvent = info;
                    } else {
                        previousEvent = info;
                    }
                    <?php
                    $optionQuery3 = "SELECT * FROM `calendarevents` WHERE `Start` <= '2021-07-16' AND `End` >= '2021-07-16'";

                    $Query3 = mysqli_query($connect, $optionQuery3);
                    if (mysqli_num_rows($Query3) > 0) {
                        while ($row3 = mysqli_fetch_array($Query3)) {
                            array_push($dailyEvents, (object)[
                                'id' => $row3["Id"]
                            ]);
                        }
                    }
                    ?>

                    var dailyEvents = <?php echo json_encode($dailyEvents) ?>;
                    //console.log(dailyEvents);
                    info.dayEl.style.backgroundColor = '#FFDC2826';
                },
            });
            calendar.render();


            $("#next").on('click', function() {
                calendar.next();
            });

            $("#prev").on('click', function() {
                calendar.prev();
            });
        });
    </script>
</head>

<body>
    <div>
        <div class="header">
            <div class="left">
                <button id="prev">PREV</button>
            </div>
            <h1 class="center" id="title"></h1>
            <div class="right">
                <button id="next">NEXT</button>
            </div>
        </div>
        <div id='calendar' style="height: 800px; width: 800px;"></div>
    </div>

    <div id="eventInfo">

    </div>
</body>

</html>