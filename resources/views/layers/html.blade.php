<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title', 'Page')</title>
</head>
<body>
<div class="container px-3">
    <header class="border-bottom">
        <div class="row d-flex flex-wrap justify-content-center pt-3">
            <a href="/"
               class=" col-auto d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Солом'яний Ігор Олександрович</span>
            </a>

            <ul class="col-auto nav nav-pills">
                <li class="nav-item"><a href="/" class="nav-link active" aria-current="page">Home</a></li>
            </ul>
            @if(Auth::user() && $order = Auth::user()->order)
                <ul class="nav col-auto">
                    <li class="nav-item"><a href="{{route('orders.show', [$order->id])}}"
                                            class="nav-link active" aria-current="page">
                            Cart <span id="products-in-order">{{Auth::user()->order->products->count()}}</span>
                        </a></li>
                </ul>
            @endif
            {{--            <li class="nav-item"><a href="{{route('users.index')}}" class="nav-link active" aria-current="page">--}}
            {{--                    Users--}}
            {{--                </a></li>--}}
        </div>
        <div class="row antialiased">
            @if (Route::has('login'))
                <div class="hidden px-6 py-2 sm:block d-flex align-items-end flex-column">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
        @endif
    </header>

</div>

<div class="container px-3">
    @yield('main-content', 'Default content')
</div>


{{--jQuery--}}
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
@stack('end_scripts')
</body>
</html>
