<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'data' => Category::all(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = Str::uuid();
        Category::create($data);

        return back()->with('success', 'Category has been created');
    }
}
