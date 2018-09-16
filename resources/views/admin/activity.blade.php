@foreach($notEarly as $key => $notify)

    <li id='{{$notify->status}}' style= "border-bottom: solid 1px silver;">
        <div class="v-bar">
        </div>
        <div class="noti-icon">
            {{substr(@\App\Lead::find($notify->type_id)->first_name,0,1)}}
        </div>
        <a href="javascript:void(0);" class="notificationElement" nid="{{ $notify->id }}">
            <span>
                {{ $notify->user->name ." is " . $notify->en_title }}
            </span>
        </a>

        <div class='timeAgo'>{{time_ago($notify->created_at)}}</div>

    </li>
@endforeach
