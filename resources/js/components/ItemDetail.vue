<template xmlns="http://www.w3.org/1999/html">
  <div class="container">
    <div class="row">
      <div class="col-md"> <img src="http://placehold.it/340x340" alt=""></div>
      <div class="col-md-8">
        <address>
          <strong>Title:</strong> <span> {{apiData.title}}</span><br>
        </address>
        <h4><strong>Price: {{apiData.price}} USD</strong></h4>
        <div style="height:50%;">{{apiData.description}}</div>
        <div style="height:17%;">
          <vue-countdown-timer
              @start_callback="startCallBack('event started')"
              @end_callback="endCallBack('event ended')"
              :start-time=currentDate
              :end-time="apiData.end_date"
              :interval="1000"
              :start-label="'Until start:'"
              :end-label="'Time left to close bid'"
              label-position="begin"
              :end-text="'Event ended!'"
              :day-txt="'days'"
              :hour-txt="'hours'"
              :minutes-txt="'minutes'"
              :seconds-txt="'seconds'">
          </vue-countdown-timer>
        </div>
        <div>
          <button @click="submitBid()" class="btn btn-success">Submit Bid</button>
          <input type="checkbox" @click="autoBid()" class="btn btn-success" ref="bidSelected" :checked="bidData"/><label>Autobid item</label>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ItemDetail",
  methods: {
    startCallBack: function(x) {
      console.log(x);
    },
    endCallBack: function(x) {
      console.log(x);
    },
    submitBid() {
      axios.post('/update', {id: this.apiData.id, price: this.apiData.price})
          .then(response => {
            if(response.data.error == 'max_limit') {
              alert('You exceeded the maximum price');
            } else {
              alert('Bid submitted');
              location.reload();
            }
          })
          .catch(errors => {
              console.log(errors);
          });
    },
    autoBid() {
      axios.post('/updateBidCheck', {id: this.apiData.id, checked: this.$refs.bidSelected.checked})
          .then(response => {
            alert('Auto Bidding updated')
          })
          .catch(errors => {
            console.log(errors);
          });

      if(this.$refs.bidSelected.checked == true) {
        axios.post('/autoBid', {id: this.apiData.id, price: this.apiData.price})
            .then(response => {})
            .catch(errors => {
              console.log(errors);
            });
      }
    }
  },
  props: {
    apiData: {
      type: Object,
      required: true
    },
    bidData: 0
  },
  data() {
    return {
      currentDate: Date.now()
    }
  },
  watch: {
    timerCount: {
      handler(value) {

        if (value > 0) {
          setTimeout(() => {
            this.timerCount--;
          }, 1000);
        }

      },
      immediate: true
    }
  }
}
</script>