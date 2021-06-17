<template>
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Participants</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div id='calendar'></div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
</template>

<script>
import axios from "axios";
var moment = require('moment');

export default {
    data() {
        return {
        }
    },
    mounted() {
        this.message = window.sess_message;
        var cur_date = moment(new Date()).format("YYYY-MM-DD")

        axios.post("/participants/load_participant_talks")
        .then(response => {
            let talks = response.data;

            var events = [];
            $.each(talks, function(key, talk){
                var event = new Object();
                event.title = talk.name;
                event.start = talk.event.date+" "+talk.event.time;
                event.end = talk.event.date+" "+talk.event.time;
                event.url = "/participants/show/"+talk.id;
                
                events[key] = event;
            });

            $("#calendar").fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: cur_date,
                defaultView: 'month',
                editable: false,
                events: events,
            });
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>