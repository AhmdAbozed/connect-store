<x-layout>
    <x-banner />
    <div class="w-5 h-5 translate-y-1 bg-black"></div>
    <x-categoriesScroll />
    <x-brandsSection />
    <x-productsScroll title="ON SALE" />
    <x-productsScroll title="CAMERAS" />
    <img src="{{ Vite::asset('resources/images/slim-banner.webp') }}" class="object-contain w-full lg:w-11/12 mx-auto  mt-1 cursor-pointer" />
    <x-productsScroll title="LAPTOPS" />
    <x-productsScroll title="ACCESSORIES" />
    
</x-layout>