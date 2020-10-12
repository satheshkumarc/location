@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>chat</h1>
        <div class="accordion" id="accordionExample">
  <div class="card" style="height:400px">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        Users
        </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
@foreach($users as $user)
        
        <a href="{{ url('chat') }}/{{$user->id}}" class="btn btn-info form-control text-left mb-1" role="alert">
            {{$user->name}}
        </a>

@endforeach      
      </div>
    </div>
  </div>
  <div class="card">
      </div>
</div>
    </div>
    <div class="col"></div>
  </div>
</div>
@endsection