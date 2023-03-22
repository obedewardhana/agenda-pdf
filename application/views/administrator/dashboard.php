<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3 pr-5 pl-3">
    <div class="row">
        <div class="col-sm-6 col-lg-3 pl-4 pr-0">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4 class="mb-0">
                        <span class="count"><?= $agenda; ?></span>
                    </h4>
                    <p class="text-light">Agenda</p>
                    <div class="card-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 pl-4 pr-0">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4 class="mb-0">
                        <span class="count"><?= $invitation; ?></span>
                    </h4>
                    <p class="text-light">Undangan</p>
                    <div class="card-icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 pl-4 pr-0">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4 class="mb-0">
                        <span class="count"><?= $minutes; ?></span>
                    </h4>
                    <p class="text-light">Notulen</p>
                    <div class="card-icon">
                        <i class="fa fa-file"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 pl-4 pr-0">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h4 class="mb-0">
                        <span class="count"><?= $user; ?></span>
                    </h4>
                    <p class="text-light">User</p>
                    <div class="card-icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12 pl-4 pr-0">
            <div class="card bg-primary p-5 bg-white">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // editable: true,
            headerToolbar: {
                left: 'prevYear,prev,next,nextYear today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            events: "<?php echo base_url(); ?>calendar/load",
            disableDragging: true
            // selectable: true,
            // selectHelper: true,
            // select: function(start, end, allDay) {
            //     var title = prompt("Enter Event Title");
            //     if (title) {
            //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            //         $.ajax({
            //             url: "<?php echo base_url(); ?>fullcalendar/insert",
            //             type: "POST",
            //             data: {
            //                 title: title,
            //                 start: start,
            //                 end: end
            //             },
            //             success: function() {
            //                 calendar.fullCalendar('refetchEvents');
            //                 alert("Added Successfully");
            //             }
            //         })
            //     }
            // },
            // editable: true,
            // eventResize: function(event) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

            //     var title = event.title;

            //     var id = event.id;

            //     $.ajax({
            //         url: "<?php echo base_url(); ?>calendar/update",
            //         type: "POST",
            //         data: {
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id
            //         },
            //         success: function() {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Update");
            //         }
            //     })
            // },
            // eventDrop: function(event) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            //     //alert(start);
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            //     //alert(end);
            //     var title = event.title;
            //     var id = event.id;
            //     $.ajax({
            //         url: "<?php echo base_url(); ?>calendar/update",
            //         type: "POST",
            //         data: {
            //             title: title,
            //             start: start,
            //             end: end,
            //             id: id
            //         },
            //         success: function() {
            //             calendar.fullCalendar('refetchEvents');
            //             alert("Event Updated");
            //         }
            //     })
            // },
            // eventClick: function(event) {
            //     if (confirm("Are you sure you want to remove it?")) {
            //         var id = event.id;
            //         $.ajax({
            //             url: "<?php echo base_url(); ?>calendar/delete",
            //             type: "POST",
            //             data: {
            //                 id: id
            //             },
            //             success: function() {
            //                 calendar.fullCalendar('refetchEvents');
            //                 alert('Event Removed');
            //             }
            //         })
            //     }
            // }
        });
        calendar.render();
    });
</script>
</script>