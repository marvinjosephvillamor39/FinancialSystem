<nav x-data="{ open: false }" class="app-shell pt-4 sm:pt-6">
    <div class="glass-panel-strong px-4 py-4 sm:px-6">
        <div class="flex min-h-16 items-center justify-between gap-4">
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    <a href="{{ auth()->check() && auth()->user()->role === 'advisor' ? route('advisor.analysis.index') : route('dashboard') }}" class="flex items-center gap-3">
                        <x-application-logo class="h-11 w-11" />
                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold uppercase tracking-[0.28em] text-teal-700">LedgerFlow</p>
                            <p class="text-sm text-slate-500">Friendly financial workspace</p>
                        </div>
                    </a>
                </div>

                <div class="hidden items-center gap-2 sm:flex">
                    @auth
                        @if(auth()->user()->role === 'advisor')
                            <x-nav-link :href="route('advisor.analysis.index')" :active="request()->routeIs('advisor.analysis.*')">
                                {{ __('Analysis') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'user')
                            <x-nav-link :href="route('incomes.index')" :active="request()->routeIs('incomes.*')">
                                {{ __('Incomes') }}
                            </x-nav-link>
                            <x-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')">
                                {{ __('Expenses') }}
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                                {{ __('Categories') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                {{ __('Users') }}
                            </x-nav-link>
                            <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                                {{ __('Reports') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
                <a href="{{ route('profile.edit') }}" class="btn-secondary">
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-danger">
                        Log Out
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white/70 p-2 text-slate-500 transition hover:border-teal-200 hover:text-slate-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
            <div class="space-y-1 border-t border-slate-200/70 pt-4">
                @auth
                    @if(auth()->user()->role === 'advisor')
                        <x-responsive-nav-link :href="route('advisor.analysis.index')" :active="request()->routeIs('advisor.analysis.*')">
                            {{ __('Analysis') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->role === 'user')
                        <x-responsive-nav-link :href="route('incomes.index')" :active="request()->routeIs('incomes.*')">
                            {{ __('Incomes') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('expenses.index')" :active="request()->routeIs('expenses.*')">
                            {{ __('Expenses') }}
                        </x-responsive-nav-link>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                            {{ __('Categories') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Users') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.*')">
                            {{ __('Reports') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
            </div>

            <div class="mt-4 border-t border-slate-200/70 pt-4">
                <div class="px-1">
                    <div class="font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-slate-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 grid gap-2">
                    <a href="{{ route('profile.edit') }}" class="btn-secondary text-center">
                        Profile
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
</nav>
