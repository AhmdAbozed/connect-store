<x-layout>
    <x-adminHeader />
    <div class="flex pt-4">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto ">
            <div class="w-52 flex ml-auto">
                <div class="w-1/2 rounded-t-lg text-center border-gray-300 border-[1px] p-1">pending</div>
                <div class="w-1/2 rounded-t-lg text-center border-gray-300 border-[1px] p-1">completed</div>
            </div>
            <div class="shadow-3xl">
                @foreach ($items as $item)
                    @if ($item->status == 'pending')
                        <div class="flex border-y-2 p-2" id="{{ 'p' . $item->id }}">
                            <div class="flex flex-col mx-1  min-w-40 max-w-60">
                                <div>
                                    Name: <span class="text-blue-500">{{ $item->fullname }}</span>
                                </div>
                                <div>
                                    Address: <span class="text-blue-500">{{ $item->address }}</span>
                                </div>
                                <div>
                                    Number: <span class="text-blue-500">{{ $item->phone_number }}</span>
                                </div>
                            </div>
                            <div class="flex flex-col mx-1">
                                <div>

                                    @php
                                        $foundProduct = null;
                                        foreach ($products as $product) {
                                            if ($product->id === json_decode($item->products)[0]->id) {
                                                $foundProduct = $product;
                                                break; // Exit the loop once the object is found
                                            }
                                        }
                                    @endphp
                                    Product: <span class="text-blue-500">{{ $foundProduct->name }}</span>
                                </div>
                                <div>
                                    Price: <span class="text-blue-500">{{ $foundProduct->discounted_price ?? $foundProduct->price }}</span>
                                </div>
                                <div>
                                    <a href="/product/{{ $foundProduct->id }}" class="text-blue-500 underline">Product Page</a>
                                </div>
                            </div>

                            <div class="ml-auto my-auto" id="{{ $item->id }}">
                                <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12 focus:ring-blue-400 completeBtn hidden">Fulfill</button>
                                <button @if (config('app.demo_mode'))
                                    disabled
                                    @endif  class="disabled:bg-red-300bg-red-500 text-white py-2  px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12 focus:ring-red-400 removeBtn" data-type="category">Delete</button>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
    </div>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/c_panel/cOrderList.ts') }}"></script>
    @endPushOnce
</x-layout>
