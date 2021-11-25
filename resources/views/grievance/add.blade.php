@extends('template.guest')
@section('content')
    <section class="container-fluid d-flex vh-100 flex-column">
        <div class="row flex-grow-1 align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Add Student's Grievances</h4>
                <form action="{{route('grievance.add')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Student Name:</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="enrolment" class="col-form-label">Enrolment No:</label>
                        <input type="text" name="enrolment" id="enrolment" value="{{old('enrolment')}}"
                               class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <select name="subject" id="subject" class="custom-select">
                            <option value="" selected hidden>Choose...</option>
                            @foreach(\App\Models\Subject::all() as $i => $subject)
                                <option
                                    value="{{$subject->id}}" {{old('subject')==$subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Describe:</label>
                        <textarea name="message" id="message" rows="4"
                                  class="form-control">{{old('message')}}</textarea>
                    </div>
                    @if ($errors->any())
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">*{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (\Illuminate\Support\Facades\Session::has('grievance_token'))
                        <ul class="list-unstyled">
                            <li class="text-success">Grievance Submitted!!!</li>
                            <li class="text-success">Your
                                Token: {{\Illuminate\Support\Facades\Session::get('grievance_token')}}</li>
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </form>
                <a href="{{route('home')}}" class="nav-link text-center">Go Back</a>
            </div>
        </div>
    </section>
@endsection
