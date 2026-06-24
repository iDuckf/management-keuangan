<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
                <p class="text-gray-400 mt-1">Organize your income and expense categories</p>
            </div>
            <button onclick="openModal('addCategoryModal')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Category
            </button>
        </div>

        {{-- Categories Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Income Categories --}}
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6">
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-800">
                    <div class="p-2 bg-emerald-600/10 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Income Categories</h3>
                        <p class="text-xs text-gray-500">3 categories</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                            <div>
                                <p class="text-sm font-medium">Salary</p>
                                <p class="text-xs text-gray-500">Monthly income</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(1)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(1)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-blue-400"></span>
                            <div>
                                <p class="text-sm font-medium">Freelance</p>
                                <p class="text-xs text-gray-500">Freelance projects</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(2)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(2)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                            <div>
                                <p class="text-sm font-medium">Investment</p>
                                <p class="text-xs text-gray-500">Dividends & stocks</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(3)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(3)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Expense Categories --}}
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6">
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-800">
                    <div class="p-2 bg-red-600/10 rounded-lg">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H4m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0a2 2 0 00-2-2H6a2 2 0 00-2 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold">Expense Categories</h3>
                        <p class="text-xs text-gray-500">3 categories</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-red-400"></span>
                            <div>
                                <p class="text-sm font-medium">Food & Drinks</p>
                                <p class="text-xs text-gray-500">Meals & groceries</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(4)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(4)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-purple-400"></span>
                            <div>
                                <p class="text-sm font-medium">Transportation</p>
                                <p class="text-xs text-gray-500">Fuel & public transport</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(5)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(5)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                        <div class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-pink-400"></span>
                            <div>
                                <p class="text-sm font-medium">Entertainment</p>
                                <p class="text-xs text-gray-500">Movies & subscriptions</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                            <button onclick="openEditModal(6)"
                                class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <button onclick="openDeleteModal(6)"
                                class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add New Category Card --}}
            <div class="bg-gray-900/50 rounded-2xl border-2 border-dashed border-gray-700 hover:border-emerald-600/50 transition duration-200 flex items-center justify-center min-h-[200px] cursor-pointer"
                onclick="openModal('addCategoryModal')">
                <div class="text-center">
                    <div class="mx-auto w-12 h-12 bg-gray-800 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <p class="text-gray-400 font-medium">New Category</p>
                    <p class="text-xs text-gray-600 mt-1">Click to create</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Category Modal --}}
    <div id="addCategoryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('addCategoryModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Add Category</h2>
                    <button onclick="closeModal('addCategoryModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="name" placeholder="e.g. Groceries"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                        <input type="text" name="slug" placeholder="e.g. groceries"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Type</label>
                        <select name="type"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            <option value="income" class="bg-gray-800">Income</option>
                            <option value="expense" selected class="bg-gray-800">Expense</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="color" value="#10b981"
                                class="w-10 h-10 rounded-lg border border-gray-700 bg-gray-800 cursor-pointer">
                            <input type="text" name="color_hex" value="#10b981"
                                class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="description" rows="2" placeholder="Brief description..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none"></textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('addCategoryModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div id="editCategoryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('editCategoryModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Edit Category</h2>
                    <button onclick="closeModal('editCategoryModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="name" value="Food & Drinks"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                        <input type="text" name="slug" value="food-drinks"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Type</label>
                        <select name="type"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            <option value="income" class="bg-gray-800">Income</option>
                            <option value="expense" selected class="bg-gray-800">Expense</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="color" value="#ef4444"
                                class="w-10 h-10 rounded-lg border border-gray-700 bg-gray-800 cursor-pointer">
                            <input type="text" name="color_hex" value="#ef4444"
                                class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 font-mono">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description <span
                                class="text-gray-500">(optional)</span></label>
                        <textarea name="description" rows="2" placeholder="Brief description..."
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 resize-none">Meals &amp; groceries</textarea>
                    </div>
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('editCategoryModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Update Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteCategoryModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('deleteCategoryModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-md border border-gray-800 shadow-2xl p-6 text-center">
                <div class="mx-auto w-14 h-14 bg-red-600/10 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-7 h-7 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <h2 class="text-lg font-bold mb-2">Delete Category</h2>
                <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this category? Related
                    transactions may be affected.</p>
                <div class="flex items-center justify-center gap-3">
                    <button onclick="closeModal('deleteCategoryModal')"
                        class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                        Cancel
                    </button>
                    <button onclick="closeModal('deleteCategoryModal')"
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
            openModal('editCategoryModal');
        }

        function openDeleteModal(id) {
            openModal('deleteCategoryModal');
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
