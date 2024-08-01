<x-layout>
    <x-banner />
    <div class="w-5 h-5 translate-y-1 bg-black"></div>
    <x-categoriesScroll :categories="$categories" :fileUrl="$fileUrl" :fileToken="$fileToken"/>
    <x-brandsSection />
    <x-productsScroll title="ON SALE" :products="$saleProducts" :fileUrl="$fileUrl" :fileToken="$fileToken"/>
    @php
    
    //temporary solution until dynamic homepage is built
    $monitors = $products->filter(function($product) {
    return $product->category_id == 2;
    });
    $laptops = $products->filter(function($product) {
    return $product->category_id == 1;
    });
    
    @endphp
    <x-productsScroll title="MONITORS" :products="$monitors" :fileUrl="$fileUrl" :fileToken="$fileToken"/>
    <img src="{{ Vite::asset('resources/images/slim-banner.webp') }}" class="object-contain w-full lg:w-11/12 mx-auto  mt-1 cursor-pointer" />
    <x-productsScroll title="LAPTOPS" :products="$laptops" :fileUrl="$fileUrl" :fileToken="$fileToken"/>

</x-layout>