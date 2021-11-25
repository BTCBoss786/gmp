@extends('template.officer')
@section('content')
    <section class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Add Officer</h4>
                <form action="{{route('officer.add')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Officer Name:</label>
                        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email ID:</label>
                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" name="password" id="password" value="{{old('password')}}"
                               class="form-control">
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
                    @if ($errors->any())
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">*{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (\Illuminate\Support\Facades\Session::has('officer_added'))
                        <ul class="list-unstyled">
                            <li class="text-success">Officer Added Successfully!!!</li>
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
