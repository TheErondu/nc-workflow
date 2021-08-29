@extends('layouts.app', ['activePage' => 'schedule', 'titlePage' => __('Dashboard')])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="tab">
                                <ul class="nav nav-tabs justify-content-between" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" href="#tab-1" data-bs-toggle="tab"
                                            role="tab">Pre-Productions Scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-2" data-bs-toggle="tab"
                                            role="tab">Video Editors scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-3" data-bs-toggle="tab"
                                            role="tab">Graphics Editors scheduler</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab-4" data-bs-toggle="tab"
                                            role="tab">Digial Editors scheduler</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-1" role="tabpanel">
                                            <div id="calendar"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="tab-pane" id="tab-2" role="tabpanel">
                                            <div id="calendar2"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="tab-pane" id="tab-3" role="tabpanel">
                                            <div id="calendar3"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>
                                    </div>
                                    <div class="tab-pane" id="tab-4" role="tabpanel">
                                            <div id="calendar4"></div>
                                            <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create <i
                                                    class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    @endsection
    @section('javascript')
    <link href='https://demos.creative-tim.com/fullcalendar/assets/css/fullcalendar.css' rel='stylesheet' />
    <link href='https://demos.creative-tim.com/fullcalendar/assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <script src='https://demos.creative-tim.com/fullcalendar/assets/js/jquery-1.10.2.js' type="text/javascript"></script>
    <script src='https://demos.creative-tim.com/fullcalendar/assets/js/jquery-ui.custom.min.js' type="text/javascript"></script>
    <script src='https://demos.creative-tim.com/fullcalendar/assets/js/fullcalendar.js' type="text/javascript"></script>

        <script>
              var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		/*  className colors

		className: default(transparent), important(red), chill(pink), success(green), info(blue)

		*/


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (https://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});
		var calendar =  $('#calendar').fullCalendar({
			header: {
				left: 'title',
				center: 'agendaDay,agendaWeek,month',
				right: 'prev,next today'
			},
			editable: true,
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			selectable: true,
			defaultView: 'month',

			axisFormat: 'h:mm',
			columnFormat: {
                month: 'ddd',    // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d',  // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
            },
			allDaySlot: false,
			selectHelper: true,
			select: function(start, end, allDay) {
				var title = prompt('Event Title:');
				if (title) {
					calendar.fullCalendar('renderEvent',
						{
							title: title,
							start: start,
							end: end,
							allDay: allDay
						},
						true // make the event "stick"
					);
				}
				calendar.fullCalendar('unselect');
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped

				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');

				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);

				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;

				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (https://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#calendar').fullCalendar('renderEvent');

        });
        $('#myTab a:first').tab('show');

				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}

			},

			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false,
					className: 'info'
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false,
					className: 'important'
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false,
				},
				{
					title: 'Click for Google',
					start: new Date(y, m, 28),
					end: new Date(y, m, 29),
					url: 'https://google.com/',
					className: 'success'
				}
			],
		});
</script>
<script>
    var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

/*  className colors

className: default(transparent), important(red), chill(pink), success(green), info(blue)

*/


/* initialize the external events
-----------------------------------------------------------------*/

$('#external-events div.external-event').each(function() {

  // create an Event Object (https://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
  // it doesn't need to have a start or end
  var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
  };

  // store the Event Object in the DOM element so we can get to it later
  $(this).data('eventObject', eventObject);

  // make the event draggable using jQuery UI
  $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
  });

});
var calendar =  $('#calendar2').fullCalendar({
  header: {
      left: 'title',
      center: 'agendaDay,agendaWeek,month',
      right: 'prev,next today'
  },
  editable: true,
  firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
  selectable: true,
  defaultView: 'month',

  axisFormat: 'h:mm',
  columnFormat: {
      month: 'ddd',    // Mon
      week: 'ddd d', // Mon 7
      day: 'dddd M/d',  // Monday 9/7
      agendaDay: 'dddd d'
  },
  titleFormat: {
      month: 'MMMM yyyy', // September 2009
      week: "MMMM yyyy", // September 2009
      day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
  },
  allDaySlot: false,
  selectHelper: true,
  select: function(start, end, allDay) {
      var title = prompt('Event Title:');
      if (title) {
          calendar.fullCalendar('renderEvent',
              {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
              },
              true // make the event "stick"
          );
      }
      calendar.fullCalendar('unselect');
  },
  droppable: true, // this allows things to be dropped onto the calendar !!!
  drop: function(date, allDay) { // this function is called when something is dropped

      // retrieve the dropped element's stored Event Object
      var originalEventObject = $(this).data('eventObject');

      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);

      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = allDay;

      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (https://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar2').fullCalendar('renderEvent', copiedEventObject, true);

      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
      }
      $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#calendar2').fullCalendar('renderEvent');

        });
        $('#myTab a:first').tab('show');

  },

  events: [
      {
          title: 'All Day Event',
          start: new Date(y, m, 1)
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d-3, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d+4, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Birthday Party',
          start: new Date(y, m, d+1, 19, 0),
          end: new Date(y, m, d+1, 22, 30),
          allDay: false,
      },
      {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'https://google.com/',
          className: 'success'
      }
  ],
});
</script>
<script>
    var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

