@extends('template.officer')
@section('content')
    <section class="container-fluid d-flex flex-column">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 py-5">
                <h4 class="text-uppercase text-center py-2 bg-info">Manage Officers</h4>
                @if (\Illuminate\Support\Facades\Session::has('officer_status'))
                    <ul class="list-unstyled">
                        <li class="text-success">Officer Updated Successfully!!!</li>
                    </ul>
                @endif
                <table class="table table-bordered table-hover text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Officer Name</th>
                        <th>Subject</th>
                        <th>Resolved</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($officers as $officer)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$officer->name}}</td>
                            <td>{{$officer->subject->name}}</td>
                            <td>{{$officer->grievances->count()}}</td>
                            <td>
                                <form action="{{route('officer.manage')}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-primary" name="id"
                                            value="{{$officer->id}}">
                                        @if($officer->trashed()) Activate @else Deactivate @endif
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $officers->links() }}
            </div>
        </div>
    </section>
@endsection
