<!DOCTYPE html>  
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset("custom-image/logo.png") }}">
    <title>Student Information Exchange</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ URL::asset("bootstrap/dist/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{ URL::asset("plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css") }}" rel="stylesheet">
    <link href="{{ URL::asset("plugins/bower_components/morrisjs/morris.css") }}" rel="stylesheet">
    @yield('other-styles')
    <!-- morris CSS -->
    <!-- animation CSS -->
    <link href="{{ URL::asset("css/animate.css") }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ URL::asset("css/style.css") }}" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{ URL::asset("css/colors/default.css") }}" id="theme" rel="stylesheet">
    <link href="{{ URL::asset("plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css") }}" rel="stylesheet">

   </head>

<body>
    <!-- Preloader -->
    <!-- <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div> -->
    <div id="wrapper">
        @yield('content')
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{ URL::asset("plugins/bower_components/jquery/dist/jquery.min.js") }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset("bootstrap/dist/js/bootstrap.min.js") }}"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{ URL::asset("plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js") }}"></script>
    <!--slimscroll JavaScript -->
    <script src="{{ URL::asset("js/jquery.slimscroll.js") }}"></script>
    <!--Wave Effects -->
    <script src="{{ URL::asset("js/waves.js") }}"></script>

    <script src="{{ URL::asset("js/custom.min.js") }}"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="{{ URL::asset("plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js") }}"></script>
    <script src="{{ URL::asset("plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js") }}"></script>
    <!--Style Switcher -->
<script src="{{ URL::asset("plugins/bower_components/styleswitcher/jQuery.style.switcher.js") }}"></script>
@yield('other-scripts')
<script src="{{ URL::asset("plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") }}"></script>
<script src="{{ URL::asset("plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js") }}"></script>
</body>

</html>