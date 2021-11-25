@extends('template.officer')
@section('content')
    <section class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Reported Grievances</h4>
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Token No</th>
                        <th>Student Name</th>
                        <th>Subject</th>
                        <th>Description</th>
                        <th>Received At</th>
                        <th>Resolve</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grievances as $grievance)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$grievance->token}}</td>
                            <td>{{$grievance->student->name}}</td>
                            <td>{{$grievance->subject->name}}</td>
                            <td>{{$grievance->message}}</td>
                            <td>{{$grievance->created_at}}</td>
                            <td><a href="{{route('grievance.reply', $grievance->token)}}" class="nav-link">Reply</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$grievances->links()}}
            </div>
        </div>
    </section>
@endsection
