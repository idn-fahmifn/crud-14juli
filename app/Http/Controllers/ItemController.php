<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\ItemRequest;
use App\Models\{Category, Item};


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('items.index', [
            'data' => Item::paginate(10),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('items.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $data['uuid'] = Str::uuid7();

        $data['category_id'] = $request->category;
        unset($data['category']);

        // pergantian nama : 
        $file = $request->file('image');
        $format = $file->getClientOriginalExtension();
        $name = 'items_' . now()->format('YmdHis') . '_' . uniqid() . '.' . $format;
        // items_20260715123409_abcd.png

        // simpan ke storage
        $file->storeAs('items', $name, 'public');

        // Simpan ke ke database 
        $data['image'] = $name;

        Item::create($data);
        return back()->with('success', 'items has been created');


    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        return view('items.detail', [
            'data' => Item::where('uuid', $param)->firstOrFail(),
            'categories' =>Category::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect()->route('items.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
