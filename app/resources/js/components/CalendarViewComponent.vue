<template>
	<div class="container">
		<div class="row">
			<div class="p-0 col-8">
				<Calendar></Calendar>
			</div>
			<div class="col-4 border-left pr-0">
				<h5>Events</h5>
				<small>Please select a date...</small>
			</div>
	    </div>
	</div>
</template>

<script>
import Calendar from 'v-year-calendar';

export default {
  components: {
    Calendar
  }
}
</script>