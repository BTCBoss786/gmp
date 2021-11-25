@extends('template.guest')
@section('content')
    <section class="container-fluid d-flex vh-100 flex-column">
        <div class="row flex-grow-1 align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Officer Login</h4>
                <form action="{{route('officer.login')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    @if ($errors->any())
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">*{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button type="submit" class="btn btn-primary my-2">Login</button>
                </form>
                <a href="{{route('home')}}" class="nav-link text-center">Go Back</a>
            </div>
        </div>
    </section>
@endsection
