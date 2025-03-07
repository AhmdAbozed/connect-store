<div
    class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-gray-600 mt-4 mb-2">
    @if ($href)
        <a href="{{'/categories/'.$products->first()->category_id.'/subcategories/'.$products->first()->subcategory_id}}">
            {{ $title }}
        </a>    
    @else
        {{ $title }}
    @endif
</div>

<div class="flex-col flex relative  max-w-[100vw]">
    <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer left-arrow p-2 ">
        <div class="h-10 w-10 border-gray-300 border-[1px] flex opacity-60 justify-center m-auto rounded-full bg-white">
            <img class="h-5 w-5 -translate-x-[2px] m-auto  rotate-180"
                src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">

        </div>
    </button>
    <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer right-arrow  p-2 right-0">
        <div class="h-10 w-10 border-gray-300 border-[1px] flex opacity-60 justify-center m-auto rounded-full bg-white">
            <img class="h-5 w-5 translate-x-[1px] m-auto"
                src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">
        </div>
    </button>

    <div
        class="relative flex overflow-y-hidden pt-1 overflow-x sm:overflow-x-hidden self-center scroll-smooth snap-x scrollable w-full shadow-sm">

        @foreach ($products->take(10) as $product)
            <div class="scroll-img w-[50%] lg:w-[16.7%] sm:w-[33.3%] flex-shrink-0 font-medium py-4">
                <div class="relative flex flex-col h-full border-r-[1px]  border-gray-300  ">
                    <a class="flex flex-col px-4 h-full" href="/product/{{ $product->id }}">
                        <img src="{{ $fileUrl . '/file/connect-store/product/' . $product->img_id . '/' . '0' . '?Authorization=' . $fileToken . '&b2ContentDisposition=attachment' }}"
                            class="object-contain  rounded  -translate-y-0 h-36 " />

                        <div
                            class=" break-words overflow-hidden w-full text-ellipsis leading-[20px] h-[40px] z-10 text-left mx-auto text-sm px-1 line-clamp-2">
                            {{ $product->name }}</div>
                        @if (Auth::check() && Auth::getUser()->type == 'trader')
                            @if ($product->wholesale)
                                <div class="z-10 text-sm font-semibold mr-1">Wholesale: {{ number_format($product->wholesale) }}
                                    <span class="text-[.83rem]">EGP</span></div>
                            @else
                                <div class="z-10 text-sm font-semibold mr-1">Wholesale unavailable</div>
                            @endif
                        @endif
                        @if ($product->discounted_price)
                            <div class="w-full z-10  text-[.83rem] leading-[0.7rem] font-semibold text-red-600 mt-5"> Save
                                {{ number_format($product->price - $product->discounted_price) }} EGP
                                ({{ intval((1 - $product->discounted_price / $product->price) * 100) }}%)</div>

                            <div class="w-full text-sm text-left flex mb-1">
                                <div class="z-10 text-xl font-semibold mr-1"> {{ number_format($product->discounted_price) }}
                                    <span class="text-[.83rem]">EGP</span></div>
                                <div class="z-10 text-gray-400 line-through flex translate-y-[6px] text-[.83rem]">
                                    {{ number_format($product->price) }} EGP</div>

                            </div>
                        @else
                            <div class="z-10 text-xl font-semibold mr-1 mt-auto"> {{ number_format($product->price) }} <span
                                    class="text-[.83rem]">EGP</span></div>
                        @endif

                    </a>
                    <button
                        class="h-8 w-[6.5rem] text-sm flex rounded-md mt-auto ml-4 justify-center border-2 border-gray-200 hover:bg-gray-800 hover:text-white addToCartBtn"
                        data-id="{{ $product->id }}">
                        <img class="h-4 w-4 mr-1 translate-x-[1px] hidden check my-auto"
                            src="{{ Vite::asset('resources/images/check.svg') }}" alt="">
                        <div class="addToCartText my-auto">+ Add To Cart</div>
                    </button>

                </div>

            </div>
        @endforeach

    </div>
</div>

@pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/imgScroll.ts') }}"></script>
    <script src="{{ Vite::asset('resources/ts/productCard.ts') }}" type="module"></script>
@endPushOnce