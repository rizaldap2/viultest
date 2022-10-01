<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('transactions.update',[$transaction->id]) }}">
            @csrf
            @method('PUT')
            <!-- name -->
            <div>
                <x-input-label for="name" :value="__('name')" />

                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$transaction->name  ??old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />

            </div>

            <!-- date-->
            <div class="mt-4">
                <x-input-label for="date" :value="__('date')" />

                <x-text-input id="date" class="block mt-1 w-full"
                                type="date"
                                name="date"
                                :value="$transaction->date->format('Y-m-d')"/>
                <x-input-error :messages="$errors->get('date')" class="mt-2" />
            </div>
            <!-- quantity-->
            <div class="mt-4">
                <x-input-label for="quantity" :value="__('quantity')" />

                <x-text-input id="quantity" class="block mt-1 w-full"
                                type="number"
                                name="quantity"
                                :value="$transaction->quantity"/>
                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>

            <!-- price -->
            <div class="mt-4">
                <x-input-label for="price" :value="__('price')" />

                <x-text-input id="price" class="block mt-1 w-full"
                                type="number"
                                step="0.01"
                                name="price"
                                :value="$transaction->price"/>
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Update') }}
                </x-primary-button>
                <a href="{{ route("transactions.index") }}"class="ml-3 inline-flex items-center px-4 py-2 bg-orange-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150"> Cancel </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
