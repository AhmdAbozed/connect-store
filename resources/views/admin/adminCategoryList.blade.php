<x-layout>
    <x-adminHeader/>
    @php
    function generateURL($data)
    {
        // Initialize an empty array for query parameters
        $queryParams = [];
        if (!empty($data->name)) {
            $queryParams['name'] = $data->name;
        }
      
        if (!empty($data->category_id) && $data->category_id !== '-1') {
            $queryParams['category_id'] = $data->category_id;
        }
         
        if ($data->specifications) {
            $queryParams['specifications'] = $data->specifications;
        }

        // Build the query string
        $queryString = http_build_query($queryParams);

        $baseUrl = request()->getScheme() . '://' . request()->getHttpHost() . '/admin/'.($data->category_id ? 'subcategory' : 'category').'/' . $data->id;
        return $baseUrl . '?' . $queryString;
    }
@endphp
    <div class="flex">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto shadow-3xl">
            @foreach ($items as $item)
            <div class="flex border-y-2 p-2" id="{{'p'.$item->id}}">
                <div class="flex flex-col mx-1">
                    <a href="{{'/categories/'.$item->id}}" class="flex flex-col ">
                        <div class="text-blue-500">{{$item->name}}</div>
                    </a>
                    
                    @if ($item->category_id)
                        <div> Category: {{$item->category->name}}</div>
                    @endif
                    
                </div>
                <div class="ml-auto my-auto" id="{{$item->id}}">
                    <a href="{{generateURL($item)}}"><button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-blue-400">Edit</button></a>
                    <button @if (config('app.demo_mode'))
                disabled
                @endif  class="disabled:bg-red-300 bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400" data-type="{{$item->category_id ? 'subcategory' : 'category'}}">Remove</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @pushOnce('scripts')
    <script src="{{ Vite::asset('resources/ts/c_panel/cProductList.ts') }}"></script>
    @endPushOnce
</x-layout>