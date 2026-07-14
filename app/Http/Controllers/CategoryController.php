<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'data' => Category::withCount('item')->get(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = Str::uuid();
        Category::create($data);

        return back()->with('success', 'Category has been created');
    }

    public function detail($param)
    {
        return view('categories.detail', [
            'data' => Category::where('uuid', $param)->withCount('item')->firstOrFail(),
        ]);
    }

    public function update(CategoryRequest $request, $param)
    {
        
        $category = Category::where('uuid', $param)->first();
        $data = $request->validated();
        $data['uuid'] = Str::uuid();

        $category->update($data);

        return redirect()->route('category.detail', $category->uuid)->with('success', 'Category has been edited');
    }

    public function delete($param)
    {
        $category = Category::where('uuid', $param)->first();
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category has been deleted');
    }

}
