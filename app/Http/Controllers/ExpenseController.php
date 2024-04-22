<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ExpenseFormRequest;
use App\Models\Vendor;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Subcategory;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function create()
    {
        $vendors = Vendor::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('expense.create', compact('vendors', 'categories', 'subcategories'));
    }

    public function index(Request $request)
    {
        $query = Expense::with(["vendor", "category", "subcategory"]);

        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('date', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor', function ($q) use ($search) {
                        $q->where('vendor_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('subcategory', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }


        $orderBy = $request->input('orderBy', 'date');
        $orderDirection = $request->input('orderDirection', 'asc');
        $query->orderBy($orderBy, $orderDirection);

        $expenses = $query->paginate(5);

        return view('expense.index', compact('expenses'));
    }

    public function getTotalExpense()
    {
        $totalExpense = Expense::sum('amount');
        $vendorCount = Vendor::count();

        return response()->json(['totalExpense' => $totalExpense, 'vendorCount' => $vendorCount]);
    }

    public function getExpenseData($year = null)
    {
        $expenses = Expense::selectRaw('MONTH(date) as month, SUM(amount) as total_amount')
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('date', $year);
            })
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_amount', 'month');

        return response()->json($expenses);
    }



    public function getSubcategories(Category $category)
    {
        $subcategories = $category->subcategories;
        return back()->withInput()->with($subcategories);
    }
    public function saveOrUpdate(ExpenseFormRequest $request, Expense $expense)
{
    $oldVendor = Vendor::find($expense->vendor_id);

    if ($oldVendor !== null && $oldVendor->id !== $request->vendor_id) {
        $oldVendor->balance += $expense->amount; 
        $oldVendor->save();

        Transaction::create([
            'vendor_id' => $oldVendor->id,
            'transaction_date' => $request->date,
            'credit' => $expense->amount,
            'balance' => $oldVendor->balance,
        ]);
    }

    $newVendor = Vendor::find($request->vendor_id);

    $newVendor->balance -= $request->amount;
    $newVendor->save();

    Transaction::create([
        'vendor_id' => $newVendor->id,
        'transaction_date' => $request->date,
        'debit' => $request->amount,
        'balance' => $newVendor->balance,
    ]);

    $fields = [
        'date' => $request->date,
        'amount' => $request->amount,
        'vendor_id' => $request->vendor_id,
        'category_id' => $request->category,
        'subcategory_id' => $request->subcategory,
    ];
    $expense->fill($fields)->save();

    $message = $expense->wasRecentlyCreated ? 'Expense created successfully' : 'Expense updated successfully';

    return redirect()->route('expense.index')->with('success', $message);
}

    public function edit(Expense $expense)
    {
        $vendors = Vendor::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('expense.edit', compact('expense', 'vendors', 'categories', 'subcategories'));
    }

    public function destroy(Expense $expense)
    {
        $vendor = Vendor::find($expense->vendor_id);

        if ($vendor) {
            $vendor->balance += $expense->amount;
            $vendor->save();
        }
        $expense->delete();
        return redirect()->route('expense.index')->with('deleted', 'Expense deleted successfully!');
    }
}
