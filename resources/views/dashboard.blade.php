<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-4 ">
                        <a href="{{ route("transactions.index") }}" class="inline-block px-5 py-3 bg-red-600 text-white rounded-lg shadow-lg uppercase font-semibold"> Daftar Transaksi </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
