@extends ('layout')

<style>
.invalid-feedback
{
	display: block !important;
}
select[multiple]
{
    height: 100px !important;
}
.rating
{
    font-size: 18px;
}
</style>

@section ('content')
        
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" id="app">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Talkshow Details</h4>
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
                @php($event_date = $talk->event->date)
                @php($cur_date = date('Y-m-d'))

                @if($event_date < $cur_date && $user_rating->isEmpty())
                    <div class="row form-group">
                        <button type="button" class="offset-10 col-md-2 btn btn-info" data-toggle="modal" data-target="#ratingModal">Please Rate <i class="far fa-star" aria-hidden="true"></i></button>
                    </div>
                @endif

                <div class="row form-group">
                    <label class="col-md-6 text-center">Name</label>
                    <div class="col-md-6">
                        {{ $talk->name }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Title</label>
                    <div class="col-md-6">
                        {{ $talk->title }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Description</label>
                    <div class="col-md-6">
                        {{ $talk->description }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Speaker</label>
                    <div class="col-md-6">
                        {{ $talk->speaker->name }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Event</label>
                    <div class="col-md-6">
                        {{ $talk->event->name }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Participants</label>
                    <div class="col-md-6">
                    @php ($participants_list = [])
                    @foreach($participants as $participant)
                        @foreach(json_decode($talk->participants) as $participant_selected)
                            @if($participant->id == $participant_selected)
                                @php ($participants_list[] = $participant->name)
                            @endif
                        @endforeach
                    @endforeach

                    {{ implode(', ', $participants_list) }}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-md-6 text-center">Tags</label>
                    <div class="col-md-6">
                    @php ($tags_list = [])
                    @foreach($tags as $tag)
                        @foreach(json_decode($talk->tags) as $tag_selected)
                            @if($tag->id == $tag_selected)
                                @php ($tags_list[] = $tag->name)
                            @endif
                        @endforeach
                    @endforeach

                    {{ implode(', ', $tags_list) }}
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            @if(!$recommended_talks->isEmpty())
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><strong>Recommended Talks</strong></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Event</th>
                            <th>Tags</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($recommended_talks as $recommended_talk)
                        <tr>
                            <td>{{ $recommended_talk->name }}</td>
                            <td>{{ $recommended_talk->event->name }}</td>
                            <td>
                            @php ($tags_list = [])
                            @foreach($tags as $tag)
                                @foreach(json_decode($recommended_talk->tags) as $tag_selected)
                                    @if($tag->id == $tag_selected)
                                        @php ($tags_list[] = $tag->name)
                                    @endif
                                @endforeach
                            @endforeach

                            {{ implode(', ', $tags_list) }}
                            </td>
                            <td><a href="{{ route('show_details',$recommended_talk->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> Show Details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>

        <!-- Modal -->
        <div id="ratingModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form class="login100-form" method="POST" action="{{ route('submit_rating', $talk->id) }}">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="ratingModalLabel"><strong>Please Rate</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="offset-2 col-md-10">
                        @foreach($ratings as $rating)
                            <div class="rating">
                                <input type="radio" name="rating_id" value="{{ $rating->id }}"><strong> {{ $rating->name }} </strong>
                                (
                                @for ($i = 1; $i <= $rating->value; $i++)
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                @endfor
                                )
                            </div>
                        @endforeach

                        @error('rating_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                </div>
            </div>
        </div>
@endsection