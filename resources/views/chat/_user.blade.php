@foreach($getChatUser as $user)
    <li class="clearfix getChatWindow">
     <a href="{{ url('chat?receiver_id='.base64_encode($user['user_id'])) }}">
        <img src="{{ $user['profile_pic'] }}" style="height: 45px;" alt="avatar">
        <div class="about">
        <div class="name">{{ $user['name'] }} 
            @if(!empty($user['messagecount']))
                <span style="background: green;color: #fff;border-radius: 5px;padding: 1px 7px;">{{ $user['messagecount'] }}</span>
            @endif
            </div>
            <div class="status"> <i class="fa fa-circle offline"></i>{{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }}</div>                                            
        </div>
     </a>
    </li>
@endforeach
 <!-- <li class="clearfix">
    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
    <div class="about">
        <div class="name">Vincent Porter</div>
        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>                                            
    </div>
 </li> -->
