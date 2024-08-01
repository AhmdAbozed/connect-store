<x-layout>
    <x-adminHeader/>
    <div class="flex">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto shadow-3xl">
            @foreach ($items as $item)
            <div class="flex border-y-2 p-2" id="{{'p'.$item->id}}">
                <div class="flex flex-col mx-1">
                    <div class="text-blue-500">{{$item->name}}</div>
                </div>
                <div class="ml-auto my-auto" id="{{$item->id}}">
                    <a href="{{request()->getScheme() . '://' . request()->getHttpHost() .'/administrator/category/'.$item->id}}"><button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-blue-400">Edit</button></a>
                    <button class="bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400" data-type="category">Remove</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cProductList.ts') }}"></script>
    @endPushOnce
</x-layout>