@php($commercialAgents = @\App\User::where('residential_commercial', 'commercial')->pluck('id')->toArray());
@php($residentialAgents = @\App\User::where('residential_commercial', 'residential')->pluck('id')->toArray());
@foreach($leads as $lead)
    {{$lead->agent}}
    <tr>
        <td class="checkbox">
            <label>
                <input class="switch" name="checked_leads[]" type="checkbox"
                       value={{ $lead->id }}>
                <span class="cr"><i class="cr-icon fa fa-check"></i></span>
            </label>
        </td>
        {{-- <td>{{ $lead->id }}</td> --}}
        <td>
            <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $residentialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
        </td>
        <td>
            <i class="fa fa-circle" aria-hidden="true" style="@if(DB::table('lead_actions')->whereIn('user_id', $commercialAgents)->where('lead_id',$lead->id)->count() > 0) color:green;@else color:red @endif"></i>
        </td>
        <td>{{$leadProbability}}</td>
        <td>{{ $lead->first_name . ' ' . $lead->last_name }}</td>
        {{-- <td>{{ $lead->phone }}</td> --}}
        <td>{{$r}}</td>
        <td>{{ @App\User::find($lead->agent_id)->name }}</td>
        <td>{{$lead->type}}</td>
        @if($lead->favorite)
            <td><i class="fa fa-star Fav" id="Fav7076" count="7076" style=""></i></td>
        @else
            <td></td>
        @endif
        <td>
            @if ($lead->hot)
                @php($color = 'color: #dd4b39')
            @else
                @php($color = '')
            @endif
            <i class="fa fa-fire Hot" id="Hot{{ $lead->id }}" count="{{ $lead->id }}" style="'{{$color }}"></i>
        </td>
        <td><select class="form-control" onchange="if(this.value=='del'){$('#delete7076').modal();} else{location = this.value;}">
            <option value="#" disabled="" selected="">Options</option>
            <option value="{{url(adminPath() . '/leads/' . $lead->id)}}">Show</option>
            <option value="{{url(adminPath() . '/leads/' . $lead->id)}}/edit">Edit</option>
            <option value="{{ url(adminPath() . '/delete-lead/' . $lead->id) }}" class="delete" data-toggle="modal" data-target="#delete7076">Delete</option>
            </select>
                <div id="delete. $lead->id" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4 class="modal-title">Delete Lead</h4>
                            </div>
                            <div class="modal-body">
                                <p>Delete gjf dtr</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                <a value="del" class="delete" data-toggle="modal" data-target="#delete' . $lead->id . '" class="btn btn-danger btn-flat">Delete</a>
                            </div>
                        </div>

                    </div>
                </div>
            </td>
           @if(auth()->user()->type  == 'admin')
             <td>
                 <a data-toggle="modal" data-target="#switch{{ $lead->id }}"
                    class="btn btn-success btn-flat">{{ trans('admin.switch') }}</a>
             </td>
             @else
          @endif
            <td><a onclick="showHintSpan('. $lead->id .')"><i class="fa fa-eye" aria-hidden="true"></a></i></td>
        {{-- <td>
            <a href="{{ url(adminPath() . '/leads/' . $lead->id) }}" class="btn btn-primary btn-flat">
                {{ __('admin.show') }}
            </a>
        </td> --}}
        {{-- <td>
            <a href="{{ url(adminPath() . '/leads/' . $lead->id . '/edit') }}" class="btn btn-warning btn-flat">
                {{ __('admin.edit') }}
            </a>
        </td>
        <td>
            <a data-toggle="modal" data-target="#delete{{ $lead->id }}"
               class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</a>
        </td> --}}
    </tr>
    <div id="delete{{ $lead->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{  trans('admin.delete') . ' ' . trans('admin.lead') }}</h4>
                </div>
                <div class="modal-body">
                    <p>{{ trans('admin.delete') . ' ' . $lead->name }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat"
                            data-dismiss="modal">{{ trans('admin.close') }}</button>
                    <a class="btn btn-danger btn-flat"
                       href="{{ url(adminPath() . '/delete-lead/' . $lead->id) }}">{{ trans('admin.delete') }}</a>
                </div>
            </div>

        </div>
    </div>
        <div id="switch{{ $lead->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ trans('admin.switch') . ' ' . trans('admin.lead') }}</h4>
                    </div>
                    <form action="{{ url(adminPath() . '/switch_leads') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <select class="select2" name="agent_id"
                            data-placeholder="{{ __('admin.agent') }}" style="width: 100%">
                            <option></option>
                            @foreach (@\App\User::get() as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>';
                            @endforeach
                        </select>
                        <input type="hidden" value="{{ $lead->id }}" name="leads[]">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat"
                        data-dismiss="modal">{{ trans('admin.close') }}</button>
                        <button type="submit"
                        class="btn btn-success btn-flat">{{ trans('admin.switch') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endforeach
