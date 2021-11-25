@extends('template.officer')
@section('content')
    <section class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Reply Grievances</h4>
                <table class="table table-bordered">
                    @foreach($grievances as $grievance)
                        <tr>
                            <th class="text-nowrap">Token No</th>
                            <td>{{$grievance->token}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">Enrolment No</th>
                            <td>{{$grievance->student->enrolment_no}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">Student Name</th>
                            <td>{{$grievance->student->name}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">Subject</th>
                            <td>{{$grievance->subject->name}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">Description</th>
                            <td>{{$grievance->message}}</td>
                        </tr>
                        <tr>
                            <th class="text-nowrap">Received At</th>
                            <td>{{$grievance->created_at}}</td>
                        </tr>
                        <form action="{{route('grievance.pending')}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$grievance->id}}">
                            <tr>
                                <th class="text-nowrap">Reply</th>
                                <td><textarea name="reply" id="reply" rows="4" class="form-control"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    @if ($errors->any())
                                        <ul class="list-unstyled">
                                            @foreach ($errors->all() as $error)
                                                <li class="text-danger">*{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <button type="submit" class="btn btn-primary my-2">Resolve</button>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
