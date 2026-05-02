<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Financial System') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-['Manrope']">
        <div class="shell-page flex min-h-screen items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid w-full max-w-6xl gap-8 lg:grid-cols-[1.05fr_0.95fr]">
                <section class="glass-panel-strong relative overflow-hidden p-8 sm:p-10 lg:p-14">
                    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-teal-500 via-amber-400 to-emerald-500"></div>
                    <div class="badge-soft mb-6 bg-teal-100 text-teal-700">Personal Finance Studio</div>
                    <h1 class="max-w-xl text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">
                        Take control of your money with a dashboard that actually feels alive.
                    </h1>
                    <p class="mt-6 max-w-xl text-base leading-7 text-slate-600 sm:text-lg">
                        Track income, monitor expenses, and keep every financial decision in one calm, structured workspace.
                    </p>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl border border-white/70 bg-white/75 p-5 shadow-lg shadow-slate-900/5">
                            <p class="text-sm font-semibold text-slate-500">Faster review</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900">Daily snapshots</p>
                        </div>
                        <div class="rounded-3xl border border-white/70 bg-white/75 p-5 shadow-lg shadow-slate-900/5">
                            <p class="text-sm font-semibold text-slate-500">Cleaner records</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900">Role-based flows</p>
                        </div>
                        <div class="rounded-3xl border border-white/70 bg-white/75 p-5 shadow-lg shadow-slate-900/5">
                            <p class="text-sm font-semibold text-slate-500">Better habits</p>
                            <p class="mt-2 text-2xl font-bold text-slate-900">Real visibility</p>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-wrap gap-3">
                        <a href="{{ route('register') }}" class="btn-primary">Create account</a>
                        <a href="{{ route('login') }}" class="btn-secondary">Sign in</a>
                    </div>
                </section>

                <section class="glass-panel-strong p-6 sm:p-8">
                    <div class="mb-6 flex items-center gap-3">
                        <a href="/" class="flex items-center gap-3">
                            <x-application-logo class="h-12 w-12" />
                            <div>
                                <p class="text-lg font-bold text-slate-900">LedgerFlow</p>
                                <p class="text-sm text-slate-500">Secure finance workspace</p>
                            </div>
                        </a>
                    </div>

                    <div class="rounded-[28px] bg-white/75 p-6 shadow-inner shadow-slate-900/5 sm:p-8">
                        {{ $slot }}
                    </div>
                </section>
            </div>
        </div>
    </body>
</html>
