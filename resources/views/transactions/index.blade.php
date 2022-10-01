<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-12 bg-white border-b border-gray-200">
                    
                    @if (auth()->user()->hasRole('superadmin'))
                        <div class="mt-4 ">
                            <a href="{{ route("transactions.create") }}" class="inline-block px-5 py-3 bg-red-600 text-white rounded-lg shadow-lg uppercase font-semibold"> Create Transaksi </a>
                        </div>
                        <br>
                    
                    <form >
                        <div class="relative w-full">
                            <input name="name" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white-50 rounded-r-lg border-l-white-50 border-l-2 border border-white-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-l-white-700  dark:border-white-600 dark:placeholder-gray-400 dark:text-black dark:focus:border-blue-500" placeholder="Nama" >
                            
                        </div>
                        <br>
                        <div class="relative w-full">
                            <input name="date" type="date" id="date-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white-50 rounded-r-lg border-l-white-50 border-l-2 border border-white-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-l-white-700  dark:border-white-600 dark:placeholder-gray-400 dark:text-black dark:focus:border-blue-500" placeholder="date" >
                            
                        </div>
                        <br>
                        <div class="relative w-full">
                            <x-primary-button class="ml-3">
                                {{ __('Search') }}
                            </x-primary-button>
                        </div>
                       
                    </form>
                    @endif
                    <br>
                    
                    
            
                    <table class="table-fixed w-full whitespace-no-wrapw-full whitespace-no-wrap" >
                        <thead>
                            <tr class="text-center font-bold">
                                <th class="border px-6 py-4">No.</th>
                                <th class="border px-6 py-4">Nama</th>
                                <th class="border px-6 py-4">Tanggal</th>
                                <th class="border px-6 py-4">Jumlah</th>
                                <th class="border px-6 py-4">Harga</th>
                                @if (auth()->user()->hasRole('superadmin'))
                                    <th class="border px-6 py-4">Actions</th>   
                                @endif
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction )
                                <tr class="text-center" >
                                    <td class="border px-6 py-4">{{$transaction->id}}</td>
                                    <td class="border px-6 py-4">{{$transaction->name}}</td>
                                    <td class="border px-6 py-4">{{$transaction->date->format('m/d/Y')}}</td>
                                    <td class="border px-6 py-4">{{$transaction->quantity}}</td>
                                    <td class="border px-6 py-4">{{$transaction->price}}</td>
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <td class="border px-6 py-4">
                                            <a href="{{ route("transactions.edit",[$transaction->id]) }}" class="ml-3 inline-flex items-center px-4 py-2 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                                            <form method="POST" action="{{ route("transactions.delete",[$transaction->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button  type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-red-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                        

                    </table>
                    <br>
                    {{ $transactions->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>