<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
                <p class="text-gray-400 mt-1">Track your spending</p>
            </div>
            <button onclick="openModal('addExpenseModal')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Expense
            </button>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-900 rounded-2xl p-6 border border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-red-600/10 rounded-xl">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H4m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0a2 2 0 00-2-2H6a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Total Expenses</p>
                        <p class="text-xl font-bold mt-0.5">Rp 299.000</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-2xl p-6 border border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-orange-600/10 rounded-xl">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">This Month</p>
                        <p class="text-xl font-bold mt-0.5">Rp 299.000</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-900 rounded-2xl p-6 border border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-purple-600/10 rounded-xl">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-sm">Total Entries</p>
                        <p class="text-xl font-bold mt-0.5">3</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-800 bg-gray-900/50">
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">#</th>
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">Title</th>
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">Amount</th>
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">Date</th>
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">Category</th>
                            <th class="text-left px-6 py-4 text-gray-400 text-sm font-medium">Description</th>
                            <th class="text-right px-6 py-4 text-gray-400 text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <tr class="hover:bg-gray-800/50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-400">1</td>
                            <td class="px-6 py-4 text-sm font-medium">Lunch at Mario's</td>
                            <td class="px-6 py-4 text-sm font-medium text-red-400">Rp 50.000</td>
                            <td class="px-6 py-4 text-sm text-gray-400">2024-06-02</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-600/10 text-red-400 text-xs font-medium rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                    Food & Drinks
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">-</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openEditModal(1)"
                                        class="p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition duration-200 cursor-pointer"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal(1)"
                                        class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition duration-200 cursor-pointer"
                                        title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-800/50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-400">2</td>
                            <td class="px-6 py-4 text-sm font-medium">Gas Station</td>
                            <td class="px-6 py-4 text-sm font-medium text-red-400">Rp 100.000</td>
                            <td class="px-6 py-4 text-sm text-gray-400">2024-06-03</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-600/10 text-purple-400 text-xs font-medium rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>
                                    Transportation
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">Full tank</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openEditModal(2)"
                                        class="p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition duration-200 cursor-pointer"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal(2)"
                                        class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition duration-200 cursor-pointer"
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
                        <tr class="hover:bg-gray-800/50 transition duration-150">
                            <td class="px-6 py-4 text-sm text-gray-400">3</td>
                            <td class="px-6 py-4 text-sm font-medium">Netflix Subscription</td>
                            <td class="px-6 py-4 text-sm font-medium text-red-400">Rp 149.000</td>
                            <td class="px-6 py-4 text-sm text-gray-400">2024-06-05</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 bg-pink-600/10 text-pink-400 text-xs font-medium rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-pink-400"></span>
                                    Entertainment
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">Monthly subscription</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="openEditModal(3)"
                                        class="p-2 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition duration-200 cursor-pointer"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal(3)"
                                        class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition duration-200 cursor-pointer"
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Expense Modal --}}
    <div id="addExpenseModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('addExpenseModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Add Expense</h2>
                    <button onclick="closeModal('addExpenseModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Title</label>
                        <input type="text" name="title" placeholder="e.g. Groceries"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Amount</label>
                        <input type="number" name="amount" placeholder="0"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
                        <input type="date" name="date"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
                        <select name="category_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            <option value="" class="bg-gray-800">Select category</option>
                            <option value="4" class="bg-gray-800">Food & Drinks</option>
                            <option value="5" class="bg-gray-800">Transportation</option>
                            <option value="6" class="bg-gray-800">Entertainment</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="description" rows="2" placeholder="Add notes..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none"></textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('addExpenseModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Save Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Expense Modal --}}
    <div id="editExpenseModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('editExpenseModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Edit Expense</h2>
                    <button onclick="closeModal('editExpenseModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Title</label>
                        <input type="text" name="title" value="Lunch at Mario's"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Amount</label>
                        <input type="number" name="amount" value="50000"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Date</label>
                        <input type="date" name="date" value="2024-06-02"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category</label>
                        <select name="category_id"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            <option value="4" selected class="bg-gray-800">Food & Drinks</option>
                            <option value="5" class="bg-gray-800">Transportation</option>
                            <option value="6" class="bg-gray-800">Entertainment</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="description" rows="2" placeholder="Add notes..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none"></textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('editExpenseModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Update Expense
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteExpenseModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('deleteExpenseModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-md border border-gray-800 shadow-2xl p-6 text-center">
                <div class="mx-auto w-14 h-14 bg-red-600/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold mb-2">Delete Expense</h2>
                <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this expense entry? This action
                    cannot be undone.</p>
                <div class="flex items-center justify-center gap-3">
                    <button onclick="closeModal('deleteExpenseModal')"
                        class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                        Cancel
                    </button>
                    <button onclick="closeModal('deleteExpenseModal')"
                        class="px-6 py-2.5 bg-red-600 hover:bg-red-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                        Delete
                    </button>
                </div>
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
        }

        function openEditModal(id) {
            openModal('editExpenseModal');
        }

        function openDeleteModal(id) {
            openModal('deleteExpenseModal');
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[role="dialog"]').forEach(el => {
                    if (!el.classList.contains('hidden')) {
                        closeModal(el.id);
                    }
                });
            }
        });
    </script>
</x-layout>
