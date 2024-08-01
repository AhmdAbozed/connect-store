<div class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-cyan-500 mt-4">
    {{$title}}
</div>

<div class="flex-col flex relative  w-full ">
    <button class="h-full flex absolute z-10 scroll-arrow cursor-pointer left-arrow rotate-180">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">
    </button>
    <button class="h-full flex absolute z-10 scroll-arrow cursor-pointer right-arrow right-0">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">
    </button>

    <div class="relative flex overflow-y-hidden pt-1 overflow-x sm:overflow-x-hidden self-center scroll-smooth snap-x scrollable w-full">

        @foreach ($products as $product)
        <a class="scroll-img w-[50vw] lg:w-[16.66vw] sm:w-[33.3vw] px-1 flex-shrink-0" id="b02" href="/product/+{{$product->id}}">
            <div class="relative flex flex-col h-full border-[1px] rounded-md border-gray-300">
                @if ($product->discounted_price)
                <div class="z-20  text-xs m-1 absolute top-0 rounded-md px-[4px] py-1 bg-blue-400 text-white text-center font-medium">{{intval((1-($product->discounted_price / $product->price)) * 100)}}% OFF</div>
                @endif
                <img src="{{$fileUrl.'/file/connect-store/product/'.'0'.$product->img_id.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" class="object-contain  rounded  -translate-y-0 h-64" />
                <div class="z-10 text-gray-800 mx-auto text-sm text-center px-1 line-clamp-2">{{$product->name}}</div>
                @if ($product->discounted_price)
                <div class="z-10 mx-auto text-sm text-center mt-auto text-blue-500" :>EGP {{number_format($product->discounted_price)}}</div>
                <div class="z-10 mx-auto text-sm text-center text-gray-400 line-through mb-2">EGP {{number_format($product->price)}}</div>

                @else
                <div class="z-10 mx-auto text-sm text-center mt-1 text-blue-500 mb-auto" :>EGP {{number_format($product->price)}}</div>
                @endif


            </div>

        </a>
        @endforeach

    </div>
</div>


@pushOnce('scripts')
<script src="{{ Vite::asset('resources/ts/imgScroll.ts') }}"></script>
@endPushOnce