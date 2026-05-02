<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Financial System') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Manrope']">
        <div class="shell-page min-h-screen px-4 py-6 sm:px-6 lg:px-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-6">
                <header class="glass-panel-strong flex flex-col gap-6 px-6 py-6 sm:px-8 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <div class="badge-soft mb-4 bg-teal-100 text-teal-700">Financial Tracking System</div>
                        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                            See your cash flow clearly and manage it with confidence.
                        </h1>
                        <p class="mt-4 text-base leading-7 text-slate-600 sm:text-lg">
                            Organize income, monitor spending, and give every role a cleaner place to work.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary text-center">Open dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary text-center">Sign in</a>
                        @endauth
                        @guest
                            <a href="{{ route('register') }}" class="btn-secondary text-center">Create account</a>
                        @else
                            <a href="{{ route('profile.edit') }}" class="btn-secondary text-center">Manage profile</a>
                        @endguest
                    </div>
                </header>

                <main class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
                    <section class="glass-panel-strong p-6 sm:p-8">
                        <div class="grid gap-4 md:grid-cols-3">
                            <div class="stat-card">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Track</p>
                                <p class="mt-3 text-2xl font-bold text-slate-900">Income and expenses</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Capture each transaction with categories, dates, and notes that stay easy to review.</p>
                            </div>
                            <div class="stat-card">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Compare</p>
                                <p class="mt-3 text-2xl font-bold text-slate-900">Balance in one view</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Spot whether spending is outpacing earnings before it turns into a bigger problem.</p>
                            </div>
                            <div class="stat-card">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Coordinate</p>
                                <p class="mt-3 text-2xl font-bold text-slate-900">Role-aware workflow</p>
                                <p class="mt-2 text-sm leading-6 text-slate-600">Support users, admins, and advisors with cleaner navigation and focused responsibilities.</p>
                            </div>
                        </div>
                    </section>

                    <section class="glass-panel-strong overflow-hidden">
                        <div class="border-b border-slate-200/70 px-6 py-5 sm:px-8">
                            <p class="text-sm font-semibold uppercase tracking-[0.22em] text-teal-700">What’s inside</p>
                            <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">Built for everyday finance work</h2>
                        </div>
                        <div class="space-y-5 px-6 py-6 sm:px-8">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Quick entries</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-600">Add income and expenses fast, without losing the structure needed for reporting later.</p>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Readable dashboard</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-600">Totals, recent activity, and action shortcuts are now easier to scan on desktop and mobile.</p>
                            </div>
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Calmer interface</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-600">A refreshed visual system gives the app more clarity, depth, and consistency across pages.</p>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
    </body>
</html>
