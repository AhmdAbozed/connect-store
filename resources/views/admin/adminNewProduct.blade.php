<x-layout>
    <x-adminHeader />
    <div class=" w-full min-h-[30rem] flex flex-col py-10">
        <div class="w-full sm:max-w-md mx-auto">
            <x-adminNewHead />
            <form class="bg-white p-6 pt-2 rounded shadow-md w-full sm:max-w-md mx-auto c-panel" id="new-product-panel">
                @if (isset($updatingItem))
                    <div class="text-2xl mb-2  mx-auto">Updating {{ $updatingItem->name }} </div>
                @else
                    <div class="text-2xl mb-2  mx-auto">New Product</div>
                @endif
                <label class="block mb-4">
                    <div id="unchangedImgs" class="{{ isset($updatingItem) ? '' : 'hidden' }}">Unchanged Images</div>
                    <label for="image-input" class="w-32 mt-1 block text-white mr-4 py-2 px-4 rounded-full border-0 text-sm font-semibold bg-blue-500 hover:bg-blue-400 cursor-pointer">
                        Upload Images
                    </label>
                    @if (isset($updatingItem))
                        <input type="file" id="image-input" multiple accept="image/*" class="hidden">
                    @else
                        <input type="file" id="image-input" multiple accept="image/*" class="hidden" required>
                    @endif
                </label>
                <div id="preview-container" class="flex flex-wrap gap-4"></div>
                <div id="" class="space-y-4 py-2">
                    <input type="text" name="productName" id="" placeholder="Product name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" name="productPrice" id="" placeholder="Product Price" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" name="discountedPrice" id="" placeholder="Discounted Price (Empty for none)" class="w-full p-2 border border-gray-300 rounded-lg">
                    <input type="number" name="wholesale" id="" placeholder="Wholesale Price (Empty for none)" class="w-full p-2 border border-gray-300 rounded-lg">
                    
                    <input type="number" name="stock" id="" placeholder="Available Stock" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" id="updatingId" name="UpdatingId" class="hidden" value="{{ isset($updatingItem) ? $updatingItem->id : 0 }}">
                    <select name="category" id="category-select" class="bg-white text-black block w-full px-3 mt-2 py-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="-1" selected disabled>Choose Category..</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select name="subcategory" id="subcategory-select" class="bg-white block w-full px-3 mt-2 py-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="0" selected>No Subcategory</option>


                    </select>
                    <div class="text-lg">Filters</div>
                    <div id="filterInputs" class=" border-b-2 pb-4">

                    </div>
                    <div class="text-lg">Specifications</div>
                    <div id="specificationInputs" class="space-y-4">

                    </div>

                </div>
                <button id="add-inputs-btn" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Add Specifications
                </button>
                <button type="submit" @if (config('app.demo_mode'))
                disabled
                @endif class="mt-4 disabled:bg-blue-300 bg-blue-500 block text-white px-4 py-2 rounded submit-btn">Submit</button>
                <div class="hidden result"><span></span><a href="" class="hidden">View Product</a></div>
            </form>




        </div>

    </div>
    <script>
        //for using blade variables in script files
        const phpCategories = {{ Illuminate\Support\Js::from($categories) }};
        const phpSubcategories = {{ Illuminate\Support\Js::from($subcategories) }}
        const phpProducts = {{ Illuminate\Support\Js::from($products) }}
    </script>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/c_panel/cNewProduct.ts') }}" type="module"></script>
    @endPushOnce
</x-layout>
