<template>
	<div>
		<app-event-generator v-on:saveEvents="saveEvents($event)"></app-event-generator>
		<div class="container">
			<div class="row">
				<div class="p-0 col-8">
					<app-calendar-view :data-source="this.dataSource"></app-calendar-view>
				</div>
				<div class="col-4 border-left pr-0">
					<h5 class="p-1 pt-2">List of Events: </h5>
						<ul class="list-group" v-for="event in events.slice().reverse()" :key="event.event_id">
							<li class="list-group-item">{{ event.event_name }}</li>
						</ul>
					</h5>
				</div>
		    </div>
		</div>
	</div>
</template>

<script>

import EventGenerator from './EventGeneratorComponent.vue';
import Calendar from './YearCalendarWrapper.vue';

export default {
	components: {
		'app-event-generator' : EventGenerator,
		'app-calendar-view' : Calendar
	},
	data() {
	  return {
		currentYear: new Date().getFullYear(),
	    minDateString: null,
	    maxDateString: null,
	    language: 'en',
	    style: 'background',
	    allowOverlap: true,
	    enableRangeSelection: false,
	    displayWeekNumber: false,
	    roundRangeLimits: false,
	    alwaysHalfDay: false,
	    dataSource: [],
	    events: []
	  }
	},
	methods: {
		saveEvents: function(data){
		  this.dataSource = data.calendarDates;

          axios.post('/saveEvent', {
              eventName: data.eventName,
              dates: data.dates
          })
          .then(response => this.events.push(response.data.data))
		}
	},
	mounted () {
        axios.get('/getEvents',)
  			 .then(response => (this.events = response.data));
	}
}
</script>