<x-layout>
    <div class="max-w-[85rem] mx-auto flex flex-col">
        <div class="flex flex-col sm:grid sm:grid-cols-6 w-full sm:w-11/12 mx-auto">
            <div class="col-span-3 flex justify-center flex-col   pb-1 mx-1 relative">
                <button id="fullscreen-icon" class="absolute w-8 top-2 h-8 object-contain right-2 z-20 sm:hidden">
                    <img src="{{ Vite::asset('resources/images/fullscreen.svg') }}" class="" />
                </button>
                <div class="flex overflow-x-hidden scroll-smooth snap-x w-[95vw] sm:w-auto max-w-[42rem] self-center pt-1  h-80 sm:h-[28rem] mb-1 scrollable" id="big-images-scrollable">
                    <div class="big-img transition-opacity duration-400 overflow-hidden h-full min-w-full big-active" id="b0">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'0'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" class="object-contain product-img transition rounded h-full mx-auto" />
                    </div>
                    <div class="big-img transition-opacity duration-400 overflow-hidden h-full min-w-full opacity-50" id="b1">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'1'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" class="object-contain product-img transition rounded h-full mx-auto" />
                    </div>
                    <div class="big-img transition-opacity duration-400 overflow-hidden h-full min-w-full opacity-50" id="b2">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'2'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" class="object-contain product-img transition rounded h-full mx-auto" />
                    </div>
                </div>

                <div class="content-between grid gap-1 grid-cols-3 grid-rows-1 p-2 ">
                    <div class="h-full flex shadow-3xl -translate-y-1">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'0'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" id="s0" class="aspect-square m-auto object-contain product-img small-img transition-opacity duration-400 cursor-pointer small-active" />
                    </div>
                    <div class="h-full flex shadow-3xl -translate-y-0">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'1'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" id="s1" class="aspect-square m-auto object-contain product-img small-img transition-opacity duration-400 cursor-pointer opacity-50" />
                    </div>
                    <div class="h-full flex shadow-3xl -translate-y-0">
                        <img src="{{$fileUrl.'/file/connect-store/product/'.'3'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" id="s2" class="aspect-square m-auto object-contain product-img small-img transition-opacity duration-400 cursor-pointer opacity-50" />
                    </div>
                </div>
            </div>
            <div class="flex w-full flex-col col-span-3 h-full py-3 px-1">
                <div class=" text-xl sm:text-2xl font-poppins mx-2 border-b-2 border-gray-300  mt-4">
                    {{$product->name}}
                </div>
                <div class="pl-4 flex flex-col font-medium mt-2 min-h-64">
                    @foreach (json_decode($product->specifications) as $specification)
                    <div class="text-gray-600 mt-2 sm:mt-3">
                        <span class="font-semibold text-gray-800">{{$specification->specName}}: </span>{{$specification->specValue}}
                    </div>
                    @endforeach

                  
                    <div class="text-gray-600 mt-2 sm:mt-3">
                        <span class="font-semibold text-gray-800">Cash On Delivery </span>
                    </div>
                    <div class="text-gray-600 my-2 sm:my-3">
                        <span class="font-semibold text-gray-800">Return for free up to 30 days</span>
                    </div>
                </div>

                <div class=" flex text-2xl font-poppins mx-2 border-y-2 border-gray-300 text-blue-500 py-2 mt-auto">
                    <div class="my-auto">
                        @if ($product->discounted_price)
                        EGP {{$product->discounted_price}} <span class="line-through text-gray-400"> EGP {{$product->price}}</span>
                        @else
                        EGP {{$product->price}}
                        @endif
                    </div>
                    <div class=" flex-col ml-auto">
                        <span class="block text-black font-medium text-sm my-auto mr-2"> In Stock</span>
                        <span class=" block text-gray-600 font-medium col-span-2 text-sm my-auto mr-2"> {{$product->stock}} left</span>

                    </div>
                </div>
                <div class="flex mt-4">
                    <div class="flex mr-1">
                        <button id="decrement" class="w-12 h-12 text-xl flex items-center justify-center rounded border-2">
                            -
                        </button>
                        <div id="number" class="w-16 h-12 bg-white text-xl flex items-center justify-center rounded shadow border">
                            1
                        </div>
                        <button id="increment" class="w-12 h-12 text-xl flex items-center justify-center rounded border-2">
                            +
                        </button>
                    </div>
                    <button class="bg-blue-500 text-white w-full rounded text-2xl py-1">Buy Now</button>
                </div>
            </div>
        </div>
        <section class="mx-2 ">
            <h2 class="text-xl  px-1 ">Specification</h2>
            <div class="grid grid-cols-3 px-8 py-3   border-b-[1px] border-gray-300">
                <div class=" font-medium">Model</div>
                <div class="text-gray-600 font-medium col-span-2">Dell G15-5515</div>
            </div>
            @foreach (json_decode($product->specifications) as $specification)
            <div class="grid grid-cols-3 px-8 py-3   border-b-[1px] border-gray-300">
                <div class=" font-medium">{{$specification->specName}}</div>
                <div class="text-gray-600 font-medium col-span-2">{{$specification->specValue}}</div>
            </div>
            @endforeach

        </section>
    </div>
    <div id="fullScreenModal" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center animate-fadeIn hidden z-30">
        <div class="relative">
            <img id="fullScreenImage" src="{{ Vite::asset('resources/images/laptop2.jpg') }}" alt="Full Screen Image" class="w-screen max-h-full">
            <button id="closeButton" class="absolute top-2 right-2 bg-white text-black rounded-full p-2">
                &times;
            </button>
        </div>
    </div>
    <x-productsScroll title="Related Products"></x-productsScroll>
    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/productPage.ts') }}"></script>
    @endPushOnce
</x-layout>