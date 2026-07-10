<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
                <p class="text-gray-400 mt-1">Manage all your balance sources</p>
            </div>
            <button onclick="openModal('addBalanceModal')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Balance
            </button>
        </div>

        {{-- Total Balance Summary --}}
        <div
            class="bg-gradient-to-r from-emerald-600/20 via-emerald-500/10 to-transparent rounded-2xl p-6 border border-emerald-600/20">
            <div class="flex items-center gap-4">
                <div class="p-4 bg-emerald-600/10 rounded-2xl">
                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Total Balance</p>
                    <p class="text-3xl font-bold text-emerald-400 mt-0.5">Rp.
                        {{ number_format($totalBalance, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Balance Cards Grouped by Type --}}
        @php
            $groupedBalances = $balances->groupBy('tipe');
            $typeOrder = ['cash', 'ewallet', 'bank'];
            $typeConfig = [
                'cash' => [
                    'icon' => 'bg-emerald-600/10 text-emerald-400',
                    'subtext' => 'text-emerald-400',
                ],
                'ewallet' => [
                    'icon' => 'bg-blue-600/10 text-blue-400',
                    'subtext' => 'text-blue-400',
                ],
                'bank' => [
                    'icon' => 'bg-purple-600/10 text-purple-400',
                    'subtext' => 'text-purple-400',
                ],
            ];
        @endphp

        @forelse ($typeOrder as $tipe)
            @if ($groupedBalances->has($tipe))
                @php
                    $items = $groupedBalances[$tipe];
                    $config = $typeConfig[$tipe] ?? ['icon' => 'bg-gray-600/10 text-gray-400', 'subtext' => 'text-gray-400'];
                @endphp
                <div class="bg-gray-900 rounded-2xl border border-gray-800 p-6">
                    {{-- Group Header --}}
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-800">
                        <div class="p-2 rounded-lg {{ $config['icon'] }}">
                            @if ($tipe === 'cash')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            @elseif ($tipe === 'ewallet')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-semibold">{{ ucfirst($tipe) }}</h3>
                            <p class="text-xs text-gray-500">{{ $items->count() }} {{ $items->count() > 1 ? 'Sources' : 'Source' }}</p>
                        </div>
                        <div class="ml-auto">
                            <p class="text-sm text-gray-400">Total</p>
                            <p class="font-bold {{ $config['subtext'] }}">Rp. {{ number_format($items->sum('amount'), 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- ATM Cards Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($items as $balance)
                            @php
                                $gradientClass = match ($balance->tipe) {
                                    'cash' => 'from-emerald-600 via-emerald-500 to-teal-600',
                                    'ewallet' => 'from-blue-600 via-indigo-500 to-purple-600',
                                    'bank' => 'from-slate-700 via-slate-600 to-zinc-800',
                                    default => 'from-gray-600 via-gray-500 to-gray-700',
                                };
                                $chipColor = match ($balance->tipe) {
                                    'cash' => 'bg-amber-300',
                                    'ewallet' => 'bg-amber-300',
                                    'bank' => 'bg-yellow-400',
                                    default => 'bg-amber-300',
                                };
                                $label = match ($balance->tipe) {
                                    'cash' => 'CASH',
                                    'ewallet' => 'E-WALLET',
                                    'bank' => 'BANK',
                                    default => strtoupper($balance->tipe),
                                };
                            @endphp
                            {{-- ATM Card --}}
                            <div class="group relative">
                                <div
                                    class="relative overflow-hidden rounded-2xl bg-gradient-to-br {{ $gradientClass }} p-6 shadow-lg h-52 flex flex-col justify-between">
                                    {{-- Decorative circles --}}
                                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full"></div>
                                    <div class="absolute -bottom-8 -left-8 w-28 h-28 bg-white/5 rounded-full"></div>

                                    {{-- Top: Chip + Type Label --}}
                                    <div class="relative flex items-start justify-between">
                                        <div class="flex items-center gap-3">
                                            {{-- Chip --}}
                                            <div
                                                class="w-10 h-7 {{ $chipColor }} rounded-md flex items-center justify-center shadow-inner">
                                                <div class="w-6 h-4 border border-amber-600/40 rounded-sm"></div>
                                            </div>
                                        </div>
                                        <span class="text-white/70 text-xs font-bold tracking-widest">{{ $label }}</span>
                                    </div>

                                    {{-- Middle: Balance Amount --}}
                                    <div class="relative">
                                        <p class="text-white text-2xl font-bold tracking-wide">Rp.
                                            {{ number_format($balance->amount, 0, ',', '.') }}</p>
                                    </div>

                                    {{-- Bottom: Name + Actions --}}
                                    <div class="relative flex items-end justify-between">
                                        <div>
                                            <p class="text-white/50 text-[10px] uppercase tracking-wider mb-0.5">Card Holder</p>
                                            <p class="text-white font-semibold text-sm tracking-wide">{{ $balance->name }}</p>
                                        </div>
                                        <div
                                            class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <button onclick='openEditModal({{ $balance->id }}, @json($balance))'
                                                class="p-2 text-white/70 hover:text-white hover:bg-white/20 rounded-lg transition duration-200 cursor-pointer"
                                                title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                            <button onclick="openDeleteModal({{ $balance->id }})"
                                                class="p-2 text-white/70 hover:text-red-300 hover:bg-red-500/20 rounded-lg transition duration-200 cursor-pointer"
                                                title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="bg-gray-900 rounded-2xl border border-gray-800 p-12 text-center">
                <div class="mx-auto w-16 h-16 bg-gray-800 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm0 0V5a2 2 0 012-2h4l2 2h4a2 2 0 012 2v2" />
                    </svg>
                </div>
                <p class="text-gray-400 font-medium">No balance sources yet</p>
                <p class="text-gray-500 text-sm mt-1">Click "Add Balance" to get started</p>
            </div>
        @endforelse
    </div>

    {{-- {{ $balances->links() }} --}}

    {{-- Add Balance Modal --}}
    <div id="addBalanceModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('addBalanceModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Add Balance</h2>
                    <button onclick="closeModal('addBalanceModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form class="p-6 space-y-4" method="POST" action="{{ route('balances-save') }}">
                    @csrf
                    @method('POST')

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name</label>
                        <input type="text" name="name" placeholder="e.g. My Cash, GoPay, BCA"
                            value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                        @error('name')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Type</label>
                        <select name="tipe"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200 hover:cursor-pointer">
                            <option value="cash" class="bg-gray-800" @selected(old('tipe') == 'cash')>Cash</option>
                            <option value="ewallet" class="bg-gray-800" @selected(old('tipe') == 'ewallet')>E-Wallet</option>
                            <option value="bank" class="bg-gray-800" @selected(old('tipe') == 'bank')>Bank</option>
                        </select>
                        @error('tipe')
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
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('addBalanceModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Save Balance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Balance Modal --}}
    <div id="editBalanceModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('editBalanceModal')"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-gray-900 rounded-2xl w-full max-w-lg border border-gray-800 shadow-2xl">
                <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold">Edit Balance</h2>
                    <button onclick="closeModal('editBalanceModal')"
                        class="p-1 text-gray-400 hover:text-white transition cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editBalanceForm" class="p-6 space-y-4" method="POST" action="">
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
                        <select name="edit_tipe" id="edit_tipe"
                            class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                            <option value="cash" class="bg-gray-800">Cash</option>
                            <option value="ewallet" class="bg-gray-800">E-Wallet</option>
                            <option value="bank" class="bg-gray-800">Bank</option>
                        </select>
                        @error('edit_tipe')
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
                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeModal('editBalanceModal')"
                            class="px-4 py-2.5 text-gray-400 hover:text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                            Update Balance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div id="deleteBalanceModal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeModal('deleteBalanceModal')"></div>
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
                    <h2 class="text-lg font-bold mb-2">Delete Balance</h2>
                    <p class="text-gray-400 text-sm mb-6">Are you sure you want to delete this balance source? This
                        action
                        cannot be undone.</p>
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" onclick="closeModal('deleteBalanceModal')"
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
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_tipe').value = data.tipe;
            document.getElementById('edit_amount').value = data.amount;

            document.getElementById('editBalanceForm').action = `/balances/${id}`;

            openModal('editBalanceModal');
        }

        function openDeleteModal(id) {
            document.getElementById('delete_id').value = id;
            document.querySelector('#deleteBalanceModal form').action = `/balances/${id}`;
            openModal('deleteBalanceModal');
        }

        @if ($errors->hasAny(['name', 'tipe', 'amount']) && !old('id'))
            document.addEventListener('DOMContentLoaded', function() {
                openModal('addBalanceModal');
            });
        @endif
    </script>

    @if (old('id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const data = @json(old());
                document.getElementById('edit_id').value = data.id;
                document.getElementById('edit_name').value = data.edit_name || '';
                document.getElementById('edit_tipe').value = data.edit_tipe || 'cash';
                document.getElementById('edit_amount').value = data.edit_amount || '';
                document.getElementById('editBalanceForm').action = '/balances/' + data.id;
                openModal('editBalanceModal');
            });
        </script>
    @endif
</x-layout>
