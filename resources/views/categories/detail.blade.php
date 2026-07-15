<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-black text-2xl text-slate-800 dark:text-white">
                    Detail Category
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    {{ $data->category_name }}
                </p>

            </div>




            <form action="{{route('category.delete', $data->uuid)}}" method="post" class="flex gap-2">
                @csrf
                @method('delete')
                <a href="{{route('category.index')}}"
                    class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-2xl text-sm font-bold">
                    Back
                </a>

                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-location')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm">
                    Edit
                </button>

                <button type="submit" onclick="return confirm('Are you sure?')"
                    class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-2xl font-bold text-sm">
                    Delete
                </button>

            </form>

        </div>

    </x-slot>

    <div class="py-10 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] overflow-hidden border border-slate-100 dark:border-slate-800">

                <div class="p-10">


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="bg-slate-50 dark:bg-slate-800 rounded-3xl p-6">

                            <p class="text-sm text-slate-400 mb-2">
                                Category Name
                            </p>

                            <h3 class="font-black text-slate-700 dark:text-white">
                                {{ $data->category_name }}
                            </h3>

                        </div>

                        <div class="bg-slate-50 dark:bg-slate-800 rounded-3xl p-6">

                            <p class="text-sm text-slate-400 mb-2">
                                Total Item
                            </p>

                            <h3 class="font-black text-slate-700 dark:text-white">
                                {{ $data->item_count }}
                            </h3>

                        </div>

                    </div>

                    <div class="mt-8">

                        <!-- data yang terkait -->
                         <div class="bg-white dark:bg-slate-900 rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr class="text-xs uppercase tracking-[0.2em] text-slate-200 dark:text-slate-800">

                            <th class="px-8 py-5 text-left">Item Name</th>
                            <th class="px-8 py-5 text-left">Price</th>
                            <th class="px-8 py-5 text-left">Category</th>
                            <th class="px-8 py-5 text-left">#</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($items as $row)
                        <tr class="text-slate-600 dark:text-slate-200">

                            <td class="px-8 py-6">{{ $row->item_name }}</td>
                            <td class="px-8 py-6 font-bold">IDR. {{number_format($row->price)}}</td>
                            <td class="px-8 py-6 font-bold">
                                {{ $row->category_id === null ? 'Category Tidak Ditemukan' : $row->category->category_name }}
                            </td>
                            <td class="px-8 py-6 text-emerald-500 font-bold">
                                <a href="{{route('items.show', $row->uuid)}}" class="text-bold">Detail</a>
                            </td>

                        </tr>

                        @empty
                        <tr class="text-slate-600 dark:text-slate-200">
                            <td colspan="3" class="px-8 py-6 text-emerald-500 font-bold">Item Not Found</td>
                        </tr>
                        @endforelse


                    </tbody>

                </table>

            </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <x-modal name="create-location" :show="false" focusable>

        <div class="p-8">

            <h2 class="text-2xl font-black mb-6 dark:text-slate-200">
                Add new category
            </h2>

            <form method="post" action="{{route('category.update', $data->uuid)}}" class="space-y-5">
                @csrf
                @method('put')
                <div>
                    <x-input-label for="category_name" value="Category Name" />
                    <x-text-input type="text" name="category_name" id="category_name"
                        value="{{ old('category_name', $data->category_name) }}"
                        class="mt-2 block w-full rounded-2xl" />
                    <x-input-error :messages="$errors->get('category_name')" class="mt-2" />

                </div>

                <div class="flex justify-end gap-3 pt-5">

                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-6 py-3 rounded-2xl text-slate-500 hover:bg-slate-100">

                        Cancel

                    </button>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-2xl font-bold">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </x-modal>

</x-app-layout>
