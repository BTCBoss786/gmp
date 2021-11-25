@extends('template.guest')
@section('content')
    <section class="container-fluid d-flex vh-100 flex-column">
        <div class="row flex-grow-1 align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Track Student's Grievance</h4>
                <form action="{{route('grievance.track')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="token" class="col-form-label">Token No:</label>
                        <input type="text" name="token" id="token" class="form-control" autocomplete="off">
                    </div>
                    @if ($errors->any())
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">*{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </form>
                <a href="{{route('home')}}" class="nav-link text-center">Go Back</a>
                @if (session()->has('record'))
                    <div class="record">
                        @if(session()->get('record')->status == 'Resolved')
                            <h4 class="text-success text-center">Your Grievance is Resolved</h4>
                        @else
                            <h4 class="text-danger text-center">Your Grievance is Pending</h4>
                        @endif
                        <table class="table table-bordered">
                            <tr>
                                <th class="text-nowrap">Student Name</th>
                                <td>{{session()->get('record')->student->name}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Enrolment No</th>
                                <td>{{session()->get('record')->student->enrolment_no}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Token No</th>
                                <td>{{session()->get('record')->token}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Subject</th>
                                <td>{{session()->get('record')->subject->name}}</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Description</th>
                                <td>
                                    {{session()->get('record')->message}} <br>
                                    <small>Received at: {{session()->get('record')->created_at}}</small>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-nowrap">Status</th>
                                @if(session()->get('record')->reply != '')
                                    <td>
                                        {{session()->get('record')->reply}} <br>
                                        <small>Replied at: {{session()->get('record')->updated_at}}</small>
                                    </td>
                                @else
                                    <td>Your Grievance is Forwarded to Concerned Officer</td>
                                @endif
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
