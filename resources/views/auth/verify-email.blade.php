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
        <h2 class="text-xl font-semibold mb-4">Verifikasi Email Anda</h2>
        <p class="text-gray-300 text-sm mb-4">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi email Anda dengan mengklik link yang baru
            saja kami kirimkan ke email Anda.
        </p>

        @if (session('message'))
            <div class="mb-4 text-sm font-medium text-green-400">
                Link verifikasi baru telah dikirim ke alamat email Anda.
            </div>
        @endif

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 rounded-lg text-sm font-medium transition">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>
        </div>
    </div>
</body>

</html>
