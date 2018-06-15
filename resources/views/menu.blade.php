@extends('layouts.content')

@section('content')
    <div class="pb-3">
        @foreach($categories as $menuCategory)
            @if($menuCategory->status)
                @if(count($categories) === 1)
                    <div>
                @else
                    <div class="mb-4 pb-2">
                @endif
                    <a name="{{ urlencode(strtolower(htmlentities($menuCategory->name))) }}"></a>
                    <h3 class="mb-0">{{ $menuCategory->name }}</h3>
                    <small class="text-muted">
                        {{ count($menuCategory->menus) }}
                        {{ $menuCategory->name === 'Getränke' ? 'Sorten' : 'Gerichte' }}
                    </small>
                    <br />
                    <br />
                    <div class="list-group menu">
                        @foreach($menuCategory->menus as $menu)
                            @if($menu->status)
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-8">
                                            <h3 class="float-left mb-0 mr-3">{{ $menu->number }}</h3>
                                            <div class="float-left" style="margin-top:3px;">
                                                <div class="d-inline-block lead">{{ $menu->name }}</div>
                                                @if(!empty($menu->note))
                                                    <div class="text-muted">{!! str_replace(', scharf', ', <span class="font-weight-bold text-primary">scharf</span>', $menu->note) !!}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div class="lead">{{ str_replace('.', ',', number_format($menu->price, 2)) }} &euro;</div>
                                            <span class="small" style="color:#bbb;">Inkl. 19% MwSt.</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection