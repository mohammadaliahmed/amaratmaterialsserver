<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerLedger;
use App\Models\Vendor;
use App\Models\VendorLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    //
    public function getCustomerLedger(Request  $request,$id){
        if ($request->isMethod('post')) {
            $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');

            CustomerLedger::create([
                'amount' => $request->amount,
                'type' => $request->type,
                'message' => $request->message,
                'date' => $date,
                'customer_id' => $id,

            ]);
            return  redirect()->back();


        }else {
            $customer = Customer::find($id);
            $startingBalance = $customer->balance ?? 0;
            $ledgerEntries = CustomerLedger::where('customer_id', $id)
                ->orderBy('date')
                ->get();
            return view('customers.ledger', compact('customer',
                'startingBalance', 'ledgerEntries'));
        }

    }
    public function getVendorLedger(Request  $request,$id){
        if ($request->isMethod('post')) {
            $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');

            VendorLedger::create([
                'amount' => $request->amount,
                'type' => $request->type,
                'message' => $request->message,
                'date' => $date,
                'vendor_id' => $id,

            ]);
            return  redirect()->back();


        }else {
            $vendor = Vendor::find($id);
            $startingBalance = $vendor->balance ?? 0;
            $ledgerEntries = VendorLedger::where('vendor_id', $id)
                ->orderBy('date')
                ->get();
            return view('vendors.ledger', compact('vendor',
                'startingBalance', 'ledgerEntries'));
        }

    }
}
