
import { Item, Recorder, systemSpecs, Camera, filteredItem, Cable, PDU } from "./types"
import { securityFilters, mapComponents } from "./utils";
/*
let recorders: Array<Recorder> = mapComponents.mapRecorders(phpRecorders);
let cameras: Array<Camera> = mapComponents.mapRecorders(phpCameras);
let PDUs: Array<PDU> = mapComponents.mapRecorders(phpPDUs);
let cables: Array<Cable> = mapComponents.mapRecorders(phpCables);
let accessories: Array<any> = mapComponents.mapRecorders(phpAccessories);
*/
let securitySystem: systemSpecs = localStorage.getItem('securitySystem') ? JSON.parse(localStorage.getItem('securitySystem')!) : { recorder: [], cameras: [], PDU: [], cables: [] }
let fadeIn = false;
//@ts-ignore
const fileUrl = phpFileUrl;
//@ts-ignore
const fileToken = phpFileToken;
//@ts-ignore
const bladeViteAsset = phpViteAsset;
function systemPreview() {
    function appendPreviewItems(items: Array<Item>, previewId: string): number {
        const previewElement = document.getElementById(previewId)!;
        let previewItemsHtml = '';
        let price = 0;
        items.forEach(item => {
            price += Number(item.discounted_price ? item.discounted_price : item.price)
            previewItemsHtml += `
                <div class="flex">
                    <div class=" line-clamp-2">${item.name}</div>
                    <div class="w-24 ml-auto text-end">+${item.discounted_price ? item.discounted_price : item.price} EGP</div>
                </div>
            `
        })
        previewElement.querySelector('.previewItems')!.innerHTML = previewItemsHtml
        if (items.length) {
            document.getElementById(previewId)!.querySelector('.previewRequired')?.classList.add('hidden')
            document.getElementById(previewId)!.querySelector('.noneSelected')?.classList.add('hidden')
        } else {
            document.getElementById(previewId)!.querySelector('.previewRequired')?.classList.remove('hidden')
            document.getElementById(previewId)!.querySelector('.noneSelected')?.classList.remove('hidden')
        }
        console.log('price isssss', price)
        return price;
    }

    let totalPrice: number = 0;
    totalPrice += appendPreviewItems(securitySystem.recorder, 'previewRecorder');
    totalPrice += appendPreviewItems(securitySystem.cameras, 'previewCameras');
    totalPrice += appendPreviewItems(securitySystem.PDU, 'previewPDU');
    totalPrice += appendPreviewItems(securitySystem.cables, 'previewCables');
    document.getElementById('bottomTotal')!.innerHTML = `${totalPrice} EGP`;
    document.getElementById('popupTotal')!.innerHTML = `${totalPrice} EGP`;

}

