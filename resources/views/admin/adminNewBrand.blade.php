<x-layout>
    <x-adminHeader />
    <div class=" w-full min-h-[30rem] flex flex-col py-10">
        <div class="w-full sm:max-w-md mx-auto">
        <x-adminNewHead/>
            <form class="bg-white p-6 pt-2 rounded shadow-md max-w-md mx-auto c-panel" id="new-brand-panel">
                <div class="text-2xl mb-2  mx-auto">New Brand</div>

                <input type="text" name="brandName" id="" placeholder="Brand name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                <button type="submit" class="mt-4 bg-blue-500 block text-white px-4 py-2 rounded submit-btn">Submit</button>
                <div class="hidden result"><span></span></div>
            </form>

        </div>

    </div>

    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cNewBrand.ts') }}"></script>
    @endPushOnce
</x-layout>