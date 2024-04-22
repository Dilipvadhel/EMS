<?php
// app/Http/Controllers/expenseReportByCategory.php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;

class expenseReportByCategory extends Controller
{
    public function expenseReportByCategory()
{

    $expensesByCategory = Category::with(['expenses' => function ($query) {
        $query->select('category_id', DB::raw('SUM(amount) as total_amount'))
            ->groupBy('category_id');
    }])->get();
    

    return view('reports.report', compact('expensesByCategory'));
}
}

