@extends('admin.index')

@section('content')

    <div id="root">
        <div class="box">
            <div class="box-body">
         <div class="form-group "><label>Select User</label>
             <select multiple name="selectuser" id="select_user" data-placeholder="Select User" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  @foreach($users as $user)
                   <option id="selec_val" value="{{$user->id}}">{{$user->name}}</option>
               @endforeach
                </select>

            </div>
            <button class="btn btn-success btn-flat" type="submit" id="save_select_user">Save</button>
        </div>
    </div>
@endsection
@section('js')
    <script src="http://fabien-d.github.io/alertify.js/assets/js/lib/alertify/alertify.min.js"></script>

    <script>
        $('#select_user').change(function() {
         var option = $(this).val();
         var _token = '{{ csrf_token() }}';
         var ulr ="{{ url(adminPath().'/change_password')}}" ;
         var data = {
             'option':option,
             '_token':_token
         }
        $('#save_select_user').click(function(){

                    $.ajax({
                        url: ulr,
                        method: 'post',
                        data: data,
                        success: function (data) {
                            console.log('success');
                            alertify.success('Success save');

                        }

                    });

            });

        });
    </script>
@endsection
