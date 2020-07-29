<!doctype html>
<html>
    <head>
        @include('includes.head')
    </head>
    <style>
        #wrapper {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            -webkit-transition: margin .25s ease-out;
            -moz-transition: margin .25s ease-out;
            -o-transition: margin .25s ease-out;
            transition: margin .25s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        #page-content-wrapper {
            min-width: 100vw;
            margin-top: 60px;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>
    <body>
        <div class="d-flex" id="wrapper">
            <div id="sidebar-wrapper" class="page-sidebar-wrapper">
                <div class="page-sidebar">
                    @include('includes.sidebar')
                </div>
            </div>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
    </body>
    @yield('scripts')
</html>
