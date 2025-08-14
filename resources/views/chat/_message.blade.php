<div class="chat-header clearfix">
     @include('chat._header')
</div>
<div class="chat-history">
    
     @include('chat._chat')
</div>
<div class="chat-message clearfix">
      <form action="" id="submit_message" method="post" class="mb-0">
        <input type="text">
        {{ csrf_field() }}
             <textarea name="" class="form-control"></textarea>
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6" style="text-align: right;">
                <button style="margin-top: 10px;" class="btn btn-primary">Send</button>
            </div>
          </div>
      </form>
</div>