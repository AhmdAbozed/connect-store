import { Item } from "./types";
//@ts-ignore 
const fileToken: Array<string> = phpFileToken;
//@ts-ignore
const fileUrl: Array<product> = phpFileUrl;

export function updateCartCount() {

    document.getElementById('cart-count')!.innerHTML = `0`;
    let items = JSON.parse(localStorage.getItem('cart_items') || '[]');
    let count = 0;
    items.forEach((item: any) => {
        count += (Number(item.quantity))
    })
    const cartCount = document.getElementById('cart-count')!;
    cartCount.innerHTML = `${count}`;
    if (Number(cartCount.innerHTML)) {
        cartCount.classList.replace('hidden', 'block')
        document.querySelector<HTMLButtonElement>('#cart-checkout')!.disabled = false
    }
    else {

        cartCount.classList.replace('block', 'hidden')
        document.querySelector<HTMLButtonElement>('#cart-checkout')!.disabled = true

    }
    updateCartTotal();
}
export function updateCartTotal() {
    const resultsDiv = document.getElementById('cart-results')!
    let total = 0;
    resultsDiv.querySelectorAll<HTMLElement>('.cart-item')!.forEach((e) => {
        total += (Number(e.dataset.price) * Number(e.querySelector('#quantity')?.innerHTML))
    })
    document.querySelector('.cart-total')!.innerHTML = `${total}`;
}
export async function fetchProducts() {
    // Retrieve items from localStorage
    const items = JSON.parse(localStorage.getItem('cart_items') || '[]');
    if (items.length) {

        let count = 0;
        // Extract the ids from the items
        const ids = items.map((item: any) => { count += item.quantity; return item.id });

        // Send the ids in the body of a POST request
        try {
            const response = await fetch('/_api/products', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                //ids is shorthand for ids: ids
                body: JSON.stringify({ ids }),
            });

            if (!response.ok) {
                throw new Error('Failed to fetch products');
            }

            const products = await response.json();
            console.log('Fetched products:', products);

            return products;
        } catch (error) {
            console.error('Error:', error);
            throw error
        }
    }
}
export function renderCartProducts(products: Array<Item>,) {
    const resultsDiv = document.getElementById('cart-results')!
    resultsDiv.replaceChildren();
    resultsDiv.addEventListener('scroll', (event) => {
        event.stopPropagation();
    });
    if (products && products.length) {
        products.forEach(product => {
            //@ts-ignore
            const bladeArrowSrc = arrowSrc;

            const items = JSON.parse(localStorage.getItem('cart_items') || '[]');

            const quantity = (items.find((item: any) => item.id == product.id)).quantity;
            const productCard = `
            <div id="c${product.id}" class="w-full mx-auto mb-2 flex border-y-[1px] border-x-[1px] border-gray-200 h-24  p-1 flex-shrink-0 cart-item" data-id="${product.id}" data-price="${Number(product.discounted_price ? product.discounted_price : product.price)}" id="b02" href="/product/${product.id}">
                <div class="relative mx-auto flex w-full h-full rounded-md p-1 justify-center">
                    <div class="flex w-16 h-full flex-shrink-0 mr-1">
                        <img  class="object-contain rounded -translate-y-0 h-full w-full my-auto " src="${fileUrl}/file/connect-store/product/${product.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" />
                    </div>
                    <div class="flex flex-col  justify-center w-full">
                        <div class="z-10 text-gray-800  text-base mr-2  line-clamp-2 my-auto">${product.name}</div>
                     
                    </div>
                    <div class=" sm:block my-auto sm:mr-4 ml-auto min-w-20">${Number(product.discounted_price ? product.discounted_price : product.price)} EGP</div>
                    <div class="flex flex-col mr-1 justify-center ml-auto">
                        <button id="" class=" cart-increment flex items-center justify-center increase quantityBtn" >
                            <img class="h-[.9rem] w-[.9rem] -translate-x-[1px] -rotate-90 -translate-y-1 m-auto opacity-40" src="${bladeArrowSrc}" alt="">
                        </button>
                        <div id="quantity" class="w-7 h-7 bg-white text-lg flex items-center justify-center border-[2px] border-gray-400 rounded-md p-0  ">
                            ${quantity}
                        </div>
                        <button id="" class=" cart-decrement flex items-center justify-center decrease quantityBtn" >
                            <img class="h-[.9rem] w-[.9rem] -translate-x-[1px]  rotate-90 translate-y-1 m-auto opacity-40" src="${bladeArrowSrc}" alt="">
                        </button>
                    </div>
                    <button class="bg-red-500 text-white h-7 w-7 flex flex-shrink-0 justify-center  pb-1 my-auto rounded-md ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 cart-remove" data-id="${product.id}">
                        x
                    </button>
                    </div>
                </div>
                
            </div>
        `;
            resultsDiv.classList.replace('hidden', 'flex');
            resultsDiv.innerHTML += productCard;
            document.querySelector('#cart-search-roller')?.classList.replace('block', 'hidden')
        })
        resultsDiv.querySelectorAll('.cart-item').forEach(
            cartItem => cartItem.querySelectorAll('.quantityBtn')!
                .forEach(quantityBtn => quantityBtn.addEventListener('click', async (e) => {
                    const target = e.currentTarget as HTMLElement

                    // Update the quantity if the item exists   
                    if (target.classList.contains('increase')) {
                        const result = await addToCartLocalStorage(Number((cartItem as HTMLElement).dataset.id))


                    }
                    if (target.classList.contains('decrease')) {
                        const result = await removeFromCartLocalStorage(Number((cartItem as HTMLElement).dataset.id), false)
                        //if(result) quantity.innerHTML = `${Number(quantity.innerHTML) - 1}`

                    }
                })))

        resultsDiv.querySelectorAll<HTMLElement>('.cart-item').forEach(
            cartItem => cartItem.querySelector('.cart-remove')!.addEventListener('click', (e) => {
                console.log('testing')
                let items: Array<any> = JSON.parse(localStorage.getItem('cart_items') || '[]');
                const existingItemIndex = items.findIndex((i: {id:number, quantity:number}) => i.id === Number(cartItem.dataset.id));

                if (existingItemIndex > -1) {

                    cartItem.remove();
                    removeFromCartLocalStorage(Number((cartItem as HTMLElement).dataset.id), true)

                }
            }))
    } else {

        document.querySelector('#cart-search-roller')?.classList.replace('block', 'hidden')
    }

    updateCartCount();
}

