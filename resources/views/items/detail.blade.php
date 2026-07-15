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

            <form action="{{route('items.destroy', $data->uuid)}}" method="post" class="flex gap-2">
                @csrf
                @method('delete')
                <a href="{{route('items.index')}}"
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
                                        {{ $data->created_at->diffForHumans() }}
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

    <x-modal name="create-location" :show="false" focusable>

        <div class="p-8">

            <h2 class="text-2xl font-black mb-6 dark:text-slate-200">
                Edit item
            </h2>

            <form method="post" action="{{route('items.update', $data->uuid)}}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 my-4 ">
                    <div>
                        <x-input-label for="item_name" value="Item Name" />
                        <x-text-input type="text" name="item_name" id="item_name" value="{{ old('item_name', $data->item_name) }}"
                            class="mt-2 block w-full rounded-2xl" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />

                    </div>
                    <div class="">
                        <x-input-label for="category" value="Category" />
                        <x-select name="category" class="mt-2 block w-full rounded-2xl">
                            <option value="" disabled>choose category</option>
                            @forelse ($categories as $category)
                            <option value="{{$category->id}}" @selected(old('category', $data->category_id) == $data->category_id)>{{$category->category_name}}
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
                        <x-text-input type="number" name="price" id="price" value="{{ old('price', $data->price) }}"
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
                                    $data->condition) == $status)>
                                <span class="ms-2 text-sm text-slate-800 dark:text-slate-200">{{$label}}</span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <x-input-label for="image" value="Image" />

                    @if ($data->image)
                        <img src="{{asset('storage/items/'.$data->image)}}" class="h-24 rounded-2xl my-2 object-cover" alt="image-items">
                        <p class="text-slate-800 dark:text-slate-200">Skip, if image is not changed</p>
                    @endif

                    <x-text-input type="file" name="image" id="image" :value="old('image')"
                        class="mt-2 block w-full rounded-2xl py-4 px-2 border" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="desc" value="Description" />
                    <x-text-area name="desc" class="mt-2 block w-full rounded-2xl py-4 px-2 border">{{old('desc', $data->desc)}}</x-text-area>
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
