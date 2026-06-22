<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="max-w-md mx-auto mt-10 p-6 bg-gray-800 text-white rounded-xl shadow-md">
        <div class="flex justify-between align-items-center">
            <h2 class="text-xl font-semibold my-2">Forgot Password</h2>

            <a href="{{ route('login') }}"
                class="bg-yellow-500 px-4 py-2 rounded-md font-bold text-black hover:bg-yellow-400">&laquo;
                Back</a>
        </div>
        <p class="text-gray-300 text-sm mb-4">
            Silakan masukkan email yang kamu daftarkan.
        </p>

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-4">
            <form method="POST" action="{{ route('forgot-password.submit') }}">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="off"
                        autofocus
                        class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition duration-200">
                    @error('email')
                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center items-center">
                    <button type="submit"
                        class="my-3 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-sm font-medium transition">
                        Kirim Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
