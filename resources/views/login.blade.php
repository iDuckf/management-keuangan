<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>MyMoney | Login</title>
</head>

<body class="bg-gray-950">
    <div class="min-h-screen flex">
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-bold text-white tracking-tight">MyMoney</h1>
                    <p class="text-gray-400 mt-2 text-sm">Sign in to manage your finances</p>
                </div>

                <div class="bg-gray-900 rounded-2xl p-8 shadow-2xl border border-gray-800">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf



                        <input type="text" class="hidden" aria-hidden="true" tabindex="-1">
                        <input type="password" class="hidden" aria-hidden="true" tabindex="-1">

                        <div class="space-y-5">
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                                <input type="email" id="email" name="email" placeholder="you@example.com"
                                    autocomplete="off" autofocus
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password"
                                    autocomplete="off"
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                                @error('password')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end">
                                <a href="{{ route('forgot-password') }}"
                                    class="text-sm text-emerald-500 hover:text-emerald-400 transition duration-200">Forgot
                                    password?</a>
                            </div>

                            <button type="submit"
                                class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                                Sign In
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-sm text-gray-400 mt-6">
                        Don't have an account?
                        <a href="{{ route('signup') }}"
                            class="text-emerald-500 hover:text-emerald-400 font-medium transition duration-200">Sign
                            up</a>
                    </p>
                </div>
            </div>
        </div>

        <div
            class="hidden lg:flex flex-1 bg-gradient-to-br from-emerald-900 via-emerald-800 to-gray-950 items-center justify-center p-12">
            <div class="max-w-md text-center">
                <div class="text-7xl mb-6">💰</div>
                <h2 class="text-3xl font-bold text-white mb-4">Take Control of Your Finances</h2>
                <p class="text-emerald-200/80 leading-relaxed">Track your expenses, manage your budget, and achieve your
                    financial goals with MyMoney.</p>
            </div>
        </div>
    </div>
</body>

</html>
