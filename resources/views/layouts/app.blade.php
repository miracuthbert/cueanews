<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.partials._head')
</head>
<body>
    <div id="app">
        @include('layouts.partials._navigation')

        <div class="container">
            @yield('content')
        </div>
    </div>

    @include('layouts.partials._scripts')
</body>
</html>
