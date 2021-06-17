<template>
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="page-title">Talks Per Event</h4>
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SI No.</th>
                        <th>Event Name</th>
                        <th>Total Talks</th>
                    </tr>
                </thead>

                <tbody v-if="talks.length">
                    <tr v-for="(talk,index) in talks">
                        <td class='text-center'>{{ index + 1 }}</td>
                        <td>{{ talk.event.name }}</td>
                        <td class="text-center">{{ talk.total_talks}}</td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td class='text-center' colspan='3'>No Talks Found !!!</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            talks: [],
        }
    },
    mounted() {
        this.message = window.sess_message;

        axios.post("/search/load_event_talks")
        .then(response => {
            this.talks = response.data;
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>