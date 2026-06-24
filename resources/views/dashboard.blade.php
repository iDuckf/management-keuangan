<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <h1 class="text-2xl font-bold">{{ $title }}</h1>
    <p class="text-gray-400 mt-1">Welcome back! {{ session('email') }}</p>
</x-layout>
