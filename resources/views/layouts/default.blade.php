<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <body>
        <div class="row">
            <div id="sidebar" class="col-md-4">
                @include('includes.sidebar')
            </div>
            <div id="content" class="col-md-8 container">
                @yield('content')
            </div>
        </div>
        @stack('scripts')
        @include('sweetalert::alert')
    </body>
</html>
