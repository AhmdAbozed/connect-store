<div class="flex">
    <div class="flex-col flex relative col-span-2 w-11/12 sm:max-w-[48rem] lg:w-[44rem] mx-auto">
        <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer left-arrow p-2 ">
            <div class="h-10 w-10 opacity-60 border-gray-300 border-[1px] flex justify-center m-auto rounded-full bg-white">
                <img class="h-5 w-5 -translate-x-[2px] m-auto opacity-40  rotate-180" src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">

            </div>
        </button>
        <button class="h-full flex absolute z-20 scroll-arrow cursor-pointer right-arrow  p-2 right-0">
            <div class="h-10 w-10 opacity-60 border-gray-300 border-[1px] flex justify-center m-auto rounded-full bg-white">
                <img class="h-5 w-5 translate-x-[1px] m-auto opacity-40" src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" alt="">
            </div>
        </button>

        <div class="flex justify-center mt-4 space-x-2 absolute bottom-2 z-20 right-1/2 translate-x-[40%]">
            <span class="dot w-4 h-4 transition-all bg-blue-400 border-4 border-blue-400 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
        </div>
        <div id="banners" class=" relative flex rounded-xl overflow-y-hidden overflow-x-hidden h-auto lg:min-w-[40rem] sm:w-auto pt-1 w-full sm:h-[26rem]  overflow-x self-center scroll-smooth snap-x scrollable">

            <div class="scroll-img h-full min-w-full " id="b01">
                <img src="{{ Vite::asset('resources/images/ban4s.jpg') }}" class=" object-contain rounded-xl h-full mx-auto -translate-y-0" />
            </div>

            <div class="scroll-img h-full min-w-full " id="b02">
                <img src="{{ Vite::asset('resources/images/ban4s.jpg') }}" class=" object-contain rounded-xl h-full mx-auto -translate-y-0" />
            </div>

            <div class="scroll-img h-full min-w-full     " id="b03">
                <img src="{{ Vite::asset('resources/images/ban4s.jpg') }}" class=" object-contain rounded-xl h-full mx-auto -translate-y-0" />
            </div>

            <div class="scroll-img h-full min-w-full " id="b04">
                <img src="{{ Vite::asset('resources/images/ban4s.jpg') }}" class=" object-contain rounded-xl h-full mx-auto -translate-y-0" />
            </div>
        </div>
    </div>
    <div class="lg:flex flex-col  justify-around hidden my-auto max-w-[26rem] mr-auto ml-1 flex-shrink">
        <img src="{{ Vite::asset('resources/images/mini-banner.webp') }}" class=" object-contain rounded h-1/2 mb-1" />
        <img src="{{ Vite::asset('resources/images/mini-banner2.webp') }}" class="object-contain rounded h-1/2 " />

    </div>
</div>

@pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/imgScroll.ts') }}"></script>
    <script src="{{ Vite::asset('resources/ts/scrollDots.ts') }}"></script>
@endPushOnce
