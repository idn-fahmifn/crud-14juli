<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-blue-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-black">{{ $totalItems }}</h1>
                        <p class="text-lg">Total Items</p>
                    </div>
                </div>
                <div class="bg-blue-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-black">{{ $totalCategory }}</h1>
                        <p class="text-lg">Total Category</p>
                    </div>
                </div>
                <div class="bg-emerald-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-black">{{ $goodCondition }}</h1>
                        <p class="text-lg">Total Items (Good Condition)</p>
                    </div>
                </div>
                <div class="bg-rose-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-2xl font-black">{{ $needAttention }}</h1>
                        <p class="text-lg">Items Need Attention</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
