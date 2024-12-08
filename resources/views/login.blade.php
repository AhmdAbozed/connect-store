<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">
    <section class=" h-full">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 bg h-full">

            <div
                class="w-full bg-white rounded-lg shadow-md  sm:max-w-md xl:p-0  transition-transform ">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 text-black">
                    <h1
                        class="text-xl  leading-tight   md:text-2xl ">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" METHOD="post" id="loginForm">
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium  ">Username</label>
                            <input v-model="form.username" type="text" name="username" id="username"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    "
                                placeholder="Username">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium  ">Password</label>
                            <input v-model="form.password" type="password" name="password" id="password"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300   sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5    ">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 b focus:ring-blue-300  ">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 ">Remember me</label>
                                </div>
                            </div>

                            <a href="#"
                                class="text-sm font-semibold text-yellow-500 hover:underline ">Forgot
                                password?
                            </a>
                        </div>

                        <button type="submit" id="submit" class="w-full text-white disabled:opacity-50 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-semibold  rounded-lg text-sm px-5 py-2.5 text-center bg-yellow-400 ">Sign
                            In</button>
                            <div class="text-red-500 text-center text-base font-medium hidden" id="invalid">Invalid Username or Password</div>
                        <div class="flex justify-center text-sm text-red-500">
                        </div>
                        <p class="text-sm font-medium">
                            Don’t have an account yet?
                            <a href="/signup" class="font-medium text-yellow-500 hover:underline ">
                                Sign up
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/login.ts') }}" type="module"></script>
    @endPushOnce
</x-layout>
