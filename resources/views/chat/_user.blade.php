@foreach($getChatUser as $user)

<li class="clearfix">
    <img src="{{ $user['profile_pic'] }}" style="height: 45px;" alt="avatar">
    <div class="about">
        <div class="name">{{ $user['name'] }} {{ $user['messasecount'] }}</div>
        <div class="status"> <i class="fa fa-circle offline"></i>{{ Carbon\Carbon::parse($user['created_date'])->diffForHumans() }}</div>                                            
    </div>
 </li>
@endforeach
 <!-- <li class="clearfix">
    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
    <div class="about">
        <div class="name">Vincent Porter</div>
        <div class="status"> <i class="fa fa-circle offline"></i> left 7 mins ago </div>                                            
    </div>
 </li> -->
