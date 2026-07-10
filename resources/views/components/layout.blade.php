<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('static/img/favicon.ico') }}">
    @vite('resources/css/app.css')
    <title>MyMoney | {{ $title }}</title>
</head>

<body class="bg-gray-950 text-white font-sans antialiased">

    <div class="h-screen flex overflow-hidden">

        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 w-64 bg-gray-900 border-r border-gray-800 flex flex-col z-40">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 h-16 border-b border-gray-800">
                <span class="text-2xl">💰</span>
                <span class="text-xl font-bold tracking-tight">MyMoney</span>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-emerald-600/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('incomes-show') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('incomes-show') ? 'bg-emerald-600/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Incomes
                </a>

                <a href="{{ route('expenses-show') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('expenses-show') ? 'bg-emerald-600/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 12H4m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0a2 2 0 00-2-2H6a2 2 0 00-2 2" />
                    </svg>
                    Expenses
                </a>

                <a href="{{ route('categories-show') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('categories-show') ? 'bg-emerald-600/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Category
                </a>

                <a href="{{ route('balances-show') }}"
                    class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('balances-show') ? 'bg-emerald-600/20 text-emerald-400' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7zm0 0V5a2 2 0 012-2h4l2 2h4a2 2 0 012 2v2" />
                    </svg>
                    Balances
                </a>
            </nav>

            {{-- Logout --}}
            <div class="p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-red-400 hover:bg-gray-800 transition duration-200 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-64 p-8 overflow-y-auto">
            @if (session('success'))
                <div id="flash-success"
                    class="mb-6 px-4 py-3 bg-emerald-600/10 border border-emerald-600/30 text-emerald-400 rounded-xl">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        const el = document.getElementById('flash-success');
                        if (el) {
                            el.style.transition = 'opacity 0.5s ease';
                            el.style.opacity = '0';
                            setTimeout(() => el.remove(), 500);
                        }
                    }, 3500);
                </script>
            @endif
            {{ $slot }}
        </main>
    </div>

</body>

</html>