/*  className colors

className: default(transparent), important(red), chill(pink), success(green), info(blue)

*/


/* initialize the external events
-----------------------------------------------------------------*/

$('#external-events div.external-event').each(function() {

  // create an Event Object (https://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
  // it doesn't need to have a start or end
  var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
  };

  // store the Event Object in the DOM element so we can get to it later
  $(this).data('eventObject', eventObject);

  // make the event draggable using jQuery UI
  $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
  });

});
var calendar =  $('#calendar3').fullCalendar({
  header: {
      left: 'title',
      center: 'agendaDay,agendaWeek,month',
      right: 'prev,next today'
  },
  editable: true,
  firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
  selectable: true,
  defaultView: 'month',

  axisFormat: 'h:mm',
  columnFormat: {
      month: 'ddd',    // Mon
      week: 'ddd d', // Mon 7
      day: 'dddd M/d',  // Monday 9/7
      agendaDay: 'dddd d'
  },
  titleFormat: {
      month: 'MMMM yyyy', // September 2009
      week: "MMMM yyyy", // September 2009
      day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
  },
  allDaySlot: false,
  selectHelper: true,
  select: function(start, end, allDay) {
      var title = prompt('Event Title:');
      if (title) {
          calendar.fullCalendar('renderEvent',
              {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
              },
              true // make the event "stick"
          );
      }
      calendar.fullCalendar('unselect');
  },
  droppable: true, // this allows things to be dropped onto the calendar !!!
  drop: function(date, allDay) { // this function is called when something is dropped

      // retrieve the dropped element's stored Event Object
      var originalEventObject = $(this).data('eventObject');

      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);

      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = allDay;

      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (https://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar4').fullCalendar('renderEvent', copiedEventObject, true);

      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
      }
      $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#calendar3').fullCalendar('renderEvent');

        });
        $('#myTab a:first').tab('show');

  },

  events: [
      {
          title: 'All Day Event',
          start: new Date(y, m, 1)
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d-3, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d+4, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Birthday Party',
          start: new Date(y, m, d+1, 19, 0),
          end: new Date(y, m, d+1, 22, 30),
          allDay: false,
      },
      {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'https://google.com/',
          className: 'success'
      }
  ],
});
</script>
<script>
    var date = new Date();
var d = date.getDate();
var m = date.getMonth();
var y = date.getFullYear();

/*  className colors

className: default(transparent), important(red), chill(pink), success(green), info(blue)

*/


/* initialize the external events
-----------------------------------------------------------------*/

$('#external-events div.external-event').each(function() {

  // create an Event Object (https://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
  // it doesn't need to have a start or end
  var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
  };

  // store the Event Object in the DOM element so we can get to it later
  $(this).data('eventObject', eventObject);

  // make the event draggable using jQuery UI
  $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
  });

});
var calendar =  $('#calendar4').fullCalendar({
  header: {
      left: 'title',
      center: 'agendaDay,agendaWeek,month',
      right: 'prev,next today'
  },
  editable: true,
  firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
  selectable: true,
  defaultView: 'month',

  axisFormat: 'h:mm',
  columnFormat: {
      month: 'ddd',    // Mon
      week: 'ddd d', // Mon 7
      day: 'dddd M/d',  // Monday 9/7
      agendaDay: 'dddd d'
  },
  titleFormat: {
      month: 'MMMM yyyy', // September 2009
      week: "MMMM yyyy", // September 2009
      day: 'MMMM yyyy'                  // Tuesday, Sep 8, 2009
  },
  allDaySlot: false,
  selectHelper: true,
  select: function(start, end, allDay) {
      var title = prompt('Event Title:');
      if (title) {
          calendar.fullCalendar('renderEvent',
              {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
              },
              true // make the event "stick"
          );
      }
      calendar.fullCalendar('unselect');
  },
  droppable: true, // this allows things to be dropped onto the calendar !!!
  drop: function(date, allDay) { // this function is called when something is dropped

      // retrieve the dropped element's stored Event Object
      var originalEventObject = $(this).data('eventObject');

      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);

      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = allDay;

      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (https://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
      }
      $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            $('#calendar4').fullCalendar('renderEvent');

        });
        $('#myTab a:first').tab('show');

  },

  events: [
      {
          title: 'All Day Event',
          start: new Date(y, m, 1)
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d-3, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          id: 999,
          title: 'Repeating Event',
          start: new Date(y, m, d+4, 16, 0),
          allDay: false,
          className: 'info'
      },
      {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          className: 'important'
      },
      {
          title: 'Birthday Party',
          start: new Date(y, m, d+1, 19, 0),
          end: new Date(y, m, d+1, 22, 30),
          allDay: false,
      },
      {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'https://google.com/',
          className: 'success'
      }
  ],
});
</script>



    @endsection
