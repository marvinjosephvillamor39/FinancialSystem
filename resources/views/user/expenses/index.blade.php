<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Expenses</h2>
            <a href="{{ route('expenses.create') }}"
               class="bg-red-500 hover:bg-red-600 text-dark font-semibold px-4 py-2 rounded-lg text-sm">
                + Add Expense
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
                <div class="bg-red-100 text-red-700 rounded-full p-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Total Expenses</p>
                    <p class="text-2xl font-bold text-red-600">₱{{ number_format($totalExpense, 2) }}</p>
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
                        @forelse($expenses as $expense)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($expense->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $expense->category->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $expense->description ?? '—' }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-red-600">₱{{ number_format($expense->amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2 items-center">
                                        <a href="{{ route('expenses.edit', $expense) }}"
                                           class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                              onsubmit="return confirm('Delete this expense?')">
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
                                    No expense records yet.
                                    <a href="{{ route('expenses.create') }}" class="text-red-600 underline">Add one!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($expenses->hasPages())
                    <div class="px-6 py-4 border-t">
                        {{ $expenses->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
