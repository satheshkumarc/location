@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Go To -> <a href="{{ url('locationlists') }}" class="btn btn-info mb-4">Location Lists</a><br>
                    Go To -> <a href="{{ url('addlocation') }}" class="btn btn-secondary">Map</a>

                    <form action="{{ url('addlocation') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="formGroupExampleInput">Add Location:</label>
                            <input type="text" class="form-control" id="locname" name="locname">
                        </div>
                        <input type="submit" value="SAVE" name="locsave" class="btn btn-success">
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
