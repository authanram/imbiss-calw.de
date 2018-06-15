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
<body >

<div class="row m-0 d-flex align-items-stretch">

    <div class="border-right d-none d-md-inline col-1">
        <div class="pt-3" style="min-width: 220px;">
            <div class="position-fixed">
                <h3>Menü</h3>

                <aside class="list-group">
                    @foreach($menuCategories as $category)
                        @if($category->status)
                            @if(request()->route()->parameter('menu') === urlencode(strtolower($category->name)))
                                <a href="/menu#{{ urlencode(strtolower(htmlentities($category->name))) }}" class="list-group-item-action border-0 active">
                            @else
                                <a href="/menu#{{ urlencode(strtolower(htmlentities($category->name))) }}" class="list-group-item-action border-0">
                            @endif
                                <span class="d-block lead p-0 m-0" style="line-height:1.2rem;">{{ $category->name }}</span>
                                <small class="text-muted">
                                    {{ count($category->menus) }}
                                    {{ $category->name === 'Getränke' ? 'Sorten' : 'Gerichte' }}
                                </small>
                            </a>
                        @endif
                    @endforeach
                </aside>

                <hr />
                <aside>
                    <span class="font-weight-bold">Telefonische Bestellung:</span>
                    <br />
                    <a class="number text-primary font-weight-bold lead" href="tel:01754156554">07051 / 934 953</a>
                    <div class="mt-2">
                        <span class="font-weight-bold">Abholung:</span>
                        <br />
                        <span>Lange Steige 6, 75365 Calw</span>
                        <br />
                        (<a href="https://goo.gl/maps/UiqyqCqvLXo" target="_blank">Anfahrt</a>)
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <div class="col d-inline-block">

        <div id="app">
            <div class="content d-block text-left mt-3 pl-3">

                <div class="mt-4">

                    <span class="float-left mr-4">
                        <a href="/" title="imbiss-calw.de">
                            <img class="img-thumbnail mb-2" style="width:220px;" src="/images/head.png" />
                        </a>
                    </span>

                    <span class="float-left">
                        <span class="text-muted">
                            <span class="d-block mt-1">
                                <a class="font-weight-bold display-5 pb-0 number" href="tel:07051934953">07051 / 934 953</a>
                            </span>
                            <span>Lange Steige 6, 75365 Calw</span>
                            (<a href="https://goo.gl/maps/UiqyqCqvLXo" target="_blank">Anfahrt</a>)
                            <br />
                            <span class="lead">Montag - Sonntag</span> 11:00-14:30, 17:00-23:00 Uhr
                            <br />
                            <span class="lead">Samstag</span> 17:00 - 23:00 Uhr
                        </span>
                    </span>

                    <div class="clearfix"></div>

                    <hr class="mt-3 mb-4" />

                </div>

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
