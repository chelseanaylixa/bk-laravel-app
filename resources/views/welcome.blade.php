<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ruang Konseling Online</title>

    <!-- Panggil Vite untuk aset CSS dan JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Untuk memastikan background memenuhi layar */
        .bg-container {
            background-image: url("{{ asset('images/siswa_smk.jpeg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Gaya tambahan untuk tombol */
        .btn {
            @apply font-bold py-3 px-8 rounded-full transition duration-300 ease-in-out transform hover:scale-105 shadow-lg;
        }
        .btn-blue {
            @apply bg-blue-600 text-white hover:bg-blue-700;
        }
        .btn-outline-white {
            @apply bg-transparent text-white border-2 border-white hover:bg-white hover:text-blue-600;
        }
    </style>
</head>
<body class="antialiased">
    <div class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        {{-- Tombol Dashboard di pojok kanan atas --}}
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @endif
            </div>
        @endif

        <div class="relative w-full min-h-screen bg-container flex flex-col justify-center items-center text-white text-center p-4">
            <div class="absolute inset-0 bg-blue-700 opacity-75"></div>
            <div class="relative z-10 max-w-2xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Ruang Konseling Online</h1>
                <h2 class="text-2xl md:text-3xl font-semibold mb-6">Selamat Datang!</h2>
                <img src="{{ asset('images/logo smk.png') }}" alt="Logo SMK Antartika 1 Sidoarjo" class="mx-auto w-36 h-36 mb-4">
                <p class="text-xl md:text-2xl font-bold mb-8">SMK ANTARTIKA 1 SIDOARJO</p>

                @if (Route::has('login'))
                    <div class="mt-8 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        @auth
                            {{-- Jika pengguna sudah login, tampilkan tombol Logout --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-white">Log out</button>
                            </form>
                        @else
                            {{-- Jika belum login, tampilkan tombol Login dan Register --}}
                            <a href="{{ route('login') }}" class="btn btn-blue">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-white">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>