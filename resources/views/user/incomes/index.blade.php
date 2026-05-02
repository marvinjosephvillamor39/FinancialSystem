<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Incomes</h2>
            <a href="{{ route('incomes.create') }}"
               class="bg-green-500 hover:bg-green-600 text-dark font-semibold px-4 py-2 rounded-lg text-sm">
                + Add Income
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Summary Card --}}
            <div class="mb-6 bg-white rounded-xl shadow p-6 flex items-center gap-4">
                <div class="bg-green-100 text-green-700 rounded-full p-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Income</p>
                    <p class="text-2xl font-bold text-green-600">₱{{ number_format($totalIncome, 2) }}</p>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($incomes as $income)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($income->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $income->category->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $income->description ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-green-600">₱{{ number_format($income->amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2 items-center">
                                        <a href="{{ route('incomes.edit', $income) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('incomes.destroy', $income) }}" method="POST"
                                              onsubmit="return confirm('Delete this income?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                    No income records yet.
                                    <a href="{{ route('incomes.create') }}" class="text-green-600 underline">Add one!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($incomes->hasPages())
                    <div class="px-6 py-4 border-t">
                        {{ $incomes->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
