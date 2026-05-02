<?php

namespace App\Http\Controllers\Advisor;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\FinancialNote;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnalysisController extends Controller
{
    public function index(): View
    {
        $users = User::query()
            ->where('role', 'user')
            ->orderBy('name')
            ->get()
            ->map(function (User $user) {
                $totalIncome = Income::where('user_id', $user->id)->sum('amount');
                $totalExpense = Expense::where('user_id', $user->id)->sum('amount');
                $latestNote = FinancialNote::where('user_id', $user->id)
                    ->where('advisor_id', auth()->id())
                    ->latest()
                    ->first();

                return [
                    'user' => $user,
                    'totalIncome' => $totalIncome,
                    'totalExpense' => $totalExpense,
                    'balance' => $totalIncome - $totalExpense,
                    'latestNote' => $latestNote,
                ];
            });

        return view('advisor.analysis.index', [
            'users' => $users,
        ]);
    }

    public function store(Request $request, User $user): RedirectResponse
    {
        abort_if($user->role !== 'user', 404);

        $validated = $request->validate([
            'advice' => ['required', 'string', 'max:2000'],
        ]);

        FinancialNote::updateOrCreate(
            [
                'user_id' => $user->id,
                'advisor_id' => auth()->id(),
            ],
            [
                'advice' => $validated['advice'],
            ]
        );

        return redirect()
            ->route('advisor.analysis.index')
            ->with('success', 'Advice saved successfully.');
    }
}
