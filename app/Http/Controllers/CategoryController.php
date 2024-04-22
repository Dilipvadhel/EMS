<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Builder;

use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $categories = $query->with('subcategories')->paginate(5);

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view("category.create");
    }
    public function saveOrUpdate(CategoryFormRequest $request, Category $category)
    {

        $categoryFields = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $category->fill($categoryFields)->save();
        if ($request->has('subnames') && is_array($request->subIds) && is_array($request->removedSubcategories)) {
            foreach ($request->subnames as $key => $subname) {
                if (isset($request->subIds[$key]) && isset($request->removedSubcategories[$key])) {
                    if ($request->subIds[$key] !== "0" && $request->removedSubcategories[$key] === "1") {
                        Subcategory::destroy($request->subIds[$key]);
                    } else {
                        $subcategory = Subcategory::updateOrCreate(
                            ['id' => $request->subIds[$key]],
                            ['name' => $subname, 'category_id' => $category->id]
                        );
                    }
                }
            }
        }
        $message = $category->wasRecentlyCreated ? 'Category created successfully' : 'Category updated successfully';
        return redirect()->route('category.index')->with('success', $message);
    }
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    // public function expenseReportByCategory()
    // {
    //     $categories = Category::with('expenses')->get();
    //     return view('reports.report', compact('categories'));
    // }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('category.index')->with('del', 'Category deleted successfully');
        } catch (QueryException $e) {
            return redirect()->route('category.index')->with('error', 'Cannot delete category because it has related expenses');
        }
    }
}
