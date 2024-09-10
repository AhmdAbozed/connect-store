<div class="mt-2">
    <div class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-gray-600">
        SHOP BY CATEGORIES
    </div>
</div>
<div class="flex-col flex relative  w-full min-h-28">
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