<!DOCTYPE html>
<html lang="en">
<?php
$connect = mysqli_connect("localhost", "root", "", "calendar-test");

if (isset($_POST["submit-new"])) {

    $id = $_POST["view-id"];
    $title = $_POST["post-title"];
    $desc = $_POST["post-description"];
    $start = $_POST["start-date"];
    $end = $_POST["end-date"];

    $sql = "INSERT INTO calendarevents (Title,Description,Start, End) VALUES ('$title','$desc','$start','$end')";

    if ($connect->query($sql) === TRUE) {

        $last_id = $connect->insert_id;
        $sql2 = "INSERT INTO usercalendar (UserId ,CalendarEventID ) VALUES (1,'$last_id')";
        if ($connect->query($sql2) === TRUE) {

            echo '<script>alert("Event added successfully")</script>';
            echo '<script>window.location ="Calendar.php"</script>';
        } else {
            echo '<script>alert("Something went wrong please try again later")</script>';
            echo '<script>window.location ="Calendar.php"</script>';
        }
    } else {
        echo '<script>alert("Something went wrong please try again later")</script>';
        echo '<script>window.location ="Calendar.php"</script>';
    }
} else if (isset($_POST["submit-edit"])) {

    $id = $_POST["post-id"];
    $title = $_POST["post-title"];
    $desc = $_POST["post-description"];
    $start = $_POST["start-date"];
    $end = $_POST["end-date"];

    $sql = "UPDATE calendarevents SET Title = '$title', Description = '$desc', Start = '$start', End = '$end' WHERE Id = $id";

    if (mysqli_query($connect, $sql)) {
        echo '<script>alert("Event edited successfully")</script>';
        echo '<script>window.location ="Calendar.php"</script>';
    } else {
        //echo ("Error description: " . mysqli_error($connect));
        echo '<script>alert("Something went wrong please try again later")</script>';
        echo '<script>window.location ="Calendar.php"</script>';
    }
}else if (isset($_POST["submit-delete"])) {

    $id = $_POST["post-id"];

    $sql = "DELETE FROM calendarevents WHERE Id = $id";

    if (mysqli_query($connect, $sql)) {
        echo '<script>alert("Event edited successfully")</script>';
        echo '<script>window.location ="Calendar.php"</script>';
    } else {
        //echo ("Error description: " . mysqli_error($connect));
        echo '<script>alert("Something went wrong please try again later")</script>';
        echo '<script>window.location ="Calendar.php"</script>';
    }
}

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="shortcut icon" type="image" href="../images/CampusBuddyNoText.png">

    <script src="../js/calendar.js"></script>
    <title> Campus Buddy | Calendar </title>

    <link rel="stylesheet" href="../css/style.css">

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
                    var evnt = calendar.getEventById(info.event.id);

                    var startDateYear = info.event.start.getFullYear();
                    var startDateMonth = info.event.start.getMonth();
                    var startDateDay = info.event.start.getDate();
                    var startToday = new Date(startDateYear, startDateMonth, startDateDay);
                    var startDate = moment(startToday).format("YYYY-MM-DD");

                    if (info.event.end == null) {
                        var endDate = startDate;
                    } else {
                        var endDateYear = info.event.end.getFullYear();
                        var endDateMonth = info.event.end.getMonth();
                        var endDateDay = info.event.end.getDate();
                        var endToday = new Date(endDateYear, endDateMonth, endDateDay);
                        var endDate = moment(endToday).format("YYYY-MM-DD");
                    }

                    $('#view-id').val(info.event.id);
                    $('#view-title').val(info.event.title);
                    $('#view-start').val(startDate);
                    $('#view-end').val(endDate);
                    $('#view-description').val(info.event.extendedProps.description);
                    $('#view-event').modal('show');
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

