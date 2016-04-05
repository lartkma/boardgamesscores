<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
</head>
<body>
    <div class="container">
        <div class="page-header clearfix">
            @yield('header')
        </div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @elseif(session()->has('errors'))
            <div class="alert alert-danger">
                {{print_r(session('errors'), true)}}
            </div>
        @endif
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @if(isset($add_js))
    @foreach($add_js as $path)
    <script src="{{$path}}"></script>
    @endforeach
    @endif
</body>
</html>
