import { filterField, product, productSpec } from "./types";
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