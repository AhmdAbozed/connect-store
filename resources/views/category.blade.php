<x-layout>
    @php

    @endphp
    <section id="filters-sidebar-wrapper" class="hidden z-30">
        <div class="flex-col w-10/12 h-full bg-gray-100 animate-slideIn fixed z-40 flex" id='filters-sidebar' style='box-shadow: 0 0 5px 0 rgba(50,50,50,.75);'>
            <h3 class="text-xl p-2 w-full border-gray-200 border-b-2">Filters</h3>
            <label for="min-price" class="px-2 py-1 font-semibold -top-4 w-full border-gray-300 text-lg">Price</label>
            <div class="flex m-1 border-gray-200 border-b-2 pb-4">
                <input type="text" pattern="\d*" title="Numbers only" min="0" name="min-price" id="min-price" placeholder="From" class="w-full p-1 border border-gray-300 rounded-lg mr-1">
                <input type="text" pattern="\d*" title="Numbers only" min="0" name="max-price" id="max-price" placeholder="To" class="w-full p-1 border border-gray-300 rounded-lg">
                <input type="button" name="set-price" value="SET" class="bg-blue-500 text-white rounded-lg text-sm p-1 pt-[3px] ml-1" id="set-price">
            </div>
        </div>

        <div class="opacity-50 bg-black w-[100vw] absolute h-[calc(100%-4rem)]" id="filter-overlay"></div>

    </section>
    <section class="flex min-h-[30rem] w-full sm:w-10/12 mt-5 mx-auto text-base">
        <section class="w-64  h-full hidden sm:flex" id="filters-lg" >
            <div class="flex-col  border-gray-200 border-x-[1px] border-t-[1px] flex" id='filters-sidebar'>
                <h3 class="text-lg p-2 w-full border-gray-200 border-b-2 h-12">Filters</h3>
                <label for="min-price" class="px-2 py-1 font-semibold -top-4 w-full border-gray-300">Price</label>
                <div class="flex m-1 border-gray-200 border-b-2 pb-4">
                    <input type="text" pattern="\d*" title="Numbers only" min="0" name="min-price" id="min-price" placeholder="From" class="w-full p-1 border border-gray-300 rounded-lg mr-1">
                    <input type="text" pattern="\d*" title="Numbers only" min="0" name="max-price" id="max-price" placeholder="To" class="w-full p-1 border border-gray-300 rounded-lg">
                    <input type="button" name="set-price" value="SET" class="bg-blue-500 text-white rounded-md text-xs p-1 pt-[3px] ml-1" id="set-price">
                </div>
            </div>

        </section>

        <section id="main-content" class="w-full border-t-[1px]">
            <section class="mb-2">
                <h2 class="text-xl m-2 sm:hidden">{{ $category->name }}</h2>
                <div class="flex border-gray-200 border-b-2 border-r-2 h-12">
                    <h2 class="text-xl m-2 hidden sm:block">{{ $category->name }}</h2>
                
                    <button id="filters-button" class="sm:hidden w-1/2 text-center align-middle  border-r-2 flex justify-center p-1">
                        <img src="{{ Vite::asset('resources/images/menu.svg') }}" class="object-contain h-4 my-auto bg-gray-300" />

                        <div class=" my-auto ml-1">Filters</div>
                    </button>
                    <div class="w-1/2 sm:w-full border-gray-200  flex justify-center p-1">
                        <img src="{{ Vite::asset('resources/images/menu.svg') }}" class="object-contain h-4 my-auto bg-gray-300" />
                        <select id="sort-by" name="category" class="bg-white block w-11/12 mx-auto  p-2 text-base  rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="unsorted" selected disabled>Sort By..</option>
                            <option value="unsorted">Unsorted</option>
                            <option value="lowest">Lowest Price</option>
                            <option value="highest">Highest Price</option>
                            <option value="newest">Newest</option>
                        </select>

                    </div>
                </div>
            </section>

        </section>

    </section>

    <script>
        //for using blade variables in script files
        const phpCategorySpecs = {{ Illuminate\Support\Js::from($category->specifications) }};
        const phpProducts = {{ Illuminate\Support\Js::from($products) }};
        const phpFileToken = {{ Illuminate\Support\Js::from($fileToken) }};
        const phpFileUrl = {{ Illuminate\Support\Js::from($fileUrl) }};
    </script>

    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/category.ts') }}"></script>
    @endPushOnce
</x-layout>
