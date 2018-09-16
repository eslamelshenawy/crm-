@extends('admin.index')
@section('content')

    @include('admin.employee.hr_nav')
    <style>
    .vacationstyle{
        text-align:right;
        font-weight: bold;
        height:59px;
    }
    .days{
        text-align: center;
        font-weight: bold;
    }
    </style>
    <style>
        label.btn span {
  font-size: 1.5em ;
}

label input[type="radio"] ~ i.fa.fa-circle-o{
    color: #c8c8c8;    display: inline;
}
label input[type="radio"] ~ i.fa.fa-dot-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-circle-o{
    display: none;
}
label input[type="radio"]:checked ~ i.fa.fa-dot-circle-o{
    color: #7AA3CC;    display: inline;
}
label:hover input[type="radio"] ~ i.fa {
color: #7AA3CC;
}

label input[type="checkbox"] ~ i.fa.fa-square-o{
    color: #c8c8c8;    display: inline;
}
label input[type="checkbox"] ~ i.fa.fa-check-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-square-o{
    display: none;
}
label input[type="checkbox"]:checked ~ i.fa.fa-check-square-o{
    color: #7AA3CC;    display: inline;
}
label:hover input[type="checkbox"] ~ i.fa {
color: #7AA3CC;
}

div[data-toggle="buttons"] label.active{
    color: #7AA3CC;
}

div[data-toggle="buttons"] label {
display: inline-block;
padding: 6px 12px;
margin-bottom: 0;
font-size: 14px;
font-weight: normal;
line-height: 2em;
text-align: left;
white-space: nowrap;
vertical-align: top;
cursor: pointer;
background-color: none;
border: 0px solid 
#c8c8c8;
border-radius: 3px;
color: #c8c8c8;
-webkit-user-select: none;
-moz-user-select: none;
-ms-user-select: none;
-o-user-select: none;
user-select: none;
}

div[data-toggle="buttons"] label:hover {
color: #7AA3CC;
}

div[data-toggle="buttons"] label:active, div[data-toggle="buttons"] label.active {
-webkit-box-shadow: none;
box-shadow: none;
}
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
</style>

        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title"></h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <h1>Create SalaryPackage</h1>

                {!! Form::open(['method'=>'POST' , 'action'=> 'SalaryPackageController@store','file'=>'true' ,'enctype'=>'multipart/form-data']) !!}

                <div class = 'form-group col-md-4'>
                    {!! Form::label('package','Package Name:') !!}
                    {!! Form::text('package_name', null,['class'=>'form-control']) !!}
                </div>
              

                
                <div class=" text-center col-md-12" id="attriputes"><br>
                <button type="button" class="btn btn-success btn-flat" id="addattriputes">Add Attripute</button>
                                            </div>
  <div class='text-left col-md-12' >
                                                {!! Form::submit('Submit ',['class'=>'btn btn-primary']) !!}
                                            </div>

{!! Form::close() !!}

            </div>


        </div>
    </div>
    @section('js')
       <script>
        var y = 1;
        $(document).on('click', '#addattriputes', function () {
            console.log('clicked');
            $('#attriputes').append(
                '<div class="well col-md-12" style="" id="removeContact' + y + '">' +
                
                '<div class="form-group col-md-6">' +
                '<label>Name</label>' +
                '<input type="text" name="attr_name[' + y + ']" class="form-control"' +
                'placeholder="Name" required>' +
                '</div>' +

                '<div class="form-group col-md-6">' +
                '<label>Value</label>' +
                '<input type="number" name="attr_value[' + y + ']" class="form-control"' +
                'placeholder="Value" required>' +
                '</div>' +
                '<h3>effect on salary</h3>'+
                   '<div class="row">' +
                '<div class="col-xs-12">' +
                '<div class="btn-group" data-toggle="buttons">' +
                '<label class="btn active">' +
                '<input type="radio" name="effect[' + y + ']" checked value="1"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>increase</span>' +
                '</label>' +
                '<label class="btn">' +
                '<input type="radio" name="effect[' + y + ']" value="0"><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x"></i><span>decrease</span>' +
                '</label>' +
                
                '</div>' +

                '<div class="text-center col-md-12">' +
                '<button type="button" class="btn btn-danger btn-flat removeVac" num="' + y + '">' +
                '{{ trans("admin.remove") }}</button>' +
                '</div>' +


                '</div>' 

              
            );
            y++;
        });

        $(document).on('click', '.removeVac', function () {
            var num = $(this).attr('num');
            $('#removeContact' + num).remove();
        })
    </script>
    @endsection
@stop