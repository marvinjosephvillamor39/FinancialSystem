<?php

use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Advisor\AnalysisController;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

// Root — redirect to login
Route::get('/', function () {
    return view('auth.login');
});

// Dashboard route (protected)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'advisor') {
        return redirect()->route('advisor.analysis.index');
    }

    $userId = auth()->id();

    $totalIncome  = Income::where('user_id', $userId)->sum('amount');
    $totalExpense = Expense::where('user_id', $userId)->sum('amount');
    $balance      = $totalIncome - $totalExpense;

    $recentIncomes  = Income::with('category')->where('user_id', $userId)->latest()->take(5)->get();
    $recentExpenses = Expense::with('category')->where('user_id', $userId)->latest()->take(5)->get();

    return view('dashboard', compact('totalIncome', 'totalExpense', 'balance', 'recentIncomes', 'recentExpenses'));
})->middleware(['auth'])->name('dashboard');

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('incomes', IncomeController::class);
    Route::resource('expenses', ExpenseController::class);
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});

// Financial Advisor routes
Route::middleware(['auth', 'role:advisor'])->prefix('advisor')->name('advisor.')->group(function () {
    Route::get('analysis', [AnalysisController::class, 'index'])->name('analysis.index');
    Route::post('analysis/{user}', [AnalysisController::class, 'store'])->name('analysis.store');
});

require __DIR__.'/auth.php';
