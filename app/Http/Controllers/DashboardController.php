<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $vendorCount = Vendor::count();
        $totalExpense = Expense::sum('amount');
        $totalPayment = Payment::sum('amount');
        $userCount = User::count();

        return view('dashboard', [
            'vendorCount' => $vendorCount,
            'totalExpense' => $totalExpense,
            'totalPayment' => $totalPayment,
            'userCount' => $userCount,
        ]);
    }
}
