@extends('template.officer')
@section('content')
    <section class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Dashboard</h4>
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>Received</th>
                        <th>Pending</th>
                        <th>Resolved</th>
                        @if(session()->has('user') && session()->get('user')->admin)
                            <th>Reported</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$total}}</td>
                        <td>{{$pending}}</td>
                        <td>{{$resolve}}</td>
                        @if(session()->has('user') && session()->get('user')->admin)
                            <td>{{$report}}</td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
