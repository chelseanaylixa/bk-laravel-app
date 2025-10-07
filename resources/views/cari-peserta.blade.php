<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4">Cari Peserta</h1>
                <p class="text-gray-600 mb-6">Masukkan nama atau kelas peserta yang ingin dicari.</p>

                <form action="{{ route('cari.peserta') }}" method="GET" class="flex space-x-2">
                    <input type="text" name="keyword" placeholder="Cari nama/kls..." class="px-4 py-2 border rounded w-full">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded">Cari</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
