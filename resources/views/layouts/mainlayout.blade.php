<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Bumil App - @yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="./plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="./plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="./plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="./plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="./plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    {{-- <link href="./plugins/sweetalert/css/sweetalert.css" rel="stylesheet"> --}}
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

</head>

<!--*******************
        Preloader start
    ********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
        Preloader end
    ********************-->

<div id="main-wrapper">

    @include('partials.header')
    @include('partials.navbar')
    @include('partials.sidebar')

</div>


<!--**********************************
Scripts
***********************************-->

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="plugins/common/common.min.js"></script>
<script src="js/custom.min.js"></script>
<script src="js/settings.js"></script>
<script src="js/gleek.js"></script>
<script src="js/styleSwitcher.js"></script>


<!-- tables -->
<script src="./plugins/tables/js/jquery.dataTables.min.js"></script>
<script src="./plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

<script src="./plugins/moment/moment.js"></script>
<script src="./plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="./plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="./plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
<script src="./plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
<script src="./plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="./plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="./plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="./plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="./js/plugins-init/form-pickers-init.js"></script>

<!-- Chartjs -->
<script src="./plugins/chart.js/Chart.bundle.min.js"></script>
<!-- Circle progress -->
<script src="./plugins/circle-progress/circle-progress.min.js"></script>
<!-- Datamap -->
<script src="./plugins/d3v3/index.js"></script>
<script src="./plugins/topojson/topojson.min.js"></script>
<script src="./plugins/datamaps/datamaps.world.min.js"></script>
<!-- Morrisjs -->
<script src="./plugins/raphael/raphael.min.js"></script>
<script src="./plugins/morris/morris.min.js"></script>
<!-- Pignose Calender -->
<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/pg-calendar/js/pignose.calendar.min.js"></script>
<!-- ChartistJS -->
<script src="./plugins/chartist/js/chartist.min.js"></script>
<script src="./plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>

{{-- sweet alert --}}

{{-- <script src="./plugins/sweetalert/js/sweetalert.min.js"></script>
<script src="./plugins/sweetalert/js/sweetalert.init.js"></script> --}}


<script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>

@yield('sweetalert')
