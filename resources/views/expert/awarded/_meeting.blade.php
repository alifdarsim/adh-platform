<div class=" tw-relative h-min-500px h-500px mt-2">
    <div class="card card-bordered tw-absolute tw-z-50 tw-w-80 tw-hidden" id="confirmTimeSlot">
        <div class="card-inner">
            <div class="card-head tw-flex tw-justify-items-center">
                <h6 class="card-title mb-0">Meeting Suggestion Slot</h6>
                <p onclick="closePopup()" class="tw-cursor-pointer"><i class="fa-regular fa-xmark"></i></p>
            </div>
            <div class="form-group">
                <div class="form-control-wrap">
                    <div class="d-flex">
                        <p class="fs-14px"><i class="fa-regular fa-user tw-w-8 fs-6"></i>
                            <span class="user">Expert (You)</span>
                        </p>
                    </div>
                    <div class="d-flex mt-3">
                        <p class="fs-14px"><i class="fa-regular fa-calendar tw-w-8 fs-6"></i>
                            <span class="date">Monday, January 1, 2024</span>
                        </p>
                    </div>
                    <div class="d-flex mt-3">
                        <p class="fs-14px"><i class="fa-regular fa-clock tw-w-8 fs-6"></i>
                            <span class="time">4:30am - 5:40am</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" onclick="addTimeSlot()" class="btn btn-sm btn-lg btn-info">Suggest time slot</button>
                <button type="submit" onclick="removeTimeSlot()" class="ms-1 btn btn-sm btn-lg btn-danger">Remove slot</button>
            </div>
        </div>
    </div>
    <div id="calendar"></div>
</div>

@push('scripts')
    <script>
        var calendar;
        var infoSelected;
        $('#meetingLink').on('shown.bs.tab', function (e) {
            // Initialize the FullCalendar when the tab is shown
            var calendarEl = document.getElementById('calendar');
            var confirmTimeSlot = document.getElementById('confirmTimeSlot');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                initialDate: new Date(),
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek'
                },
                dayMaxEvents: 1,
                height: '100%',
                scrollTime: '09:00:00',
                allDaySlot: false,
                selectable: true,
                editable: true,
                eventColor: 'rgba(22,118,251,0.8)',
                nowIndicator: "true",
                select: function (info) {
                    infoSelected = info;
                    let timeSlotElement = calendarEl.querySelector('.fc-highlight');
                    if (info.startStr.split('T')[0] === info.endStr.split('T')[0]) {
                        showPopup(calendarEl, timeSlotElement, confirmTimeSlot, info);
                        info.jsEvent.preventDefault();
                    }
                },
                eventClick: function (info, jsEvent, view) {
                    infoSelected = info;
                    console.log(info.event.title)
                    //if title contain 'Admin'  then do nothing
                    if (info.event.title.includes('Admin'))  return;
                    showPopup(calendarEl, info.el, confirmTimeSlot, info.event);
                    info.jsEvent.preventDefault();
                },
                eventDrop: function(info) {
                    updateEvent(info.event);
                },
                eventResize: function(info) {
                    updateEvent(info.event);
                },
            });
            calendar.render();
            downloadEvent();
        });



        function showPopup(calendarEl, timeSlotElement, confirmTimeSlot, info) {
            // Get the position of the clicked time slot in the calendar's view
            var timeSlotRect = timeSlotElement.getBoundingClientRect();

            // Get the position of the calendar in the viewport
            var calendarRect = calendarEl.getBoundingClientRect();
            var offsetX = timeSlotRect.left - calendarRect.left;
            var offsetY = timeSlotRect.top - calendarRect.top;

            // get width and height of the clicked time slot
            var slotWidth = timeSlotRect.right - timeSlotRect.left;
            var slotHeight = timeSlotRect.bottom - timeSlotRect.top;

            $(confirmTimeSlot).removeClass('tw-hidden');

            if (timeSlotRect.right < (calendarRect.right - 500)) {
                confirmTimeSlot.style.left = offsetX + 'px';
                offsetX = offsetX + slotWidth + 5;
                $(confirmTimeSlot).css({"opacity":0, "right":"+=200"});
                $(confirmTimeSlot).animate({left:offsetX, opacity:1},200);
            }
            else {
                confirmTimeSlot.style.left = (offsetX- confirmTimeSlot.offsetWidth) + 'px';
                offsetX = offsetX - 5 - confirmTimeSlot.offsetWidth;
                $(confirmTimeSlot).css({"opacity":0, "left":"+=200"});
                $(confirmTimeSlot).animate({left:offsetX, opacity:1},200);
            }

            // Set the position of the dialog near the click
            confirmTimeSlot.style.left = offsetX + 'px';
            confirmTimeSlot.style.top = offsetY + 'px';

            var dateRange = info.start.toLocaleDateString() + ' - ' + info.end.toLocaleDateString();
            //convert clock to am pm using dayjs
            var startTime = dayjs(info.start).format('h:mm A');
            var endTime = dayjs(info.end).format('h:mm A');

            var timeRange = startTime + ' - ' + endTime;

            confirmTimeSlot.querySelector('.date').textContent = dateRange;
            confirmTimeSlot.querySelector('.time').textContent = timeRange;
        }

        function addTimeSlot(){
            $('#confirmTimeSlot').addClass('tw-hidden');
            // Example code for creating a new event:
            uploadEvent(infoSelected);
            calendar.unselect();
        }

        function closePopup(){
            $('#confirmTimeSlot').addClass('tw-hidden');
            calendar.unselect();
        }

        function removeTimeSlot(){
            $('#confirmTimeSlot').addClass('tw-hidden');
            calendar.unselect();
            if (infoSelected.event) {
                deleteEvent(infoSelected.event);
            }
        }

        function uploadEvent(event){
            console.log(event)
            let start = event.startStr;
            let end = event.endStr;
            console.log(start)
            console.log(end)
            $.ajax({
                url: "{{route('expert.awarded.upload')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pid": "{{$project->pid}}",
                    "start": start,
                    "end": end,
                },
                success: function (response) {
                    calendar.addEvent({
                        title: '{{auth()->user()->name}}',
                        start: infoSelected.startStr,
                        end: infoSelected.endStr,
                        id: response.message,
                    });
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }

        function downloadEvent(){
            $.ajax({
                url: "{{route('expert.awarded.download')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pid": "{{$project->pid}}",
                },
                success: function (response) {
                    console.log(response)
                    response.message.forEach(function (item, index) {
                        calendar.addEvent({
                            title: item.title,
                            start: item.start,
                            end: item.end,
                            id: item.id,
                            editable: item.editable,
                            color: item.editable ? 'rgba(22,118,251,0.8)' : 'rgba(255,55,55,0.5)'
                        });
                        console.log(calendar)
                    });
                },
                error: function (response) {
                    console.log(response);
                }
            })
        }

        function deleteEvent(event){
            $.ajax({
                url: "{{route('expert.awarded.delete')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pid": "{{$project->pid}}",
                    "id": event.id,
                },
                success: function (response) {
                    event.remove();
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }

        function updateEvent(event){
            $.ajax({
                url: "{{route('expert.awarded.update')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "pid": "{{$project->pid}}",
                    "id": event.id,
                    "start": event.startStr,
                    "end": event.endStr,
                },
                success: function (response) {
                    // console.log(response);
                },
                error: function (response) {
                    // console.log(response);
                }
            })
        }
    </script>
@endpush
