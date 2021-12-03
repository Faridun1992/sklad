<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::withCount('products')->orderBy('title')->get();
        return view('categories.categories_main', compact('categories'));
    }

    public function create()
    {
        return view('categories.categories_create');
    }


    public function store(CategoryRequest $request, Category $category)
    {
        $category->create($request->validated());
        return redirect()->route('categories.index')->with('status', "Категория $category->title успешно добавлена");
    }

    public function edit(Category $category)
    {
        return view('categories.categories_edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return back()->with('status', "Категория $category->title успешно отредактирован");
    }


    public function destroy(Category $category)
    {
        if($category->products->count() > 0){
            return back()->withErrors('У данной категории есть товары');
        }
        $category->delete();
        return back()->with('status', "Категория $category->title успешно удалена");
    }
}
