@extends ('layout')

<style>
.invalid-feedback
{
	display: block !important;
}
table th{
    text-align: center;
}
.text-right{
    text-align: right;
    padding-bottom: 20px;
}
.text-center{
    text-align: center;
}
</style>

@section ('content')
        
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" id="app">
        <samedaytalks-display></samedaytalks-display>
    </div>

@endsection