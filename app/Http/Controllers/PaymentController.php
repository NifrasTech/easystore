<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function gotoTransactions(){
        $pageConfigs = ['pageHeader' => false,];
        return view('/transactions/transactions',compact('pageConfigs'));
    }

    public function gotoCheques(){
        $pageConfigs = ['pageHeader' => false,];
        return view('/transactions/cheques',compact('pageConfigs'));
    }

    public function showTransactions(Request $request){
        $payments = Payment::query();

        if(isset($request->from) && isset($request->to))
        {
            $payments = $payments->whereBetween('payments.created_at',
                [$request->from.' 00:00:00', $request->to.' 23:59:59']
            );
        }

        $payments = $payments->select("payments.*","contacts.name")
        ->leftJoin("contacts","contacts.id","=","payments.contact_id")
        ->where('payment_type',"<>","credit");
        // ->orderBy('created_at','DESC');

        return datatables()->eloquent($payments)
        ->editColumn('created_at', function($payments){return $payments->created_at->format("Y-m-d");})
        ->editColumn('payment_type', function($payments){return ucwords($payments->payment_type);})
        ->make(true);
    }

    public function showCheques(Request $request){
        $payments = Payment::query();

        if(isset($request->from) && isset($request->to))
        {
            $payments = $payments->whereBetween('payments.cheque_date',[$request->from, $request->to]);
        }
        $payments = $payments->select("payments.*","contacts.name")
        ->leftJoin("contacts","contacts.id","=","payments.contact_id")
        ->where('payment_type',"=","cheque");

        return datatables()->eloquent($payments)->make(true);
    }
}
