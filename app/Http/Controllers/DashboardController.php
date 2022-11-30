<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Contact;
use Barryvdh\Debugbar\Facade as Debugbar;
class DashboardController extends Controller
{
  // Dashboard - Ecommerce
  public function dashboardEcommerce()
  {
    $pageConfigs = ['pageHeader' => false,];
    $products = Product::count();
    $customers = Contact::where('is_supplier','=',false)->count();
    $suppliers = Contact::where('is_supplier','=',true)->count();
    $sales = Sale::sum("total");
    $purchases = Purchase::sum("total");
    $cheques = Payment::where('payment_type','=','cheque')->count();
    $recentTrans = Payment::latest()->take(5)->get();
    $recentSale = Sale::latest()->take(5)->get();
    $recentPurchase = Purchase::latest()->take(5)->get();
    return view('/dashboard',compact(
      'pageConfigs','products','sales','purchases','customers','suppliers','cheques','recentTrans',
      'recentSale','recentPurchase'
    ));

  }
  
  
}
