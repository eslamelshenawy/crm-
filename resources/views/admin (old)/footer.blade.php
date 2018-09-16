</section>
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs hidden">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://propetzcrm.com" target="_blank">propetzcrm</a>.</strong> All
    rights
    reserved.
</footer>

</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script sr="{{ url('js/asIconPicker.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('style/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('style/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url('style/raphael/raphael.min.js') }}"></script>
{{--<script src="{{ url('style/morris.js/morris.min.js') }}"></script>--}}
<!-- Sparkline -->
<script src="{{ url('style/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('style/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('style/moment/min/moment.min.js') }}"></script>
<script src="{{ url('style/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('style/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ url('style/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('style/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.0/js/buttons.colVis.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.0/js/buttons.html5.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('style/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('style/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ url('dist/js/pages/dashboard.js') }}"></script>--}}
<script src="{{ url('plugins/file_upload/file_upload.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}"></script>
<script src="{{ url('style/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ url('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ url('plugins/iCheck/icheck.min.js') }}"></script>
<!-- FLOT CHARTS -->
<script src="{{ url('style/Flot/jquery.flot.js') }}"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="{{ url('style/Flot/jquery.flot.resize.js') }}"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="{{ url('style/Flot/jquery.flot.pie.js') }}"></script>

<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="{{ url('style/Flot/jquery.flot.categories.js') }}"></script>
<script src="{{ url('js/bootstrap-tagsinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>

<!-- CK Editor -->
<script src="{{ url('style/ckeditor/ckeditor.js') }}"></script>

<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
    });

    $('.timepicker').timepicker({
        showInputs: false
    });

    $('.select2').select2();

    $(".switch-box").bootstrapSwitch();
</script>
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })
</script>
<script>
    $('#ddss').click(function () {
        console.log('sheno');
        $('#ddssa').submit();
    })
</script>

<script src="{{ url('socket/node_modules/socket.io/node_modules/socket.io-client/socket.io.js') }}"></script>
<script>
    var socket = io.connect('https://newavenue-egypt.com:4619');
    socket.on('notify', function (data) {
        if (data.assigned_to == '{{ auth()->user()->id }}' || '{{ auth()->user()->type }}' == 'admin') {
            var count = parseInt($('#countNotifications').text());
            $('#notifications').prepend('<a href="#"><li>'+data.notification+'</li></a>');
            $('#countNotifications').html(count + 1);
        }
    });

</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>

<script>
    $(document).on('click', '.notificationElement', function () {
        var id = $(this).attr('nid');
        var url = $(this).attr('url');
        var _token = '{{ csrf_token() }}';
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {id: id, _token: _token},
            url: '{{ url(adminPath().'/notification-status') }}',
            success: function (data) {
                if (data.status == 1) {
                    window.location.href = url;
//                    alert(url);
                }
            }
        })
    })
    $('.unread').on('click',function () {
        var elem = $(this);
        var id =$(this).attr('noti-id');
        var _token = '{{ csrf_token() }}';
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {id: id, _token: _token},
            url: '{{ url(adminPath().'/unread') }}',
            success: function (data) {
                if (data.status === 'read') {
//                    console.log($("status="+id));
                   $("#noti-"+id).css('color','#414561');
                   console.log(elem);
                   elem.attr('title','mark as read');
                   $('[data-toggle=tooltip]').tooltip();
                   $('#countNotifications').text(parseInt($('#countNotifications').text())+1);
//                    alert(url);
                }
                else{
                    $("#noti-"+id).css('color','#eee');
                    console.log(elem);
                    elem.attr('title','mark as unread');
                    $('[data-toggle=tooltip]').tooltip();
                    $('#countNotifications').text(parseInt($('#countNotifications').text())-1);
                }
            }
        })
    });
</script>

@if(session()->has('notification') and session()->has('assigned_to'))
    <script>
        $(document).ready(function () {
            var data = {
                'notification': '{{ session()->get("notification") }}',
                'assigned_to': '{{ session()->get("assigned_to") }}'
            };
            var socket = io.connect('https://newavenue-egypt.com:4619');
            socket.emit('notify', data);
        })
    </script>
@endif
@yield('js')
</body>
</html>