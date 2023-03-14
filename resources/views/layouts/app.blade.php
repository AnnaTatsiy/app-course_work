<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- подключение bootstrap локально -->
    <link rel="stylesheet" href={{ asset('lib/css/bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="{{ asset('lib/js/bootstrap.min.js') }}"></script>
</head>
<body  class="antialiased">

@section('header')

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container-fluid">
            <div style="width: 80%; margin: auto;">
                <div class="navbar-collapse" id="appNavbar-1">
                    <ul class="navbar-nav fs-6">
                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('index')" href="/">Главная</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('clientsActive')" href="/clients/all">Клиенты</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('workersActive')" href="/workers/all">Рабочие</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('carsActive')" href="/cars/all">Авто</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('repairsActive')" href="/repairs/all">Ремонты</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('archiveActive')" href="/repairs/archive-all">Архив</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('specialtiesActive')" href="/specializations/select-count-by-specialization">Специальности</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('malfunctionsActive')" href="/malfunctions/all">Неисправности</a>
                        </li>

                        <li class="nav-item pt-1">
                            <a class="nav-link @yield('about')" href="/about">О разработчике</a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </nav>

@show

<main class="container-fluid">

    <div class="row-sm mt-5 p-3 container-fluid-style">

        <div class="p-4 bg-white m-3 border-warning-top border-warning-bottom">

            <!-- контент страницы -->
            <div class="container">
                @yield('content')
            </div>
        </div>

    </div>

</main>

@section('footer')
    <div class="mt-5 p-3 bg-dark text-white-50 text-center footer">
        <p>Выполнила: Таций Анна ПД011 Донецк 2023</p>
    </div>
@show

</body>
</html>

