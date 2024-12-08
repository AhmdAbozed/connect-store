import { filterField, product, productSpec } from "./types";
import { Item, Recorder, systemSpecs, Camera, filteredItem, Cable, PDU } from "./types"
export const getFilters = (categorySpecs: Array<any>, products: Array<product>) => {

    const specFilters: Array<filterField> = categorySpecs.map((spec) => { return { filterName: spec, filterChildren: [] } })
    products.forEach((product: any) => {

        const productSpecs: Array<productSpec> = JSON.parse(product.specifications);
        productSpecs.forEach((productSpec) => {
            //find product spec name that exists in category filters if any
            const filter = specFilters.find(filter => filter.filterName == productSpec.specName)
            if (filter) {
                //see if a filter check for this value already exists
                const filterChild = filter.filterChildren.find(child => child.value == productSpec.specValue)
                if (filterChild) {
                    //filter check already exists, increment number of products that have it 
                    filterChild.productCount += 1;
                } else {
                    //filther check doesn't exist, add it to the checks
                    filter.filterChildren.push({ value: productSpec.specValue, productCount: 1 })
                }
            }
        })
    });
    return specFilters;
}

export class securityFilters {
    public static recorderName = 'Video Recorders';
    public static cameraName = 'Security Cameras';
    public static PDUName = 'Power Supplies';
    public static cableName = 'Camera Cables';
    public static accName = 'Surveillance Equipment';
    public static monitorName = 'Monitors';
    public static hddName = 'Hard Drives';
    public static switchesName = 'Network Switches';
    
    
    public static getSpecsString(item: Item) {
        let specs = '';
        JSON.parse(item.specifications).forEach((spec: any) => {
            specs += spec.specValue + '  '
        })
        return specs;
    }
    public static filterRecorders(recorders: Array<Recorder>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Recorder>> = [];
        recorders.forEach((recorder: Recorder) => {
            const specs = this.getSpecsString(recorder);
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

    public static filterCameras(cameras: Array<any>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Camera>> = [];
        cameras.forEach((camera: Camera) => {

            const specs = this.getSpecsString(camera);
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
           
            if (system.cables.length) {
                const incompatibleCableType: Cable | undefined = system.cables.find((cable) => (camera.type == 'Analog' && cable.type == 'Ethernet') || (camera.type == 'IP' && cable.type == 'Coaxial'))
                if (incompatibleCableType) {
                    filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Incompatible type with cable: ' + incompatibleCableType.name })
                    return;
                }
            }

            if (system.cameras.length == 8) {
                filteredItems.push({ item: camera, specs: specs, compatibility: false, message: 'Max 8 cameras' })
                return;
            }
            filteredItems.push({ item: camera, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }

  
    public static filterCables(cables: Array<any>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Cable>> = [];
        cables.forEach((cable: Cable) => {
            const specs = this.getSpecsString(cable);
            if (system.cameras.length) {
                const incompatibleCameraType: Camera | undefined = system.cameras.find((camera) => (camera.type == 'Analog' && cable.type == 'Ethernet') || (camera.type == 'IP' && cable.type == 'Coaxial'))

                if (incompatibleCameraType) {
                    filteredItems.push({ item: cable, specs: specs, compatibility: false, message: 'Incompatible type with: ' + incompatibleCameraType.name })
                    return;
                }
            }
            if (system.cables.length == 8) {
                filteredItems.push({ item: cable, specs: specs, compatibility: false, message: 'Max 8 cables' })
                return;
            }
            filteredItems.push({ item: cable, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }
    public static noFilters(items: Array<any>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Item>> = [];
        items.forEach((item: Item) => {
            const specs = this.getSpecsString(item);
            filteredItems.push({ item: item, specs: specs, compatibility: true, message: null })
        })
        return filteredItems;
    }
}

export class mapComponents {

    public static mapRecorders(products: Array<any>) {
        const recorders = Object.values(products).map((item: any) => {
            const specs = JSON.parse(item.specifications);
            const channelsSpec = specs.find((spec: any) => spec.specName === 'Channel Number');
            const resolutionSpec = specs.find((spec: any) => spec.specName === 'Resolution');
            const typeSpec = specs.find((spec: any) => spec.specName === 'Type');

            if (!channelsSpec || !resolutionSpec || !typeSpec) {
                return null;
            }

            const channels = Number(channelsSpec.specValue.replace(/\D/g, ''));
            const resolutionInMP = Number(resolutionSpec.specValue.replace(/\D/g, ''));
            let type = typeSpec.specValue;
            type = type.slice(0, item.subcategory.name.length - 1);

            return {
                type,
                channels,
                resolutionInMP,
                ...item
            };
        }).filter(item => item !== null);

        return recorders;
    }

    public static mapCameras(products: Array<any>) {
        const cameras = Object.values(products).map((item: any) => {
            const specs = JSON.parse(item.specifications);
            const resolutionSpec = specs.find((spec: any) => spec.specName === 'Resolution');
            const typeSpec = specs.find((spec: any) => spec.specName === 'Camera Types');

            if (!resolutionSpec || !typeSpec) {
                return null;
            }
            const resolutionInMP = Number(resolutionSpec.specValue.replace(/\D/g, ''));
            let type = typeSpec.specValue;
            type = type.slice(0, item.subcategory.name.length - 1);

            return {
                type,
                resolutionInMP,
                ...item
            } as Camera;
        }).filter(item => item !== null);

        return cameras;
    }

    public static mapCables(products: Array<any>) {
        const cables = Object.values(products).map((item: any) => {
            const specs = JSON.parse(item.specifications);
            const typeSpec = specs.find((spec: any) => spec.specName === 'Cable Type');

            if (!typeSpec) {
                return null;
            }

            const type = typeSpec.specValue;

            return {
                type,
                ...item,
            } as Cable;
        }).filter(item => item !== null);

        return cables;
    }
}

export async function signout(){
    
    const response = await fetch('/_api/user/signout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({}) // Sending an empty JSON object
    });

    const data = await response.text();
    if (response.status === 200) {
        window.location.href = '/login'
    } else {
        console.error('Error:', response.statusText);
        return false;
    }
}