import { Item } from "./types";

const resultsWrapper = document.getElementById('search-results-wrapper')!;
const searchWrapper = document.getElementById('search-wrapper')!;

//@ts-ignore 
const fileToken: Array<string> = phpFileToken;
//@ts-ignore
const fileUrl: Array<product> = phpFileUrl;
class searchHandler {
    public static handleClickOutsideSearch(event: any) {

        if (!searchWrapper.contains(event.target) && !(event.target.id == 'searchBtn') && !(event.target.id == 'searchBtnImg')) {
            if(window.innerWidth <= 1024) searchWrapper.classList.replace('flex', 'hidden');
            else resultsWrapper.classList.replace('flex', 'hidden');
        }else{
            searchWrapper.classList.replace('hidden', 'flex')
        }
    }
    public static async fetchSearchResults(query: string) {
        if (query.trim() === '') {
            resultsWrapper.classList.replace('flex', 'hidden');

            return;
        }

        try {
            const response = await fetch(`/_api/product/search?query=${encodeURIComponent(query)}`, { method: "POST" });
            const products = await response.json()
            console.log('Search results:', products);
            this.renderSearchResults(products)
        } catch (error) {
            console.error('Error fetching search results:', error);
        }
    }
    private static renderSearchResults(products: Array<Item>) {
        document.getElementById('search-roller')?.classList.replace('block', 'hidden')

        if (products.length) {
            document.getElementById('none-found')?.classList.replace('block', 'hidden')
            document.getElementById('search-results')?.replaceChildren()
            products.forEach((product) => {
                const priceElement = product.discounted_price ? `
                    <div class="w-full text-sm text-left flex mb-1">
            
                        <div class="z-10 text-xl font-semibold mr-1"> ${product.discounted_price} <span class="text-[.83rem]">EGP</span></div>
                        <div class="z-10 text-gray-400 line-through flex translate-y-[6px] text-[.83rem]"> ${product.price} EGP</div>
    
                    </div>`
                    :
                    `<div class="z-10  mt-1 text-blue-500 mb-auto" :> ${product.price} EGP</div>`;
                const productHtml = `
                    <a  class="sm:flex-row flex-col flex p-2 pr-3 border-b-[1px] border-r-[1px] h-[10rem] sm:h-[6.6rem] w-1/2 border-gray-300 animate-fadeIn">
                        <img  class="object-contain rounded -translate-y-0 mb-auto w-auto lg:w-28 h-16 lg:h-24 mr-4" src="${fileUrl}/file/connect-store/product/${product.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" />
                        <div class ="flex flex-col">
                            <div class="text-ellipsis line-clamp-2 leading-6 mb-auto">${product.name}</div>    
                            <div>${priceElement}</div>    
                        </div>
                    </a>
                `
                document.getElementById('search-results')?.insertAdjacentHTML('beforeend', productHtml);
            })

        } else {

            document.getElementById('none-found')?.classList.replace('hidden', 'block')
        }
    }

}
const searchInput = document.getElementById('search-input')!;

document.addEventListener('click', searchHandler.handleClickOutsideSearch)
document.getElementById('searchBtn')?.addEventListener('click',()=>{
    searchInput.classList.replace('hidden','flex');
})

let timeoutId: number;

// Attach the debounced function to the input event
searchInput.addEventListener('input', (e) => {
    document.getElementById('search-results')?.replaceChildren()
    document.getElementById('none-found')?.classList.replace('block', 'hidden')
    document.getElementById('search-roller')?.classList.replace('hidden', 'block')
    resultsWrapper.classList.replace('hidden', 'flex');
    if (timeoutId) clearTimeout(timeoutId);
    //@ts-ignore// May fix type error later
    timeoutId = setTimeout(() => searchHandler.fetchSearchResults(e.target.value), 1000);
});