export async function addToCartLocalStorage(item_id: number, quantity?: number) {

    let items:Array<{id:number, quantity:number}> = JSON.parse(localStorage.getItem('cart_items') || '[]');
    const existingItemIndex = items.findIndex((i: any) => {return i.id === item_id});
    
    if (existingItemIndex > -1) {
    
        items[existingItemIndex].quantity += quantity || 1;
        localStorage.setItem('cart_items', JSON.stringify(items));
    
        if (document.getElementById('c' + item_id)!) {
            const quantity = document.getElementById('c' + item_id)!.querySelector("#quantity")!;
            quantity.innerHTML = `${items[existingItemIndex].quantity}`;

        }
    
        updateCartCount();
    } else {
        items.push({ id: Number(item_id), quantity: quantity || 1 });
        localStorage.setItem('cart_items', JSON.stringify(items));
        //fetch and rerender if there are new products
        const products = await fetchProducts()
        renderCartProducts(products);
    }
    return true;
}
async function removeFromCartLocalStorage(item_id: number, removeAll: boolean) {
    let items:Array<{id:number, quantity:number}> = JSON.parse(localStorage.getItem('cart_items') || '[]');
    const existingItemIndex = items.findIndex((i: any) => i.id === item_id);
    if (removeAll) {
        items.splice(existingItemIndex, 1);
    } else {
        console.log(existingItemIndex)
        if (items[existingItemIndex].quantity > 1) {
            items[existingItemIndex].quantity -= 1
            if (document.getElementById('c' + item_id)!) {
                const quantity = document.getElementById('c' + item_id)!.querySelector("#quantity")!;
                quantity.innerHTML = `${Number(quantity.innerHTML) - 1}`;

            }
        }
    }
    localStorage.setItem('cart_items', JSON.stringify(items));
    updateCartCount();
    return true;
}