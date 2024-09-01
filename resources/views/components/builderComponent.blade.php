<div class="py-4 border-b-2 border-gray-200 sm:text-sm" id="{{$title}}">
    <div class="text-xl font-semibold flex">
        {{$title}}
        <div class="bg-red-600  w-[5.5rem] ml-auto text-center px-1 rounded-full text-base text-white font-semibold requiredAlert">
            Required!
        </div>
        
    </div>
    
    <div class="noneSelected text-lg text-gray-600 my-6">None selected</div>

    <div class="text-lg text-gray-600 mb-2 selectedItems flex flex-col">
    
        <div>
            <div class="text-xl text-black selectedItemTitle"></div>
        </div>
        <div class="ml-auto selectedItemPrice text-black"></div>
    </div>

    <div class="text-gray-600 mt-1 pl-1">Compatible items</div>
    <div class="flex-col flex itemsWrapper">

    </div>
    <div class="text-gray-600 mt-1 pl-1 incompatibleItemsTitle">Incompatible items</div>
    <div class="flex-col flex opacity-70 incompatibleItemsWrapper">

    </div>
</div>
