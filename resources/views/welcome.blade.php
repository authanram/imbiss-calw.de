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

        <div class="m-b-md pt-2 pb-2">

            <h3>Unsere wunderbaren Menüs</h3>
            Schnell, Preiswert, gut und immer frisch zubereitet.

            <div class="pt-3">

                @foreach($categories as $category)
                    <a href="/menu/{{ urlencode(strtolower($category->name)) }}">
                        <span class="d-inline-block p-4 border menu-tile mb-2 mr-1">
                            <span class="font-weight-bold h5">{{ $category->name }}</span>
                            <br />
                            <small class="text-muted">
                                {{ count($category->menus) }}
                                {{ $category->name === 'Getränke' ? 'Sorten' : 'Gerichte' }}
                            </small>
                        </span>
                    </a>
                @endforeach

            </div>

        </div>
    </div>
@endsection