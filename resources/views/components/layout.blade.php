<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
</head>
@php
    if (Auth::check()) {
        $user = Auth::user()->load('orders');
    }

@endphp

<body class="flex flex-col font-semibold font-sans">
    <div id="order-popup" class=" hidden">
        <div id='order-overlay' class="opacity-50 bg-black w-[100vw] fixed h-full z-50 ">

        </div>
        <section class="z-[60] fixed flex w-full h-full -translate-y-12 animate-fadeIn">
            <form class="bg-gray-100 m-auto h-96 w-96 max-w-[90%] p-4 relative text-sm space-y-5 rounded" id="cart-order-form">
                <button id="close-order" class="absolute -top-1 right-2 text-3xl text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <div class="mb-2">
                    <label for="full-name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="Name" id="full-name" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Name" @if (Auth::check()) value="{{ $user->name }}" @endif>
                </div>

                <div class="mb-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1 ">Address</label>
                    <input type="text" name="Address" id="address" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Address">
                </div>

                <div class="mb-5">
                    <label for="phone-number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" name="PhoneNumber" id="phone-number" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder=" Number" minlength="10" maxlength="15" pattern="\d{10,}"
                        @if (Auth::check()) value="{{ Auth::getUser()->phone_number }}" @endif>
                </div>

                <button class="w-full bg-blue-500 text-white py-2 rounded-lg shadow-md hover:bg-blue-600 transition-colors" id="submit-btn">Send Order</button>

            </form>
        </section>

    </div>
    <header class="flex flex-col  fixed w-full z-40 h-[4.5rem] bg-white shadow-md ">
        <div class="flex  w-full max-w-[80rem] m-auto">
            <!-- Left element -->
            <button class="flex-shrink-0 lg:hidden" id='sidebar-button'>
                <img src="{{ Vite::asset('resources/images/menu.svg') }}" class="object-contain h-8" />
            </button>

            <button class="flex-shrink-0 ">
                <img src="{{ Vite::asset('resources/images/logo.svg') }}" class="object-contain h-7 ml-4 translate-y-[2px]" />
            </button>
            <div class="flex-shrink-0  ml-1 text-lg flex-grow static lg:relative flex">
                <div class=" peer pt-[0.95rem] ml-6  hidden lg:flex">Categories</div>
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
                <img src="{{ Vite::asset('resources/images/right-arrow-dark.svg') }}" class=" hidden lg:flex object-contain h-3 ml-1 my-auto peer-hover:rotate-90 peer-hover/panel:rotate-90 transition-all" />
                <div class="flex-grow p-2 hidden lg:flex bg-white shadow-md lg:shadow-none lg:mx-8  lg:relative absolute w-[100vw] right-0 m-0 lg:w-auto translate-y-12 lg:translate-y-0" id="search-wrapper">

                    <input type="text" class="m-0 py-3 px-4 flex-grow lg:static hidden  lg:flex lg:w-auto text-[#7f8286] bg-[#f4f5f6e3] bg-clip-border rounded-lg text-base font-normal leading-6 tracking-normal h-12 border-2 border-gray-400 lg:border-0" autocomplete="off" id="search-input"
                        placeholder="Search">
                    <img src="{{ Vite::asset('resources/images/search.svg') }}" class="absolute hidden lg:block right-6 opacity-50 object-contain h-5 top-6 ml-1 my-auto peer-hover:rotate-90 peer-hover/panel:rotate-90 transition-all" />
                    <div class="flex-grow min-h-80  z-40 w-[95vw] lg:w-full  bg-white translate-y-[1.2rem]  shadow-xl  animate-fadeIn transition-all absolute top-11 rounded-lg hidden" id="search-results-wrapper">
                        <div class="flex  w-full text-black flex-wrap max-h-[70vh] overflow-y-auto content-baseline" id="search-results">

                        </div>
                        <div class="w-4/12 max-w-20 absolute left-1/2 top-1/2 block" id="search-roller">
                            <img src="{{ Vite::asset('resources/images/roller.svg') }}" class="opacity-20 w-full -translate-y-1/2 -translate-x-1/2"></img>
                        </div>

                        <div class=" absolute left-1/2 top-1/2 text-gray-500 hidden" id="none-found">
                            <div class="-translate-y-1/2 -translate-x-1/2 text-center">
                                No matches found.
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <div class="relative flex mr-6" id="profileWrapper">
                <!-- Profile Button -->
                <button
                    class=" p-2  relative rounded-full  focus:outline-none"

                    @if (Auth::check()) onclick="document.getElementById('profilePanel').classList.toggle('hidden')"        
                    @else
                    onclick="window.location.href = '/login'" @endif>
                    <!-- Profile Icon (you can replace this with an image) -->
                    <img src="{{ Vite::asset('resources/images/prof-bigger.svg') }}" class="object-contain h-8 opacity-75 my-auto " id="cartBtnImg" />
                </button>



                @if (Auth::check())
                    <div class="flex flex-col  text-sm my-auto">
                        <div class="flex items-center">{{ $user->name }}</div>
                        <div class="flex items-center">{{$user->orders->count()}} orders</div>

                    </div>
                @endif
                <!-- Dropdown Panel -->
                <div
                    id="profilePanel"
                    class="absolute right-0 mt-14 w-36 bg-white rounded-lg shadow-lg py-2 hidden">
                    <a href="/orders" class=" px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex">
                        <img src="{{ Vite::asset('resources/images/bag1.svg') }}" class="object-contain h-7 mr-3 my-auto " id="cartBtnImg" />

                        <div class="-translate-x-1 translate-y-[2px]">My Orders</div>
                    </a>
                    <button class=" px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex w-full" id="signout">
                        <img src="{{ Vite::asset('resources/images/signout.svg') }}" class="object-contain h-6 mr-3  my-auto " id="cartBtnImg" />

                        Sign Out
                    </button>
                </div>
            </div>

            <button class="ml-auto mr-4 relative" id="cartBtn">
                <img src="{{ Vite::asset('resources/images/cart-h.svg') }}" class="object-contain h-10 my-auto " id="cartBtnImg" />
                <div class="rounded-full w-[18px] h-[18px] bg-red-600 text-xs text-white pt-[1px] absolute -translate-y-11 translate-x-2 right-0 hidden" id="cart-count">0</div>
            </button>
            <div class="flex-grow p-2  lg:mx-8 lg:h-auto  absolute w-[100vw] right-0 m-0 lg:w-auto hidden" id="cart-wrapper">
                <div class="flex-grow  lg:min-h-80 h-full  w-[90vw] z-40 sm:w-[75vw]  lg:w-[27rem]  bg-white translate-y-[1rem]  shadow-md   animate-fadeIn transition-all absolute top-11 rounded-lg right-0 lg:right-full" id="search-results-wrapper">
                    <div class="flex  bg-white w-full text-black flex-wrap max-h-[60vh] px-1 min-h-full    overflow-y-auto shadow-md content-baseline" id="cart-results">

                    </div>
                    <div class="text-xl pt-4 pb-4 px-6 flex border-2 rounded-b bg-white shadow-md">
                        <div class="mr-4">Total: <span><span class="cart-total">0</span> EGP</span></div>
                        <button class="ml-auto disabled border-2 hover:bg-slate-800 border-gray-600 hover:text-white px-3 py-2 rounded-md " id="cart-checkout">
                            Checkout
                        </button>
                    </div>
                    <div class="w-4/12 max-w-20 absolute left-1/2 top-1/2 block" id="cart-search-roller">
                        <img src="{{ Vite::asset('resources/images/roller.svg') }}" class="opacity-20 w-full -translate-y-1/2 -translate-x-1/2"></img>
                    </div>

                </div>

            </div>
            <button class="ml-auto mr-4 lg:hidden" id="searchBtn">
                <img src="{{ Vite::asset('resources/images/search.svg') }}" class="object-contain h-7 my-auto " id="searchBtnImg" />

            </button>

        </div>

        </div>
    </header>
    <section class="flex-col w-10/12 sm:w-52 h-full bg-gray-900 hidden animate-slideIn fixed z-40 mt-10" id='sidebar' style='box-shadow: 0 0 5px 0 rgba(50,50,50,.75);'>
        <a href="/" class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Home
        </a>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Special Offers
        </div>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer">
            Checkout
        </div>
        <div class="border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12 cursor-pointer ">
            Contact Us
        </div>
        <button class="flex border-b-2 text-xl p-2 border-gray-700 text-gray-100 h-12">
            <div>Categories</div>
            <img class="h-6 w-6 ml-auto my-auto mr-2 rotate-90" src="{{ Vite::asset('resources/images/right-arrow-white.svg') }}" alt="">
        </button>
        <div class="flex flex-col">
            <a href="/categories/1" class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-100 h-12">
                Laptops
            </a>
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-100 h-12">
                Cameras
            </div>
            <a class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-100 h-12">
                Monitors
            </a>
            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-100 h-12">
                Headphones
            </div>

            <div class="flex cursor-pointer text-xl p-2 ml-4  border-gray-700 text-gray-100 h-12">
                Accessories
            </div>
    </section>
    <div class="flex flex-col mt-[5rem] mb-4">
        {{ $slot }}
    </div>
    <div class="mt-5"></div>
    <footer class="w-full min-h-50 bg-gray-950 flex flex-col mt-auto">
        <div class="grid font-medium w-full min-h-40 grid-cols-2  sm:grid-cols-3 lg:grid-cols-5 text-gray-100 pl-6 pt-4">
            <div class=" lg:ml-10 text-lg">
                <div class="mt-1">
                    <a href="/">Home</a>
                </div>
                <div class="mt-1">
                    Support: 01061676615
                </div>
                <div class="flex mt-2">
                    <a href="https://api.whatsapp.com/send?phone=01061676615" class="mr-2">
                        <img src="{{ Vite::asset('resources/images/whatsapp.svg') }}" class="object-contain h-5 ml-1 my-auto transition-all" />
                    </a>
                    <a href="https://facebook.com">
                        <img src="{{ Vite::asset('resources/images/facebook.svg') }}" class="object-contain h-5 ml-1 my-auto transition-all" />
                    </a>

                </div>
            </div>
            <div class="text-lg">

                <div class=" text-gray-100 mt-1">
                    Laptops
                </div>
                <div class=" text-gray-100 mt-1">
                    Cameras
                </div>
                <div class=" text-gray-100 mt-1">
                    PCs
                </div>
                <div class="block sm:hidden">

                    <div class=" text-gray-300 mt-1">
                        Printers
                    </div>
                    <div class=" text-gray-300 mt-1">
                        Monitors
                    </div>
                </div>
            </div>

            <div class="hidden sm:block text-lg">

                <div class=" text-gray-300 mt-1">
                    Printers
                </div>
                <div class=" text-gray-300 mt-1">
                    Monitors
                </div>
            </div>

        </div>
        <div class=" text-gray-400 text-xs p-2 pt-0 mr-4">All Rights Reserved by Connect ©.</div>
    </footer>
</body>
<script>
    @if (isset($fileToken))
        const phpFileToken = {{ Illuminate\Support\Js::from($fileToken) }};
        const phpFileUrl = {{ Illuminate\Support\Js::from($fileUrl) }};
        const arrowSrc = @json(Vite::asset('resources/images/right-arrow-dark.svg'));
    @endif
</script>
<script src="{{ Vite::asset('resources/ts/cart.ts') }}" type="module"></script>
<script src="{{ Vite::asset('resources/ts/sidebar.ts') }}"></script>
<script src="{{ Vite::asset('resources/ts/header.ts') }}" type="module"></script>
@stack('scripts')

</html>
