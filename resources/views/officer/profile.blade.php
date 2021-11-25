@extends('template.officer')
@section('content')
    <section class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Update Profile</h4>
                <form action="{{route('officer.profile')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Officer Name:</label>
                        <input type="text" name="name" id="name" value="{{$officer->name}}" class="form-control"
                               autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="old_password" class="col-form-label">Old Password:</label>
                        <input type="password" name="old_password" id="old_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">New Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    @if ($errors->any())
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">*{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    @if (\Illuminate\Support\Facades\Session::has('officer_updated'))
                        <ul class="list-unstyled">
                            <li class="text-success">Details Updated Successfully!!!</li>
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
