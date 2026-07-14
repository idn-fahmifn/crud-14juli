<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-black text-2xl text-slate-800 dark:text-white">
                    Categories
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    List of categories item
                </p>

            </div>

            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-location')"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm">

                + Add New

            </button>

        </div>

    </x-slot>

    <div class="py-10 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ALERT --}}

            @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-6 flex items-center justify-between bg-blue-100 border border-blue-300 text-blue-700 px-6 py-4 rounded-2xl">

                <span class="font-semibold">
                    {{ session('success') }}
                </span>

                <button @click="show = false">
                    ✕
                </button>

            </div>
            @endif



            {{-- TABLE --}}
            <div class="bg-white dark:bg-slate-900 rounded-lg overflow-hidden">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr class="text-xs uppercase tracking-[0.2em] text-slate-200 dark:text-slate-800">

                            <th class="px-8 py-5 text-left">Category Name</th>
                            <th class="px-8 py-5 text-left">Total Item</th>
                            <th class="px-8 py-5 text-left">#</th>

                        </tr>

                    </thead>

                    <tbody>

                    @forelse ($data as $row)
                        <tr class="text-slate-600 dark:text-slate-200">

                            <td class="px-8 py-6">{{ $row->category_name }}</td>
                            <td class="px-8 py-6 font-bold">{{$row->item_count}} Item</td>
                            <td class="px-8 py-6 text-emerald-500 font-bold">
                                <a href="" class="text-bold">Detail</a>
                            </td>

                        </tr>

                    @empty
                        
                    @endforelse

                        
                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- MODAL --}}
    <x-modal name="create-location" :show="false" focusable>

        <div class="p-8">

            <h2 class="text-2xl font-black mb-6 dark:text-slate-200">
                Add new category
            </h2>

            <form method="post" action="{{route('category.store')}}" class="space-y-5">
                @csrf
                <div>
                    <x-input-label for="category_name" value="Category Name" />
                    <x-text-input type="text" name="category_name" id="category_name"
                        class="mt-2 block w-full rounded-2xl" />
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
