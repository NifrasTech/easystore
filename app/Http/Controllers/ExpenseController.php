<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function gotoExpenses(){
        $pageConfigs = ['pageHeader' => false,];
        return view('/expenses/expenses',compact('pageConfigs'));
    }

    public function showExpenses(Request $request){
        $expenses = Expense::query();

        if(isset($request->from) && isset($request->to))
        {
            $expenses = $expenses->whereBetween('expenses.expense_date',[$request->from.' 00:00:00', $request->to.' 23:59:59']);
        }

        return datatables()->eloquent($expenses)
        ->editColumn('expense_date', function($expenses){return $expenses->expense_date->format("Y-m-d");})
        ->make(true);
    }

    public function deleteExpense(Request $request){
        $expense = Expense::find($request->id);
        $expense = $expense->delete();
        return 'Deleted';
    }
}
