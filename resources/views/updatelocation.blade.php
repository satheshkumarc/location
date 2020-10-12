@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url('updatelocation') }}/{{$location->id}}" method="post">
@csrf
<table class="table">
  <thead>
    <tr>
      <th scope="col">Location Name</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="text" name="locname" value="{{$location->locname}}"></td>
      <td><input type="text" name="loclat" value="{{$location->loclat}}" disabled></td>
      <td><input type="text" name="loclong" value="{{$location->loclong}}" disabled></td>
      <td><input type="submit" value="Update" class="btn btn-success float-right"></td>
    </tr>
  </tbody>
</table>
</form>
</div>
@endsection