<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categorySave(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'type' => 'required|string|max:100',
            'color_hex' => 'required|string',
        ]);

        Category::create([
            'user_id' => session('id'),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'type' => Str::lower($request->type),
            'color' => $request->color_hex,
        ]);

        return redirect()->route('categories-show')->with('success', 'Category baru berhasil ditambahkan!');
    }

    public function categoryEdit(Request $request, Category $category)
    {
        $request->validate([
            'edit_name' => 'required|string|max:100',
            'edit_type' => 'required|string|max:100',
            'edit_color_hex' => 'required|string',
        ]);

        $category->update([
            'name' => $request->edit_name,
            'slug' => Str::slug($request->edit_name),
            'type' => Str::lower($request->edit_type),
            'color' => $request->edit_color_hex,
        ]);

        return redirect()->route('categories-show')->with('success', 'Category berhasil diperbarui!');
    }

    public function categoryDelete(Category $category)
    {
        $category->delete();

        return redirect()->route('categories-show')->with('success', 'Category berhasil dihapus!');
    }
}
