const filterPanelHandler = () => {
    const sidebar = document.getElementById('filters-sidebar-wrapper')!;
    document.getElementById('filters-button')?.addEventListener('click', () => {
        console.log('clicky')
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.replace('hidden', 'flex');
        } else {
            sidebar.classList.replace('flex', 'hidden');
        }
    })

    document.getElementById('filter-overlay')?.addEventListener('click', () => {
        sidebar.classList.replace('flex', 'hidden');
    })
}

type product = {
    id: number,
    name: string,
    price: number,
    discounted_price: number,
    specifications: string,
    created_at: string,
    img_id: string
}
type productSpec = { specName: string, specValue: string };
type filterChild = { value: string, productCount: number };
type filterField = { filterName: string, filterChildren: Array<filterChild> };

const setFilterValues = (specFilters: Array<filterField>, products: Array<product>) => {

    products.forEach((product: any) => {

        const productSpecs: Array<productSpec> = JSON.parse(product.specifications);
        productSpecs.forEach((productSpec) => {
            //find product spec name that exists in category filters if any
            const filter = specFilters.find(filter => filter.filterName == productSpec.specName)
            if (filter) {
                //see if a filter check for this value already exists
                const filterChild = filter.filterChildren.find(child => child.value == productSpec.specValue)
                if (filterChild) {
                    //filter check already exists, increment number of products for that have it 
                    filterChild.productCount += 1;
                } else {
                    //filther check doesn't exist, add it to the checks
                    filter.filterChildren.push({ value: productSpec.specValue, productCount: 1 })
                }
            }
        })
    });
}
const updateProductFilters = () => {
    const filteredProducts = filterProducts(getFilterValues(), bladeProducts, Number(minPrice), Number(maxPrice));
    createProductCards(filteredProducts);
}
const generateFilterHtml = (specFilters: Array<filterField>, products: Array<product>) => {

    let filtersContainer: HTMLElement;
    console.log(window.innerWidth)
    if (window.innerWidth <= 640) {
        filtersContainer = document.getElementById('filters-sidebar')!;
    } else {
        filtersContainer = document.getElementById('filters-lg')!;
    }
    specFilters.forEach(filter => {
        // Create a fieldset for each filterName
        if (filter.filterChildren.length) {
            const fieldset = document.createElement('fieldset');
            fieldset.className = ' rounded-md  py-1  text-sm border-b-2 border-gray-300 filterset';
            const legend = document.createElement('legend');
            legend.textContent = filter.filterName;
            legend.className = 'px-2 py-1 text-base font-semibold -top-4 w-full border-gray-300';
            fieldset.appendChild(legend);

            // Create checkboxes for each filterChild
            filter.filterChildren.forEach(child => {
                const label = document.createElement('label');
                label.className = 'flex items-center mb-2 ';

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = filter.filterName;
                checkbox.value = child.value;
                checkbox.className = 'form-checkbox text-blue-500 h-4 w-4 translate-y-[1px] mr-2 ml-5';
                checkbox.addEventListener('change', function (e) {
                    if (this.checked) {
                        const target = e.target as HTMLInputElement
                        const checkboxes = target.parentElement!.parentElement!.querySelectorAll('input')
                        checkboxes.forEach((cb) => {
                            if (cb !== this) cb.checked = false;
                        });
                    }
                    updateProductFilters();
                })
                const text = `${child.value} <span class="ml-1 inline-block text-gray-400">(${child.productCount})</span>`

                label.appendChild(checkbox);
                label.insertAdjacentHTML('beforeend', text);
                fieldset.appendChild(label);
            });

            // Append the fieldset to the container
            console.log(filtersContainer)
            console.log(fieldset)
            filtersContainer.appendChild(fieldset);
            console.log('it is ', filtersContainer)
        }
    });
}
const getFilterValues = () => {
    const filterSets = document.querySelectorAll('.filterset')
    console.log(filterSets)
    const filterParameters: Array<productSpec> = [];
    filterSets.forEach((filterSet) => {
        const filterName = filterSet.querySelector('legend')?.innerText;
        console.log(JSON.stringify(filterName))

        const filterCheckbox = (filterSet.querySelector('label input:checked') as HTMLInputElement)
        console.log(filterCheckbox)

        if (filterName && filterCheckbox) filterParameters.push({ specName: filterName, specValue: filterCheckbox.value })
    })
    return filterParameters
}
const sortProducts = (products: Array<product>) => {
    const sortBy = (document.getElementById('sort-by') as HTMLSelectElement).value as "highest" | 'lowest' | 'newest' | 'unsorted'
    if (sortBy != 'unsorted') {
        products.sort((a, b) => {
            const priceA = a.discounted_price ?? a.price;
            const priceB = b.discounted_price ?? b.price;

            switch (sortBy) {

                case "highest":
                    return priceB - priceA;
                case "lowest":
                    return priceA - priceB;
                case "newest":
                    return (new Date(a.created_at)).getTime() - (new Date(b.created_at)).getTime();; // No sorting if sortBy doesn't match "highest" or "lowest"
            }
        })
    }
}
const filterProducts = (specFilters: Array<productSpec>, products: Array<product>, minPrice: number, maxPrice: number) => {
    const filteredProducts = products.filter((product) => {
        const productPrice = product.discounted_price ?? product.price;

        if (!minPrice) minPrice = 0

        if (!maxPrice) maxPrice = 10000000
        if (productPrice < minPrice || productPrice > maxPrice) {
            return false;
        }

        // Filter by price range

        console.log('spec is', JSON.parse(product.specifications))
        console.log('filters are ', specFilters)
        const passedFilter = specFilters.every((filter) => {
            const result = JSON.parse(product.specifications).some((specification: productSpec) => {
                return specification.specName == filter.specName && specification.specValue == filter.specValue

            })
            console.log('result is ', result)
            return JSON.parse(product.specifications).some((specification: productSpec) => {
                //console.log('first check', specification.specValue == filter.specValue)
                //console.log(specification.specName == filter.specName)
                return specification.specName == filter.specName && specification.specValue == filter.specValue
            })
        })

        return passedFilter;
    });
    sortProducts(filteredProducts)
    return filteredProducts;
}

