@extends('admin.index')

@section('content')

    @include('admin.employees.hr_nave')

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $title }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        $('.datatable').dataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': true,
            'info': true,
            "order": [[ 0, "desc" ]],
            'autoWidth': true
        })
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "320px";
            document.getElementById("main").style.marginLeft = "320px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
        var closeNav = function () {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "white";
        }
    </script>
@stop