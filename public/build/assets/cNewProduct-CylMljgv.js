let r=[];const h=()=>{document.getElementById("image-input").addEventListener("change",function(d){const c=Array.from(d.target.files);if(r.length+c.length>3){alert("You can only upload 3 images for a product.");return}console.log("before push, ",c),c.forEach(t=>r.push(t)),s()})};function v(d){var c;(c=document.getElementById("category-select"))==null||c.addEventListener("change",t=>{const e=t.target,n=Number(e.value),o=d.find(i=>i.id==n);console.log(d);const l=JSON.parse(o.specifications);l.length&&(document.getElementById("specificationInputs").replaceChildren(),l.forEach(i=>{p(i)}))})}function s(){const d=document.getElementById("preview-container");d.innerHTML="",r.forEach((c,t)=>{const e=document.createElement("div");e.classList.add("relative","border","border-gray-200","p-1","rounded","flex","items-center","justify-center");const n=document.createElement("img");n.src=URL.createObjectURL(c),n.onload=function(){URL.revokeObjectURL(n.src)},n.classList.add("object-cover","w-full","h-full","rounded");const o=document.createElement("button");o.innerHTML="&times;",o.classList.add("absolute","top-0","right-0","bg-red-500","text-white","rounded-full","w-6","h-6","flex","items-center","justify-center","text-xs","hover:bg-red-700"),o.addEventListener("click",function(){r.splice(t,1),s()}),e.appendChild(n),e.appendChild(o),d.appendChild(e)})}const p=function(d){const c=document.createElement("div");c.className="flex space-x-4 items-center product-specification";const t=document.createElement("input");t.type="text",t.placeholder="Specification",t.className="w-full p-2 border border-gray-300 rounded-lg",t.required=!0,d&&(t.value=d);const e=document.createElement("input");e.type="text",e.placeholder="Value",e.required=!0,e.className="w-full p-2 border border-gray-300 rounded-lg";const n=document.createElement("button");n.type="button",n.innerText="X",n.className="bg-red-500 text-white py-2 px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400",n.addEventListener("click",function(){c.remove()}),c.appendChild(t),c.appendChild(e),c.appendChild(n),document.getElementById("specificationInputs").appendChild(c)},y=()=>{p(),document.getElementById("add-inputs-btn").addEventListener("click",function(d){d.preventDefault(),p()})},b=()=>{const d=async c=>{console.log(r),c.preventDefault();const t=c.target,e=t.querySelector(".result"),n=t.querySelector(".submit-btn");n.disabled=!0,n.innerHTML="Submitting...",e.classList.add("hidden");try{const o=new FormData;r.forEach(a=>{a.type.match("^image/")&&o.append("Images[]",a)}),o.append("Name",t.elements.productName.value),o.append("Price",t.elements.productPrice.value),o.append("Discounted_price",t.elements.discountedPrice.value),o.append("Stock",t.elements.stock.value),o.append("Category_id",t.elements.category.value),o.append("Updating_id",t.elements.UpdatingId.value);const i=Array.from(document.querySelectorAll(".product-specification")).map(a=>({specName:a.children[0].value,specValue:a.children[1].value}));console.log(i),o.append("Specifications",JSON.stringify(i));const m={method:"POST",headers:{"Access-Control-Allow-Credentials":"true",Accept:"multipart/form-data"},credentials:"include",body:o};t.reset();const f=location.protocol+"//"+location.host+"/_api/product/",u=await fetch(f,m),g=await u.json();n.innerHTML="Submit",n.disabled=!1,r=[],s(),e.classList.remove("hidden"),u.status===200?(e.children[0].innerHTML="Product Added.",e.children[1].classList.remove("hidden"),e.children[1].href=window.location.protocol+"//"+window.location.hostname+(window.location.port?":"+window.location.port:"")+"/product/"+g.id):(e.children[0].innerHTML="Failed to add product. Code: "+u.status,e.children[1].classList.add("hidden"))}catch(o){throw console.log(o),r=[],s(),n.innerHTML="Submit",n.disabled=!1,e.classList.remove("hidden"),e.children[0].innerHTML="Failed to add product. Unknown Error",e.children[1].classList.add("hidden"),o}};document.getElementById("new-product-panel").addEventListener("submit",d)};h();y();b();const L=phpCategories;v(L);
