<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentFormRequest;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Vendor;

class PaymentController extends Controller
{
    public function create()
    {
        $vendors = Vendor::all();
        return view('payment.create', compact('vendors'));
    }

    public function getTotalPayment()
    {
        $totalPayment = Payment::sum('amount');
        $vendorCount = Vendor::count();

        return response()->json(['totalPayment' => $totalPayment, 'vendorCount' => $vendorCount]);
    }

    public function index(Request $request)
    {
        $query = Payment::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('vendor', function (Builder $query) use ($searchTerm) {
                $query->where('vendor_name', 'like', "%$searchTerm%")
                    ->orWhere('amount', 'like', "%$searchTerm%");
            });
        }

        $payments = $query->orderBy('date', 'asc')->paginate(5);

        return view('payment.index', compact('payments'));
    }

    // public function index()
    // {
    //     $payments = Payment::orderBy('date', 'asc')->paginate(5);
    //     $payments->transform(function ($payment) {
    //         $payment->date = Carbon::createFromFormat('Y-m-d', $payment->date)->format('d/m/Y');
    //         return $payment;
    //     });

    //     return view('payment.index', compact('payments'));
    // }
    public function saveOrUpdate(PaymentFormRequest $request, Payment $payment)
    {
        $vendor = Vendor::find($payment->vendor_id);

        if ($vendor !== null && $vendor->id !== $request->vendor_id) {
            $vendor->balance -= $payment->amount;
            $vendor->save();
            Transaction::create([
                'vendor_id' => $vendor->id,
                'transaction_date' => $request->date,
                'debit' => $payment->amount,
                'balance' => $vendor->balance,
            ]);
        }

        $newVendor = Vendor::find($request->vendor_id);

        $newBalance = $newVendor->balance + $request->amount;
        $newVendor->update(['balance' => $newBalance]);

        Transaction::create([
            'vendor_id' => $newVendor->id,
            'transaction_date' => $request->date,
            'credit' => $request->amount,
            'balance' => $newBalance,
        ]);

        $fields = [
            'date' => $request->date,
            'amount' => $request->amount,
            'vendor_id' => $request->vendor_id,
        ];

        $payment->fill($fields)->save();

        $message = $payment->wasRecentlyCreated ? 'Payment created successfully' : 'Payment updated successfully';

        return redirect()->route('payment.index')->with('success', $message);
    }

    public function edit(Payment $payment)
    {
        $vendors = Vendor::all();
        return view('payment.edit', compact('payment', 'vendors'));
    }

    public function destroy(Payment $payment)
    {
        $vendor = Vendor::find($payment->vendor_id);

        if ($vendor) {
            $vendor->balance -= $payment->amount;
            $vendor->save();
        }

        $payment->delete();

        return redirect()->route('payment.index')->with('deleted', 'Payment deleted successfully!');
    }
}
