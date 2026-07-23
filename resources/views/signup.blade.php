<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>MyMoney | Sign Up</title>
</head>

<body class="bg-gray-950">
    <div class="min-h-screen flex">
        <div
            class="hidden lg:flex flex-1 bg-gradient-to-br from-blue-900 via-blue-800 to-gray-950 items-center justify-center p-12">
            <div class="max-w-md text-center">
                <div class="text-7xl mb-6">🚀</div>
                <h2 class="text-3xl font-bold text-white mb-4">Start Your Journey</h2>
                <p class="text-blue-200/80 leading-relaxed">Join thousands of users who already trust MyMoney to manage
                    their personal finances.</p>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 py-8 sm:py-12">
            <div class="w-full max-w-md">
                <div class="text-center mb-8 sm:mb-10">
                    <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Create Account</h1>
                    <p class="text-gray-400 mt-2 text-sm">Get started with your free account</p>
                </div>

                <div class="bg-gray-900 rounded-2xl p-6 sm:p-8 shadow-2xl border border-gray-800">
                    <form action="{{ route('signup.submit') }}" method="POST">
                        @csrf

                        @method('post')

                        <input type="text" class="hidden" aria-hidden="true" tabindex="-1">
                        <input type="password" class="hidden" aria-hidden="true" tabindex="-1">

                        <div class="space-y-5">
                            <div>
                                <label for="username"
                                    class="block text-sm font-medium text-gray-300 mb-1.5">Username</label>
                                <input type="text" id="username" name="username" placeholder="Someone"
                                    autocomplete="off" autofocus
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:border-transparent transition duration-200">
                                @error('username')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                                <input type="email" id="email" name="email" placeholder="you@example.com"
                                    autocomplete="off"
                                    class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:border-transparent transition duration-200">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-300 mb-1.5">Password</label>
                                    <input type="password" id="password" name="password" placeholder="Min. 8 chars"
                                        autocomplete="off"
                                        class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:border-transparent transition duration-200">
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-300 mb-1.5">Confirm</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Repeat password" autocomplete="off"
                                        class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-800 focus:border-transparent transition duration-200">
                                    @error('password_confirmation')
                                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full py-2.5 bg-blue-800 hover:bg-blue-700 text-white font-medium rounded-xl transition duration-200 cursor-pointer">
                                Create Account
                            </button>
                        </div>
                    </form>

                    <p class="text-center text-sm text-gray-400 mt-6">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="text-blue-800 hover:text-blue-700 transition duration-200 font-bold">Sign
                            in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
