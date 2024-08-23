<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieve all categories for the parent category dropdown
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Create a new category using the validated data
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        // Redirect to the route that shows the list of categories
        return redirect()->route('admin.view_category')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $categories = Category::all(); // For the parent category dropdown
        return view('admin.edit_category', compact('category', 'categories'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('admin.view_category')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.view_category')->with('success', 'Category deleted successfully.');
    }
}

