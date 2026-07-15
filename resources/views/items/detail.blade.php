<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-black text-2xl text-slate-800 dark:text-white">
                    Detail Item
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    Information detail about {{ $data->item_name }}
                </p>

            </div>

            <a href="/items"
                class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl text-sm font-bold">

                Kembali

            </a>

        </div>

    </x-slot>

    <div class="py-10 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-slate-900 rounded-lg overflow-hidden border border-slate-100 dark:border-slate-800">

                <div class="p-10">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                        <div>

                            <img src="{{asset('storage/items/' . $data->image)}}"
                                class="rounded-3xl w-full object-cover" alt="Barang">

                        </div>

                        <div>

                            <h2 class="text-3xl font-black text-slate-800 dark:text-white">
                                {{ $data->item_name }}
                            </h2>

                            <p class="text-slate-400 mt-2">
                                {{ $data->desc }}
                            </p>

                            <div class="mt-8 space-y-5">

                                <div>

                                    <p class="text-sm text-slate-400">
                                        Price
                                    </p>

                                    <h3 class="font-black text-slate-700 dark:text-white">
                                        IDR. {{ number_format($data->price) }}
                                    </h3>

                                </div>

                                <div>

                                    <p class="text-sm text-slate-400">
                                        Category
                                    </p>

                                    <h3 class="font-black text-slate-700 dark:text-white">
                                        {{ $data->category->category_name }}
                                    </h3>

                                </div>

                                <div>

                                    <p class="text-sm text-slate-400">
                                        Tanggal Pembelian
                                    </p>

                                    <h3 class="font-black text-slate-700 dark:text-white">
                                        {{ $data->created_at }}
                                    </h3>

                                </div>

                                <div>

                                    <p class="text-sm text-slate-400">
                                        Status
                                    </p>

                                    <h3
                                        class="font-black {{ $data->condition === 'good' ? 'text-emerald-600' : ($data->condition === 'maintenance' ? 'text-yellow-600' : 'text-rose-600' ) }} ">
                                        {{ $data->condition === 'good' ? 'Good Condition' : ($data->condition === 'maintenance' ? 'Under Maintenance' : 'Broke Item' ) }}
                                    </h3>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
