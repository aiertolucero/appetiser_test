<template>
	<div>
		<app-event-generator v-on:displayDates="setDataSource($event)"></app-event-generator>
		<div class="container">
			<div class="row">
				<div class="p-0 col-8">
					<app-calendar-view :data-source="this.dataSource"></app-calendar-view>
				</div>
				<div class="col-4 border-left pr-0">
					<h5>Events</h5>
					<small>Please select a date...</small>
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
	    dataSource: []
	  }
	},
	methods: {
		setDataSource: function(dates){
			this.dataSource = dates;
		} 
	}
}
</script>