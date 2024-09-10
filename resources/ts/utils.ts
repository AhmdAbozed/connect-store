import { filterField, product, productSpec } from "./types";
import {Item, Recorder, systemSpecs, Camera, filteredItem, Cable, PDU } from "./types"
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

export class securityFilters{
    public static recordersId = 1;  
    public static camerasId = 2;  
    public static PDUsId = 3;  
    public static CablesId = 4;  
    public static accessoriesId = 5;  
    
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

    public static filterCameras(cameras: Array<Camera>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<Camera>> = [];
        let requiredAmps = 0;
        system.cameras.forEach((camera) => {
            requiredAmps += camera.amp
        })
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

    public static filterPDUs(PDUs: Array<PDU>, system: systemSpecs) {
        const filteredItems: Array<filteredItem<PDU>> = [];
        let requiredAmps = 0;
        system.cameras.forEach((camera) => {
            requiredAmps += camera.amp
        })
        PDUs.forEach((PDU: PDU) => {

            const specs = this.getSpecsString(PDU);

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
    public static filterCables(cables: Array<Cable>, system: systemSpecs) {
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
            if(system.cables.length == 8){
                filteredItems.push({ item: cable, specs: specs, compatibility: false, message: 'Max 8 cables' })
                return;
            }
            filteredItems.push({ item: cable, specs: specs, compatibility: true, message: null })
            return;

        })
        return filteredItems;
    }
}

export class mapComponents {

    public static mapRecorders(products:Array<any>) {
        //enum object probably because it's from a collection operation on laravel
        const recorders = Object.values(products).map((item: any) => {
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
        return recorders;
    }

    public static mapCameras(products:Array<any>) {
        
        console.log('filtring', products)
        const cameras = Object.values(products).map((item: any) => {
            console.log(item)
            console.log(JSON.parse(item.specifications));
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
        console.log(cameras)
        return cameras;
    }

    public static mapPDUs(products:Array<any>) {
        const PDUs = Object.values(products).map((item: any) => {
            const voltage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Voltage').specValue.replace(/\D/g, ''));
            const wattage = Number(JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Wattage').specValue.replace(/\D/g, ''));
            return {
                voltage: voltage,
                amp: wattage / voltage,
                ...item,
            } as PDU
        })
        return PDUs
    }

    public static  mapCables(products:Array<any>) {
        const cables = Object.values(products).map((item: any) => {
            const type = JSON.parse(item.specifications).find((spec: any) => spec.specName == 'Type').specValue;
            return {
                type: type,
                ...item,
            } as Cable
        })
        return cables;
    }
}
