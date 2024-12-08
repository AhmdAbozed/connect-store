<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">
    <section class=" h-full">
        <div class="flex flex-col items-center justify-center px-6 max-w-[32rem] mx-auto py-10 h-full">

            <div
                class="w-full bg-white rounded-lg shadow-md  text-xl  transition-transform ">
                <div class="p-6 flex flex-col  sm:p-8 text-black relative">
                    <img class="h-40 mb-6" src="{{ Vite::asset('resources/images/boxes.svg') }}">

                    <div class=" mb-2 mx-w-1 font-medium">
                        Your trader account is pending approval.
                    </div>
                    <div class="text-base text-yellow-500 font-medium">
                        You will be contacted by support for confirmation soon.
                    </div>
                    <button class="text-blue-500  text-sm absolute top-2 right-4 signout" >Sign out</button>
                </div>
            </div>
        </div>
    </section>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/pendingTrader.ts') }}"></script>
    @endPushOnce
</x-layout>
