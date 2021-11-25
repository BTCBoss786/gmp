@extends('template.officer')
@section('content')
    <section class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Pending Grievances</h4>
                @if (\Illuminate\Support\Facades\Session::has('status'))
                    <ul class="list-unstyled">
                        <li class="text-success">Grievance Resolved Successfully!!!</li>
                    </ul>
                @endif
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>Token No</th>
                        <th>Description</th>
                        <th>Resolve</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grievances as $grievance)
                        <tr>
                            <td>{{$grievance->token}}</td>
                            <td>{{$grievance->message}}</td>
                            <td><a href="{{route('grievance.reply', $grievance->token)}}" class="nav-link">Reply</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$grievances->links()}}
            </div>
        </div>
    </section>
@endsection
