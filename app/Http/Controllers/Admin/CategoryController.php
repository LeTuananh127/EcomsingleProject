<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function Index(){
        $categories = Category::latest()->get();
        return view('admin.allcategory', compact('categories'));
    }
    public function AddCategory(){
        return view('admin.addcategory');
    }
    public function StoreCategory(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        return redirect()->route('allcategory')->with('message', 'Category Added Successfully');

    }
    public function EditCategory($id) {
        $category_infor = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_infor'));
    }
    public function UpdateCategory(Request $request, $id){
        $category_id = Category::findOrFail($id);
        $request->validate([
            'category_name' => 'required|unique:categories',
        ]);
        Category::findOrFail($id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);
        return redirect()->route('allcategory')->with('message', 'Category Updated Successfully');
    }
    public function DeleteCategory($id){
        Category::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
    
}
