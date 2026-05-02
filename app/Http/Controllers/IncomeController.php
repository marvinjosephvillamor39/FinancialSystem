<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Category;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::with('category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        $totalIncome = Income::where('user_id', auth()->id())->sum('amount');

        return view('user.incomes.index', compact('incomes', 'totalIncome'));
    }

    public function create()
    {
        $categories = Category::where('type', 'income')->get();
        return view('user.incomes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'amount'       => 'required|numeric|min:0.01',
            'description'  => 'nullable|string|max:255',
            'date'         => 'required|date',
        ]);

        Income::create([
            'user_id'     => auth()->id(),
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully!');
    }

    public function edit(Income $income)
    {
        // Make sure the user owns this record
        abort_if($income->user_id !== auth()->id(), 403);

        $categories = Category::where('type', 'income')->get();
        return view('user.incomes.edit', compact('income', 'categories'));
    }

    public function update(Request $request, Income $income)
    {
        abort_if($income->user_id !== auth()->id(), 403);

        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'amount'       => 'required|numeric|min:0.01',
            'description'  => 'nullable|string|max:255',
            'date'         => 'required|date',
        ]);

        $income->update([
            'category_id' => $request->category_id,
            'amount'      => $request->amount,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

        return redirect()->route('incomes.index')->with('success', 'Income updated successfully!');
    }

    public function destroy(Income $income)
    {
        abort_if($income->user_id !== auth()->id(), 403);
        $income->delete();
        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully!');
    }
}