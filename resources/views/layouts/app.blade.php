<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Amy') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <script src="https://jp.vuejs.org/js/vue.min.js"></script>
</head>
<body>
    <div id="app">
        <div class="ui menu">
            <a class="item" href="/">{{ config('app.name', 'Amy') }}</a>
            <div class="right menu">
                <div class="ui pointing dropdown link item">
                @if (Auth::guest())
                    <span class="text"><a href="{{ route('login') }}">Login</a></span>
                @else
                <span class="text">{{ Auth::user()->name }}</span>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @yield('content')
</div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
<script>

$(function() {
$('.ui.dropdown')
  .dropdown()
;
});
</script>
</body>
</html>
