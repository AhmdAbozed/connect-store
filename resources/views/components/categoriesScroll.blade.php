<div class="mt-2">
    <div class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-gray-600">
        SHOP BY CATEGORIES
    </div>
</div>
<div class="flex-col flex relative  w-full min-h-28">
    <div class="h-full flex  w-10 absolute z-10 scroll-arrow cursor-pointer left-arrow rotate-180">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">

    </div>
    <div class="h-full flex  w-10 absolute z-10 scroll-arrow cursor-pointer right-arrow right-0">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">

    </div>

    <div class="relative flex overflow-y-hidden pt-1 overflow-x sm:overflow-x-hidden self-center scroll-smooth snap-x scrollable w-full">
    @foreach ($categories as $category)
        <a href="/categories/{{$category->id}}" class="scroll-img w-[50vw] lg:w-[16.66vw] sm:w-[33.3vw] px-1 flex-shrink-0" id="b01">
            <div class="relative">
                <img src="{{ $fileUrl . '/file/connect-store/product/' . $category->img_id.'/0'.'?Authorization='.$fileToken.'&b2ContentDisposition=attachment' }}" class="col object-contain  rounded h-52 mx-auto -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">{{$category->name}}</div>

            </div>

        </a>
    @endforeach
     


    </div>
</div>


@pushOnce('scripts')
<script src="{{ Vite::asset('resources/ts/imgScroll.ts') }}"></script>
@endPushOnce