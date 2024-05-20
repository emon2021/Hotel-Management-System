<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.foodCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3|unique:food_categories',
        ]);

        $category = new FoodCategory();
        $category->category_name = $request->category_name;
        $category->category_slug = Str::slug($request->category_name,'-');
        if(isset($request->category_status))
        {
            $category->category_status = $request->category_status;
        }
        $category->save();

        return response()->json('Food Category Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show( $m)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $m)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $m)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $m)
    {
        //
    }
}
