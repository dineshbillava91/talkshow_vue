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
</style>

@section ('content')
        
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Add Talk</h4>
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
                <form class="login100-form" method="POST" action="{{ route('store_talk') }}">
                    @csrf
                    <div class="offset-3 col-md-6">
                        <div class="row form-group">
                            <label class="col-md-5 text-center">Name</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Title</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" name="title" value="{{ old('title') }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Speakers</label>
                            <div class="col-md-6">
                                <select class="form-control" name="speaker_id" id="speaker_id">
                                    <option value="">Select Speaker</option>
                                    @foreach($speakers as $speaker)
                                        <option value="{{ $speaker->id }}" {{ (collect(old('speaker_id'))->contains($speaker->id)) ? 'selected':'' }} >{{ $speaker->name }}</option>
                                    @endforeach
                                </select>

                                @error('speaker_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Events</label>
                            <div class="col-md-6">
                                <select class="form-control" name="event_id" id="events">
                                    <option value="">Select Events</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}" {{ (old('event_id') == $event->id) ? 'selected':'' }}>{{ $event->name }}</option>
                                    @endforeach
                                </select>

                                @error('event_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Participants</label>
                            <div class="col-md-6">
                                <select class="form-control" name="participants[]" id="participants" multiple>
                                    <option value="">Select Participants</option>
                                    @foreach($participants as $participant)
                                        <option value="{{ $participant->id }}" {{ (collect(old('participants'))->contains($participant->id)) ? 'selected':'' }}>{{ $participant->name }}</option>
                                    @endforeach
                                </select>

                                @error('participants')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label class="col-md-5 text-center">Tags</label>
                            <div class="col-md-6">
                                <select class="form-control" name="tags[]" id="tags" multiple>
                                    <option value="">Select Tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>

                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <input type="submit" class="btn btn-success col-md-2" value="Save">
                            <a class="btn btn-dark col-md-2" href="{{ route('talks') }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
@endsection