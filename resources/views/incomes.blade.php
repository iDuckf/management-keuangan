<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-4 sm:space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold">{{ $title }}</h1>
                <p class="text-gray-400 mt-1 text-sm">Manage your income entries</p>
            </div>
            <button onclick="openModal('addIncomeModal')"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Income
            </button>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-6">
            <div class="bg-gray-900 rounded-2xl p-4 sm:p-6 border border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 sm:p-3 bg-emerald-600/10 rounded-xl">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs sm:text-sm">Total Income</p>
                        <p class="text-lg sm:text-xl font-bold mt-0.5">Rp. {{ number_format($totalIncomes, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-2xl p-4 sm:p-6 border border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 sm:p-3 bg-blue-600/10 rounded-xl">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs sm:text-sm">This Month</p>
                        <p class="text-lg sm:text-xl font-bold mt-0.5">Rp. {{ number_format($totalThisMonth, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-2xl p-4 sm:p-6 border border-gray-800 sm:col-span-2 md:col-span-1">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 sm:p-3 bg-purple-600/10 rounded-xl">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs sm:text-sm">Total Entries</p>
                        <p class="text-lg sm:text-xl font-bold mt-0.5">{{ $totalEntries }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px]">
                    <thead>
                        <tr class="border-b border-gray-800 bg-gray-900/50">
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">No.</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Name</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Amount</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Date</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Category</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Source</th>
                            <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Description</th>
                            <th class="text-right px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($incomes as $income)
                            <tr class="hover:bg-gray-800/50 transition duration-150">
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium">{{ $income->source }}</td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium text-emerald-400">Rp.
                                    {{ number_format($income->amount, 0, ',', '.') }}</td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $income->date->format('j F Y') }}</td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1 bg-emerald-600/10 text-emerald-400 text-xs font-medium rounded-full">
                                        <span class="w-1.5 h-1.5 rounded-full"
                                            style="background: {{ $income->category->color }}"></span>
                                        {{ $income->category->name }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1 bg-yellow-600/10 text-yellow-400 text-xs font-medium rounded-full">
                                        {{ $income->balance->name }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">
                                    {{ Str::limit($income->description, 50, '...') }}</td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-right">
                                    <div class="flex items-center justify-end gap-1 sm:gap-2">
                                        <button
                                            onclick='openEditModal({{ $income->id }}, @json($income))'
                                            class="p-1.5 sm:p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition duration-200 cursor-pointer"
                                            title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button onclick="openDeleteModal({{ $income->id }})"
                                            class="p-1.5 sm:p-2 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition duration-200 cursor-pointer"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 sm:px-6 py-6 sm:py-8 text-center text-gray-500 text-sm">Anda Belum
                                    Membuat Data Incomes</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $incomes->links() }}

    {{-- Add Income Modal --}}
    <div id="addIncomeModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('addIncomeModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-3 sm:p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between px-4 sm:px-6 pt-4 sm:pt-6 pb-3 sm:pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Add Income</h2>
                    <button onclick="closeModal('addIncomeModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-4 sm:p-6 space-y-4" method="POST" action="{{ route('incomes-save') }}">
                    @csrf
                    @method('POST')

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Source</label>
                        <input type="text" name="source" placeholder="e.g. Monthly Salary"
                            value="{{ old('source') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('source')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Amount</label>
                        <input type="number" name="amount" placeholder="0" value="{{ old('amount') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('amount')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
                        <input type="date" name="date" value="{{ old('date') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 hover:cursor-pointer">
                        @error('date')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
                        <select name="category_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 hover:cursor-pointer">
                            @foreach ($categories as $category)
                                @if ($category->type === Str::lower('Income'))
                                    <option value="{{ $category->id }}" class="bg-gray-800"
                                        @selected(old('category_id') == $category->id)>{{ $category->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Source</label>
                        <select name="balance_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 hover:cursor-pointer">
                            @foreach ($balances as $balance)
                                <option value="{{ $balance->id }}" class="bg-gray-800" @selected(old('balance_id') == $balance->id)>
                                    {{ $balance->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="description" rows="2" placeholder="Add notes..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('addIncomeModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Save Income
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Income Modal --}}
    <div id="editIncomeModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('editIncomeModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-3 sm:p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between px-4 sm:px-6 pt-4 sm:pt-6 pb-3 sm:pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Edit Income</h2>
                    <button onclick="closeModal('editIncomeModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editIncomeForm" class="p-4 sm:p-6 space-y-4" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_id" name="id">

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Source</label>
                        <input type="text" name="edit_source" id="edit_source"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('edit_source')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Amount</label>
                        <input type="number" name="edit_amount" id="edit_amount"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('edit_amount')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
                        <input type="date" name="edit_date" id="edit_date"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('edit_date')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
                        <select name="edit_category_id" id="edit_category_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            @foreach ($categories as $category)
                                @if ($category->type === Str::lower('Income'))
                                    <option value="{{ $category->id }}" class="bg-gray-800"
                                        @selected(old('edit_category_id') == $category->id)>{{ $category->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('edit_category_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
                        <select name="edit_balance_id" id="edit_balance_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            @foreach ($balances as $balance)
                                <option value="{{ $balance->id }}" class="bg-gray-800" @selected(old('edit_balance_id') == $balance->id)>
                                    {{ $balance->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('edit_balance_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="edit_description" id="edit_description" rows="2" placeholder="Add notes..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none"></textarea>
                        @error('edit_description')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('editIncomeModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Update Income
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteIncomeModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('deleteIncomeModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-3 sm:p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-md border border-gray-800 shadow-2xl p-5 sm:p-6 text-center">
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <div class="mx-auto w-14 h-14 bg-red-600/10 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold mb-2">Delete Income</h2>
                    <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this income entry? This
                        action
                        cannot be undone.</p>
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" onclick="closeModal('deleteIncomeModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-red-600 hover:bg-red-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = '';

            document.querySelectorAll('[role="dialog"] p.mt-1.text-xs.text-red-400')
                .forEach(el => el.remove());
        }

        function openEditModal(id, data) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_source').value = data.source;
            document.getElementById('edit_amount').value = data.amount;

            if (data.date) {
                document.getElementById('edit_date').value = data.date.substring(0, 10);
            }

            document.getElementById('edit_category_id').value = data.category_id;
            document.getElementById('edit_balance_id').value = data.balance_id;
            document.getElementById('edit_description').value = data.description || '';

            document.getElementById('editIncomeForm').action = `/incomes/${id}`;

            openModal('editIncomeModal');
        }

        function openDeleteModal(id) {
            document.getElementById('delete_id').value = id;
            document.querySelector('#deleteIncomeModal form').action = `/incomes/${id}`;
            openModal('deleteIncomeModal');
        }

        @if ($errors->hasAny(['source', 'amount', 'date', 'category_id']) && !old('id'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal('addIncomeModal');
            });
        @endif
    </script>

    @if (old('id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json(old());
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_source').value = data.edit_source || '';
                document.getElementById('edit_amount').value = data.edit_amount || '';
                if (data.edit_date) {
                    document.getElementById('edit_date').value = data.edit_date.substring(0, 10);
                }
                document.getElementById('edit_category_id').value = data.edit_category_id || '';
                document.getElementById('edit_balance_id').value = data.edit_balance_id || '';
                document.getElementById('edit_description').value = data.edit_description || '';
                document.getElementById('editIncomeForm').action = '/incomes/' + data.id;
                openModal('editIncomeModal');
            });
        </script>
    @endif
</x-layout>
