function imageHandler(){
    const scrollArrows = document.querySelectorAll(".scroll-arrow") as NodeListOf<HTMLButtonElement>
    console.log(scrollArrows)
    function resetScrolls(){
        const imgSections = document.querySelectorAll(".scrollable").forEach((e)=>{
            e.scrollLeft = 0;
        })
    }
    resetScrolls();
    scrollArrows.forEach((element) => {
        console.log("hmm")
        element.addEventListener("click", (e) => {
            console.log('clciked')
            element.disabled = true;
            setTimeout(()=>{
                element.disabled = false
            }, 300)
            const target = e.currentTarget as HTMLImageElement
            const scrollableWrapper = target.parentElement!.querySelector('.scrollable')!;
            const direction = target.classList.contains('left-arrow') ? -1 : 1;
            const scrollWidth = scrollableWrapper.children[0].getBoundingClientRect().width!;
            console.log(scrollWidth)
            console.log(scrollableWrapper.scrollLeft)
            
            scrollableWrapper.scrollLeft += direction*scrollWidth;
        
            console.log(scrollableWrapper.scrollLeft)
        })
    })
    
    
}
imageHandler();