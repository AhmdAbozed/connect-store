<x-layout>
    <header class="flex bg-gray-100 shadow-md -translate-y-1 text-black  h-11 w-full px-4">
        <!-- Left element -->
        <div class="flex-shrink-0 mx-3 text-lg  relative flex w-full">
            <div class="flex-shrink-0  text-lg pt-2 min-w-16 text-center hover:text-blue-400 px-4 ml-auto">
                Add
            </div>
            <div class="flex-shrink-0  text-lg pt-2 min-w-16 text-center hover:text-blue-400 px-4">
                Products
            </div>
            <div class="flex-shrink-0  text-lg pt-2 min-w-16 text-center hover:text-blue-400 px-4 ">
                Categories
            </div>
        </div>
    </header>
    <div class="flex">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto shadow-3xl">
            @foreach ($products as $product)
            <div class="flex border-y-2 p-2" id="{{'p'.$product->id}}">
                <div class="flex flex-col mx-1">
                    <div class="text-blue-500">{{$product->name}}</div>
                    <div>
                        <div>Price: EGP {{$product->price}}</div>
                        <div>discount: EGP {{$product->discounted_price}}</div>
                    </div>
                </div>
                <div class="flex flex-col ml-4">
                    <div class=" ">Stock: {{$product->stock}} left.</div>
                    <a href="{{request()->getScheme() . '://' . request()->getHttpHost() .'/product/'.$product->id}}" class="text-blue-500 underline">Product Page</a>

                </div>
                <div class="ml-auto my-auto" id="{{$product->id}}">
                    <a href="{{request()->getScheme() . '://' . request()->getHttpHost() .'/administrator/product/'.$product->id}}"><button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-blue-400">Edit</button></a>
                    <button class="bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400">Remove</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cProductList.ts') }}"></script>
    @endPushOnce
</x-layout>