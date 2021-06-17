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
.container-fluid{
    padding: 25px;
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

            <talks-display></talks-display>
            
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>

        <script>
            window.sess_message = "";
            @if(Session::has('success'))
                window.sess_message = "{{ Session::get('success') }}";
            @endif
        </script>
@endsection