<body class="CalendarBackground">


    <!-- This is the Navigation Bar -->
    <nav class="navbar">
        <div class="logo"> <img src="../images/CampusBuddiesTextLogo.png" alt=""> </div>

        <div id="sidebar">
            <div class="toggle-btn" onclick="show()">
                <div id="openMenu"><i class="fa fa-bars"></i></div>
            </div>

            <div class="closeMenu" onclick="hide()"><i class="fa fa-times"></i></div>

            <ul>
                <li class="active">Home</li>
                <li>Student Support</li>
                <li>Student ID Profile</li>
                <li>Semester Calendar</li>
                <li>Library</li>
            </ul>
        </div>
    </nav>

    <!-- This is the top section of the page that doesn't scroll -->
    <div class="NoScroll">
        <!-- This is the Section Below the Navigation Bar -->
        <div class="userBar">
            <span> Hi, Chris </span>
            <img src="../images/CampusBuddyNoText.png" alt="">
        </div>

        <!-- This is the page title -->
        <div class="PageTitle">
            <span> Semester Calendar </span>
        </div>

        <!-- Month and Year -->
        <div class="MonthAndYearDiv">
            <div class="MonthAndYearBack" id="prev"> <i class="fas fa-chevron-left"></i> </div>
            <span class="MonthAndYear" id="title"> September 2021 </span>
            <div class="MonthAndYearForward" id="next"> <i class="fas fa-chevron-right"></i> </div>
        </div>
    </div>

    <div class="whiteSpace"></div>

    <div class="CalendarContainer">
        <div class="CalendarContentDiv">
            <div class="Calendar" id="calendar"></div>
            <div class="AddTaskAndAppointmentBtn">
                <button class="AddEventButton" data-toggle="modal" data-target="#new-event"> + Event/Task </button>
                <button class="AddEventButton"> + Appointment </button>
            </div>
            <div class="DisplayEventsHere">
                <div class="EventCategoryName">
                    <span> Bank Holidays </span>
                    <div class="NumberOfEvents"> 02 </div>
                </div>

                <div class="EventCategoryName">
                    <span> Electives Registration </span>
                    <div class="NumberOfEvents"> 05 </div>
                </div>

                <div class="EventCategoryName">
                    <span> Electives Registration </span>
                    <div class="NumberOfEvents"> 05 </div>
                </div>

                <div class="EventCategoryName">
                    <span> Electives Registration </span>
                    <div class="NumberOfEvents"> 05 </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <div class="bottomNavBar">
            <ul class="BottomNavUl">
                <li class="borderSettings">
                    <a href="#"> <i class="fas fa-exclamation-triangle"></i> </a>
                </li>
                <li class="borderSettings">
                    <a href="#"> <i class="fas fa-home"></i> </a>
                </li>
                <li class="borderSettings">
                    <a href="#"> <i class="far fa-calendar-alt"></i> </a>
                </li>
                <li class="borderSettings">
                    <a href="#"> <i class="fas fa-bell"></i> </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal fade" id="new-event" tabindex="-1" role="dialog" aria-labelledby="new-event" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="add-post-form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="post-title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" name="post-title" required>
                        </div>
                        <div class="form-group">
                            <label for="post-description" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="post-description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start-date" class="col-form-label">Start Date:</label>
                            <input type="date" class="form-control" name="start-date" required>
                        </div>
                        <div class="form-group">
                            <label for="end-date" class="col-form-label">End Date:</label>
                            <input type="date" class="form-control" name="end-date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Create new event" name="submit-new" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view-event" tabindex="-1" role="dialog" aria-labelledby="view-event" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="add-post-form">
                    <div class="modal-body">
                        <input type="hidden" name="post-id" id="view-id" readonly>
                        <div class="form-group">
                            <label for="post-title" class="col-form-label">Title:</label>
                            <input id="view-title" type="text" class="form-control" name="post-title" required>
                        </div>
                        <div class="form-group">
                            <label for="post-description" class="col-form-label">Description:</label>
                            <textarea id="view-description" class="form-control" name="post-description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="start-date" class="col-form-label">Start Date:</label>
                            <input id="view-start" type="date" class="form-control" name="start-date" required>
                        </div>
                        <div class="form-group">
                            <label for="end-date" class="col-form-label">End Date:</label>
                            <input id="view-end" type="date" class="form-control" name="end-date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" value="Delete event" name="submit-delete" class="btn btn-danger">
                        <input type="submit" value="Edit event" name="submit-edit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/navBar.js"></script>

</body>



</html>