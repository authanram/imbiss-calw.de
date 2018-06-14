@extends('layouts.content')

@section('content')
    <div class="content d-block">

        @if (Route::has('login') && false)
            <div class="text-right">
                <div class="links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        {{--<a href="{{ route('register') }}">Register</a>--}}
                    @endauth
                </div>
            </div>
        @endif

        <div class="m-b-md mt-2">
            <span class="float-left mr-4">
                <img class="img-thumbnail" style="width:220px;" src="/images/head.png" />
            </span>

            <span class="float-left">
                <span class="text-muted">
                    <span class="d-block mt-1 mb-1">
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

            <hr class="mt-4 mb-4" />

            ...

        </div>
    </div>
@endsection