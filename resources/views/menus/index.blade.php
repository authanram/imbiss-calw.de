@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Menus</div>
                    <div class="card-body">
                        <a href="{{ url('/menus/create') }}" class="btn btn-success btn-sm" title="Add New Menu">
                            Create Menu
                        </a>

                        <form method="GET" action="{{ url('/menus') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Number</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $item)
                                    <tr>
                                        <td>{{ $item->number }}</td>
                                        <td style="width:37%;">
                                            {{ $item->name }}

                                            @if($item->note)
                                                <div class="text-muted small">{{ $item->note }}</div>
                                            @endif
                                        </td>
                                        <td>{{ number_format($item->price, 2) }} &euro;</td>
                                        <td>{{ $item->menuCategory->name }}</td>
                                        <td>{{ $item->status === 1 ? 'Visible' : 'Hidden' }}</td>
                                        <td class="text-right">
                                            {{--<a href="{{ url('/menus/' . $item->id) }}" title="View Menu"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                            <a href="{{ url('/menus/' . $item->id . '/edit') }}" title="Edit Menu"><button class="btn btn-secondary btn-sm">Edit</button></a>

                                            <form method="POST" action="{{ url('/menus' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Menu" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $menus->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
