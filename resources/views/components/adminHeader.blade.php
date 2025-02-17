<header class="flex flex-col shadow-md text-black h-auto w-full px-4">
    <!-- Container for left elements -->
    <div class="flex-shrink-0 flex flex-wrap w-full max-w-6xl py-2">
        <a href="/admin/product" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4 sm:ml-auto">
            Add
        </a>
        <a href="/admin/products" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4">
            Products
        </a>
        <a href="/admin/categories" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4">
            Categories
        </a> 
        <a href="/admin/subcategories" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4">
            Subcategories
        </a>
        <a href="/admin/orders/pending" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4">
            Orders
        </a>
        <a href="/admin/traders" class="flex-shrink-0 text-lg min-w-16 text-center hover:text-blue-400 px-4">
            Traders
        </a>
    </div>
</header>

@if (config('app.demo_mode'))
<div class="mx-auto text-xl text-blue-500 mt-4">PREVIEW ONLY MODE</div><div class="mx-auto mb-4"> Post endpoints are disabled and personal info is hidden</div>
@endif
