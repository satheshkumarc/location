@extends('layouts.app')

@section('content')
<div class="container">
@if(session()->has('message'))
<div class="alert alert-success" role="alert">
    {{session()->get('message')}}
</div>
@endif
Go To -> <a href="{{ url('/home') }}" class="btn btn-info mb-2">Home</a><br>
Go To -> <a href="{{ url('addlocation') }}" class="btn btn-secondary">Map</a>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Location Name</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
@foreach($locations as $location)
    <tr>
      <td>{{$location->locname}}</td>
      <td>{{$location->loclat}}</td>
      <td>{{$location->loclong}}</td>
      <td><a href="{{ url('editlocation') }}/{{$location->id}}" class="btn btn-info">EDIT</a> <a href="{{ url('dellocation') }}/{{$location->id}}" class="btn btn-danger">DELETE</a></td>
    </tr>
@endforeach
  </tbody>
</table>
</div>
@endsection