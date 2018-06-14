@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Menucategories</div>
                    <div class="card-body">
                        <a href="{{ url('/menu-categories/create') }}" class="btn btn-success btn-sm" title="Add New MenuCategory">
                            Create Category
                        </a>

                        <form method="GET" action="{{ url('/menu-categories') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>Order</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Menus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($menucategories as $item)
                                    <tr>
                                        <td>{{ $item->order }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->status === 1 ? 'Visible' : 'Hidden' }}</td>
                                        <td>{{ count($item->menus) }}</td>
                                        <td class="text-right">
                                            <a href="{{ url('/menu-categories/' . $item->id . '/edit') }}" title="Edit MenuCategory"><button class="btn btn-secondary btn-sm">Edit</button></a>

                                            <form method="POST" action="{{ url('/menu-categories' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete MenuCategory" onclick="return confirm(&quot;Confirm delete?&quot;)">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $menucategories->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
