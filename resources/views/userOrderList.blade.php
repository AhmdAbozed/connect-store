<x-layout>
    <div class="flex pt-4">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto ">

            <h2 class="text-2xl">My Orders:</h2>
            <div class="pt-2">
                @foreach ($orders as $order)
                    <div class="flex flex-col border-2 border-gray-200 rounded-md pb-3 shadow-md mb-2 " id="{{ 'p' . $order->id }}">
                        <div class="flex border-b-2 p-3">
                            <div class="flex flex-col mx-1 min-w-40 w-full">
                                <div>
                                    Date: <span class="text-blue-500">{{ date('Y-m-d', strtotime($order->created_at)) }}</span>
                                </div>
                                <div>
                                    Address: <span class="text-blue-500 ">{{ $order->address }}</span>
                                </div>
                                <div>
                                    Number: <span class="text-blue-500">{{ $order->phone_number }}</span>
                                </div>
                                <div>
                                    Status: <span class="text-blue-500">{{ $order->status }}</span>
                                </div>

                            </div>
                            <div class="ml-auto my-auto justify-end flex-col flex" id="{{ $order->id }}">
                                @if ($order->status == 'complete')
                                    <div class="bg-green-500 text-white py-2 px-2 w-24 rounded-lg max-h-12 ">Completed</div>
                                @else
                                    <button class="bg-red-500 text-white py-2 px-4 w-20 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12 focus:ring-red-400 removeBtn" data-type="category">Delete</button>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-col mx-1">
                            @php
                                $foundProducts = []; // Initialize an empty array for found products
                                $totalPrice = 0; // Initialize total price
                                foreach (json_decode($order->products) as $orderedProduct) {
                                    foreach ($products as $product) {
                                        if ($product->id == $orderedProduct->id) {
                                            $price = ($product->discounted_price ?: $product->price) * $orderedProduct->quantity;
                                            $totalPrice += $price; // Add the price to the total
                                            $foundProducts[] = [
                                                'product' => $product,
                                                'quantity' => $orderedProduct->quantity,
                                            ];
                                        }
                                    }
                                }
                            @endphp

                            @if (count($foundProducts) > 0)
                                <div class="product-list w-full">
                                    @foreach ($foundProducts as $index => $product)
                                        @if ($index < 3)
                                            <div class="product-item min-h-16 flex flex-col sm:flex-row sm:justify-between sm:items-center py-3 border-b-[1px] p-3 pb-1">
                                                <div class="flex-1 flex sm:text-left text-blue-500 sm:h-12">
                                                    <div class="font-semibold  text-black flex-grow-0 flex-shrink-0 whitespace-pre">{{ $index + 1 }}. Product: </div>
                                                    <a href="/product/{{$product['product']->id}}" class="line-clamp-2 text-ellipsis">{{ $product['product']->name }}</a>
                                                </div>
                                                <div class="sm:mx-auto sm:mr-4 text-blue-500 sm:h-12">
                                                    <span class="font-semibold text-black">Quantity:</span> {{ $product['quantity'] }}
                                                </div>
                                                <div class="sm:text-right text-blue-500 sm:h-12">
                                                    <span class="font-semibold text-black">Price:</span> {{ number_format($product['product']->discounted_price ?: $product->price) }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach


                                    <div>
                                        <div class="product-more hidden">

                                            @foreach ($foundProducts as $index => $product)
                                                @if ($index >= 3)
                                                    <div class="product-item min-h-16 flex flex-col sm:flex-row sm:justify-between sm:items-center py-3 border-b-[1px] p-3 pb-1">
                                                        <div class="flex-1 flex sm:text-left text-blue-500 sm:h-12">
                                                            <div class="font-semibold  text-black flex-grow-0 flex-shrink-0 whitespace-pre">{{ $index + 1 }}. Product: </div>
                                                            <a href="/product/{{$product['product']->id}}" class="line-clamp-2 text-ellipsis">{{ $product['product']->name }}</a>
                                                        </div>
                                                        <div class="sm:mx-auto sm:mr-4 text-blue-500 sm:h-12">
                                                            <span class="font-semibold text-black">Quantity:</span> {{ $product['quantity'] }}
                                                        </div>
                                                        <div class="sm:text-right text-blue-500 sm:h-12">
                                                            <span class="font-semibold text-black">Price:</span> {{ number_format($product['product']->discounted_price ?: $product->price) }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="flex pt-4 pl-2">
                                        <button class=" text-blue-500 py-1 px-2 rounded-lg hover:bg-blue-500 hover:text-white focus:outline-none border-2 border-blue-400 showMoreBtn  @if (!(count($foundProducts) > 3)) hidden @endif">
                                            Show More
                                        </button>
                                        @if ($totalPrice > 0)
                                            <div class="sm:ml-auto px-2 font-semibold text-right ">
                                                Total Price: <span class="text-blue-500 ">{{ number_format($totalPrice) }}</span>
                                            </div>

                                    </div>
                            @endif
                        </div>
                    @else
                        <div>No products found for this order.</div>
                @endif
                <!-- Display total price at the bottom -->

            </div>


        </div>
        @endforeach
    </div>
    </div>
    </div>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/userOrderList.ts') }}"></script>
    @endPushOnce
</x-layout>
