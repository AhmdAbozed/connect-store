
import { addToCartLocalStorage } from "./cart";
import { Item, systemSpecs } from "./types"
import { securityFilters } from "./utils";
addToCartLocalStorage
let securitySystem: systemSpecs = localStorage.getItem('securitySystem') ? JSON.parse(localStorage.getItem('securitySystem')!) : { recorder: [], cameras: [], PDU: [], cables: [], monitor: [], hdd: [], accessories: [] }
let fadeIn = false;
//@ts-ignore
const fileUrl = phpFileUrl;
//@ts-ignore
const fileToken = phpFileToken;
//@ts-ignore
const bladeViteAsset = phpViteAsset;
function setPowerType() {
    const powerElement = document.getElementById(securityFilters.PDUName)!;

    if (securitySystem.recorder.length) {

        powerElement.classList.replace('hidden', 'block')
        if (securitySystem.recorder[0].specifications.includes('DVR')) {
            if (securitySystem.PDU.length) {
                //@ts-ignore
                if (securitySystem.PDU[0].subcategory.name == securityFilters.switchesName) {
                    securitySystem.PDU = [];
                }
            }
            powerElement.querySelector('.componentTitle')!.innerHTML = 'Power Supply'
            //@ts-ignore
            powerElement.querySelector('.componentHref')!.setAttribute('href', `/categories/1/subcategories/${phpPDUId}/builder`); console.log(phpPDUId)
        } else {
            if (securitySystem.PDU.length) {
                //@ts-ignore
                if (securitySystem.PDU[0].subcategory.name == securityFilters.PDUName) {
                    securitySystem.PDU = [];
                }
            }
            powerElement.querySelector('.componentTitle')!.innerHTML = 'Network Switch'
            //@ts-ignore
            powerElement.querySelector('.componentHref')!.setAttribute('href', `/categories/1/subcategories/${phpSwitchesId}/builder`);

        }
    } else {
        powerElement.classList.replace('block', 'hidden')
        securitySystem.PDU = [];

    }
}
setPowerType()
function addBuildToCart() {

    Object.entries(securitySystem).forEach(([key, value]) => {
        if (Array.isArray(value)) {
            value.forEach(item => {
                if (item.id !== undefined) {
                    addToCartLocalStorage(item.id)
                    const orderWindow = document.getElementById('builder-order-popup')!;
                    orderWindow.classList.add('hidden')
                }
            });
        }
    });
}
document.getElementById('previewCartBtn')?.addEventListener('click', addBuildToCart);
document.getElementById('order-form')?.addEventListener('submit', (e) => { e.preventDefault() });
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
        return price;
    }

    let totalPrice: number = 0;
    totalPrice += appendPreviewItems(securitySystem.recorder, 'previewRecorder');
    totalPrice += appendPreviewItems(securitySystem.cameras, 'previewCameras');
    totalPrice += appendPreviewItems(securitySystem.PDU, 'previewPDU');
    totalPrice += appendPreviewItems(securitySystem.cables, 'previewCables');
    totalPrice += appendPreviewItems(securitySystem.monitor, 'previewMonitor');
    totalPrice += appendPreviewItems(securitySystem.hdd, 'previewHdd');
    totalPrice += appendPreviewItems(securitySystem.accessories, 'previewAccessories');
    document.getElementById('bottomTotal')!.innerHTML = `${totalPrice} EGP`;
    document.getElementById('popupTotal')!.innerHTML = `${totalPrice} EGP`;

}

function renderComponents() {

    function selectedItemHtml(selectedItem: any, index: number, length: number) {



        return `
            <div class="flex text-base sm:text-lg py-2 selectedItem ${(index != length - 1) || fadeIn ? '' : 'animate-fadeIn'} cursor-pointer border-white border-2 " >
                <img src="${fileUrl}/file/connect-store/product/${selectedItem.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" class="object-contain h-16 w-16 my-auto sm:h-24 sm:w-24" class="selectedItemImg"  />
                <div class="flex text-sm flex-col justify-center ml-4">
                    <div class="  font-semibold sm:text-xl text-black selectedItemTitle  line-clamp-2" > ${selectedItem.name} </div>
                    <div class="selectedItemSpecs sm:text-xl" > </div>
                </div>
                <div class="flex flex-col ml-auto sm:flex-row">
                
                    <div class="ml-auto selectedItemPrice w-[5.5rem] sm:w-auto text-black flex items-center sm:mr-6 sm:my-0 my-auto" > +${selectedItem.discounted_price ? selectedItem.discounted_price : selectedItem.price} EGP</div>
                    
                </div>
                <button class='selectedItemRemove bg-red-600 font-semibold text-white w-8 h-8 my-auto rounded-full text-xl flex items-center justify-center pb-[1px]' data-index="${index}">x</button>
            </div>
        `
    }
    function renderSelectedItems(componentElementId: string, selectedItems: Array<Item>, multipleParts: boolean) {

        const itemsBody = document.getElementById(componentElementId)!
        if (selectedItems.length) {
            itemsBody.querySelector('.noneSelected')?.classList.add('hidden')
            itemsBody.querySelector('.requiredAlert')?.classList.add('hidden')
            itemsBody.querySelector('.titleSelectBtn')!.classList.remove('hidden')
            if (multipleParts) {
                itemsBody.querySelector('.titleSelectBtn')!.innerHTML = 'Add More';
            }
            else {
                itemsBody.querySelector('.titleSelectBtn')!.innerHTML = 'Change Component';

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
                    selectedItems.splice(Number((item as HTMLElement).dataset.index), 1);
                    localStorage.setItem('securitySystem', JSON.stringify(securitySystem));
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
    //this function assumes an element with provided id exists, fills it with the corresponding item in securitySystem
    renderSelectedItems(securityFilters.recorderName, securitySystem.recorder, false);
    renderSelectedItems(securityFilters.cameraName, securitySystem.cameras, true);
    renderSelectedItems(securityFilters.PDUName, securitySystem.PDU, false);
    renderSelectedItems(securityFilters.cableName, securitySystem.cables, true);
    renderSelectedItems(securityFilters.accName, securitySystem.accessories, true)
    renderSelectedItems(securityFilters.monitorName, securitySystem.monitor, false)
    renderSelectedItems(securityFilters.hddName, securitySystem.hdd, false)

    systemPreview();

}

const orderWindow = document.getElementById('builder-order-popup')!;
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