<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Sale;


class ContactController extends Controller
{
    public function gotoCustomers(){
        $pageConfigs = ['pageHeader' => false];
        $contact_type = 'customer';
        return view('/contacts/contacts', compact('pageConfigs','contact_type'));
    }

    public function gotoSuppliers(){
        $pageConfigs = ['pageHeader' => false];
        $contact_type = 'vendor';
        return view('/contacts/contacts', compact('pageConfigs','contact_type'));
    }

    public function showContacts(Request $request){

        if($request->type == "customer") $is_supplier = false;
        else if ($request->type=="vendor") $is_supplier = true;
        $contacts = Contact::where('is_supplier','=',$is_supplier)->get();
        return datatables()->of($contacts)->make(true);
    }

    //Find Product By ID
    public function findContact(Request $request){

        $contact=Contact::findOrFail($request->input('contact'));
        return response()->json($contact);
    }

    public function contactApi(Request $request)
    {
        $is_supplier = true;
        if($request->type=="customer") $is_supplier=false;

        $search = $request->searchTerm;
        if($search == '')
        {
            $datas = Contact::limit(10)->where('is_supplier',$is_supplier)->get();
        }
        else $datas = Contact::where('is_supplier',$is_supplier)->where('name','LIKE', "{$search}%")->limit(15)->get();

        $category=array();
        // $category[]=array("id"=>1,"text"=>"WALK IN CLIENT");
        foreach ($datas as $data) {
            $category[] = array("id"=>$data->id,"text"=>$data->name.' | Rs. '.number_format($data->balance,2));
        }
        return response()->json($category);
    }

    public function gotoContactReport($id){
        $pageConfigs = ['pageHeader' => false];
        $setting = Setting::first();
        $contact = Contact::find($id);

        if(!$contact->is_supplier){
            $report = DB::table('sales')
            ->select('sales.created_at','sales.id as transid','reference AS description','total AS billamount',DB::raw("0 as paid"),'note',DB::raw("0 as is_pay"))
            ->where('sales.contact_id','=',$id);
        }
        else{
            $report = DB::table('purchases')
            ->select('purchases.purchase_date as created_at','purchases.id as transid','reference AS description','total AS billamount',DB::raw("0 as paid"),'note',DB::raw("0 as is_pay"))
            ->where('purchases.contact_id','=',$id);
        }

        $summary = DB::table('payments')
        ->select('payments.created_at','payments.id as transid','payment_type AS description',DB::raw("0 as billamount"),'amount as paid','note',DB::raw("1 as is_pay"))
        ->where('payment_type','<>','credit')
        ->where('payments.contact_id','=',$id)
        ->union($report)->orderBy('created_at','asc')
        ->get();

        return view('contacts.contact-report',compact('pageConfigs','setting','summary','contact'));
    }
}
