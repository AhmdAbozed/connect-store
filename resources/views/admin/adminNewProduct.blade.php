<x-layout>
    <x-adminHeader />
    <div class=" w-full min-h-[30rem] flex flex-col py-10">
        <div class="w-full sm:max-w-md mx-auto">
        <x-adminNewHead/>
            <form class="bg-white p-6 pt-2 rounded shadow-md w-full sm:max-w-md mx-auto c-panel" id="new-product-panel">
                @if (isset($updatingItem))
                <div class="text-2xl mb-2  mx-auto">Updating {{$updatingItem->name}} </div>

                @else
                <div class="text-2xl mb-2  mx-auto">New Product</div>
                @endif
                <label class="block mb-4">
                    <span class="text-gray-700">Upload product images</span>
                    <input type="file" id="image-input" multiple accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                </label>
                <div id="preview-container" class="flex flex-wrap gap-4"></div>
                <div id="specificationInputs" class="space-y-4 py-2">
                    <input type="text" name="productName" id="" placeholder="Product name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" name="productPrice" id="" placeholder="Product Price" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" name="discountedPrice" id="" placeholder="Discounted Price (Empty for none)" class="w-full p-2 border border-gray-300 rounded-lg">
                    <input type="number" name="stock" id="" placeholder="Available Stock" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    <input type="number" id="updatingId" name="UpdatingId" class="hidden" value="{{ isset($updatingItem) ?  $updatingItem->id : 0 }}">
                    <!-- Input fields will be added here -->
                    <select name="category" class="bg-white block w-full px-3 mt-2 py-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="-1" selected disabled>Choose Category..</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select name="brand" class="bg-white block w-full px-3 mt-2 py-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="-1" selected disabled>Choose Brand..</option>
                        @foreach ($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button id="add-inputs-btn" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Add Specifications
                </button>
                <button type="submit" class="mt-4 bg-blue-500 block text-white px-4 py-2 rounded submit-btn">Submit</button>
                <div class="hidden result"><span></span><a href="" class="hidden">View Product</a></div>
            </form>




        </div>

    </div>

    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cNewProduct.ts') }}"></script>
    @endPushOnce
</x-layout>