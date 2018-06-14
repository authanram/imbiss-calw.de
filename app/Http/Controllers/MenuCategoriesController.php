<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MenuCategory;
use Illuminate\Http\Request;

class MenuCategoriesController extends Controller
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
            $menucategories = MenuCategory::where('name', 'LIKE', "%$keyword%")
                ->orWhere('order', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $menucategories = MenuCategory::paginate($perPage);
        }

        return view('menu-categories.index', compact('menucategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('menu-categories.create');
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
			'name' => 'required',
			'order' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();
        
        MenuCategory::create($requestData);

        return redirect('menu-categories')->with('flash_message', 'Category added.');
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
        $menucategory = MenuCategory::findOrFail($id);

        return view('menu-categories.show', compact('menucategory'));
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
        $menucategory = MenuCategory::findOrFail($id);

        return view('menu-categories.edit', compact('menucategory'));
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
			'name' => 'required',
			'order' => 'required',
			'status' => 'required'
		]);
        $requestData = $request->all();
        
        $menucategory = MenuCategory::findOrFail($id);
        $menucategory->update($requestData);

        return redirect('menu-categories')->with('flash_message', 'Category updated.');
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
        MenuCategory::destroy($id);

        return redirect('menu-categories')->with('flash_message', 'Category deleted.');
    }
}
