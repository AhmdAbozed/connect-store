<div>
    <div class="font-semibold text-lg font-poppins mx-3 border-b-2 after:block after:w-16 after:m after:border-b-2 after:absolute after:border-cyan-500">
        SHOP BY CATEGORIES
    </div>
</div>
<div class="flex-col flex relative  w-full min-h-28">
    <div class="h-full flex absolute z-10 scroll-arrow cursor-pointer left-arrow rotate-180">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">

    </div>
    <div class="h-full flex absolute z-10 scroll-arrow cursor-pointer right-arrow right-0">
        <img class="h-6 w-6 m-auto" src="{{ Vite::asset('resources/images/right-arrow.svg') }}" alt="">

    </div>

    <div class="relative flex overflow-y-hidden sm:overflow-x-hidden sm:w-auto pt-1 min-w-100vw  overflow-x self-center scroll-smooth snap-x scrollable">

        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b01">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>

        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b01">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b01">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b01">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b02">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b03">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>
        </div>

        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b03">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>
        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b03">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>
        </div>
        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b04">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>

        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b05">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>

        <div class="scroll-img min-w-[33%]  lg:min-w-[16.6%]" id="b06">
            <div class="relative">
                <img src="{{ Vite::asset('resources/images/camera-mini.webp') }}" class="col object-contain  rounded h-full -translate-y-0" />
                <div class="z-10 text-black mx-auto bottom-0 absolute left-1/2 -translate-x-1/2 font-semibold ">Cameras</div>

            </div>

        </div>


    </div>


    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/js/img-scroll.ts') }}"></script>
    <script src="{{ Vite::asset('resources/js/scrollDots.ts') }}"></script>
    @endPushOnce

</div>