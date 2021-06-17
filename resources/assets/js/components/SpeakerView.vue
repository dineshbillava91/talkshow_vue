<template>
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Speakers</h4>
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
            <div v-if="message" class="col-md-12 alert alert-success">
            {{ message }}
            </div>

            <div class="col-md-12 text-right">
                <a href="/speaker/create"><i class="fa fa-plus" aria-hidden="true"></i> Add Speaker</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SI No.</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody v-if="speakers.length">
                    <tr v-for="(speaker,index) in speakers">
                        <td class='text-center'>{{ index + 1 }}</td>
                        <td>{{ speaker.name }}</td>
                        <td class='text-center'><a :href="'speaker/edit/'+ speaker.id" class="btn btn-info"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;<a :href="'speaker/delete/'+ speaker.id" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td class='text-center' colspan='6'>No Speakers Found !!!</td>
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
            speakers: [],
            message: ''
        }
    },
    mounted() {
        this.message = window.sess_message;

        axios.post("/speaker/load_speakers")
        .then(response => {
            this.speakers = response.data;
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>
