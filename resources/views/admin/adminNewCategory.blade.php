<x-layout>
    <x-adminHeader />
    <div class=" w-full min-h-[30rem] flex flex-col py-10">
        <div class="w-full sm:max-w-md mx-auto">
            <x-adminNewHead/>
            <form class="bg-white p-6 pt-2 rounded shadow-md max-w-md mx-auto c-panel" id="new-category-panel">
                @if (isset($updatingItem))
                <div class="text-2xl mb-2  mx-auto">Updating {{$updatingItem->name}}</div>

                @else
                <div class="text-2xl mb-2  mx-auto">New Category</div>
                @endif
                <input type="file" name="categoryImage" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <input type="number" id="updatingId" name="UpdatingId" class="hidden" value="{{ isset($updatingItem) ?  $updatingItem->id : 0 }}">

                <div id="specificationInputs" class="space-y-4 py-2">
                    <input type="text" name="categoryName" id="" placeholder="Category name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <!-- Input fields will be added here -->

                </div>
                <button id="add-inputs-btn" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Add Filter Specifications
                </button>
                <button type="submit" class="mt-4 bg-blue-500 block text-white px-4 py-2 rounded submit-btn">Submit</button>
                <div class="hidden result"><span></span></div>
            </form>


        </div>

    </div>

    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cNewCategory.ts') }}"></script>
    @endPushOnce
</x-layout>