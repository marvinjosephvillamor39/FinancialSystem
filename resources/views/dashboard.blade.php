<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold text-teal-700">Overview</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Financial Tracking System</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">Welcome back, {{ Auth::user()->name }}. This page shows your money summary in a simple way.</p>
            </div>
            <div class="simple-chip">
                {{ \Carbon\Carbon::now()->format('F d, Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="app-shell space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="stat-card flex items-center gap-5 border-l-4 border-emerald-400">
                    <div class="rounded-full bg-emerald-100 p-4 text-emerald-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Income</p>
                        <p class="text-3xl font-bold text-emerald-600">&#8369;{{ number_format($totalIncome, 2) }}</p>
                    </div>
                </div>

                <div class="stat-card flex items-center gap-5 border-l-4 border-rose-400">
                    <div class="rounded-full bg-rose-100 p-4 text-rose-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Expenses</p>
                        <p class="text-3xl font-bold text-rose-600">&#8369;{{ number_format($totalExpense, 2) }}</p>
                    </div>
                </div>

                <div class="stat-card flex items-center gap-5 border-l-4 {{ $balance >= 0 ? 'border-sky-400' : 'border-amber-400' }}">
                    <div class="{{ $balance >= 0 ? 'bg-sky-100 text-sky-600' : 'bg-amber-100 text-amber-600' }} rounded-full p-4">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Net Balance</p>
                        <p class="text-3xl font-bold {{ $balance >= 0 ? 'text-sky-600' : 'text-amber-600' }}">
                            {{ $balance < 0 ? '-' : '' }}&#8369;{{ number_format(abs($balance), 2) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="table-card">
                    <div class="flex items-center justify-between border-b border-slate-200/70 px-6 py-4">
                        <h3 class="font-semibold text-slate-800">Recent Incomes</h3>
                        <a href="{{ route('incomes.index') }}" class="text-sm font-semibold text-emerald-600">View all</a>
                    </div>
                    <ul class="divide-y divide-slate-100">
                        @forelse($recentIncomes as $income)
                            <li class="flex items-center justify-between px-6 py-3">
                                <div>
                                    <p class="text-sm font-medium text-slate-700">{{ $income->category->name }}</p>
                                    <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($income->date)->format('M d, Y') }}</p>
                                </div>
                                <span class="text-sm font-semibold text-emerald-600">+&#8369;{{ number_format($income->amount, 2) }}</span>
                            </li>
                        @empty
                            <li class="px-6 py-6 text-center text-sm text-slate-400">No income records yet.</li>
                        @endforelse
                    </ul>
                    <div class="bg-white/50 px-6 py-4">
                        <a href="{{ route('incomes.create') }}" class="btn-primary block text-center">Add Income</a>
                    </div>
                </div>

                <div class="table-card">
                    <div class="flex items-center justify-between border-b border-slate-200/70 px-6 py-4">
                        <h3 class="font-semibold text-slate-800">Recent Expenses</h3>
                        <a href="{{ route('expenses.index') }}" class="text-sm font-semibold text-rose-600">View all</a>
                    </div>
                    <ul class="divide-y divide-slate-100">
                        @forelse($recentExpenses as $expense)
                            <li class="flex items-center justify-between px-6 py-3">
                                <div>
                                    <p class="text-sm font-medium text-slate-700">{{ $expense->category->name }}</p>
                                    <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</p>
                                </div>
                                <span class="text-sm font-semibold text-rose-600">-&#8369;{{ number_format($expense->amount, 2) }}</span>
                            </li>
                        @empty
                            <li class="px-6 py-6 text-center text-sm text-slate-400">No expense records yet.</li>
                        @endforelse
                    </ul>
                    <div class="bg-white/50 px-6 py-4">
                        <a href="{{ route('expenses.create') }}" class="btn-primary block text-center">Add Expense</a>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="glass-panel p-6">
                        <h3 class="mb-4 font-semibold text-slate-800">Income vs Expenses</h3>
                        @php
                            $total = $totalIncome + $totalExpense;
                            $incomePercent = $total > 0 ? round(($totalIncome / $total) * 100) : 0;
                            $expensePercent = $total > 0 ? round(($totalExpense / $total) * 100) : 0;
                        @endphp
                        <div class="mb-3 flex h-4 overflow-hidden rounded-full bg-slate-100">
                            @if($incomePercent > 0)
                                <div class="h-4 bg-emerald-400" style="width: {{ $incomePercent }}%"></div>
                            @endif
                            @if($expensePercent > 0)
                                <div class="h-4 bg-rose-400" style="width: {{ $expensePercent }}%"></div>
                            @endif
                        </div>
                        <div class="flex justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1">
                                <span class="inline-block h-2 w-2 rounded-full bg-emerald-400"></span> Income {{ $incomePercent }}%
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="inline-block h-2 w-2 rounded-full bg-rose-400"></span> Expenses {{ $expensePercent }}%
                            </span>
                        </div>
                    </div>

                    <div class="glass-panel p-6">
                        <h3 class="mb-4 font-semibold text-slate-800">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('incomes.create') }}" class="flex items-center gap-3 rounded-lg bg-emerald-50 p-3 transition hover:bg-emerald-100">
                                <div class="rounded-full bg-emerald-200 p-2 text-emerald-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-emerald-700">Record Income</span>
                            </a>
                            <a href="{{ route('expenses.create') }}" class="flex items-center gap-3 rounded-lg bg-rose-50 p-3 transition hover:bg-rose-100">
                                <div class="rounded-full bg-rose-200 p-2 text-rose-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-rose-700">Record Expense</span>
                            </a>
                            <a href="{{ route('incomes.index') }}" class="flex items-center gap-3 rounded-lg bg-slate-50 p-3 transition hover:bg-slate-100">
                                <div class="rounded-full bg-slate-200 p-2 text-slate-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">View All Incomes</span>
                            </a>
                            <a href="{{ route('expenses.index') }}" class="flex items-center gap-3 rounded-lg bg-slate-50 p-3 transition hover:bg-slate-100">
                                <div class="rounded-full bg-slate-200 p-2 text-slate-700">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-slate-700">View All Expenses</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn-danger w-full">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
