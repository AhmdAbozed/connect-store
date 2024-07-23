<div class="flex">
    <div class="flex-col flex relative col-span-2 w-11/12  sm:w-[44rem] mx-auto lg:mr-2 ">
        <div class="h-full flex absolute z-10 scroll-arrow cursor-pointer left-arrow rotate-180">
            <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">
        </div>
        <div class="h-full flex absolute z-10 scroll-arrow cursor-pointer right-arrow right-0">
            <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">
        </div>

        <div class="flex justify-center mt-4 space-x-2 absolute bottom-2 z-20 right-1/2 translate-x-[40%]">
            <span class="dot w-4 h-4 transition-all bg-blue-400 border-4 border-blue-400 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
            <span class="dot w-4 h-4 transition-all bg-white border-2 border-gray-300 rounded-full"></span>
        </div>
        <div id="banners" class=" relative flex rounded-xl overflow-y-hidden overflow-x-hidden h-auto sm:w-auto pt-1 w-full sm:h-[26rem]  overflow-x self-center scroll-smooth snap-x scrollable">

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
    <div class="lg:flex flex-col w-full justify-around hidden h-[24rem] my-auto max-w-96 mr-auto">
        <img src="{{ Vite::asset('resources/images/mini-banner.webp') }}" class=" object-contain rounded h-1/2" />
        <img src="{{ Vite::asset('resources/images/mini-banner2.webp') }}" class="object-contain rounded h-1/2" />

    </div>
</div>