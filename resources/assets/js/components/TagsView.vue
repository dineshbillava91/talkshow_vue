<template>  
    <div>          
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Tag</h4>
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
                <a href="/tag/create"><i class="fa fa-plus" aria-hidden="true"></i> Add Tag</a>
            </div>

            <table class="table table-striped">
                <tr>
                    <th>SI No.</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>

                <tbody v-if="tags.length">
                    <tr v-for="(tag,index) in tags">
                        <td class='text-center'>{{ index + 1 }}</td>
                        <td>{{ tag.name }}</td>
                        <td class='text-center'><a :href="'tag/edit/'+ tag.id" class="btn btn-info"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>&nbsp;&nbsp;<a :href="'tag/delete/'+ tag.id" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td class='text-center' colspan='3'>No Tags Found !!!</td>
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
            tags: [],
            message: ''
        }
    },
    mounted() {
        this.message = window.sess_message;

        axios.post("/tag/load_tags")
        .then(response => {
            this.tags = response.data;
        })
        .catch(error => {
            console.log(error);
        });
    }
}
</script>