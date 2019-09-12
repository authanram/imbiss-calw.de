<div class="col-md-3">
    @foreach($adminMenus->menus as $section)
        @if(($section->items && (!empty($section->role) && request()->user()->hasRole($section->role))) || empty($section->role))
            <div class="card">
                <div class="card-header">
                    {{ $section->section }}
                </div>

                <div class="card-body">
                    <ul class="nav flex-column" role="tablist">
                        @foreach($section->items as $menu)
                            @if ((!empty($menu->role) && request()->user()->hasRole($menu->role)) || empty($menu->role))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="{{ url($menu->url) }}">
                                        {{ $menu->title }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <br/>
        @endif
    @endforeach
</div>
