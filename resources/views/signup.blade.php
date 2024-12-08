<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <section class=" h-full">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 bg h-full">

            <div class="w-full bg-white rounded-lg shadow-md  sm:max-w-md xl:p-0  transition-transform ">
                <div class="hidden p-4 pt-16 pb-12 flex-col" id="chooseAccount">
                    <div class="text-2xl text-center mb-16 ">Choose account type</div>
                    <div class="flex" id="accountType">
                        <button class="w-56 h-56   shadow-lg hover:-translate-y-2 transition-all hover:shadow-xl mr-4 flex flex-col" id="customerType">
                            <img class="h-40" src="{{ Vite::asset('resources/images/bag.svg') }}">
                            <div class="text-lg text-yellow-400 leading-none mt-4">Customer</div>
                            <div class="font-medium text-sm text-gray-600">for shoppers & customers</div>
                        </button>

                        <button class="w-56 h-56   shadow-lg hover:-translate-y-2 transition-all hover:shadow-xl mr-4 flex flex-col" id="traderType">
                            <img class="h-40" src="{{ Vite::asset('resources/images/boxes.svg') }}">
                            <div class="text-lg text-yellow-400 leading-none mt-4">Bulk Buyer</div>
                            <div class="font-medium text-sm text-gray-600">For Traders & Distributors</div>
                        </button>

                    </div>
                    
                    <p class="text-sm font-medium mt-4">
                        Already have an account?
                        <a href="/login" class="font-medium text-yellow-500 hover:underline ">
                            Sign in
                        </a>
                    </p>
                </div>
                <div class="p-6 hidden  sm:p-8 text-black flex-col relative animate-fadeIn" id="signup">
                    <button id="returnButton" class="text-sm pb-2.5 right-6 text-yellow-400 absolute top-6"><span class="text-lg inline-block mr-[2px]"></span> Return</button>
                    <h1
                        class="text-xl  leading-tight pt-2.5 pb-4 md:text-2xl " id='formTitle'>
                        Creating a customer account
                    </h1>
                    <form class="" METHOD="post" id="signupForm">
                        <input type="text" class="hidden" name="type" id="typeInput" value="">
                        <div>
                            <label for="username"
                                class="block  text-sm font-medium  ">Username</label>
                            <input type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     "
                                placeholder="Username">
                            <div class="text-red-400 text-sm formInputError h-4 mb-2">

                            </div>
                        </div>
                        <div>
                            <label for="number"
                                class="block  text-sm font-medium  ">Phone Number</label>
                            <input type="text" name="number" id="number"
                                placeholder="Phone Number ex: 01212345678"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     ">
                            <div class="text-red-400 text-sm formInputError h-4 mb-2">

                            </div>
                        </div>
                        <div>
                            <label for="email"
                                class="block  text-sm font-medium  ">Email</label>
                            <input type="text" name="email" id="email"
                                placeholder="Email"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     ">
                            <div class="text-red-400 text-sm formInputError h-4 mb-2">

                            </div>
                        </div>

                        <div>
                            <label for="password"
                                class="block  text-sm font-medium  ">Password</label>
                            <input type="password" name="password" id="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5     ">
                            <div class="text-red-400 text-sm formInputError h-4 mb-2">

                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 b focus:ring-blue-300  ">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 ">By continuing, you agree to our <a href="/" class="underline text-blue-500">Privacy Policy</a> and <a href="/" class="underline text-blue-500">Terms of Use</a> </label>
                                </div>
                            </div>

                        </div>
                        <div id="captcha-container" style="hidden">
                            <div class="g-recaptcha" data-sitekey="6LdLfkwqAAAAAO8rjdQ6lv1SDDEmPGnmBkvxMyrb" data-callback="enableSubmit"></div>
                        </div>
                        <button type="submit" id="submit" disabled class="w-full text-white disabled:opacity-50 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300  rounded-lg text-sm px-5 py-2.5 text-center bg-yellow-400 ">Sign
                            Up</button>

                        <div class="flex justify-center text-sm text-red-500">
                        </div>

                    </form>
                    <p class="text-sm font-medium mt-0">
                        Already have an account?
                        <a href="/login" class="font-medium text-yellow-500 hover:underline ">
                            Sign in
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </section>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/signup.ts') }}"></script>
    @endPushOnce
</x-layout>
