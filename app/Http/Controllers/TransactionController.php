<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->whereHas('vendor', function ($q) use ($searchTerm) {
                $q->where('vendor_name', 'like', '%' . $searchTerm . '%');
            })->orWhere('transaction_date', 'like', '%' . $searchTerm . '%');
        }

        $transactions = $query->orderBy('transaction_date', 'asc')->paginate(10);
        return view('transaction.index', compact('transactions'));
    }
    
    public function getTransactionsBalance($month)
    {
        $balances = Transaction::select('transaction_date', 'balance')
            ->whereMonth('transaction_date', $month)
            ->orderBy('transaction_date')
            ->get();

        $months = $balances->pluck('transaction_date')->map(function ($date) {
            return Carbon::parse($date)->format('F');
        });

        $balances = $balances->pluck('balance');

        return response()->json([
            'months' => $months,
            'balances' => $balances,
        ]);
    }
    public function getTransactionBalances()
    {
        $transactionBalances = Transaction::select(DB::raw('YEAR(transaction_date) as year'), DB::raw('MONTH(transaction_date) as month'), DB::raw('SUM(credit - debit) as balance'))
            ->groupBy(DB::raw('YEAR(transaction_date)'), DB::raw('MONTH(transaction_date)'))
            ->orderBy(DB::raw('YEAR(transaction_date)'), 'asc')
            ->orderBy(DB::raw('MONTH(transaction_date)'), 'asc')
            ->get();

        return response()->json($transactionBalances);
    }
}
