<?php
// app/Http/Controllers/VendorController.php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\VendorFormRequest;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Transaction;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use PDF;


class VendorController extends Controller
{
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getVendorCount()
    {
        $vendorCount = Vendor::count();
        return response()->json(['count' => $vendorCount]);
    }
    public function getVendorTransactions($vendorId)
    {
        $vendor = Vendor::findOrFail($vendorId);
        $transactions = $vendor->transactions()->get();
        return response()->json($transactions);
    }

    // public function index()
    // {
    //     $vendorCount = Vendor::count(); 
    //     $vendors = Vendor::paginate(5);
    //     return view('vendor.index')->with('vendors', $vendors)->with('vendorCount', $vendorCount);
    // }

    public function index(Request $request)
    {
        $query = Vendor::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function (Builder $q) use ($search) {
                $q->where('vendor_name', 'like', '%' . $search . '%')
                    ->orWhere('company_name', 'like', '%' . $search . '%')
                    ->orWhere('mobile_no', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $vendors = $query->paginate(5);

        return view('vendor.index', compact('vendors'));
    }

    public function generatePDF($vendorId, Request $request)
    {
        $vendor = Vendor::findOrFail($vendorId);
        $transactions = $vendor->transactions();

        if ($request->has('start_date') && $request->has('end_date')) {
            $transactions->whereBetween('transaction_date', [$request->start_date, $request->end_date]);
        }

        $transactions = $transactions->get();

        $pdf = 'PDF'::loadView('vendor.vendor_transactions_pdf', compact('vendor', 'transactions'));
        return $pdf->download('vendor_transactions_' . $vendor->vendor_name . '.pdf');
    }


    public function create()
    {
        return view('vendor.create');
    }


    public function saveOrUpdate(VendorFormRequest $request, Vendor $vendor)
    {
        $fields = [
            'vendor_name' => $request->vendor_name,
            'company_name' => $request->company_name,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'email' => $request->email,

        ];

        $vendor->fill($fields)->save();

        $message = $vendor->wasRecentlyCreated ? 'Vendor created successfully' : 'Vendor updated successfully';

        return redirect()->route('vendor.index')->with('success', $message);
    }
    public function edit(Vendor $vendor)
    {
        return view('vendor.edit')->with('vendor', $vendor);
    }

    //     public function destroy(Vendor $vendor)
    // {
    //     if ($vendor->expenses()->count() > 0) {
    //         return redirect()->route('vendor.index')->with('error', 'This is not Delete Beacuse join with Expense');
    //     }

    //     $vendor->delete();

    //     return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    // }


    public function destroy(Vendor $vendor)
    {
        if ($vendor->transactions()->count() > 0) {
            return redirect()->route('vendor.index')->with('error', 'Cannot delete vendor as there are attach to transactions');
        }
        $vendor->delete();
        return redirect()->route('vendor.index')->with('del', 'Vendor deleted successfully.');
    }
}
