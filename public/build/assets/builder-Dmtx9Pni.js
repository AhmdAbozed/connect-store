let T=[],$=[],C=[],E=[],d={recorder:[],cameras:[],PDU:[],cables:[]},N=!1;phpFileUrl;phpFileToken;const I=phpViteAsset;function V(){function c(w,y){var m,u,p,s;const n=document.getElementById(y);let f="",g=0;return w.forEach(e=>{g+=Number(e.discount?e.discount:e.price),f+=`
                <div class="flex">
                    <div class=" line-clamp-2">${e.name}</div>
                    <div class="w-24 ml-auto text-end">+${e.discount?e.discount:e.price} EGP</div>
                </div>
            `}),n.querySelector(".previewItems").innerHTML=f,w.length?((m=document.getElementById(y).querySelector(".previewRequired"))==null||m.classList.add("hidden"),(u=document.getElementById(y).querySelector(".noneSelected"))==null||u.classList.add("hidden")):((p=document.getElementById(y).querySelector(".previewRequired"))==null||p.classList.remove("hidden"),(s=document.getElementById(y).querySelector(".noneSelected"))==null||s.classList.remove("hidden")),console.log("price isssss",g),g}let b=0;b+=c(d.recorder,"previewRecorder"),b+=c(d.cameras,"previewCameras"),b+=c(d.PDU,"previewPDU"),b+=c(d.cables,"previewCables"),document.getElementById("bottomTotal").innerHTML=`${b} EGP`,document.getElementById("popupTotal").innerHTML=`${b} EGP`}function O(){function c(){T=Object.values(phpRecorders).map(n=>{const f=Number(JSON.parse(n.specifications).find(u=>u.specName=="Channels").specValue.replace(/\D/g,"")),g=Number(JSON.parse(n.specifications).find(u=>u.specName=="Resolution").specValue.replace(/\D/g,""));let m=JSON.parse(n.specifications).find(u=>u.specName=="Type").specValue;return m=m.slice(0,n.subcategory.name.length-1),{type:m,channels:f,resolutionInMP:g,...n}})}function b(){$=Object.values(phpCameras).map(n=>{const f=Number(JSON.parse(n.specifications).find(p=>p.specName=="Voltage").specValue.replace(/\D/g,"")),g=Number(JSON.parse(n.specifications).find(p=>p.specName=="Wattage").specValue.replace(/\D/g,"")),m=Number(JSON.parse(n.specifications).find(p=>p.specName=="Resolution").specValue.replace(/\D/g,""));let u=JSON.parse(n.specifications).find(p=>p.specName=="Type").specValue;return u=u.slice(0,n.subcategory.name.length-1),{type:u,voltage:f,amp:g/f,resolutionInMP:m,...n}})}function w(){C=Object.values(phpPDUs).map(n=>{const f=Number(JSON.parse(n.specifications).find(m=>m.specName=="Voltage").specValue.replace(/\D/g,"")),g=Number(JSON.parse(n.specifications).find(m=>m.specName=="Wattage").specValue.replace(/\D/g,""));return{voltage:f,amp:g/f,...n}})}function y(){E=Object.values(phpCables).map(n=>({type:JSON.parse(n.specifications).find(g=>g.specName=="Type").specValue,...n}))}c(),b(),y(),w()}function S(){function c(s){let e="";return JSON.parse(s.specifications).forEach(i=>{e+=i.specValue+"  "}),e}function b(s,e,i){return`<button class="bg-white border-2 h-28 sm:h-24 ${s.compatibility?"hover:border-gray-400":"cursor-default"} border-gray-200 text-start px-1 sm:px-2 py-2  flex mb-2 ${s.compatibility?"itemBtn":""}" id="${s.item.id}" data-index="${e}" data-compatibility="${s.compatibility}">
        <div class="flex">
            <img src="${I}" class="object-contain h-16 w-16 sm:h-20 sm:w-20 my-auto" />
            <div class="flex  flex-col text-sm sm:text-base  justify-center ml-4">
                <div class="  sm:text-lg text-black line-clamp-2" >${s.item.name} </div>
                <div class="text-gray-600" > ${i} </div>
                <div class=" text-red-500 text-sm line-clamp-2">${s.compatibility?"":s.message}</div>
            </div>
        </div>
        <div class="ml-auto text-black flex items-center w-[5.5rem] sm:w-auto text-sm sm:text-lg sm:mr-4 justify-center">+${s.item.discounted_price?s.item.discounted_price:s.item.price} EGP</div>
    </button>`}function w(s,e,i){let a="";return JSON.parse(s.specifications).forEach((t,l)=>{JSON.parse(s.specifications).length-1!=l?a+=t.specValue+" - ":a+=t.specValue}),`
            <div class="flex text-base sm:text-lg py-2 selectedItem ${e!=i-1||N?"":"animate-fadeIn"} cursor-pointer border-white border-2 " data-index="${e}">
                <img src="${I}" class="object-contain h-16 w-16 my-auto sm:h-24 sm:w-24" class="selectedItemImg"  />
                <div class="flex text-sm flex-col justify-center ml-4">
                    <div class="  font-semibold sm:text-xl text-black selectedItemTitle  line-clamp-2" > ${s.name} </div>
                    <div class="selectedItemSpecs sm:text-xl" > ${a} </div>
                </div>
                <div class="flex flex-col ml-auto sm:flex-row">
                
                    <div class="ml-auto selectedItemPrice w-[5.5rem] sm:w-auto text-black flex items-center sm:mr-6 sm:my-0 my-auto" > +${s.discounted_price?s.discounted_price:s.price} EGP</div>
                    
                </div>
                </div>
        `}function y(s,e){let i="",a="";e.forEach((t,l)=>{let r=t.specs;const o=b(t,l,r);t.compatibility?i+=o:a+=o}),s.querySelector(".itemsWrapper").innerHTML=i,s.querySelector(".incompatibleItemsWrapper").innerHTML=a}function n(s,e){var i,a,t,l;if(e.length){(i=s.querySelector(".noneSelected"))==null||i.classList.add("hidden"),(a=s.querySelector(".requiredAlert"))==null||a.classList.add("hidden");let r="";e.forEach((o,h)=>{r+=w(o,h,e.length)}),s.querySelector(".selectedItems").innerHTML=r,s.querySelectorAll(".selectedItem").forEach(o=>{o.addEventListener("click",h=>{console.log(e),console.log(d),e.splice(Number(o.dataset.index),1),console.log(e),console.log(d);const v=window.scrollX,x=window.scrollY;h.currentTarget.remove(),N=!0,S(),N=!1,V(),window.scrollTo(v,x)})})}else(t=s.querySelector(".noneSelected"))==null||t.classList.remove("hidden"),(l=s.querySelector(".requiredAlert"))==null||l.classList.remove("hidden")}function f(s,e){const i=[];return s.forEach(a=>{var l,r;const t=c(a);if((l=e.cameras)!=null&&l.length){const o=e.cameras.find(v=>v.type=="Analog"&&a.type=="NVR"||v.type=="IP"&&a.type=="DVR"),h=e.cameras.find(v=>v.resolutionInMP>a.resolutionInMP);if(o){i.push({item:a,specs:t,compatibility:!1,message:"Incompatible type with: "+o.name});return}else if(a.channels<((r=e.cameras)==null?void 0:r.length)){i.push({item:a,specs:t,compatibility:!1,message:"Not enough camera channels"});return}else if(h){i.push({item:a,specs:t,compatibility:!1,message:"Incompatible resolution with: "+h.name});return}else{i.push({item:a,specs:t,compatibility:!0,message:null});return}}else{i.push({item:a,specs:t,compatibility:!0,message:null});return}}),i}function g(s,e){const i=[];let a=0;return e.cameras.forEach(t=>{a+=t.amp}),s.forEach(t=>{var r,o,h;const l=c(t);if(e.recorder[0]){if(((r=e.cameras)==null?void 0:r.length)>=e.recorder[0].channels){i.push({item:t,specs:l,compatibility:!1,message:"Not enough camera channels in recorder"});return}else if(t.type=="Analog"&&e.recorder[0].type=="NVR"||t.type=="IP"&&e.recorder[0].type=="DVR"){i.push({item:t,specs:l,compatibility:!1,message:"Incompatible type with recorder"});return}else if(t.resolutionInMP>e.recorder[0].resolutionInMP){i.push({item:t,specs:l,compatibility:!1,message:"Incompatible resolution with recorder"});return}}if(e.PDU[0]){if(t.voltage!=((o=e.PDU[0])==null?void 0:o.voltage)){i.push({item:t,specs:l,compatibility:!1,message:"Incompatible voltage with PDU"});return}else if(a+t.amp>((h=e.PDU[0])==null?void 0:h.amp)){i.push({item:t,specs:l,compatibility:!1,message:"Not enough Amps in PDU for more cameras"});return}}if(e.cables.length){const v=e.cables.find(x=>t.type=="Analog"&&x.type=="Ethernet"||t.type=="IP"&&x.type=="Coaxial");if(v){i.push({item:t,specs:l,compatibility:!1,message:"Incompatible type with cable: "+v.name});return}}if(e.cameras.length==8){i.push({item:t,specs:l,compatibility:!1,message:"Max 8 cameras"});return}i.push({item:t,specs:l,compatibility:!0,message:null})}),i}function m(s,e){const i=[];let a=0;return e.cameras.forEach(t=>{a+=t.amp}),s.forEach(t=>{const l=c(t);if(e.cameras.length){const r=e.cameras.find(o=>o.voltage!=t.voltage);if(r){i.push({item:t,specs:l,compatibility:!1,message:"Incompatible voltage with: "+r.name});return}else if(a>t.amp){i.push({item:t,specs:l,compatibility:!1,message:"Not enough Amps. "+a+"A Needed"});return}}i.push({item:t,specs:l,compatibility:!0,message:null})}),i}function u(s,e){const i=[];return E.forEach(a=>{const t=c(a);if(e.cameras.length){const l=e.cameras.find(r=>r.type=="Analog"&&a.type=="Ethernet"||r.type=="IP"&&a.type=="Coaxial");if(l){i.push({item:a,specs:t,compatibility:!1,message:"Incompatible type with: "+l.name});return}}if(e.cables.length==8){i.push({item:a,specs:t,compatibility:!1,message:"Max 8 cables"});return}i.push({item:a,specs:t,compatibility:!0,message:null})}),i}function p(s,e,i,a){const t=document.getElementById(i);y(t,s),t.querySelectorAll(".itemBtn").forEach(l=>{l.addEventListener("click",r=>{const o=window.scrollX,h=window.scrollY;a?e[0]=s[l.dataset.index].item:e.push(s[l.dataset.index].item),S(),V(),window.scrollTo(o,h)})}),n(t,e)}p(f(T,d),d.recorder,"Video Recorder",!0),p(g($,d),d.cameras,"Cameras",!1),p(m(C,d),d.PDU,"Power Supply",!0),p(u(E,d),d.cables,"Camera Cables",!1)}const P=document.getElementById("order-popup");var L;(L=document.getElementById("close-order"))==null||L.addEventListener("click",c=>{c.preventDefault(),P.classList.add("hidden")});var q;(q=document.getElementById("previewBtn"))==null||q.addEventListener("click",c=>{c.preventDefault(),P.classList.remove("hidden")});var D;(D=document.getElementById("order-wrapper"))==null||D.addEventListener("click",c=>{c.target.id=="order-overlay"&&P.classList.add("hidden")});O();S();
