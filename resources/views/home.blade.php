<x-layout :fileUrl="$fileUrl" :fileToken="$fileToken">
    <div class="flex lg:h-[26rem] mx-auto px-2 mt-4">
        <x-categoriesPanel />
        <x-banner />
    </div>
    <div class="flex flex-col justify-center ">
        <div class="mx-auto flex flex-col max-w-[80rem]">

            <x-categoriesScroll :categories="$categories" :fileUrl="$fileUrl" :fileToken="$fileToken" />
            <x-productsScroll title="ON SALE" :products="$saleProducts" :fileUrl="$fileUrl" :fileToken="$fileToken" :href="false"/>
            @php

                //temporary solution until dynamic homepage is built
                $laptops = $products->filter(function ($product) {
                    return $product->subcategory_id == 11;
                });
                $cameras = $products->filter(function ($product) {
                    return $product->subcategory_id == 2;
                });

            @endphp
            <x-productsScroll title="LAPTOPS" :products="$laptops" :fileUrl="$fileUrl" :fileToken="$fileToken" :href="true"/>
            <img src="{{ Vite::asset('resources/images/slim-banner.webp') }}" class="object-contain w-full lg:w-11/12 mx-auto  mt-1 cursor-pointer" />
            <x-productsScroll title="CAMERAS" :products="$cameras" :fileUrl="$fileUrl" :fileToken="$fileToken" :href="true"/>

        </div>
    </div>
</x-layout>
