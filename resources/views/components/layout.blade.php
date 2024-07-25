<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/ts/app.ts'])
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>

<body class="flex flex-col font-semibold font-sans">
    <header class="flex flex-col  fixed w-full z-40">
        <div class="flex bg-gray-950 text-white  h-11 w-full px-4">
            <!-- Left element -->
            <button class="flex-shrink-0 lg:hidden" id='sidebar-button'>
                <img src="{{ Vite::asset('resources/images/menu.svg') }}" class="object-contain h-8" />
            </button>
            <div class="flex-shrink-0 mx-3 text-lg  relative hidden lg:flex w-full">
                <div class=" peer pt-2">Categories</div>
                <div class="w-[50vw] h-80 bg-gray-100 z-40 pl-6 pt-3 shadow-xl hidden peer/panel peer-hover:flex  hover:flex animate-fadeIn transition-all absolute top-11 rounded-lg">
                    <div class="grid grid-cols-4 text-black">
                        <div class="flex flex-col">
                            <div class="text-md border-b-2 cursor-pointer w-32">Laptops</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Lenovo</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Apple</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Dell</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Asus</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Acer</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">HP</div>

                        </div>
                        <div class="flex flex-col">
                            <div class="text-md border-b-2 cursor-pointer w-32">Cameras</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Webcams</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Dome</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Turret</div>
                        </div>
                        <div class="flex flex-col">
                            <div class="text-md border-b-2 cursor-pointer w-32">Mobiles</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Samsung</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Apple</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Lenovo</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Xiaomi</div>
                        </div>
                        <div class="flex flex-col">
                            <div class="text-md border-b-2 cursor-pointer w-32">Accessories</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Mouses</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Keyboards</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Microphones</div>
                            <div class="mt-2 font-medium cursor-pointer text-gray-700">Headsets</div>
                        </div>
                    </div>
                </div>

                <img src="{{ Vite::asset('resources/images/right-arrow-white.svg') }}" class="object-contain h-3 ml-1 my-auto peer-hover:rotate-90 peer-hover/panel:rotate-90 transition-all" />
                <div class="flex-shrink-0 mx-3 text-lg pt-2 hover:text-blue-400">
                    Home
                </div>
                <div class="flex-shrink-0 mx-3 text-lg pt-2 hover:text-blue-400">
                    Special Offers
                </div>
                <div class="flex-shrink-0 mx-3 text-lg pt-2 hover:text-blue-400">
                    Stores
                </div>
                <div class="flex-shrink-0 mx-3 text-lg pt-2 hover:text-blue-400 ml-auto">
                    Contact Us
                </div>
            </div>

        </div>
    </header>
    <section class="flex-col w-10/12 sm:w-52 h-full bg-gray-900 hidden animate-slideIn fixed z-40 mt-10" id='sidebar' style='box-shadow: 0 0 5px 0 rgba(50,50,50,.75);'>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Home
        </div>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Special Offers
        </div>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Checkout
        </div>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Contact Us
        </div>
        <button class="flex border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12">
            <div>Categories</div>
            <img class="h-6 w-6 ml-auto my-auto mr-2 rotate-90" src="{{ Vite::asset('resources/images/right-arrow-white.svg') }}" alt="">
        </button>
        <div class="flex flex-col">
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-300 h-12">
                Laptops
            </div>
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-300 h-12">
                Cameras
            </div>
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-300 h-12">
                Screens
            </div>
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-300 h-12">
                Headphones
            </div>

            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-300 h-12">
                Accessories
            </div>
    </section>
    <div class="flex flex-col mt-12  mb-10">
        {{$slot}}
    </div>
    <footer class="w-full min-h-50 bg-gray-950 flex flex-col mt-auto">
        <div class="grid font-medium w-full min-h-40  grid-cols-3 lg:grid-cols-5 text-gray-100 pl-6 pt-4">
            <div class="justify-center col-span-1 lg:grid-span-3 lg:ml-10">
                <div class="text-lg">
                    Home
                </div>
                <div class="text-lg">
                    Special Offers
                </div>
                <div class="text-lg">
                    Contact Us
                </div>
                <div class="text-lg">
                    About Us
                </div>

            </div>
            <div>
                <div class="text-lg">
                    Categories
                </div>
                <div class=" text-gray-300 mt-1">
                    Laptops
                </div>
                <div class=" text-gray-300 mt-1">
                    Cameras
                </div>
                <div class=" text-gray-300 mt-1">
                    Accessories
                </div>
            </div>

            <div>
                <div class="text-lg">
                    Brands
                </div>
                <div class=" text-gray-300 mt-1">
                    Lenovo
                </div>
                <div class=" text-gray-300 mt-1">
                    Asus
                </div>
                <div class=" text-gray-300 mt-1">
                    Dell
                </div>
            </div>

        </div>
        <div class=" text-gray-400 text-xs p-1 pt-0 mr-4">All Rights Reserved by Connect ©.</div>
    </footer>
</body>

<script src="{{ Vite::asset('resources/ts/sidebar.ts') }}"></script>
@stack('scripts')

</html>