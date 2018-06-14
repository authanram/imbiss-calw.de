<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Asia Imbiss Calw</title>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="row m-0 h-100">

    <div class="col-2 border-right">
        <aside class="list-group">
            @foreach($menuCategories as $category)
                <a href="#" class="list-group-item list-group-item-action border-0">
                    {{ $category->name }}
                </a>
            @endforeach
        </aside>

    </div>

    <div class="col-9">

        <div id="app">
            <div class="content d-block text-left">

                @yield('content')

                <hr class="mt-4 mb-4" />

                <div class="mb-4">
                    Telefonische Bestellung: <a class="mr-2 number font-weight-bold lead" href="tel:01754156554">07051 / 934 953</a>
                    <br />
                    <a href="/">www.imbiss-calw.de</a>
                    <br />
                    <span class="d-inline-block small">(Inh. ...)</span>
                </div>

                <hr />

                <div class="mb-4 small float-left">
                    <a class="muted d-inline-block mr-2" href="/">Startseite</a>
                </div>

                <div class="mb-4 small float-right">
                    <a class="muted d-inline-block mr-2" href="/impressum">Impressum</a>
                    <a class="muted d-inline-block mr-2" href="/datenschutzerklaerung">Datenschutzerklärung</a>
                    <a class="muted d-inline-block" href="/haftungsausschluss">Haftungsausschluss</a>

                    @guest
                        <a class="d-inline-block ml-2" href="/login">Login</a>
                    @else
                        <a class="d-inline-block ml-2" href="/admin">Manage</a>
                    @endguest
                </div>
            </div>
        </div>

    </div>

</div>

<script src="{{ mix('/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</body>
</html>
