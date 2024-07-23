const scrollable = document.getElementById("banners")!;
const dots = document.querySelectorAll(".dot");
console.log(scrollable)
scrollable.addEventListener("scroll", () => {
    const scrollLeft = scrollable.scrollLeft;
    //const scrollPosition = scrollable.scrollLeft / maxScrollLeft;
    const scrollWidth =scrollable.children[0].getBoundingClientRect().width!;
    
    console.log('heeelp: ', scrollLeft)
    console.log(Math.round( scrollLeft / (scrollWidth)));
    dots.forEach((dot, index) => {
        if (index == Math.round( scrollLeft / (scrollWidth))) {
            dot.classList.replace("bg-white","bg-blue-400");
            dot.classList.replace("border-gray-300","border-blue-400");
            
            dot.classList.replace("border-2","border-4");
        } else {
            dot.classList.replace("bg-blue-400", "bg-white");
            dot.classList.replace("border-blue-400","border-gray-300");
            dot.classList.replace("border-4","border-2");
        }
    });
});

// Initial state
dots[0].classList.replace("bg-white","bg-blue-400");

dots[0].classList.replace("bg-white","bg-blue-400");
dots[0].classList.replace("border-gray-300","border-blue-400");