<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{config('app.name')}}</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a href="{{route('officer.dashboard')}}" class="nav-link">Home</a>
            </li>
            @if(session()->has('user') && session()->get('user')->admin)
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Officers</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('officer.add')}}" class="dropdown-item">Add Officer</a></li>
                        <li><a href="{{route('officer.manage')}}" class="dropdown-item">Manage Officer</a></li>
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Grievances</a>
                <ul class="dropdown-menu">
                    @if(session()->has('user') && !session()->get('user')->admin)
                        <li><a href="{{route('grievance.pending')}}" class="dropdown-item">Pending</a></li>
                    @else
                        <li><a href="{{route('grievance.report')}}" class="dropdown-item">Reported</a></li>
                    @endif
                    <li><a href="{{route('grievance.resolve')}}" class="dropdown-item">Resolved</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('officer.profile')}}" class="nav-link">Profile</a>
            </li>
            <li class="nav-item">
                <a href="{{route('officer.logout')}}" class="nav-link">Logout</a>
            </li>
        </ul>
    </div>
</nav>
@yield('content')
</body>
</html>
