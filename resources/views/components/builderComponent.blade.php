<div class="py-4 border-b-2 border-gray-200 sm:text-sm" id="{{$title}}">
    <div class="text-xl font-semibold flex">
        {{$title}}
        <div class="bg-red-600  w-[5.5rem] text-sm sm:text-base pt-[2px] sm:pt-0 sm:px-1 ml-auto text-center px-1 rounded-lg  text-white font-semibold requiredAlert">
            Required!
        </div>
        <a href="/categories/1/subcategories/{{$subcategoryId}}/builder" class="ml-auto font-medium text-sm sm:text-lg rounded-xl bg-blue-600 p-2 text-white titleSelectBtn hidden"><button>Select Component</button></a>
        
    </div>

    <div class="flex w-full my-6  text-sm sm:text-lg selectBtn">
        <div class="noneSelected  text-gray-600 flex my-auto">None selected</div>
        <a href="/categories/1/subcategories/{{$subcategoryId}}/builder" class="ml-auto rounded-xl bg-blue-600 p-2 text-white "><button>Select Component</button></a>
    </div>
    
    <div class="text-lg text-gray-600 mb-2 selectedItems flex flex-col">
    
        <div>
            <div class="text-xl text-black selectedItemTitle"></div>
        </div>
        <div class="ml-auto selectedItemPrice text-black"></div>
    </div>

</div>
