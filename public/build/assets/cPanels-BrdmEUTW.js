function e(){document.querySelectorAll(".c-panel").forEach(n=>{n.classList.add("hidden")})}document.getElementById("new-product-button").addEventListener("click",()=>{e(),document.getElementById("new-product-panel").classList.remove("hidden")});document.getElementById("new-category-button").addEventListener("click",()=>{e(),document.getElementById("new-category-panel").classList.remove("hidden")});document.getElementById("new-brand-button").addEventListener("click",()=>{e(),document.getElementById("new-brand-panel").classList.remove("hidden")});
