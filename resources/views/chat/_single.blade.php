<div class="chat-header clearfix">
    <div class="row">
        <div class="col-lg-6">
            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                <img src="{{ $getReceiver->getProfileDirect() }}" alt="avatar">
            </a>
            <div class="chat-about">
                <h6 class="m-b-0">{{ $getReceiver->name }} {{ $getReceiver->last_name }}</h6>
            </div>
        </div>
    </div>
</div>
<div class="chat-history">
    <ul class="m-b-0">
        @foreach($getChat as $value)
            @if($value->sender_id == $sender_id)
            <li class="clearfix">
                <div class="message-data text-right">
                    <span class="message-data-time">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
                    <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
                </div>
                <div class="message other-message float-right">{{ $value->message }}</div>
            </li>
            @else
            <li class="clearfix">
                <div class="message-data">
                    <img src="{{ $value->getSender->getProfileDirect() }}" alt="avatar">
                    <span class="message-data-time">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
                </div>
                <div class="message my-message">{{ $value->message }}</div>
            </li>
            @endif
        @endforeach
    </ul>
</div>
<div class="chat-message clearfix">
    <form class="form-horizontal" id="submit_message" action="" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-0">
            <div class="input-group-prepend">
                <button class="input-group-text" type="submit"><i class="fa fa-send"></i></button>
            </div>
            <input type="hidden" name="receiver_id" value="{{ $getReceiver->id }}">
            <input type="text" name="message" class="form-control" placeholder="Enter text here...">
        </div>
    </form>
</div>
