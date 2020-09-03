<template>
  <div class="p-4" style="background:#e2e2e2">
    <div class="row">
      <div class="col-12">
        <label>Event</label>
        <b-form-input v-model="eventname" placeholder="Enter event name"></b-form-input>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-12">
        <label for="example-datepicker">From</label>
        <b-form-datepicker id="example-datepicker" v-model="fromdate" class="mb-2"></b-form-datepicker>
      </div>
      <div class="col-md-6 col-sm-12">
        <label for="example-datepicker">To</label>
        <b-form-datepicker id="example-datepicker" v-model="todate" class="mb-2"></b-form-datepicker>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <b-form-checkbox-group
          v-model="days"
          :options="options"
          value-field="item"
          text-field="name"
        >
        </b-form-checkbox-group>
      </div>
    </div>
    <div class="row">
      <div class="col-12 pt-3">
        <button class="btn btn-primary" @click="saveEvent">Save</button>
      </div>
    </div>
</div>
</template>

<script>
  import moment from 'moment'
  export default {
    data() {
      return {
        fromdate: '',
        todate: '',
        eventname: '',
        days: [],
        options: [
          { item: 'Sunday', name: 'Sunday' },
          { item: 'Monday', name: 'Monday' },
          { item: 'Tuesday', name: 'Tuesday' },
          { item: 'Wednesday', name: 'Wednesday' },
          { item: 'Thursday', name: 'Thursday' },
          { item: 'Friday', name: 'Friday' },
          { item: 'Saturday', name: 'Saturday' },
        ]
      }
    },
    methods: {
        saveEvent: function() {
          let start = moment(this.fromdate);
          let end   = moment(this.todate);
          var arr = [];
          var view = [];
          let tmp = start.clone();

          while( tmp.isBefore(end) ){
            this.days.forEach(weekday => {
              if(tmp.day(weekday).isSameOrAfter(start)){
                var toPushDay = tmp.day(weekday);
                arr.push(toPushDay);
                view.push({
                  startDate : toPushDay.toDate(),
                  endDate : toPushDay.toDate(),
                  color : 'yellow'
                })
              }
            })
            tmp.add(1, 'w');
          }

          this.$emit('displayDates',view);
        }  
    }
  }
</script>