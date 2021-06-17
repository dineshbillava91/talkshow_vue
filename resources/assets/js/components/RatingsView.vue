<template>
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Rating</h4>
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
                <a href="/rating/create"><i class="fa fa-plus" aria-hidden="true"></i> Add Rating</a>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>SI No.</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>

                <tbody v-if="ratings.length">
                    <tr v-for="(rating,index) in ratings">
                        <td class='text-center'>{{ index + 1 }}</td>
                        <td>{{ rating.name }}</td>
                        <td>{{ rating.value }}</td>
                        <td class='text-center'><a :href="'rating/edit/'+ rating.id" class="btn btn-info"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;<a :href="'rating/delete/'+ rating.id" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td class='text-center' colspan='4'>No Ratings Found !!!</td>
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
            ratings: [],
            message: ''
        }
    },
    mounted() {
        this.message = window.sess_message;

        axios.post("/rating/load_ratings")
        .then(response => {
            this.ratings = response.data;
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>