<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-teal-700">Advisor Area</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Financial Advice Review</h2>
                <p class="mt-2 text-sm leading-6 text-slate-500">Review each user’s totals and leave a short, helpful note they can act on.</p>
            </div>
            <div class="rounded-full border border-white/70 bg-white/80 px-4 py-2 text-sm font-medium text-slate-500 shadow-sm">
                {{ $users->count() }} user{{ $users->count() === 1 ? '' : 's' }} to review
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="app-shell space-y-6">
            @if(session('success'))
                <div class="glass-panel border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($users as $entry)
                <section class="glass-panel-strong p-6 sm:p-8">
                    <div class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                        <div>
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900">{{ $entry['user']->name }}</h3>
                                    <p class="text-sm text-slate-500">{{ $entry['user']->email }}</p>
                                </div>
                                <span class="badge-soft {{ $entry['balance'] >= 0 ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $entry['balance'] >= 0 ? 'Healthy Balance' : 'Needs Attention' }}
                                </span>
                            </div>

                            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                                <div class="stat-card border-l-4 border-emerald-400">
                                    <p class="text-sm font-medium text-slate-500">Income</p>
                                    <p class="mt-2 text-2xl font-bold text-emerald-600">&#8369;{{ number_format($entry['totalIncome'], 2) }}</p>
                                </div>
                                <div class="stat-card border-l-4 border-rose-400">
                                    <p class="text-sm font-medium text-slate-500">Expenses</p>
                                    <p class="mt-2 text-2xl font-bold text-rose-600">&#8369;{{ number_format($entry['totalExpense'], 2) }}</p>
                                </div>
                                <div class="stat-card border-l-4 {{ $entry['balance'] >= 0 ? 'border-sky-400' : 'border-amber-400' }}">
                                    <p class="text-sm font-medium text-slate-500">Balance</p>
                                    <p class="mt-2 text-2xl font-bold {{ $entry['balance'] >= 0 ? 'text-sky-600' : 'text-amber-600' }}">
                                        {{ $entry['balance'] < 0 ? '-' : '' }}&#8369;{{ number_format(abs($entry['balance']), 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="glass-panel p-5">
                            <h4 class="text-lg font-semibold text-slate-900">Advisor Note</h4>
                            <p class="mt-1 text-sm text-slate-500">Share one simple recommendation for this user.</p>

                            <form method="POST" action="{{ route('advisor.analysis.store', $entry['user']) }}" class="mt-4 space-y-4">
                                @csrf
                                <div>
                                    <label for="advice-{{ $entry['user']->id }}" class="field-label">Advice</label>
                                    <textarea
                                        id="advice-{{ $entry['user']->id }}"
                                        name="advice"
                                        rows="6"
                                        class="field-input"
                                        placeholder="Example: Try keeping weekly food spending under a set budget and review it every Friday."
                                    >{{ old('advice', optional($entry['latestNote'])->advice) }}</textarea>
                                    @error('advice')
                                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-primary w-full">
                                    Save Advice
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            @empty
                <div class="glass-panel-strong px-6 py-10 text-center">
                    <h3 class="text-xl font-semibold text-slate-900">No users available yet</h3>
                    <p class="mt-2 text-sm text-slate-500">Ask an admin to create user accounts so advisors can start reviewing finances.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
