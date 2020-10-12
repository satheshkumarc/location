@extends('layouts.app')

@section('content')
<div class="container" id="app">
  <div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>chat</h1>
        <div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" id="userid" value="{{ $user->id }}" aria-expanded="true" aria-controls="collapseOne">
        {{ $user->name }}
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show overflow-auto" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
            <div class="overflow-auto" id="scrolldown" style="overflow-y: scroll;height:250px">
                @foreach($messages as $sendmessage)
                @if($sendmessage->user_id != $user->id)
                    <div class="alert alert-success" role="alert">
                      {{$sendmessage->message}}
                    </div>
                    @else
                    <div class="alert alert-dark text-right" role="alert">
                      {{$sendmessage->message}}
                    </div>
                    @endif
                @endforeach
            </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <form action="" method="post">
        <div class="form-group">
    <textarea class="form-control" id="message" rows="3"></textarea>
  </div>
  <button type="button" id="send" class="btn btn-primary btn-sm float-right">send</button>
        </form>
      </h2>
    </div>
  </div>
</div>
    </div>
    <div class="col"></div>
  </div>
</div>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="application/javascript">
$(document).ready(function(){
  var element = document.getElementById("scrolldown");
  element.scrollTop = element.scrollHeight;
    $('#send').click(function(){
        message();
    });
    $('#message').on('keypress',function(e) {
      if(e.which == 13) {
        message();
      }
    });    
    function message() {
      var message = $('#message').val();
        var userid = $('#userid').val();
        $.ajax({
                url: 'chat',
                type: 'post',
                data: {
                    message : message,
                    userid : userid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function( data ){
                    $('#message').val('');
                    $('#app').load(window.location.href);
                    var element = document.getElementById("scrolldown");
                    element.scrollTop = element.scrollHeight;

                    var pusher = new Pusher('38cc5814880163d91ade', {
  cluster: 'ap2'
});
                    var channel = pusher.subscribe('chat');
                    channel.bind('ChatEvent', function(data) {
                       $('#app').load(window.location.href);
});

                    console.log( data );

                },
                error: function( ){
                    alert( 'Try After Some Time' );
                }
            });
    }
});
</script>
@endsection