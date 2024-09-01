type systemSpecs = {
    recorder: Array<Recorder>,
    cameras: Array<Camera>,
    PDU: Array<PDU>,
    cables: Array<Cable>

}
type SystemComponent =
    Array<Recorder> |
    Array<Camera> |
    Array<PDU> |
    Array<Cable>;
interface Item {
    id: number;
    name: string;
    price: number;
    discount: number;
    specifications: string;
}

type Recorder = Item & {
    type: 'DVR' | 'NVR';
    channels: number;
    resolutionInMP: number;
};

type Camera = Item & {
    type: 'Analog' | 'IP';
    resolutionInMP: number;
    voltage: number;
    amp: number;
};

type Cable = Item & {
    type: 'Coaxial' | 'Ethernet';
};

type PDU = Item & {
    voltage: number;
    amp: number;
};

interface SystemSpecs {
    recorder: Array<Recorder>;
    cameras: Array<Camera>;
    PDU: Array<PDU>;
    cables: Array<Cable>;
}

type filteredItem<itemType> = {
    item: itemType;
    specs: string;
    compatibility: boolean;
    message: string | null;
}
let recorders: Array<Recorder> = [];
let cameras: Array<Camera> = [];
let PDUs: Array<PDU> = [];
let cables: Array<Cable> = [];
let accessories: Array<any> = [];
let securitySystem: systemSpecs = { recorder: [], cameras: [], PDU: [], cables: [] }
let fadeIn = false;
//@ts-ignore
const fileUrl = phpFileUrl;
//@ts-ignore
const fileToken = phpFileToken;
//@ts-ignore
const bladeViteAsset = phpViteAsset;  
function systemPreview() {
    function appendPreviewItems(items: Array<Item>, previewId: string):number {
        const previewElement = document.getElementById(previewId)!;
        let previewItemsHtml = '';
        let price = 0;
        items.forEach(item => {
            price += Number(item.discount ? item.discount : item.price)
            previewItemsHtml += `
                <div class="flex">
                    <div class=" line-clamp-2">${item.name}</div>
                    <div class="w-24 ml-auto text-end">+${item.discount ? item.discount : item.price} EGP</div>
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

    let totalPrice:number = 0;
    totalPrice += appendPreviewItems(securitySystem.recorder, 'previewRecorder');
    totalPrice += appendPreviewItems(securitySystem.cameras, 'previewCameras');
    totalPrice += appendPreviewItems(securitySystem.PDU, 'previewPDU');
    totalPrice += appendPreviewItems(securitySystem.cables, 'previewCables');
    document.getElementById('bottomTotal')!.innerHTML = `${totalPrice} EGP`;
    document.getElementById('popupTotal')!.innerHTML = `${totalPrice} EGP`;

}

function mapComponents() {

    function mapRecorders() {
        //@ts-ignore //enum object probably because it's from a collection operation on laravel
        recorders = Object.values(phpRecorders).map((item: any) => {
            const channels = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Channels').specValue.replace(/\D/g, ''));
            const resolutionInMP = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Resolution').specValue.replace(/\D/g, ''));
            let type = JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Type').specValue;
            //DVRs/NVRS => DVR/NVR
            type = type.slice(0, item.subcategory.name.length - 1);

            return {
                type: type,
                channels: channels,
                resolutionInMP: resolutionInMP,
                ...item
            }
        })
    }

    function mapCameras() {
        //@ts-ignore 
        cameras = Object.values(phpCameras).map((item: any) => {
            const voltage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Voltage').specValue.replace(/\D/g, ''));
            const wattage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Wattage').specValue.replace(/\D/g, ''));
            const resolutionInMP = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Resolution').specValue.replace(/\D/g, ''));
            let type = JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Type').specValue;
            //DVRs/NVRS => DVR/NVR
            type = type.slice(0, item.subcategory.name.length - 1);

            return {
                type: type,
                voltage: voltage,
                amp: wattage / voltage,
                resolutionInMP: resolutionInMP,
                ...item
            } as Camera
        })
    }

    function mapPDUs() {
        //@ts-ignore
        PDUs = Object.values(phpPDUs).map((item: any) => {
            const voltage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Voltage').specValue.replace(/\D/g, ''));
            const wattage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Wattage').specValue.replace(/\D/g, ''));
            return {
                voltage: voltage,
                amp: wattage / voltage,
                ...item,
            } as PDU
        })
    }

    function mapCables() {
        //@ts-ignore
        cables = Object.values(phpCables).map((item: any) => {
            const type = JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Type').specValue;
            return {
                type: type,
                ...item,
            } as Cable
        })
    }
    mapRecorders();
    mapCameras();
    mapCables();
    mapPDUs();
}

function renderComponents() {
    function getSpecsString(item: Item) {
        let specs = '';
        JSON.parse(item.specifications).forEach((spec: any) => {
            specs += spec.specValue + '  '
        })
        return specs;
    }
    function itemButtonHtml(filteredItem: filteredItem<any>, index: number, specs: string) {
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
    }
    function selectedItemHtml(selectedItem: any, index: number, length: number) {

        let specs = '';
        JSON.parse(selectedItem.specifications).forEach((spec: any, index:number) => {
            if(JSON.parse(selectedItem.specifications).length-1 != index){
                specs += spec.specValue + ' - '
            }else{
                specs += spec.specValue
            }
        })

        return `
            <div class="flex text-base sm:text-lg py-2 selectedItem ${(index != length - 1)||fadeIn ? '' : 'animate-fadeIn'} cursor-pointer border-white border-2 " data-index="${index}">
                <img src="${bladeViteAsset}" class="object-contain h-16 w-16 my-auto sm:h-24 sm:w-24" class="selectedItemImg"  />
                <div class="flex text-sm flex-col justify-center ml-4">
                    <div class="  font-semibold sm:text-xl text-black selectedItemTitle  line-clamp-2" > ${selectedItem.name} </div>
                    <div class="selectedItemSpecs sm:text-xl" > ${specs} </div>
                </div>
                <div class="flex flex-col ml-auto sm:flex-row">
                
                    <div class="ml-auto selectedItemPrice w-[5.5rem] sm:w-auto text-black flex items-center sm:mr-6 sm:my-0 my-auto" > +${selectedItem.discounted_price ? selectedItem.discounted_price : selectedItem.price} EGP</div>
                    
                </div>
                </div>
        `
    }
    function appendItemsToWrapper(itemsBody: HTMLElement, items: Array<filteredItem<Item>>) {

        let itemsHtml = '';
        let incompatibleItemsHtml = '';
        items.forEach((filteredItem, index) => {
            let specs = filteredItem.specs;
            const element = itemButtonHtml(filteredItem, index, specs)
            if (filteredItem.compatibility) {
                itemsHtml += element;
            } else {
                incompatibleItemsHtml += element;
            }
        })
        itemsBody.querySelector('.itemsWrapper')!.innerHTML = itemsHtml;
        itemsBody.querySelector('.incompatibleItemsWrapper')!.innerHTML = incompatibleItemsHtml;
    }
    function renderSelectedItems(itemsBody: HTMLElement, selectedItems: Array<Item>) {
        if (selectedItems.length) {
            itemsBody.querySelector('.noneSelected')?.classList.add('hidden')
            itemsBody.querySelector('.requiredAlert')?.classList.add('hidden')
            let selectedItemsHtml = '';
            selectedItems!.forEach((selectedItem, index) => {
                selectedItemsHtml += selectedItemHtml(selectedItem, index, selectedItems.length);
            })
            itemsBody.querySelector('.selectedItems')!.innerHTML = selectedItemsHtml;
            //add eventlisteners for remove selected button
            itemsBody.querySelectorAll('.selectedItem')!.forEach(item => {
                item.addEventListener('click', (e) => {

                    console.log(selectedItems)
                    
                    console.log(securitySystem)
                    
                    selectedItems.splice(Number((item as HTMLElement).dataset.index), 1);
                    console.log(selectedItems)
                    
                    console.log(securitySystem)
                    const scrollX = window.scrollX;
                    const scrollY = window.scrollY;
                    (e.currentTarget as HTMLElement).remove();
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
        }
    }
    function filterRecorders(recorders: Array<Recorder>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Recorder>> = [];
        recorders.forEach((recorder: Recorder) => {
            const specs = getSpecsString(recorder);
            if (system.cameras?.length) {
                const incompatibleCameraType: Camera | undefined = system.cameras.find((camera) => (camera.type == 'Analog' && recorder.type == 'NVR') || (camera.type == 'IP' && recorder.type == 'DVR'))
                const incompatibleCameraResolution = system.cameras.find((camera) => (camera.resolutionInMP > recorder.resolutionInMP))

                if (incompatibleCameraType) {
                    filteredItems.push({ item: recorder, specs: specs, compatibility: false, message: 'Incompatible type with: ' + incompatibleCameraType.name })
                    return;
                }
                else if (recorder.channels < system.cameras?.length) {
                    filteredItems.push({ item: recorder, specs: specs, compatibility: false, message: 'Not enough camera channels' })
                    return;
                }
                else if (incompatibleCameraResolution) {
                    filteredItems.push({ item: recorder, specs: specs, compatibility: false, message: 'Incompatible resolution with: ' + incompatibleCameraResolution.name })
                    return;
                }
                else {
                    filteredItems.push({ item: recorder, specs: specs, compatibility: true, message: null })
                    return;
                }
            }
            else {
                filteredItems.push({ item: recorder, specs: specs, compatibility: true, message: null })
                return;
            }
        })
        return filteredItems;
    }

    function filterCameras(cameras: Array<Camera>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Camera>> = [];
        let requiredAmps = 0;
        system.cameras.forEach((camera) => {
            requiredAmps += camera.amp
        })
        cameras.forEach((camera: Camera) => {

            const specs = getSpecsString(camera);
            if (system.recorder[0]) {
                if (system.cameras?.length >= system.recorder[0].channels) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Not enough camera channels in recorder' })
                    return;
                }
                else if ((camera.type == 'Analog' && system.recorder[0].type == 'NVR') || (camera.type == 'IP' && system.recorder[0].type == 'DVR')) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Incompatible type with recorder' })
                    return;
                }
                else if (camera.resolutionInMP > system.recorder[0].resolutionInMP) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Incompatible resolution with recorder' })
                    return;
                }

            }
            if (system.PDU[0]) {

                if (camera.voltage != system.PDU[0]?.voltage) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Incompatible voltage with PDU' })
                    return;
                }
                else if (requiredAmps + camera.amp > system.PDU[0]?.amp) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Not enough Amps in PDU for more cameras' })
                    return;
                }
            }
            if (system.cables.length) {
                const incompatibleCableType: Cable | undefined = system.cables.find((cable) => (camera.type == 'Analog' && cable.type == 'Ethernet') || (camera.type == 'IP' && cable.type == 'Coaxial'))
                if (incompatibleCableType) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Incompatible type with cable: ' + incompatibleCableType.name })
                    return;
                }
            }
            
            if(system.cameras.length == 8){
                filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Max 8 cameras' })
                return;
            }
            filteredItems.push({ item: camera, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }

    function filterPDUs(PDUs: Array<PDU>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<PDU>> = [];
        let requiredAmps = 0;
        system.cameras.forEach((camera) => {
            requiredAmps += camera.amp
        })
        PDUs.forEach((PDU: PDU) => {

            const specs = getSpecsString(PDU);

            if (system.cameras.length) {
                const incompatibleCameraVoltage: Camera | undefined = system.cameras.find((camera) => (camera.voltage != PDU.voltage))

                if (incompatibleCameraVoltage) {
                    filteredItems.push({ item: PDU, specs: specs, compatibility: false, message: 'Incompatible voltage with: ' + incompatibleCameraVoltage.name })
                    return;
                }
                else if (requiredAmps > PDU.amp) {
                    filteredItems.push({ item: PDU, specs: specs, compatibility: false, message: 'Not enough Amps. ' + requiredAmps + 'A Needed' })
                    return;
                }
            }
            filteredItems.push({ item: PDU, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }
    function filterCables(PDUs: Array<Cable>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Cable>> = [];
        cables.forEach((cable: Cable) => {
            const specs = getSpecsString(cable);
            if (system.cameras.length) {
                const incompatibleCameraType: Camera | undefined = system.cameras.find((camera) => (camera.type == 'Analog' && cable.type == 'Ethernet') || (camera.type == 'IP' && cable.type == 'Coaxial'))

                if (incompatibleCameraType) {
                    filteredItems.push({ item: cable, specs: specs, compatibility: false, message: 'Incompatible type with: ' + incompatibleCameraType.name })
                    return;
                }
            }
            if(system.cables.length == 8){
                filteredItems.push({ item: cable, specs: specs, compatibility: false, message: 'Max 8 cables' })
                return;
            }
            filteredItems.push({ item: cable, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }
    function renderItems(filteredItems: Array<filteredItem<any>>, systemComponent: Array<any>, componentId: string, isSingular: boolean) {
        const component = document.getElementById(componentId)!
        appendItemsToWrapper(component, filteredItems);
        component.querySelectorAll('.itemBtn').forEach((item: any) => {
            item.addEventListener('click', (e: any) => {
                const scrollX = window.scrollX;
                const scrollY = window.scrollY;
                if (isSingular) {
                    systemComponent[0] = filteredItems[item.dataset.index].item;
                } else {
                    systemComponent.push(filteredItems[item.dataset.index].item);
                }
                renderComponents();
                systemPreview();
                window.scrollTo(scrollX, scrollY)
            })
        })
        renderSelectedItems(component, systemComponent)
    }

    renderItems(filterRecorders(recorders, securitySystem), securitySystem.recorder, 'Video Recorder', true);
    renderItems(filterCameras(cameras, securitySystem), securitySystem.cameras, 'Cameras', false);
    renderItems(filterPDUs(PDUs, securitySystem), securitySystem.PDU, 'Power Supply', true);
    renderItems(filterCables(cables, securitySystem), securitySystem.cables, 'Camera Cables', false);

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
mapComponents();
renderComponents();