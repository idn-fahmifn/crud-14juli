<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="font-black text-2xl text-slate-800 dark:text-white">
                    Items
                </h2>

                <p class="text-sm text-slate-400 mt-1">
                    List of Items
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

                            <th class="px-8 py-5 text-left">Item Name</th>
                            <th class="px-8 py-5 text-left">Stock</th>
                            <th class="px-8 py-5 text-left">Category</th>
                            <th class="px-8 py-5 text-left">#</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($data as $row)
                        <tr class="text-slate-600 dark:text-slate-200">

                            <td class="px-8 py-6">{{ $row->item_name }}</td>
                            <td class="px-8 py-6 font-bold">{{$row->stock}} Item</td>
                            <td class="px-8 py-6 font-bold">{{$row->category->category_name}} </td>
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

    {{-- MODAL --}}
    <x-modal name="create-location" :show="false" focusable>

        <div class="p-8">

            <h2 class="text-2xl font-black mb-6 dark:text-slate-200">
                Add new item
            </h2>

            <form method="post" action="{{route('items.store')}}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-4 ">
                    <div>
                        <x-input-label for="item_name" value="Item Name" />
                        <x-text-input type="text" name="item_name" id="item_name" :value="old('item_name')"
                            class="mt-2 block w-full rounded-2xl" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />

                    </div>
                    <div class="">
                        <x-input-label for="category" value="Category" />
                        <x-select name="category" class="mt-2 block w-full rounded-2xl">
                            <option value="" disabled>choose category</option>
                            @forelse ($categories as $category)
                            <option value="{{$category->id}}" @selected(old('category') == $category->id)>{{$category->category_name}}
                            </option>
                            @empty
                            <option value="" disabled>category not found</option>
                            @endforelse
                        </x-select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-4 ">
                    <div>
                        <x-input-label for="price" value="Price" />
                        <x-text-input type="number" name="price" id="price" :value="old('price')"
                            class="mt-2 block w-full rounded-2xl" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />

                    </div>
                    <div class="">

                        @php
                        $opsi = [
                        'good' => 'good',
                        'bad' => 'bad',
                        'maintenance' => 'maintenance',
                        ]
                        @endphp

                        <x-input-label for="condition" value="Condition" />


                        @foreach ($opsi as $status => $label)
                        <div class="flex justify-between">
                            <label for="" class="mt-2">
                                <input type="radio" name="condition" id="condition" value="{{$status}}"
                                    class="dark:text-indigo-600 focus:ring-indigo-500" @checked(old('condition',
                                    $status->condition ?? '' ) == $status)>
                                <span class="ms-2 text-sm text-slate-800 dark:text-slate-200">{{$label}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <x-input-label for="image" value="Image" />
                    <x-text-input type="file" name="image" id="image" :value="old('image')"
                        class="mt-2 block w-full rounded-2xl py-4 px-2 border" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="desc" value="Description" />
                    <x-text-area name="desc" class="mt-2 block w-full rounded-2xl py-4 px-2 border">{{old('desc')}}</x-text-area>
                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />
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
