<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Menu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $menus = Menu::where('menu_category_id', 'LIKE', "%$keyword%")
                ->orWhere('number', 'LIKE', "%$keyword%")
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('note', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $menus = Menu::paginate($perPage);
        }

        $menucategories = \App\MenuCategory::all();

        return view('menus.index', compact('menus', 'menucategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $menucategories = \App\MenuCategory::all();

        return view('menus.create', compact('menucategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'menu_category_id' => 'required',
			'number' => 'required',
			'name' => 'required',
			'price' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();
        
        Menu::create($requestData);

        return redirect('menus')->with('flash_message', 'Menu added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menucategories = \App\MenuCategory::all();


        return view('menus.edit', compact('menu', 'menucategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'menu_category_id' => 'required',
			'number' => 'required',
			'name' => 'required',
			'price' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();
        
        $menu = Menu::findOrFail($id);
        $menu->update($requestData);

        return redirect('menus')->with('flash_message', 'Menu updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Menu::destroy($id);

        return redirect('menus')->with('flash_message', 'Menu deleted.');
    }
}
