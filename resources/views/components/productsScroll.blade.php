<div class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-gray-600 mt-4 mb-2">
    {{ $title }}
</div>

<div class="flex-col flex relative  w-full ">
    <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer left-arrow p-2 ">
        <div class="h-10 w-10 border-gray-300 border-[1px] flex justify-center m-auto rounded-full bg-white">
        <img class="h-5 w-5 -translate-x-[2px] m-auto opacity-40  rotate-180" src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">

        </div>
    </button>
    <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer right-arrow  p-2 right-0">
        <div class="h-10 w-10 border-gray-300 border-[1px] flex justify-center m-auto rounded-full bg-white">
        <img class="h-5 w-5 translate-x-[1px] m-auto opacity-40" src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">
        </div>
    </button>

    <div class="relative flex overflow-y-hidden pt-1 overflow-x sm:overflow-x-hidden self-center scroll-smooth snap-x scrollable w-full">

        @foreach ($products as $product)
            <a class="scroll-img w-[50vw] lg:w-[16.7vw] sm:w-[33.3vw] flex-shrink-0 font-medium py-4" id="b02" href="/product/+{{ $product->id }}">
                <div class="relative flex flex-col h-full border-r-[1px]  border-gray-300  ">
                    <img src="{{ $fileUrl . '/file/connect-store/product/' . $product->img_id . '/' . '0' . '?Authorization=' . $fileToken . '&b2ContentDisposition=attachment' }}" class="object-contain  rounded  -translate-y-0 h-36 px-4" />
                    <div class="flex flex-col px-4">
                        <div class=" break-words overflow-hidden w-full text-ellipsis leading-[20px] h-[40px] z-10 text-left mx-auto text-sm px-1 line-clamp-2">{{ $product->name }}</div>
                        @if ($product->discounted_price)
                            <div class="w-full z-10  text-[.83rem] leading-[0.7rem] font-semibold text-red-600 mt-5"> Save {{ number_format($product->price - $product->discounted_price) }} EGP ({{intval((1-($product->discounted_price / $product->price)) * 100)}}%)</div>
    
                            <div class="w-full text-sm text-left flex mb-1">
    
                                <div class="z-10 text-xl font-semibold mr-1"> {{ number_format($product->discounted_price) }} <span class="text-[.83rem]">EGP</span></div>
                                <div class="z-10 text-gray-400 line-through flex translate-y-[6px] text-[.83rem]"> {{ number_format($product->price) }} EGP</div>
    
                            </div>
                        @else
                            <div class="z-10  mt-1 text-blue-500 mb-auto" :> {{ number_format($product->price) }} EGP</div>
                        @endif
    
                    </div>
                    

                </div>

            </a>
        @endforeach

    </div>
</div>


@pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/imgScroll.ts') }}"></script>
@endPushOnce
