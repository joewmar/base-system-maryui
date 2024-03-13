@section('title') Schedule @endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
@endpush
    <div class="container pt-20">
        <div class=" font-semibold m-5">
            <p class="text-2xl">Delivery Management | Schedule</p>
            <div id='calendar' class="text-xl"></div>
        </div>
    </div>
       
<script>
    $(document).ready(function () {
        // Define the site URL
        var SITEURL = '';

        // Setup AJAX headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Initialize FullCalendar
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: SITEURL,
            displayEventTime: false,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {
                // Prompt for event title
                var title = prompt('Event Title:');
                if (title) {
                    var start = $.fullCalendar.formatDate(start, 'Y-MM-DD');
                    var end = $.fullCalendar.formatDate(end, 'Y-MM-DD');
                    // Add event via AJAX
                    $.ajax({
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            type: 'add'
                        },
                        type: 'POST',
                        success: function (data) {
                            displayMessage('Event Created Successfully');
                            calendar.fullCalendar('renderEvent', {
                                id: data.id,
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            }, true);
                            calendar.fullCalendar('unselect');
                        }
                    });
                }
            },
            eventDrop: function (event, delta) {
                var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD');
                var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD');
                // Update event via AJAX
                $.ajax({
                    data: {
                        title: event.title,
                        start: start,
                        end: end,
                        id: event.id,
                        type: 'update'
                    },
                    type: 'POST',
                    success: function (response) {
                        displayMessage('Event Updated Successfully');
                    }
                });
            },
            eventClick: function (event) {
                var deleteMsg = confirm('Do you really want to delete?');
                if (deleteMsg) {
                    // Delete event via AJAX
                    $.ajax({
                        type: 'POST',
                        data: {
                            id: event.id,
                            type: 'delete'
                        },
                        success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage('Event Deleted Successfully');
                        }
                    });
                }
            }
        });

        // Function to display Toastr messages
        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    });
</script>