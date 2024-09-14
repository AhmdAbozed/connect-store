function imageHandler(){
    const scrollArrows = document.querySelectorAll(".scroll-arrow") as NodeListOf<HTMLButtonElement>
    function resetScrolls(){
        const imgSections = document.querySelectorAll(".scrollable").forEach((e)=>{
            e.scrollLeft = 0;
        })
    }
    resetScrolls();
    scrollArrows.forEach((element) => {
        element.addEventListener("click", (e) => {
            element.disabled = true;
            setTimeout(()=>{
                element.disabled = false
            }, 300)
            const target = e.currentTarget as HTMLImageElement
            const scrollableWrapper = target.parentElement!.querySelector('.scrollable')!;
            const direction = target.classList.contains('left-arrow') ? -1 : 1;
            const scrollWidth = scrollableWrapper.children[0].getBoundingClientRect().width!;
            scrollableWrapper.scrollLeft += direction*scrollWidth;
        
        })
    })
    
    
}
imageHandler();