function renderComponents() {

    /*function itemButtonHtml(filteredItem: filteredItem<any>, index: number, specs: string) {
        return `<button class="bg-white border-2 h-28 sm:h-24 ${filteredItem.compatibility ? 'hover:border-gray-400' : 'cursor-default'} border-gray-200 text-start px-1 sm:px-2 py-2  flex mb-2 ${filteredItem.compatibility ? 'itemBtn' : ''}" id="${filteredItem.item.id}" data-index="${index}" data-compatibility="${filteredItem.compatibility}">
        <div class="flex">
            <img src="${bladeViteAsset}" class="object-contain h-16 w-16 sm:h-20 sm:w-20 my-auto" />
            <div class="flex  flex-col text-sm sm:text-base  justify-center ml-4">
                <div class="  sm:text-lg text-black line-clamp-2" >${filteredItem.item.name} </div>
                <div class="text-gray-600" > ${specs} </div>
                <div class=" text-red-500 text-sm line-clamp-2">${filteredItem.compatibility ? '' : filteredItem.message}</div>
            </div>
        </div>
        <div class="ml-auto text-black flex items-center w-[5.5rem] sm:w-auto text-sm sm:text-lg sm:mr-4 justify-center">+${filteredItem.item.discounted_price ? filteredItem.item.discounted_price : filteredItem.item.price} EGP</div>
    </button>`
    }*/
    function selectedItemHtml(selectedItem: any, index: number, length: number) {

        let specs = '';
        JSON.parse(selectedItem.specifications).forEach((spec: any, index: number) => {
            if (JSON.parse(selectedItem.specifications).length - 1 != index) {
                specs += spec.specValue + ' - '
            } else {
                specs += spec.specValue
            }
        })

        return `
            <div class="flex text-base sm:text-lg py-2 selectedItem ${(index != length - 1) || fadeIn ? '' : 'animate-fadeIn'} cursor-pointer border-white border-2 " >
                <img src="${fileUrl}/file/connect-store/product/${selectedItem.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" class="object-contain h-16 w-16 my-auto sm:h-24 sm:w-24" class="selectedItemImg"  />
                <div class="flex text-sm flex-col justify-center ml-4">
                    <div class="  font-semibold sm:text-xl text-black selectedItemTitle  line-clamp-2" > ${selectedItem.name} </div>
                    <div class="selectedItemSpecs sm:text-xl" > ${specs} </div>
                </div>
                <div class="flex flex-col ml-auto sm:flex-row">
                
                    <div class="ml-auto selectedItemPrice w-[5.5rem] sm:w-auto text-black flex items-center sm:mr-6 sm:my-0 my-auto" > +${selectedItem.discounted_price ? selectedItem.discounted_price : selectedItem.price} EGP</div>
                    
                </div>
                <button class='selectedItemRemove bg-red-600 font-semibold text-white w-8 h-8 my-auto rounded-full text-2xl' data-index="${index}"><span class="-translate-y-[3px] block">x</span></button>
            </div>
        `
    }
    function renderSelectedItems(componentId: string, selectedItems: Array<Item>) {
        const itemsBody = document.getElementById(componentId)!
        console.log(componentId);
        if (selectedItems.length) {
            itemsBody.querySelector('.noneSelected')?.classList.add('hidden')
            itemsBody.querySelector('.requiredAlert')?.classList.add('hidden')
            itemsBody.querySelector('.titleSelectBtn')!.classList.remove('hidden')
            if (selectedItems[0].subcategory_id == securityFilters.recordersId || selectedItems[0].subcategory_id == securityFilters.PDUsId) {
                itemsBody.querySelector('.titleSelectBtn')!.innerHTML = 'Change Component';
            }
            else {
                itemsBody.querySelector('.titleSelectBtn')!.innerHTML = 'Add More';
            }

            itemsBody.querySelector('.selectBtn')?.classList.add('hidden')


            let selectedItemsHtml = '';
            selectedItems!.forEach((selectedItem, index) => {
                console.log(selectedItem)
                selectedItemsHtml += selectedItemHtml(selectedItem, index, selectedItems.length);
            })
            itemsBody.querySelector('.selectedItems')!.innerHTML = selectedItemsHtml;
            //add eventlisteners for remove selected button
            itemsBody.querySelectorAll('.selectedItemRemove')!.forEach(item => {
                item.addEventListener('click', (e) => {

                    console.log(selectedItems)

                    console.log((item as HTMLElement).dataset.index)
                    selectedItems.splice(Number((item as HTMLElement).dataset.index), 1);
                    localStorage.setItem('securitySystem', JSON.stringify(securitySystem));
                    console.log(selectedItems)

                    console.log(securitySystem)
                    const scrollX = window.scrollX;
                    const scrollY = window.scrollY;
                    (e.currentTarget as HTMLElement).parentElement!.remove();
                    fadeIn = true;
                    renderComponents();
                    fadeIn = false;
                    systemPreview();
                    window.scrollTo(scrollX, scrollY);
                })
            })
        }
        else {
            itemsBody.querySelector('.noneSelected')?.classList.remove('hidden')
            itemsBody.querySelector('.requiredAlert')?.classList.remove('hidden')
            itemsBody.querySelector('.titleSelectBtn')?.classList.add('hidden')
            itemsBody.querySelector('.selectBtn')?.classList.remove('hidden')

        }
    }
    console.log(securitySystem)
    renderSelectedItems('Video Recorder', securitySystem.recorder);
    renderSelectedItems('Cameras', securitySystem.cameras);
    renderSelectedItems('Power Supply', securitySystem.PDU);
    renderSelectedItems('Cables', securitySystem.cables);
    systemPreview();

}

const orderWindow = document.getElementById('order-popup')!;
document.getElementById('close-order')?.addEventListener('click', (e) => {
    e.preventDefault()
    orderWindow.classList.add('hidden')
})

document.getElementById('previewBtn')?.addEventListener('click', (e) => {
    e.preventDefault()
    orderWindow.classList.remove('hidden')
})
document.getElementById('order-wrapper')?.addEventListener('click', (e) => {
    if ((e.target as HTMLElement).id == 'order-overlay') {
        orderWindow.classList.add('hidden')
    }
})
renderComponents();