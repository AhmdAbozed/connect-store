<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">

    <section class=" h-full">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 bg h-full">

            <div class="flex font-medium shadow-lg rounded-lg flex-col p-6 justify-center center" id="verificationForm">
                <div class="text-xl text-center mb-6 font-semibold">Verify Number</div>
                Enter the verification code sent to this number: <div id="numberDisplay" class="font-semibold text-xl">{{ $number }}</div>
                <input class="hidden" value="{{ $number }}" id="enteredNumber" type="text">
                <form action="" class="flex flex-col justify-center">
                    <input type="text" name="code" id="code"
                        placeholder="X X X X X X"
                        class="bg-gray-50 border w-36 text-lg text-center mx-auto border-gray-300 rounded-lg focus:ring-blue-600 focus:border-blue-600 block p-2 my-5 self-center">
                    <button type="submit" id="submit" class=" w-36 mx-auto text-white disabled:opacity-50 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300  rounded-lg text-base px-5 py-2.5 text-center bg-yellow-400">Submit</button>
                    <div class="text-red-500 hidden" id="error">Failed to send code, try again later</div>
                </form>
                <div class="flex justify-center mt-2 text-gray-600">
                    <div>Can't find it?</div> <button class="ml-2 text-yellow-500 hover:underline" id="resendCode"> Resend Code</button>
                </div>
                <form action="" id="resendForm">
                    <div id="captcha-container" style="hidden">
                        <div class="g-recaptcha" data-sitekey="6LdLfkwqAAAAAO8rjdQ6lv1SDDEmPGnmBkvxMyrb"></div>
                    </div>
                    <button id="resendButton" class="hidden w-36 mx-auto text-white disabled:opacity-50 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-300  rounded-lg text-base px-5 py-2.5 text-center bg-yellow-400">Resend Code</button>
                    <div class="text-red-500 hidden" id="resendError">Failed to send code, try again later</div>
         
                </form>
            </div>
        </div>
    </section>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/verifyNumber.ts') }}" type="module"></script>
    @endPushOnce
</x-layout>
