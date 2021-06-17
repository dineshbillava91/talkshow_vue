<template>
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Top Speakers</h4>
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
            <div class="col-md-12 text-right">
                <select name="search_type" id="search_type" v-model="search_type" @change="loadSpeakers();">
                    <option v-bind:value="1">Top speaker by task</option>
                    <option v-bind:value="2">Top speaker by rating</option>
                </select>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SI No.</th>
                        <th>Speaker Name</th>
                        <th v-if="search_type === 1">Talk Name</th>
                        <th v-if="search_type === 1">Total Talks</th>
                        <th v-if="search_type === 2">Rating</th>
                    </tr>
                </thead>

                <tbody v-if="speakers.length">
                    <tr v-for="(top_speaker,index) in speakers">
                        <td class='text-center'>{{ index + 1 }}</td>
                        <td>{{ top_speaker.speaker.name }}</td>
                        <td v-if="search_type === 1">{{ top_speaker.name }}</td>
                        <td v-if="search_type === 1" class='text-center'>{{ top_speaker.total_talks }}</td>
                        <td v-if="search_type === 2" class='text-center'>{{ parseFloat(top_speaker.rating) }}</td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td v-if="search_type === 1" class='text-center' colspan='4'>No Speakers Found !!!</td>
                        <td v-if="search_type === 2" class='text-center' colspan='3'>No Speakers Found !!!</td>
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
            search_type: 1,
            speakers: []
        }
    },
    mounted() {
        this.loadSpeakers();
    },
    methods: {
        loadSpeakers: function(){
            axios.post("/search/load_topspeaker",{ search_type : this.search_type })
            .then(response => {
                this.speakers = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
}
</script>