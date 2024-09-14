const m=phpFileToken,f=phpFileUrl;function o(){document.getElementById("cart-count").innerHTML="0";let r=JSON.parse(localStorage.getItem("cart_items")||"[]"),a=0;r.forEach(e=>{a+=Number(e.quantity)});const t=document.getElementById("cart-count");t.innerHTML=`${a}`,Number(t.innerHTML)?(t.classList.replace("hidden","block"),document.querySelector("#cart-checkout").disabled=!1):(t.classList.replace("block","hidden"),document.querySelector("#cart-checkout").disabled=!0),y()}function y(){const r=document.getElementById("cart-results");let a=0;r.querySelectorAll(".cart-item").forEach(t=>{var e;a+=Number(t.dataset.price)*Number((e=t.querySelector("#quantity"))==null?void 0:e.innerHTML)}),document.querySelector(".cart-total").innerHTML=`${a}`}async function g(){const r=JSON.parse(localStorage.getItem("cart_items")||"[]");if(r.length){let a=0;const t=r.map(e=>(a+=e.quantity,e.id));try{const e=await fetch("/_api/products",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({ids:t})});if(!e.ok)throw new Error("Failed to fetch products");const n=await e.json();return console.log("Fetched products:",n),n}catch(e){throw console.error("Error:",e),e}}}function h(r){var t;const a=document.getElementById("cart-results");a.replaceChildren(),a.addEventListener("scroll",e=>{e.stopPropagation()}),r&&r.length?(r.forEach(e=>{var l;const n=arrowSrc,c=JSON.parse(localStorage.getItem("cart_items")||"[]").find(u=>u.id==e.id).quantity,s=`
            <div id="c${e.id}" class="w-full mx-auto mb-2 flex border-y-[1px] border-x-[1px] border-gray-200 h-24  p-1 flex-shrink-0 cart-item" data-id="${e.id}" data-price="${Number(e.discounted_price?e.discounted_price:e.price)}" id="b02" href="/product/${e.id}">
                <div class="relative mx-auto flex w-full h-full rounded-md p-1 justify-center">
                    <div class="flex w-16 h-full flex-shrink-0 mr-1">
                        <img  class="object-contain rounded -translate-y-0 h-full w-full my-auto " src="${f}/file/connect-store/product/${e.img_id}/0?Authorization=${m}&b2ContentDisposition=attachment" />
                    </div>
                    <div class="flex flex-col  justify-center w-full">
                        <div class="z-10 text-gray-800  text-base mr-2  line-clamp-2 my-auto">${e.name}</div>
                     
                    </div>
                    <div class=" sm:block my-auto sm:mr-4 ml-auto min-w-20">${Number(e.discounted_price?e.discounted_price:e.price)} EGP</div>
                    <div class="flex flex-col mr-1 justify-center ml-auto">
                        <button id="" class=" cart-increment flex items-center justify-center increase quantityBtn" >
                            <img class="h-[.9rem] w-[.9rem] -translate-x-[1px] -rotate-90 -translate-y-1 m-auto opacity-40" src="${n}" alt="">
                        </button>
                        <div id="quantity" class="w-7 h-7 bg-white text-lg flex items-center justify-center border-[2px] border-gray-400 rounded-md p-0  ">
                            ${c}
                        </div>
                        <button id="" class=" cart-decrement flex items-center justify-center decrease quantityBtn" >
                            <img class="h-[.9rem] w-[.9rem] -translate-x-[1px]  rotate-90 translate-y-1 m-auto opacity-40" src="${n}" alt="">
                        </button>
                    </div>
                    <button class="bg-red-500 text-white h-7 w-7 flex flex-shrink-0 justify-center  pb-1 my-auto rounded-md ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 cart-remove" data-id="${e.id}">
                        x
                    </button>
                    </div>
                </div>
                
            </div>
        `;a.classList.replace("hidden","flex"),a.innerHTML+=s,(l=document.querySelector("#cart-search-roller"))==null||l.classList.replace("block","hidden")}),a.querySelectorAll(".cart-item").forEach(e=>e.querySelectorAll(".quantityBtn").forEach(n=>n.addEventListener("click",async i=>{const c=i.currentTarget;c.classList.contains("increase")&&await p(Number(e.dataset.id)),c.classList.contains("decrease")&&await d(Number(e.dataset.id),!1)}))),a.querySelectorAll(".cart-item").forEach(e=>e.querySelector(".cart-remove").addEventListener("click",n=>{console.log("testing"),JSON.parse(localStorage.getItem("cart_items")||"[]").findIndex(s=>s.id===Number(e.dataset.id))>-1&&(e.remove(),d(Number(e.dataset.id),!0))}))):(t=document.querySelector("#cart-search-roller"))==null||t.classList.replace("block","hidden"),o()}async function p(r,a){let t=JSON.parse(localStorage.getItem("cart_items")||"[]");const e=t.findIndex(n=>(console.log(n.id," ",r," ",n.id===r),n.id===r));if(e>-1){if(t[e].quantity+=a||1,localStorage.setItem("cart_items",JSON.stringify(t)),document.getElementById("c"+r)){const n=document.getElementById("c"+r).querySelector("#quantity");n.innerHTML=`${t[e].quantity}`}o()}else{t.push({id:Number(r),quantity:a||1}),localStorage.setItem("cart_items",JSON.stringify(t));const n=await g();h(n)}return!0}async function d(r,a){let t=JSON.parse(localStorage.getItem("cart_items")||"[]");const e=t.findIndex(n=>n.id===r);if(a)t.splice(e,1);else if(console.log(e),t[e].quantity>1&&(t[e].quantity-=1,document.getElementById("c"+r))){const n=document.getElementById("c"+r).querySelector("#quantity");n.innerHTML=`${Number(n.innerHTML)-1}`}return localStorage.setItem("cart_items",JSON.stringify(t)),o(),!0}export{p as a,g as f,h as r,o as u};
