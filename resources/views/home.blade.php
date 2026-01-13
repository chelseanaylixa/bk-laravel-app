<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Selamat datang kembali!</h3>

                    <p class="mb-4">
                        Aplikasi ini adalah tempat buat kamu para siswa dan siswi SMK Antartika 1 Sidoarjo untuk bisa terhubung dengan layanan bimbingan konseling. Di sini, kamu bisa curhat, mencari solusi untuk masalah, atau sekadar mendapatkan motivasi untuk jadi versi terbaik dari dirimu.
                    </p>
                    <p class="mb-6">
                        Tim guru BK kami siap sedia untuk mendengarkan dan membimbingmu. Santai saja, semua yang kamu ceritakan di sini pasti aman dan rahasia.
                    </p>
                    
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                        Mulai Jelajahi <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>