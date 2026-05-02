<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalIncomes = Income::sum('amount');
        $totalExpenses = Expense::sum('amount');
        $balance = $totalIncomes - $totalExpenses;

        $incomeByCategory = Income::select('categories.name', Income::raw('SUM(incomes.amount) as total'))
            ->join('categories', 'incomes.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        $expenseByCategory = Expense::select('categories.name', Expense::raw('SUM(expenses.amount) as total'))
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        return view('admin.reports.index', compact('totalUsers', 'totalIncomes', 'totalExpenses', 'balance', 'incomeByCategory', 'expenseByCategory'));
    }
}
