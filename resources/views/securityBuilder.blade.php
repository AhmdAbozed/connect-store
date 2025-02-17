<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">
    <div id="builder-order-popup" class="hidden">
        <section class="z-50 fixed flex w-full h-full  animate-fadeIn" id='order-wrapper'>

            <div id='order-overlay' class="opacity-50 bg-black w-[100vw] fixed h-full top-0 z-30 ">

            </div>
            <form class="z-40 bg-gray-100 m-auto -translate-y-12 min-h-96 w-96  max-w-[95%] max-h-[85%]   p-4 relative text-sm rounded flex flex-col pt-8" id="order-form">
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

                        <div id="previewPDU" class="mb-3 hidden">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold" id="PDUName">Power Supply</div>
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

                        <div id="previewMonitor" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Monitor</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>

                        <div id="previewHdd" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Hard Drive</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">
                                    Required!
                                </div>
                            </div>
                            <div class=" flex w-full previewItems flex-col">

                            </div>
                            <div class="noneSelected text-gray-600 ">None selected</div>
                        </div>

                        <div id="previewAccessories" class="mb-3">
                            <div class="flex">
                                <div class="flex items-center text-lg previewName font-semibold">Surveillance Equipment</div>
                                <div class="text-red-500  ml-auto  items-center flex  rounded-full text-base  font-semibold previewRequired">

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
                <button class="bg-blue-500 text-white rounded-xl py-1 px-3 w-full sendOrder mt-auto" id="previewCartBtn">Add To Cart</button>

            </form>
        </section>
    </div>

    <div class=" max-w-3xl w-full shadow-3xl p-4 mx-auto bg-gray-50">
        <h2 class="text-2xl p-4 text-center border-b-2 justify-center flex items-center">Build Your Surveillance System</h2>
        <div class=" font-medium">

            <x-builderComponent title='Video Recorder' :subcategory="$subcategories->get('Video Recorders')" />
            <x-builderComponent title='Security Cameras' :subcategory="$subcategories->get('Security Cameras')" />
            <x-builderComponent title='Power Supply' :subcategory="$subcategories->get('Power Supplies')" />
            <x-builderComponent title='Cables' :subcategory="$subcategories->get('Camera Cables')" />
            <x-builderComponent title='Monitor' :subcategory="$subcategories->get('Monitors')" />
            <x-builderComponent title='Hard Drive' :subcategory="$subcategories->get('Hard Drives')" />
            <x-builderComponent title='Surveillance Equipment' :subcategory="$subcategories->get('Surveillance Equipment')" />

            <div class="flex text-lg mt-6 justify-between">
                <div class="price justify-center flex items-center sm:text-2xl"> Build Cost: <span class="text-gray-700" id='bottomTotal'>0 EGP</span></div>
                <button class="bg-blue-500 text-white rounded-xl py-1 px-3 sm:text-2xl" id="previewBtn">Preview Order</button>

            </div>
        </div>

    </div>
    <script>
        //for using blade variables in script files
        const phpPDUs = {{ Illuminate\Support\Js::from($PDUs) }};
        const phpCameras = {{ Illuminate\Support\Js::from($cameras) }};
        const phpCables = {{ Illuminate\Support\Js::from($cables) }};
        const phpRecorders = {{ Illuminate\Support\Js::from($recorders) }};
        const phpViteAsset = "{{ Vite::asset('resources/images/camera-mini.webp') }}"
        const phpNetworkSwitches = {{ Illuminate\Support\Js::from($switches) }};
        const phpHardDrive = {{ Illuminate\Support\Js::from($hardDrives) }};
        const phpMonitors = {{ Illuminate\Support\Js::from($monitors) }};
        const phpAccessories = {{ Illuminate\Support\Js::from($accessories) }};

        //used for switching them according to recorder per requirements
        const phpPDUId = {{ $subcategories->get('Power Supplies')->id }};
        const phpSwitchesId = {{ $subcategories->get('Network Switches')->id }};
    </script>

    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/builder.ts') }}" type="module"></script>
    @endPushOnce
</x-layout>
