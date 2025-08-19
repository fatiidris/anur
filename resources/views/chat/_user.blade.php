@foreach($getChatUser as $user)
<li class="clearfix chat-list" data-user-id="{{ $user->id }}">
    <a href="{{ url('chat?receiver_id='.base64_encode($user->id)) }}">
        <img src="{{ $user->getProfileDirect() }}" alt="avatar">
        <div class="about">
            <div class="name">{{ $user->name }} {{ $user->last_name }}</div>
            <div class="status">
                @if($user->user_type == 1)
                    Admin
                @elseif($user->user_type == 2)
                    Teacher
                @elseif($user->user_type == 3)
                    Student
                @elseif($user->user_type == 4)
                    Parent
                @endif
            </div>
        </div>
    </a>
</li>
@endforeach