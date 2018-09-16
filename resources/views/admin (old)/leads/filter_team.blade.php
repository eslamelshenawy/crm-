@foreach($leads as $lead)
    <tr>
        <td>{{ $lead->id }}</td>
        <td>{{ @$lead->agent->name }}</td>
        <td>{{ $lead->first_name . ' ' . $lead->last_name }}</td>
        <td><a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a></td>
        <td>{{ $lead->phone }}</td>
        <td>{{ @\App\LeadSource::find($lead->lead_source_id)->name }}</td>
        <td>
            <a href="{{ url(adminPath() . '/leads/' . $lead->id) }}" class="btn btn-primary btn-flat">
                {{ __('admin.show') }}
            </a>
        </td>
        <td>
            <a href="{{ url(adminPath() . '/leads/' . $lead->id . '/edit') }}" class="btn btn-warning btn-flat">
                {{ __('admin.edit') }}
            </a>
        </td>
        <td>
            <a data-toggle="modal" data-target="#delete{{ $lead->id }}"
               class="btn btn-danger btn-flat">{{ trans('admin.delete') }}</a>
        </td>
        <td>
            <a data-toggle="modal" data-target="#switch{{ $lead->id }}"
               class="btn btn-success btn-flat">{{ trans('admin.switch') }}</a>
        </td>
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