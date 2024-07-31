function hidePanels(){
    const newPanels = document.querySelectorAll('.c-panel')
    newPanels.forEach(e=>{
        e.classList.add('hidden')
    });
}
document.getElementById('new-product-button')!.addEventListener('click',()=>{
    hidePanels()
    document.getElementById('new-product-panel')!.classList.remove('hidden')
    
})

document.getElementById('new-category-button')!.addEventListener('click',()=>{
    hidePanels()
    document.getElementById('new-category-panel')!.classList.remove('hidden')
})


document.getElementById('new-brand-button')!.addEventListener('click',()=>{
    hidePanels()
    document.getElementById('new-brand-panel')!.classList.remove('hidden')
})