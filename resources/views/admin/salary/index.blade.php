@extends('admin.index')

@section('content')
<style>
    .table .round-img img {
    width: 38px;
}

.round-img img {
    border-radius: 100px;
}
.slip {
    text-align:center;
}
#date{
    float:right;
}
    
    /*Check box*/
input[type="checkbox"] + .label-text:before{
	content: "\f096";
	font-family: "FontAwesome";
	speak: none;
	font-style: normal;
	font-weight: normal;
	font-variant: normal;
	text-transform: none;
	line-height: 1;
	-webkit-font-smoothing:antialiased;
	width: 1em;
	display: inline-block;
	margin-right: 5px;
}

input[type="checkbox"]:checked + .label-text:before{
	content: "\f14a";
	color: #2980b9;
	animation: effect 250ms ease-in;
}

input[type="checkbox"]:disabled + .label-text{
	color: #aaa;
}

input[type="checkbox"]:disabled + .label-text:before{
	content: "\f0c8";
	color: #ccc;
}
input[type="checkbox"], input[type="radio"]{
	position: absolute;
	right: 9000px;
}
.select-btn{
    height: 50px;
}
#filter{
    position: absolute;
    top: 76px;
    right: 704px;
}




    </style>
    @include('admin.employee.hr_nav')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $title }}</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            
               {!! Form::open(['method'=>'POST' , 'action'=> ['SalariesController@index']]) !!}
               <div class="select-btn">
                   
               <button class="btn btn-secondary rounded-s" id="filter" type="submit">
                
                        <i class="fa fa-search"></i> Filter
                    </button>
                
                    <div class='form-group col-md-3'id="date">
                    {!! Form::label('to_date','To Date:') !!}
                    {!! Form::text('to_date', null,['class'=>'form-control datepicker']) !!}
                    </div>
                  <div class='form-group col-md-3' id='date'>
                    {!! Form::label('from_date','From Date:') !!}
                    {!! Form::text('from_date', null,['class'=>'form-control datepicker']) !!}
                </div>
            </div>
                
                   {!! Form::close() !!}
       <form method='POST' action ="{{ url(adminPath() . '/salaries/slips') }}" >
                      {{ csrf_field() }}

            {{--<table class="table table-hover table-striped datatable">--}}
            <table class="table datatable table-striped table-bordered  dt-responsive nowrap" style="width:100%">
                <div class="form-check">
					<label>
                        <input type="checkbox" class="custom-control-input" onclick="toggle(this)" name="chk1"  id="chk1">
                        <span class="label-text"><strong>Select All</strong></span>
					</label>
				</div>
            
                <!--	<label class="btn btn-success active">
                <input type="checkbox" class="custom-control-input" onclick="toggle(this)" name="chk1"  id="chk1">
                <strong>Select All</strong>
				
            </label>-->
            
    
        
                <thead>
                    <tr>
                        <th></th>
                        <th>Image</th>
                        <th>ID</th>
                        <th>Paid Dt</th>
                        <th>Name</th>
                        <th>Baisc salary</th>
                        <th>gross salary</th>
                        <th>net salary</th>
                        <th>Full salary</th>
                        <th>Edit</th>
                        
                    </tr>
                </thead>
                <tbody>
                     @foreach($salaries as $salary)
                     <tr>
                     <td>
                          <div "form-check">
					<label>
                         <input type="checkbox" class="custom-control-input" name="foo[]" id="foo[]" value="{{$salary->employee_id}}">
                         <span class="label-text"></span>
                         	</label>
                         </div>
                        </td>
                         <td>
                             @php  $emp = @\App\Employee::find($salary->employee_id) @endphp

                             @if($emp && @$emp->photos->where('code', 'profile')->first()->image)
                                 <div class="round-img">
                                     <img src="{{url('uploads/'.@\App\Employee::find($salary->employee_id)->photos->where('code', 'profile')->first()->image) }}"
                                          alt="{{ __('admin.employee') }}">
                                 </div>
                             @else
                                 <div class="round-img">
                                     <img src="{{url('uploads/website_cover_81698172832.jpg')}}"
                                          alt="{{ __('admin.employee') }}">
                                 </div>
                             @endif
                         </td>

                            <td>{{$salary->employee_id}}</td>
                            <td>{{$salary->paid_date}}</td>
                            <td>{{@\App\Employee::find($salary->employee_id)->en_first_name.' '.@\App\Employee::find($salary->employee_id)->en_middle_name}}</td>
                            <td>{{$salary->basic}}</td>
                            <td>{{$salary->gross}}</td>
                            <td>{{$salary->net}}</td>
                            <td>{{$salary->full_salary}}</td>
                            <td>
                                <a href="{{route('salaries.edit', $salary->id)}}" class="btn btn-warning">
                                    <span class="fa fa-edit"></span> Edit </a>
                            </td>
                            
                        </tr>
                    @endforeach
                   </tbody>
                   <thead>
                       <tr>
                          <td colspan="5"><h4>Total</h4></td>
                       <td align="left"><h4>{{$toltal_basic_salary}}</h4></td>
                       <td align="left"><h4>{{$total_gross}}</h4></td>
                       <td align="left"><h4>{{$total_net}}</h4></td>
                       <td colspan ="2" align="left"><h4>{{$total_full_salary}}</h4></td>


                        </tr>
                        
                     </thead>
              
                </table>
                <div class="slip">

            
            
                <input name="print" type="submit" id="print" value="Salary Slip" class="btn btn-primary">
                
            </form>
            
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
            'info': false,
            'autoWidth': true,
            "pagingType": 'simple',

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
    <script>
$('#chk1').click(function(event) {
    if(this.checked) {
        $(':checkbox').prop('checked', true);
    } else {
        $(':checkbox').prop('checked', false);
    }
});
</script>
 <script>
        $('.datepicker').datepicker({
            autoclose: true,
            format: "mm/dd/yyyy",
            viewMode: "years",
            minViewMode: "years",
        });
    </script>
@endsection

