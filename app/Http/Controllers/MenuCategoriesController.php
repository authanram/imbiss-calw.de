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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $menucategory = MenuCategory::findOrFail($id);

        return view('menu-categories.show', compact('menucategory'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $menucategory = MenuCategory::findOrFail($id);

        return view('menu-categories.edit', compact('menucategory'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
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
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        MenuCategory::destroy($id);

        return redirect('menu-categories')->with('flash_message', 'Category deleted.');
    }
}
