@extends('template.guest')
@section('content')
    <section class="container-fluid d-flex vh-100 flex-column">
        <div class="row">
            <div class="col text-right">
                <a href="{{route('officer.login')}}" class="nav-link">Officer Login</a>
            </div>
        </div>
        <div class="row flex-grow-1 justify-content-center align-items-center">
            <div class="col-6 text-center">
                <h4 class="text-uppercase py-2 bg-info">Grievance Portal</h4>
                <a href="{{route('grievance.track')}}" class="nav-link my-4 h4">Track Grievance</a>
                <a href="{{route('grievance.add')}}" class="nav-link h4">Add Grievance</a>
            </div>
        </div>
    </section>
@endsection
