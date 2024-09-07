
export type product = {
    id: number,
    name: string,
    price: number,
    discounted_price: number,
    specifications: string,
    created_at: string,
    img_id: string
}
export type productSpec = { specName: string, specValue: string };
export type filterChild = { value: string, productCount: number };
export type filterField = { filterName: string, filterChildren: Array<filterChild> };
export type systemSpecs = {
    
    [key: string]: any;
    recorder: Array<Recorder>,
    cameras: Array<Camera>,
    PDU: Array<PDU>,
    cables: Array<Cable>

}
export type SystemComponent =
    Array<Recorder> |
    Array<Camera> |
    Array<PDU> |
    Array<Cable>;
    export interface Item {
    id: number;
    name: string;
    price: number;
    discounted_price: number;
    specifications: string;
    subcategory_id: number;
}

export type Recorder = Item & {
    type: 'DVR' | 'NVR';
    channels: number;
    resolutionInMP: number;
};

export type Camera = Item & {
    type: 'Analog' | 'IP';
    resolutionInMP: number;
    voltage: number;
    amp: number;
};

export type Cable = Item & {
    type: 'Coaxial' | 'Ethernet';
};

export type PDU = Item & {
    voltage: number;
    amp: number;
};

export interface SystemSpecs {
    recorder: Array<Recorder>;
    cameras: Array<Camera>;
    PDU: Array<PDU>;
    cables: Array<Cable>;
}

export type filteredItem<itemType> = {
    item: itemType;
    specs: string;
    compatibility: boolean;
    message: string | null;
}