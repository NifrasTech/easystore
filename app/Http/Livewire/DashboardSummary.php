<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Expense;
use App\Models\Payment;
Use \Carbon\Carbon;

class DashboardSummary extends Component
{
    public $dtStart, $dtEnd, $sales, $expense, $profit, $recieved, $discount;

    public function render()
    {
        return view('livewire.dashboard-summary');
    }

    public function mount(){
        $this->dtStart = $this->dtEnd = date("Y-m-d");
        $this->getRecord();
    }

    public function getRecord(){
        $wheredate = [$this->dtStart.' 00:00:00', $this->dtEnd.' 23:59:59'];
        $this->sales = Sale::whereBetween('sales.created_at',$wheredate)->sum('total');
        $this->discount = Sale::whereBetween('sales.created_at',$wheredate)->sum('discount');
        $this->expense = Expense::whereBetween('expenses.expense_date',$wheredate)->sum('amount');
        $this->profit = Sale::whereBetween('sales.created_at',$wheredate)->sum('profit');
        $this->recieved = Payment::whereIn('payment_type',['cash','cheque'])->whereBetween('payments.created_at',$wheredate)->sum('amount');
    }

}
