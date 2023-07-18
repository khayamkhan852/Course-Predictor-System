<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="canonical" href="https://vrent.bosuite.app" />
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        let defaultThemeMode = "light";
        let themeMode;
        if ( document.documentElement ) {
            if ( document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if ( localStorage.getItem("data-theme") !== null ) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode; }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root">
        <style>
            body {
                background-image: url('{{ asset('theme/assets/media/auth/bg4.jpg') }}');
            }
            [data-theme="dark"] body {
                background-image: url('{{ asset('theme/assets/media/auth/bg4-dark.jpg') }}');
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">

                    <a href="{{ url('/') }}" class="mb-7">
                        <h1>SMART GUIDE</h1>
                    </a>
                    <h2 class="text-white fw-normal m-0">Smart course for your Academia</h2>

                </div>
            </div>

            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px">
                    <div class="card-body p-10 p-lg-20">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>var hostUrl = "assets/";</script>
    <script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('theme/assets/js/custom/authentication/sign-in/general.js') }}"></script>
    @yield('javascript')
</body>
</html>
