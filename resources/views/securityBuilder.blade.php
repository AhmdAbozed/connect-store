<x-layout>
    <div id="order-popup" class="">
        <section class="z-50 fixed flex w-full h-full -translate-y-12 animate-fadeIn" id='order-wrapper'>

            <div id='order-overlay' class="opacity-50 bg-black w-[100vw] fixed h-full translate-y-2 z-30 ">

            </div>
            <form class="z-40 bg-gray-100 m-auto min-h-96 w-96  max-w-[95%] max-h-[85%]   p-4 relative text-sm rounded flex flex-col pt-8" id="order-form">
                <button id="close-order" class="absolute -top-1 right-2 text-3xl text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <div class="overflow-y-auto">
                    <div class="systemComponents font-medium text-base flex flex-col border-b-2 border-gray-300">

                        <div id="previewRecorder" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Video Recorder</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>

                        <div id="previewCameras" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Cameras</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>

                        <div id="previewPDU" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Power Supply</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>

                        <div id="previewCables" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Cables</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>
                    </div>

                </div>
                <div class="flex">
                    <div class="text-xl">Total: </div>
                    <div id="popupTotal" class="ml-auto text-xl">0 EGP</div>
                </div>
                <button class="bg-blue-500 text-white rounded-xl py-1 px-3 w-full sendOrder mt-auto">Send Order</button>

            </form>
        </section>
    </div>

    <div class=" max-w-3xl w-full shadow-3xl p-4 mx-auto bg-gray-50">
        <h2 class="text-2xl p-4 text-center border-b-2 justify-center flex items-center">SECURITY SYSTEM</h2>
        <div class=" font-medium">
            <x-builderComponent title='Video Recorder' />
            <x-builderComponent title='Cameras' />
            <x-builderComponent title='Power Supply' />
            <x-builderComponent title='Camera Cables' />

            <div class="flex text-lg mt-6 justify-between">
                <div class="price justify-center flex items-center sm:text-2xl"> Build Cost: <span class="text-gray-700" id='bottomTotal'>0 EGP</span></div>
                <button class="bg-blue-500 text-white rounded-xl py-1 px-3 sm:text-2xl" id="previewBtn">Preview Order</button>

            </div>
        </div>

    </div>
    <script>
        //for using blade variables in script files
        const phpPDUs = {{ Illuminate\Support\Js::from($PDUs) }};
        const phpAccessories = {{ Illuminate\Support\Js::from($accessories) }};
        const phpCameras = {{ Illuminate\Support\Js::from($cameras) }};
        const phpCables = {{ Illuminate\Support\Js::from($cables) }};
        const phpRecorders = {{ Illuminate\Support\Js::from($recorders) }};
        const phpFileToken = {{ Illuminate\Support\Js::from($fileToken) }};
        const phpFileUrl = {{ Illuminate\Support\Js::from($fileUrl) }};
        const phpViteAsset = "{{ Vite::asset('resources/images/camera-mini.webp') }}"
    </script>

    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/builder.ts') }}" type="module"></script>
    @endPushOnce
</x-layout>
