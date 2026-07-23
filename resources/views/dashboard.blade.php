<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="space-y-4 sm:space-y-6">
        <h1 class="text-xl sm:text-2xl font-bold">Dashboard</h1>

        {{-- Filter --}}
        <div class="bg-gray-900 rounded-lg py-3 font-bold">
            <h1 class="text-center text-sm sm:text-base">Dashboard Filter</h1>
            <div class="flex justify-center items-center pt-3 px-4">
                <form method="GET" action="{{ route('dashboard') }}">
                    <label for="filrerYear" class="text-sm">Year : </label>
                    <select id="filrerYear" name="year" onchange="this.form.submit()"
                        class="bg-gray-800 text-sm rounded-lg px-3 py-1 border border-gray-700">
                        @if ($years->isEmpty())
                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        @else
                            @foreach ($years as $y)
                                <option value="{{ $y }}" @selected($selectedYear == (int) $y)>{{ $y }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </form>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4">
            <div class="bg-gray-900 p-4 sm:p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-sm">Total Income This Month</h3>
                <p class="text-2xl sm:text-3xl font-bold text-emerald-400 mt-1">Rp {{ number_format($totalIncomesMonth, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-500 mt-2">{{ $totalIncomesEntries }} entries</p>
            </div>
            <div class="bg-gray-900 p-4 sm:p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-sm">Total Expense This Month</h3>
                <p class="text-2xl sm:text-3xl font-bold text-red-400 mt-1">Rp {{ number_format($totalExpensesMonth, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500 mt-2">{{ $totalExpensesEntries }} entries</p>
            </div>
            <div class="bg-gray-900 p-4 sm:p-6 rounded-xl border border-gray-800">
                <h3 class="text-gray-400 text-sm">Total Balance</h3>
                <p class="text-2xl sm:text-3xl font-bold text-blue-400 mt-1">Rp {{ number_format($totalBalances, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 font-bold">

            <!-- Bar Chart -->
            <div class="bg-gray-900 rounded-lg p-3 sm:p-4 lg:col-span-2">
                <h2 class="text-center pb-3 text-white text-sm sm:text-base">Income VS Expense Monthly</h2>
                <canvas id="financialChart"></canvas>
            </div>

            <!-- Donut Chart -->
            <div class="bg-gray-900 rounded-lg p-3 sm:p-4">
                <h2 class="text-center pb-3 text-white w-full text-sm sm:text-base">Category Expense</h2>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-full max-w-96 mx-auto">
                        <canvas id="myDonutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Balances Summary --}}
        <div class="bg-gray-900 rounded-2xl border border-gray-800 p-4 sm:p-6">
            <h2 class="text-center pb-4 text-white font-bold text-sm sm:text-base">Balances Summary</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                @php
                    $typeConfig = [
                        'cash' => [
                            'label' => 'Cash',
                            'gradient' => 'from-emerald-600/20 to-teal-600/10',
                            'border' => 'border-emerald-600/30',
                            'iconBg' => 'bg-emerald-600/10',
                            'iconText' => 'text-emerald-400',
                            'amountText' => 'text-emerald-400',
                        ],
                        'ewallet' => [
                            'label' => 'E-Wallet',
                            'gradient' => 'from-blue-600/20 to-purple-600/10',
                            'border' => 'border-blue-600/30',
                            'iconBg' => 'bg-blue-600/10',
                            'iconText' => 'text-blue-400',
                            'amountText' => 'text-blue-400',
                        ],
                        'bank' => [
                            'label' => 'Bank',
                            'gradient' => 'from-slate-600/20 to-zinc-600/10',
                            'border' => 'border-slate-500/30',
                            'iconBg' => 'bg-purple-600/10',
                            'iconText' => 'text-purple-400',
                            'amountText' => 'text-purple-400',
                        ],
                    ];
                @endphp

                @foreach ($typeConfig as $tipe => $config)
                    @php
                        $total = $groupedBalances->has($tipe) ? $groupedBalances[$tipe]['total'] : 0;
                    @endphp
                    <div
                        class="bg-gradient-to-br {{ $config['gradient'] }} rounded-xl p-4 sm:p-5 border {{ $config['border'] }}">
                        <div class="flex items-center gap-3">
                            <div class="p-2 sm:p-2.5 rounded-lg {{ $config['iconBg'] }}">
                                @if ($tipe === 'cash')
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 {{ $config['iconText'] }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                @elseif ($tipe === 'ewallet')
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 {{ $config['iconText'] }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 {{ $config['iconText'] }}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs sm:text-sm">{{ $config['label'] }}</p>
                                <p class="text-lg sm:text-xl font-bold {{ $config['amountText'] }}">Rp
                                    {{ number_format($total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Newest Incomes & Expenses --}}
        <div>
            <h1 class="text-center pb-4 text-white font-bold text-sm sm:text-base">Newest Incomes and Expenses</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-start">
                {{-- Incomes table --}}
                <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-x-auto">
                    <table class="w-full min-w-[500px]">
                        <thead>
                            <tr>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">No.</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Name</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Amount</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Date</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Category</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($newestIncomes as $income)
                                <tr class="hover:bg-gray-800/50 transition duration-150">
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium">{{ Str::limit($income->source, 10) }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium text-emerald-400">Rp.
                                        {{ number_format($income->amount, 0, ',', '.') }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $income->date->format('j F Y') }}
                                    </td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 sm:px-6 py-6 sm:py-8 text-center text-gray-500 text-sm">Belum Ada
                                        Data Incomes Terbaru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Expense table --}}
                <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-x-auto">
                    <table class="w-full min-w-[500px]">
                        <thead>
                            <tr>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">No.</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Name</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Amount</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Date</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Category</th>
                                <th class="text-left px-4 sm:px-6 py-3 sm:py-4 text-gray-400 text-xs sm:text-sm font-medium">Source</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($newestExpenses as $expense)
                                <tr class="hover:bg-gray-800/50 transition duration-150">
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $loop->iteration }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium">{{ Str::limit($expense->title, 10) }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm font-medium text-red-400">Rp.
                                        {{ number_format($expense->amount, 0, ',', '.') }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-gray-400">{{ $expense->date->format('j F Y') }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1 bg-red-600/10 text-red-400 text-xs font-medium rounded-full">
                                            <span class="w-1.5 h-1.5 rounded-full"
                                                style="background: {{ $expense->category->color }}"></span>
                                            {{ $expense->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2 sm:px-3 py-1 bg-yellow-600/10 text-yellow-400 text-xs font-medium rounded-full">
                                            {{ $expense->balance->name }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 sm:px-6 py-6 sm:py-8 text-center text-gray-500 text-sm">Belum Ada
                                        Data Expenses Terbaru</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('financialChart').getContext('2d');
            const ctxDonut = document.getElementById('myDonutChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

                    datasets: [{
                            label: 'Income',
                            data: @json($incomeDataChart),
                            backgroundColor: '#34d399',
                            borderColor: '#0f9f90',
                            borderWidth: 1
                        },
                        {
                            label: 'Expense',
                            data: @json($expenseDataChart),
                            backgroundColor: '#e71d36',
                            borderColor: '#b81427',
                            borderWidth: 1
                        }
                    ]
                },

                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#ffffff'
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#ffffff'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#ffffff'
                            },
                        }
                    }
                }
            });

            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: @json($donutLabels),
                    datasets: [{
                        label: 'Expense by Category',
                        data: @json($donutDatas),
                        backgroundColor: @json($donutColors)
                    }]
                },

                options: {
                    responsive: true,
                    radius: '80%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#ffffff'
                            }
                        }
                    }
                }
            })
        </script>
</x-layout>
