<!doctype html>
<html lang="ES">

<head>
    <title></title>
    @include('layouts.includes.head')
    @yield('head')
</head>

<body>
    <div id="oscurecer"></div>
    <div class="layout">
        <div class="main">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
