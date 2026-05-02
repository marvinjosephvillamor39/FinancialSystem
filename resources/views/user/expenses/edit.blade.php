<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('expenses.index') }}" class="text-gray-400 hover:text-gray-600">← Back</a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Expense</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-6">

                <form action="{{ route('expenses.update', $expense) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="category_id"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('category_id') border-red-500 @enderror">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $expense->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₱)</label>
                        <input type="number" name="amount" step="0.01" min="0.01"
                               value="{{ old('amount', $expense->amount) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('amount') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date" name="date"
                               value="{{ old('date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 @error('date') border-red-500 @enderror">
                        @error('date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-gray-400">(optional)</span>
                        </label>
                        <input type="text" name="description"
                               value="{{ old('description', $expense->description) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                               placeholder="e.g. Grocery shopping">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-gray font-semibold px-6 py-2 rounded-lg">
                            Update Expense
                        </button>
                        <a href="{{ route('expenses.index') }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2 rounded-lg">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
