@extends ('layout')

<style>
.invalid-feedback
{
	display: block !important;
}
table th{
    text-align: center;
}
.text-center{
    text-align: center;
}
.text-right{
    text-align: right;
    padding-bottom: 20px;
}
</style>

@section ('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" id="app">
        <participant-talks-display></participant-talks-display>
    </div>
@endsection