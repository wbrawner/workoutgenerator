<html>
    <head>
        <title>Workout Generator - @yield('title')</title>
        <link rel="stylesheet" href={{ asset('assets/css/styles.css') }}>
    </head>
    <body>
        @section('header')
            <div class="header">
                <div class="container">
                    <a href="/"><img id="logo" src={{ asset('assets/images/logo.png') }} alt='Fitness 1440'></a>
                    <div id=nav>
                        <ul>
                            <a href="/"><li>Home</li></a> |
                            <a href="/about"><li>About</li></a> |
                            <a href="/generate"><li>Generate</li></a>
                        </ul>
                    </div>
                </div>
            </div>
            <div id=top-grad></div>
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
