<template>
    <div>
        <div class="page-breadcrumb bg-white">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Talks</h4>
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

            <div class="col-md-12 text-right" style="display: flex;">
                <div class="col-md-4 offset-1">
                    <select class="form-control" name="speaker" id="speaker" v-model="speaker" @change="loadTalks()">
                        <option value="">Select Speaker</option>
                        <option v-for="(speaker,index) in speakers" v-bind:value="speaker.id">{{ speaker.name }}</option>
                    </select>
                </div>

                <div class="col-md-4 offset-1">
                    <select class="form-control" name="tag" id="tag" v-model="tag" @change="loadTalks()">
                        <option value="">Select Tag</option>
                        <option v-for="(tag,index) in tags" v-bind:value="tag.id">{{ tag.name }}</option>
                    </select>
                </div>

                <a class="col-md-2" href="/talks/create"><i class="fa fa-plus" aria-hidden="true"></i> Add Talk</a>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th nowrap>SI No.</th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Speaker</th>
                        <th>Events</th>
                        <th>Participants</th>
                        <th>Tags</th>
                        <th>Rating</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody v-if="talks.length">
                    <tr v-for="(talk,index) in talks">
                        <td>{{ index + 1 }}</td>
                        <td>{{ talk.name }}</td>
                        <td>{{ talk.title }}</td>
                        <td>{{ talk.description }}</td>
                        <td>{{ talk.speaker.name }}</td>
                        <td>{{ talk.event.name }}</td>
                        <td>{{ participant_name(talk.participants) }}</td>
                        <td>{{ tag_name(talk.tags) }}</td>
                        <td class='text-center'>{{ talk.rating != null ? parseFloat(talk.rating) : '' }}</td>
                        <td><a :href="'talks/edit/' + talk.id" class="btn btn-info"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a><a :href="'talks/delete/' + talk.id" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr>
                        <td class='text-center' colspan='10'>No Talks Found !!!</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            speaker: '',
            tag: '',
            talks: [],
            participants: [],
            tags: [],
            speakers: [],
            message: ''
        }
    },
    mounted() {
        this.loadTalks();
        this.message = window.sess_message;
    },
    methods: {
        loadTalks: function(){
            axios.post("/talks/search",{ speaker:this.speaker,tag:this.tag })
            .then(response => {
                this.talks = response.data.talks;
                this.participants = response.data.participants;
                this.tags = response.data.tags;
                this.speakers = response.data.speakers;
            })
            .catch(error => {
                console.log(error);
            });
        },
        participant_name: function(talk_participants){
            var selected_participants = [];

            talk_participants = JSON.parse(talk_participants);
            var all_participants = this.participants;

            $.each(talk_participants, function(key1,participant_stored){
                $.each(all_participants, function(key2,participant){
                    if(participant.id == participant_stored){
                        selected_participants.push(participant.name);
                    }
                });
            });

            return selected_participants.join(', ');
        },
        tag_name: function(talk_tags){
            var selected_tags = [];

            talk_tags = JSON.parse(talk_tags);
            var all_tags = this.tags;
            
            $.each(talk_tags, function(key1,tag_stored){
                $.each(all_tags, function(key2,tag){
                    if(tag.id == tag_stored){
                        selected_tags.push(tag.name);
                    }
                });
            });

            return selected_tags.join(', ');
        }
    }
}
</script>
