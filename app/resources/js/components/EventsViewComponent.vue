<template>
	<div>
		<h5 class="p-1">List of Events: </h5>
		<ul class="list-group" v-for="event in events" :key="event.event_id">
			<li class="list-group-item">{{ event.event_name }}</li>
		</ul>
	</div>
</template>

<script>
	import moment from 'moment'
	export default {
		data() {
			return {
				events : []
			}
		},
		mounted () {
	        axios.get('/getEvents',)
      			 .then(response => (this.events = response.data))
		}
	}
</script>
				