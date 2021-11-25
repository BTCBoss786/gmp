@extends('template.officer')
@section('content')
    <section class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Resolved Grievances</h4>
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Token No</th>
                        <th>Student Name</th>
                        @if(session()->has('user') && session()->get('user')->admin)
                            <th>Officer Name</th>
                            <th>Subject</th>
                        @endif
                        <th>Description</th>
                        <th>Received At</th>
                        <th>Reply</th>
                        <th>Resolved At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($grievances as $grievance)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$grievance->token}}</td>
                            <td>{{$grievance->student->name}}</td>
                            @if(session()->has('user') && session()->get('user')->admin)
                                <td>{{$grievance->officer->name}}</td>
                                <td>{{$grievance->subject->name}}</td>
                            @endif
                            <td>{{$grievance->message}}</td>
                            <td>{{$grievance->created_at}}</td>
                            <td>{{$grievance->reply}}</td>
                            <td>{{$grievance->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$grievances->links()}}
            </div>
        </div>
    </section>
@endsection
