<template>
  <div class="p-4" style="background:#e2e2e2">
    <p v-if="errors.length">
      <b>Please correct the following error(s):</b>
      <ul>
        <li v-for="error in errors">{{ error }}</li>
      </ul>
    </p>
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
        <button class="btn btn-primary" @click="onSaveEvent">Save</button>
      </div>
    </div>
</div>
</template>

<script>
  import moment from 'moment'
  export default {
    data() {
      return {
        errors: [],
        fromdate: null,
        todate: null,
        eventname: null,
        days: [],
        options: [
          { item: '0', name: 'Sunday' },
          { item: '1', name: 'Monday' },
          { item: '2', name: 'Tuesday' },
          { item: '3', name: 'Wednesday' },
          { item: '4', name: 'Thursday' },
          { item: '5', name: 'Friday' },
          { item: '6', name: 'Saturday' },
        ]
      }
    },
    methods: {
        onSaveEvent: function() {
          if(this.checkForm()){
            let start = moment(this.fromdate);
            let end   = moment(this.todate);
            var arr = [];
            var view = [];
            let tmp = start.clone();

            while( tmp.isSameOrBefore(end) ){
              this.days.forEach(weekday => {
                  if(tmp.weekday() == weekday){
                    arr.push(tmp.format('YYYY-MM-DD'));
                    view.push({
                      startDate : tmp.toDate(),
                      endDate : tmp.toDate(),
                      color : 'blue'
                    })
                  }
              })
              tmp.add(1, 'd');
            }

            this.$emit('saveEvents', {
                calendarDates : view,
                eventName: this.eventname,
                dates: arr
            });
          }
        },
        checkForm: function (e) {
          if (this.eventname && this.todate && this.fromdate) {
            return true;
          }

          this.errors = [];

          if (!this.eventname) {
            this.errors.push('Event Name required.');
          }
          if (!this.todate) {
            this.errors.push('Start Date required.');
          }
          if (!this.fromdate) {
            this.errors.push('End Date required.');
          }

          e.preventDefault();
        }
    }
  }
</script>