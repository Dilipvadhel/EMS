<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Models\Subcategory;
use App\Models\Category;
use App\Http\Requests\SubcategoryFormRequest;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        $subcategories = Subcategory::paginate(5);

        return view('subcategory.index')->with('subcategories', $subcategories);
    }

    public function create()
    {
        $categories = Category::all();
        return view('subcategory.create')->with('categories', $categories);
    }

    public function saveOrUpdate(SubcategoryFormRequest $request, Subcategory $subcategory)
    {
        $fields = [
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'description' => $request->description,
        ];
        $subcategory->fill($fields)->save();

        $message = $subcategory->wasRecentlyCreated ? 'Subcategory created successfully' : 'Subcategory updated successfully';

        return redirect()->route('subcategory.index')->with('success', $message);
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategory.edit')->with('subcategory', $subcategory)->with('categories', $categories);
    }


    public function destroy(Subcategory $subcategory)
    {
        try {
            if ($subcategory->expenses->isEmpty()) {
                $subcategory->delete();
                return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully');
            } else {
                return redirect()->route('subcategory.index')->with('error', 'Cannot delete subcategory because it has related expenses');
            }
        } catch (QueryException $e) {
            return redirect()->route('subcategory.index')->with('error', 'An error occurred while deleting the subcategory');
        }
    }
}
