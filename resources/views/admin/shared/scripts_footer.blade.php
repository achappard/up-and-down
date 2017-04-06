<script src="{{ URL::asset('adminLTE/vendor/js/jquery-2.2.3.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/fastclick.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/datepicker/locales/bootstrap-datepicker.fr.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/app.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/vendor/js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('adminLTE/js/back_upanddown.js') }}"></script>



<script>
    $(function () {
        $('#datepicker').datepicker({
            autoclose: true,
            format: "dd/mm/yyyy",
            language: 'fr'
        });
    });
</script>