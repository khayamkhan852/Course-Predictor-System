<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>404 Not Found</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if ( document.documentElement ) {
            if ( document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if ( localStorage.getItem("data-theme") !== null ) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
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
                background-image: url('{{ asset('theme/assets/media/auth/bg1.jpg') }}');
            }
            [data-theme="dark"] body {
                background-image: url('{{ asset('theme/assets/media/auth/bg1-dark.jpg') }}');
            }
        </style>

        <div class="d-flex flex-column flex-center flex-column-fluid">
            <div class="d-flex flex-column flex-center text-center p-10">
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1><!--end::Title-->
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">We can't find that page.</div>
                        <div class="mb-3">
                            <img src="{{ asset('theme/assets/media/auth/404-error.png') }}" class="mw-100 mh-300px theme-light-show" alt="" />
                            <img src="{{ asset('theme/assets/media/auth/404-error-dark.png') }}" class="mw-100 mh-300px theme-dark-show" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
</body>
</html>
