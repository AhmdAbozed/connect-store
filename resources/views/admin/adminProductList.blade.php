<x-layout>
    <x-adminHeader/>
    <div class="flex">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto shadow-3xl text-sm sm:text-base">
            @foreach ($items as $item)
            <div class="flex border-y-2 p-2" id="{{'p'.$item->id}}">
                <div class="flex flex-col mx-1">
                    <div class="text-blue-500 max-w-40 sm:w-72 sm:max-w-72">{{$item->name}}</div>
                    <div>
                        <div >Price: <span class="text-gray-600"> {{$item->price}}</span></div>
                        <div>discount: <span class="text-gray-600"> {{$item->discounted_price}}</span> </div>
                    </div>
                </div>
                <div class="flex flex-col ml-4">
                    <div class=" ">Stock: {{$item->stock}} left.</div>
                    <a href="{{request()->getScheme() . '://' . request()->getHttpHost() .'/product/'.$item->id}}" class="text-blue-500 underline">Product Page</a>

                </div>
                <div class="ml-auto my-auto" id="{{$item->id}}">
                    <a href="{{request()->getScheme() . '://' . request()->getHttpHost() .'/administrator/product/'.$item->id}}"><button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-blue-400">Edit</button></a>
                    <button class="bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400" data-type="product">Remove</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cProductList.ts') }}"></script>
    @endPushOnce
</x-layout>