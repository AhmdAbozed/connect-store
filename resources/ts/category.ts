import { filterField, filteredItem, product, productSpec, systemSpecs } from "./types";
import { getFilters, mapComponents, securityFilters } from "./utils";
const filterPanelHandler = () => {
    const sidebar = document.getElementById('filters-sidebar-wrapper')!;
    document.getElementById('filters-button')?.addEventListener('click', () => {
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
            filtersContainer.appendChild(fieldset);
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
    if (bladeBuildingSecSystem) {
        wrapper.className = "flex flex-col p-1"
    } else {
        wrapper.className = "grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 p-1 pr-0";
    }
    wrapper.id = "products-wrapper";
    let builderComponents: Array<filteredItem<any>> | undefined;

    const securitySystem: systemSpecs = localStorage.getItem('securitySystem') ? JSON.parse(localStorage.getItem('securitySystem')!) : { recorder: [], cameras: [], PDU: [], cables: [], monitor: [], hdd: [], accessories: [] };
    //@ts-ignore 
    const fileToken: Array<string> = phpFileToken;
    //@ts-ignore
    const fileUrl: Array<product> = phpFileUrl;

    if (bladeBuildingSecSystem) {
        //picking a builder component, builder display

        console.log(bladeSubcategory.name == securityFilters.cameraName)
        switch (bladeSubcategory.name) {
            case securityFilters.recorderName: builderComponents = securityFilters.filterRecorders(mapComponents.mapRecorders(products), securitySystem); break;
            case securityFilters.cameraName: builderComponents = securityFilters.filterCameras(mapComponents.mapCameras(products), securitySystem); break;
            case securityFilters.cableName: builderComponents = securityFilters.filterCables(mapComponents.mapCables(products), securitySystem); break;
            default: builderComponents = securityFilters.noFilters(products, securitySystem); break;
        }

        //sort incompatible to bottom
        builderComponents.sort((a: filteredItem<any>, b: filteredItem<any>) => {
            //+ converts boolean to number so ts doesn't complain
            return +b.compatibility - +a.compatibility;
        });
        builderComponents.forEach((product) => {
            let specsDiv = '';

            JSON.parse(product.item.specifications).forEach((spec: any) => {
                if (bladeSubcategorySpecs.includes(spec.specName)) {
                    specsDiv += `<div class="mb-1">${spec.specName}: <span class="font-normal">${spec.specValue}</span></div>`;

                }
            });
            let discountPercentage = null;
            if (product.item.discounted_price) {
                discountPercentage = Math.round((1 - (product.item.discounted_price / product.item.price)) * 100);
            }
            function getcomponentType(name: string) {
                switch (name) {
                    case securityFilters.recorderName: return 'recorder';
                    case securityFilters.cameraName: return 'cameras';
                    case securityFilters.PDUName: return 'PDU';
                    case securityFilters.switchesName: return 'PDU';
                    case securityFilters.cableName: return 'cables';
                    case securityFilters.monitorName: return 'monitor';
                    case securityFilters.accName: return 'accessories';
                    case securityFilters.hddName: return 'hdd';

                }
            }
            const disabled = product.compatibility ? '' : 'disabled';
            const priceElement = product.item.discounted_price ? `
            <div class="ml-auto my-auto mx-auto text-lg translate-y-1">
                <div class="z-10   text-center my-auto text-blue-500 ml-auto">${product.item.discounted_price.toLocaleString()} EGP </div>
                <div class="z-10   text-center text-gray-400 line-through mb-2">${product.item.price.toLocaleString()} EGP </div>
            </div>`:
                `<div class="ml-auto my-auto mx-auto text-lg text-blue-500">${product.item.price.toLocaleString()} EGP </div>`;
            const productCard = `
            <div class="lg:w-full w-11/12 mx-auto mb-2 flex lg:block border-y-[1px] border-x-[1px] border-gray-200  p-1 flex-shrink-0" id="b02" href="/product/${product.item.id}">
                <div class="relative mx-auto flex flex-col lg:flex-row w-full lg:w-auto h-full rounded-md p-2 ">
                    ${discountPercentage ? `<div class="z-20 text-xs m-1 absolute top-0 rounded-md px-[4px] py-1 bg-blue-400 text-white text-center font-medium">${discountPercentage}% OFF</div>` : ''}
                    <div class="flex mx-auto  lg:mx-0">
                        <img  class="object-contain rounded -translate-y-0 h-36 my-auto w-36 lg:ml-4 lg:w-36 mr-4" src="${fileUrl}/file/connect-store/product/${product.item.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" />
                            <div class="block lg:hidden text-lg my-auto">${priceElement}</div>
                    </div>
                    <div class="flex flex-col lg:mx-0 mx-auto max-w-[22rem]  w-full justify-between ">
                        <div class="z-10 text-gray-800  text-lg px-1 line-clamp-2 mb-4 lg:text-left ">${product.item.name}</div>
                        <div class="grid grid-cols-2 mb-4  lg:w-full lg:-translate-y-3 lg:max-w-full lg:mx-2 lg:mb-0">
                            ${specsDiv}
                        </div>
                        <div class="text-red-600 line-clamp-2 w-[20rem] lg:w-auto">${product.compatibility ? '' : product.message}</div>
                    </div>
                    <div class="hidden lg:block lg:my-auto lg:mr-4 lg:ml-auto">${priceElement}</div>
                    <button class=" rounded-xl  p-2 text-white  text-center mx-auto lg:mx-0 my-auto ${product.compatibility ? 'bg-blue-600' : 'bg-blue-200'}   h-auto w-40 selectComponentBtn" ${disabled} data-type="${getcomponentType(product.item.subcategory.name)}" id="${product.item.id}">Select Component</button>
     
                </div>
                
            </div>
        `;
            wrapper.insertAdjacentHTML('beforeend', productCard);
        })
    } else {
        //not picking a builder component, normal display
        products.forEach((product) => {
            let discountPercentage = null;
            if (product.discounted_price) {
                discountPercentage = Math.round((1 - (product.discounted_price / product.price)) * 100);
            }

            // Create the card structure
            const productCard = `
                <a class="scroll-img w-full  border-t-[1px] border-r-[1px] border-gray-200  p-1 flex-shrink-0" id="b02" href="/product/${product.id}">
                    <div class="relative flex flex-col h-full rounded-md">
                        ${discountPercentage ? `<div class="z-20 text-xs m-1 absolute top-0 rounded-md px-[4px] py-1 bg-blue-400 text-white text-center font-medium">${discountPercentage}% OFF</div>` : ''}
                        <img  class="object-contain rounded -translate-y-0 h-52" src="${fileUrl}/file/connect-store/product/${product.img_id}/0?Authorization=${fileToken}&b2ContentDisposition=attachment" />
                        <div class="z-10 text-gray-800 mx-auto text-sm text-center px-1 line-clamp-2">${product.name}</div>
                        ${product.discounted_price ?
                    `<div class="z-10 mx-auto text-sm text-center mt-auto text-blue-500">${product.discounted_price.toLocaleString()} EGP </div>
                            <div class="z-10 mx-auto text-sm text-center text-gray-400 line-through mb-2">${product.price.toLocaleString()} EGP </div>` :
                    `<div class="z-10 mx-auto text-sm text-center mt-1 text-blue-500 mb-auto">${product.price.toLocaleString()} EGP </div>`
                }
                    </div>
                </a>
            `;
            wrapper.insertAdjacentHTML('beforeend', productCard);
        })
    }
    document.getElementById('main-content')?.append(wrapper)
    document.querySelectorAll('.selectComponentBtn').forEach((element: any) => {
        element.addEventListener('click', (e: any) => {
            if (e.target.dataset.type == 'cameras' || e.target.dataset.type == 'cables' || e.target.dataset.type == 'accessories') {
                securitySystem[e.target.dataset.type as string].push((builderComponents!.find(component => component.item.id == e.target.id))!.item)
            } else {
                securitySystem[e.target.dataset.type as string] = [builderComponents!.find(component => component.item.id == e.target.id)!.item]

            }
            console.log(securitySystem[e.target.dataset.type as string]);
            localStorage.setItem('securitySystem', JSON.stringify(securitySystem));
            window.location.href = '/builder'
        })
    })

}

function setPrice(e: any) {
    const target = e.target as HTMLButtonElement;
    const newMin = Number((target.parentElement?.querySelector('#min-price') as HTMLInputElement).value)
    const newMax = Number((target.parentElement?.querySelector('#max-price') as HTMLInputElement).value)
    newMin ? minPrice = newMin : minPrice = 0;
    newMax ? maxPrice = newMax : maxPrice = 999999;
    updateProductFilters();
}
//@ts-ignore
const bladeSubcategory = phpSubcategory;
//@ts-ignore //to use blade variable in ts file, i reassign it in ts so its not undefined to the editor 
const bladeSubcategorySpecs: Array<string> = (bladeSubcategory ? JSON.parse(phpSubcategory.specifications) : ['Brand']);
//@ts-ignore
const bladeProducts: Array<product> = phpProducts;
//@ts-ignore
const bladeBuildingSecSystem: boolean = phpBuilding;
let minPrice = 0;
let maxPrice = 9999999;
filterPanelHandler();
createProductCards(bladeProducts);
const specFilters = getFilters(bladeSubcategorySpecs || ['Brand'], bladeProducts);
generateFilterHtml(specFilters, bladeProducts);
document.getElementById('set-price')?.addEventListener('click', setPrice);
document.getElementById('set-price-lg')?.addEventListener('click', setPrice);
document.getElementById('sort-by')?.addEventListener('change', updateProductFilters);