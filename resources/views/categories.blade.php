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
            @forelse ($groupedCategories as $type => $categories)
                {{-- Setiap ada 'type' baru di database, box div ini akan otomatis terbuat satu lagi --}}
                <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6">

                    {{-- Header Box (Dinamis Berdasarkan Nama Tipe) --}}
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-800">
                        {{-- Mengatur warna icon secara dinamis berdasarkan tipe --}}
                        <div
                            class="p-2 rounded-lg {{ $type === 'income' ? 'bg-emerald-600/10' : ($type === 'expense' ? 'bg-red-600/10' : 'bg-blue-600/10') }}">
                            <svg class="w-5 h-5 {{ $type === 'income' ? 'text-emerald-400' : ($type === 'expense' ? 'text-red-400' : 'text-blue-400') }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            {{-- ucfirst() untuk membuat huruf pertama Kapital (ex: income -> Income) --}}
                            <h3 class="font-semibold">Type : {{ ucfirst($type) }}</h3>
                            <p class="text-xs text-gray-500">{{ $categories->count() }} Categories</p>
                        </div>
                    </div>

                    {{-- Isi Kategori didalam Tipe Tersebut --}}
                    <div class="space-y-3">
                        @foreach ($categories as $category)
                            <div
                                class="flex items-center justify-between p-3 bg-gray-800/50 rounded-xl hover:bg-gray-800 transition duration-150 group">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 rounded-full"
                                        style="background-color: {{ $category->color ?? '#6b7280' }}"></span>
                                    <div>
                                        <p class="text-sm font-medium">{{ $category->name }}</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition duration-150">
                                    <button onclick='openEditModal({{ $category->id }}, @json($category))'
                                        class="p-1.5 text-gray-400 hover:text-blue-400 hover:bg-blue-600/10 rounded-lg transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button onclick="openDeleteModal({{ $category->id }})"
                                        class="p-1.5 text-gray-400 hover:text-red-400 hover:bg-red-600/10 rounded-lg transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-900 rounded-2xl border border-gray-800">
                    <p class="text-gray-500">Belum ada kategori yang dibuat.</p>
                </div>
            @endforelse

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
                <form class="p-6 space-y-4" action="{{ route('category-save') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="name" placeholder="e.g. Groceries" value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('name')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Type</label>
                        <input type="text" name="type" placeholder="Ex : Income" value="{{ old('type') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('type')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="color" value="#10b981"
                                oninput="this.nextElementSibling.value = this.value"
                                class="w-10 h-10 rounded-lg border border-gray-700 bg-gray-800 cursor-pointer">
                            <input type="text" name="color_hex" value="#10b981"
                                class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 font-mono">
                            @error('color_hex')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
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
                <form id="editCategoryForm" class="p-6 space-y-4" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_id" name="id">

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="edit_name" id="edit_name"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('edit_name')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Type</label>
                        <input type="text" name="edit_type" id="edit_type" placeholder="e.g. groceries"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('edit_type')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" name="edit_color" id="edit_color" value="#10b981"
                                oninput="document.getElementById('edit_color_hex').value = this.value"
                                class="w-10 h-10 rounded-lg border border-gray-700 bg-gray-800 cursor-pointer">
                            <input type="text" name="edit_color_hex" id="edit_color_hex" value="#10b981"
                                class="flex-1 px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 font-mono">
                            @error('edit_color_hex')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
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
                    <h2 class="text-lg font-bold mb-2">Delete Category</h2>
                    <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this category? Related
                        transactions may be affected.</p>
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" onclick="closeModal('deleteCategoryModal')"
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

            // Hapus error messages dari SEMUA modal
            document.querySelectorAll('[role="dialog"] p.mt-1.text-xs.text-red-400')
                .forEach(el => el.remove());
        }

        function openEditModal(id, data) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_type').value = data.type;
            document.getElementById('edit_color').value = data.color || '#10b981';
            document.getElementById('edit_color_hex').value = data.color || '#10b981';

            document.getElementById('editCategoryForm').action = `/categories/${id}`;

            openModal('editCategoryModal');
        }

        function openDeleteModal(id) {
            document.getElementById('delete_id').value = id;
            document.querySelector('#deleteCategoryModal form').action = `/categories/${id}`;
            openModal('deleteCategoryModal');
        }

        @if ($errors->hasAny(['name', 'type', 'color', 'color_hex']) && !old('id'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal('addCategoryModal');
            });
        @endif
    </script>

    @if (old('id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json(old());
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_name').value = data.edit_name || '';
                document.getElementById('edit_type').value = data.edit_type || '';
                document.getElementById('edit_color').value = data.edit_color || '';
                document.getElementById('edit_color_hex').value = data.edit_color_hex || '';

                document.getElementById('editCategoryForm').action = '/categories/' + data.id;
                openModal('editCategoryModal');
            });
        </script>
    @endif
</x-layout>