function createProductCards(products: Array<product>) {
    // Calculate discount percentage if discounted_price exists
    if (document.getElementById("products-wrapper")) {
        document.getElementById("products-wrapper")?.remove();
    }
    const wrapper = document.createElement("section")
    wrapper.className = "grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 p-1 pr-0";
    wrapper.id = "products-wrapper";
    console.log(products)
    products.forEach((product) => {
        let discountPercentage = null;
        if (product.discounted_price) {
            discountPercentage = Math.round((1 - (product.discounted_price / product.price)) * 100);
        }

        // Create the card structure

        //@ts-ignore //to use blade variable in ts file, i reassign it in ts so its not undefined to the editor 
        const fileToken: Array<string> = phpFileToken;
        //@ts-ignore
        const fileUrl: Array<product> = phpFileUrl;
        const productCard = `
            <a class="scroll-img w-full  border-t-[1px] border-r-[1px] border-gray-200  p-1 flex-shrink-0" id="b02" href="/product/${product.id}">
                <div class="relative flex flex-col h-full rounded-md">
                    ${discountPercentage ? `<div class="z-20 text-xs m-1 absolute top-0 rounded-md px-[4px] py-1 bg-blue-400 text-white text-center font-medium">${discountPercentage}% OFF</div>` : ''}
                    <img src="${fileUrl}/file/connect-store/product/${product.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" class="object-contain rounded -translate-y-0" />
                    <div class="z-10 text-gray-800 mx-auto text-sm text-center px-1 line-clamp-2">${product.name}</div>
                    ${product.discounted_price ?
                `<div class="z-10 mx-auto text-sm text-center mt-auto text-blue-500">EGP ${product.discounted_price.toLocaleString()}</div>
                        <div class="z-10 mx-auto text-sm text-center text-gray-400 line-through mb-2">EGP ${product.price.toLocaleString()}</div>` :
                `<div class="z-10 mx-auto text-sm text-center mt-1 text-blue-500 mb-auto">EGP ${product.price.toLocaleString()}</div>`
            }
                </div>
            </a>
        `;

        // Append to the container
        wrapper.insertAdjacentHTML('beforeend', productCard);

    })
    document.getElementById('main-content')?.append(wrapper)
}
function setPrice(e:any){
const target = e.target as HTMLButtonElement;
const newMin = Number((target.parentElement?.querySelector('#min-price') as HTMLInputElement).value)
const newMax = Number((target.parentElement?.querySelector('#max-price') as HTMLInputElement).value)
newMin ? minPrice = newMin : minPrice = 0;
newMax ? maxPrice = newMax : maxPrice = 9999999;
updateProductFilters();
}
//@ts-ignore //to use blade variable in ts file, i reassign it in ts so its not undefined to the editor 
const bladeCategorySpecs: Array<string> = JSON.parse(phpCategorySpecs);
//@ts-ignore
const bladeProducts: Array<product> = phpProducts;
let minPrice = 0;
let maxPrice = 9999999;
const specFilters: Array<filterField> = bladeCategorySpecs.map((spec) => { return { filterName: spec, filterChildren: [] } })
filterPanelHandler();
createProductCards(bladeProducts);
setFilterValues(specFilters, bladeProducts);
generateFilterHtml(specFilters, bladeProducts);
document.getElementById('set-price')?.addEventListener('click', setPrice);
document.getElementById('set-price-lg')?.addEventListener('click', setPrice);
document.getElementById('sort-by')?.addEventListener('change', updateProductFilters);

