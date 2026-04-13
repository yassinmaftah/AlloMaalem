<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('admin.settings.index', compact('categories', 'cities'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);
        return redirect()->back()->with(['success' => 'Category added successfully!', 'active_tab' => 'categories']);
    }

    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->back()->with(['success' => 'Category deleted!', 'active_tab' => 'categories']);
    }

    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
        ]);

        City::create(['name' => $request->name]);
        return redirect()->back()->with(['success' => 'City added successfully!', 'active_tab' => 'cities']);
    }

    public function destroyCity($id)
    {
        City::findOrFail($id)->delete();
        return redirect()->back()->with(['success' => 'City deleted!', 'active_tab' => 'cities']);
    }
}
