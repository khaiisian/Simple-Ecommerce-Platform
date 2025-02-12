<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Storage;

class AdminItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        $items = Item::with('category')->get();
        return view('admin.item', compact('categories', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'item_name' => 'required|max:100',
            'item_desc' => 'required|max:500',
            'item_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'item_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer',
            'category' => 'required|integer|exists:categories,category_id',
        ]);

        $item_image = $validatedData['item_image']->getClientOriginalName();

        $item = Item::create([
            'item_name' => $validatedData['item_name'],
            'item_desc' => $validatedData['item_desc'],
            'item_price' => $validatedData['item_price'],
            'image' => $item_image,
            'stock' => $validatedData['stock'],
            'category_id' => $validatedData['category'],
        ]);


        if ($item) {
            $validatedData['item_image']->storeAs('public/images', $item_image);
            return redirect()->route('admin.item')->with('success', 'Item created successfully');
        } else {
            return redirect()->route('admin.item')->with('error', 'Item failed to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $item = Item::findOrFail($id);
        $categories = Category::all();
        return view('admin.item_edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        $validateData = $request->validate([
            'item_name' => 'required|max:100',
            'item_desc' => 'required|max:500',
            'item_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'item_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer',
            'category' => 'required|integer|exists:categories,category_id',
        ]);

        if ($request->hasFile('item_image')) {
            $item_image = $validateData['item_image']->getClientOriginalName();
            Storage::delete('public/images/' . $item->image);
            $validateData['item_image']->storeAs('public/images', $item_image);
        } else {
            $item_image = $item->image;
        }

        $item->update([
            'item_name' => $validateData['item_name'],
            'item_desc' => $validateData['item_desc'],
            'item_price' => $validateData['item_price'],
            'image' => $item_image,
            'stock' => $validateData['stock'],
            'category_id' => $validateData['category'],
        ]);



        return redirect()->route('admin.item')->with('sucess', 'Item is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $item = Item::findOrFail($id);
        if ($item && $item->image) {
            Storage::delete('public/images/' . $item->image);
        }
        $item->delete();
        return redirect()->route('admin.item')->with('success', 'Item deleted successfully');
    }
}