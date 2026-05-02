<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $totalExpense = Expense::where('user_id', auth()->id())->sum('amount');

        return view('user.expenses.index', compact('expenses', 'totalExpense'));
    }

    public function create()
    {
        $categories = Category::where('type', 'expense')->get();
        return view('user.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'amount'       => 'required|numeric|min:0.01',
            'description'  => 'nullable|string|max:255',
            'date'         => 'required|date',
        ]);

        Expense::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    public function edit(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $categories = Category::where('type', 'expense')->get();
        return view('user.expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'amount'       => 'required|numeric|min:0.01',
            'description'  => 'nullable|string|max:255',
            'date'         => 'required|date',
        ]);

        $expense->update([
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    public function destroy(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }
}