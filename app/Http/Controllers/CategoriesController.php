<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Show a view that lists all categories.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(15);

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form to create a category.
     *
     * @param  Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category)
    {
        return view('categories.create', compact('category'));
    }

    /**
     * Stores a category into the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        request()->validate([
            'name' => 'required|string|min:3|unique:categories,name',
            'color' => 'required|string|max:25'
        ]);

        Category::create(request(['name', 'color']));

        $this->flash('Categoria criada.');

        return redirect('/admin/categories');
    }

    /**
     * Show the form to edit the given category.
     *
     * @param  Category  $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the given category.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category)
    {
        request()->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                Rule::unique('categories')->ignore($category->name, 'name')
            ],
            'color' => 'required|string|max:25'
        ]);

        $category->update(request(['name', 'color']));

        $this->flash('Categoria atualizada.');

        return redirect('/admin/categories');
    }
}
