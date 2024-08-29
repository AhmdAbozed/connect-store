
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
