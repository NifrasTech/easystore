<?php

namespace App\Http\Livewire\Expenses;

use Livewire\Component;
use App\Models\Expense;

class ExpenseModal extends Component
{
    public $expense;

    protected $rules=[
        'expense.description'=>'required',             
        'expense.amount'=>'required',             
        'expense.expense_date'=>'required',             
    ];

    public function render()
    {
        return view('livewire.expenses.expense-modal');
    }

    public function mount(){
        $this->expense = new Expense;
    }

    public function store(){
        $this->validate();
        $this->expense->save();
        $this->expense = new Expense;

        //Show Message (this function is from Javascript - product.js)
        $this->emit('showMessage','Successfully added');
    }
}
