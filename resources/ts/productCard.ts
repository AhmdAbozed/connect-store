import { addToCartLocalStorage } from "./cart";


document.querySelectorAll<HTMLButtonElement>('.addToCartBtn').forEach(element=>{
    element.addEventListener('click', async()=>{
        element.classList.add('bg-gray-800', 'text-white')
        element.querySelector('.addToCartText')!.innerHTML='Adding';
        element.disabled = true;
        const result = await addToCartLocalStorage(Number(element.dataset.id))
        element.querySelector('.check')?.classList.replace('hidden', 'block')
        element.querySelector('.addToCartText')!.innerHTML='Added';
        setTimeout(() => {
            element.classList.replace('bg-gray-800','bg-white');
            element.classList.replace('text-white', 'text-black');
            element.querySelector('.addToCartText')!.innerHTML='+ Add to Cart';
            element.disabled = false;
            element.querySelector('.check')?.classList.replace('block', 'hidden')
                
        }, 2000);
    });

})