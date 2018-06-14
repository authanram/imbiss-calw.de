@extends('layouts.content')

@section('content')
    <div class="pb-3">
        @foreach($categories as $menuCategory)
            <h3 class="mb-0">{{ $menuCategory->name }}</h3>
            <small class="text-muted">
                {{ count($menuCategory->menus) }}
                {{ $menuCategory->name === 'Getränke' ? 'Sorten' : 'Gerichte' }}
            </small>
            <br />
            <br />
            <div class="list-group menu">
                @foreach($menuCategory->menus as $menu)
                    <div class="list-group-item pb-2">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="float-left mb-0 mr-3">{{ $menu->number }}</h3>
                                <div class="float-left" style="margin-top:3px;">
                                    <div class="d-inline-block lead">{{ $menu->name }}</div>
                                    @if(!empty($menu->note))
                                        <div class="text-muted">{{ $menu->note }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4 text-right lead">
                                {{ number_format($menu->price, 2) }} &euro;
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection