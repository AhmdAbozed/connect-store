import{s as S}from"./utils-B3iq3xPc.js";let o=localStorage.getItem("securitySystem")?JSON.parse(localStorage.getItem("securitySystem")):{recorder:[],cameras:[],PDU:[],cables:[]},v=!1;const B=phpFileUrl,I=phpFileToken;phpViteAsset;function h(){function r(l,e){var i,m,u,p;const t=document.getElementById(e);let n="",d=0;return l.forEach(c=>{d+=Number(c.discounted_price?c.discounted_price:c.price),n+=`
                <div class="flex">
                    <div class=" line-clamp-2">${c.name}</div>
                    <div class="w-24 ml-auto text-end">+${c.discounted_price?c.discounted_price:c.price} EGP</div>
                </div>
            `}),t.querySelector(".previewItems").innerHTML=n,l.length?((i=document.getElementById(e).querySelector(".previewRequired"))==null||i.classList.add("hidden"),(m=document.getElementById(e).querySelector(".noneSelected"))==null||m.classList.add("hidden")):((u=document.getElementById(e).querySelector(".previewRequired"))==null||u.classList.remove("hidden"),(p=document.getElementById(e).querySelector(".noneSelected"))==null||p.classList.remove("hidden")),console.log("price isssss",d),d}let s=0;s+=r(o.recorder,"previewRecorder"),s+=r(o.cameras,"previewCameras"),s+=r(o.PDU,"previewPDU"),s+=r(o.cables,"previewCables"),document.getElementById("bottomTotal").innerHTML=`${s} EGP`,document.getElementById("popupTotal").innerHTML=`${s} EGP`}function L(){function r(l,e,t){let n="";return JSON.parse(l.specifications).forEach((d,i)=>{JSON.parse(l.specifications).length-1!=i?n+=d.specValue+" - ":n+=d.specValue}),`
            <div class="flex text-base sm:text-lg py-2 selectedItem ${e!=t-1||v?"":"animate-fadeIn"} cursor-pointer border-white border-2 " >
                <img src="${B}/file/connect-store/product/${l.img_id}/0?Authorization=${I}&b2ContentDisposition=attachment" class="object-contain h-16 w-16 my-auto sm:h-24 sm:w-24" class="selectedItemImg"  />
                <div class="flex text-sm flex-col justify-center ml-4">
                    <div class="  font-semibold sm:text-xl text-black selectedItemTitle  line-clamp-2" > ${l.name} </div>
                    <div class="selectedItemSpecs sm:text-xl" > ${n} </div>
                </div>
                <div class="flex flex-col ml-auto sm:flex-row">
                
                    <div class="ml-auto selectedItemPrice w-[5.5rem] sm:w-auto text-black flex items-center sm:mr-6 sm:my-0 my-auto" > +${l.discounted_price?l.discounted_price:l.price} EGP</div>
                    
                </div>
                <button class='selectedItemRemove bg-red-600 font-semibold text-white w-8 h-8 my-auto rounded-full text-2xl' data-index="${e}"><span class="-translate-y-[3px] block">x</span></button>
            </div>
        `}function s(l,e){var n,d,i,m,u,p,c;const t=document.getElementById(l);if(console.log(l),e.length){(n=t.querySelector(".noneSelected"))==null||n.classList.add("hidden"),(d=t.querySelector(".requiredAlert"))==null||d.classList.add("hidden"),t.querySelector(".titleSelectBtn").classList.remove("hidden"),e[0].subcategory_id==S.recordersId||e[0].subcategory_id==S.PDUsId?t.querySelector(".titleSelectBtn").innerHTML="Change Component":t.querySelector(".titleSelectBtn").innerHTML="Add More",(i=t.querySelector(".selectBtn"))==null||i.classList.add("hidden");let f="";e.forEach((a,y)=>{console.log(a),f+=r(a,y,e.length)}),t.querySelector(".selectedItems").innerHTML=f,t.querySelectorAll(".selectedItemRemove").forEach(a=>{a.addEventListener("click",y=>{console.log(e),console.log(a.dataset.index),e.splice(Number(a.dataset.index),1),localStorage.setItem("securitySystem",JSON.stringify(o)),console.log(e),console.log(o);const b=window.scrollX,q=window.scrollY;y.currentTarget.parentElement.remove(),v=!0,L(),v=!1,h(),window.scrollTo(b,q)})})}else(m=t.querySelector(".noneSelected"))==null||m.classList.remove("hidden"),(u=t.querySelector(".requiredAlert"))==null||u.classList.remove("hidden"),(p=t.querySelector(".titleSelectBtn"))==null||p.classList.add("hidden"),(c=t.querySelector(".selectBtn"))==null||c.classList.remove("hidden")}console.log(o),s("Video Recorder",o.recorder),s("Cameras",o.cameras),s("Power Supply",o.PDU),s("Cables",o.cables),h()}const g=document.getElementById("order-popup");var w;(w=document.getElementById("close-order"))==null||w.addEventListener("click",r=>{r.preventDefault(),g.classList.add("hidden")});var E;(E=document.getElementById("previewBtn"))==null||E.addEventListener("click",r=>{r.preventDefault(),g.classList.remove("hidden")});var x;(x=document.getElementById("order-wrapper"))==null||x.addEventListener("click",r=>{r.target.id=="order-overlay"&&g.classList.add("hidden")});L();
