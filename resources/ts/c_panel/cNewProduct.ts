import { filterField } from "@/types";
import { getFilters } from "../utils";

let selectedProductFiles: Array<any> = [];
function fillFormFromURL() {
    // Get the URL query parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Get values from the URL query string and convert them to the appropriate type
    const productName: string | null = urlParams.get('name');
    const productPrice: string | null = urlParams.get('price');
    const discountedPrice: string | null = urlParams.get('discounted_price');
    
    const wholesale: string | null = urlParams.get('wholesale');
    const stock: string | null = urlParams.get('stock');
    const categoryId: string | null = urlParams.get('category_id');
    const subcategoryId: string | null = urlParams.get('subcategory_id');
    const specificationsJSON: string | null = urlParams.get('specifications');
    // Assign the values to the form fields if they exist
    if (productName) {
        const productNameInput = document.querySelector<HTMLInputElement>('input[name="productName"]');
        if (productNameInput) productNameInput.value = productName;
    }

    if (productPrice) {
        const productPriceInput = document.querySelector<HTMLInputElement>('input[name="productPrice"]');
        if (productPriceInput) productPriceInput.value = productPrice;
    }

    
    if (wholesale) {
        const wholesaleInput = document.querySelector<HTMLInputElement>('input[name="wholesale"]');
        if (wholesaleInput) wholesaleInput.value = wholesale;
    }
    if (discountedPrice) {
        const discountedPriceInput = document.querySelector<HTMLInputElement>('input[name="discountedPrice"]');
        if (discountedPriceInput) discountedPriceInput.value = discountedPrice;
    }

    if (stock) {
        const stockInput = document.querySelector<HTMLInputElement>('input[name="stock"]');
        if (stockInput) stockInput.value = stock;
    }


    if (categoryId) {
        const categorySelect = document.querySelector<HTMLSelectElement>('select[name="category"]');
        if (categorySelect) {
            categorySelect.value = categoryId;
            const event = new Event('change', { bubbles: true });
            categorySelect.dispatchEvent(event);
        }
    }

    const subcategorySelect = document.querySelector<HTMLSelectElement>('select[name="subcategory"]');
    if (subcategoryId) {
        if (subcategorySelect) {
            subcategorySelect.value = subcategoryId;
            const event = new Event('change', { bubbles: true });
            subcategorySelect.dispatchEvent(event);
        }
    }
    if (specificationsJSON) {
        //once for url encoding and once for json
        const specifications: Array<any> = JSON.parse(specificationsJSON);

        const subcategory = bladeSubcategories.find(sub=>sub.id ==Number(subcategoryId));
        console.log(JSON.parse(subcategory.specifications))
        if (subcategory && subcategoryId) {
            const filterSpecs = [];
            const subcategorySpecs = JSON.parse(subcategory.specifications)
            console.log('yup', specifications)

            //backwards so splice doesnt affect index
            for (let i = specifications.length - 1; i >= 0; i--) {
                if (subcategorySpecs.includes(specifications[i].specName)) {
                    filterSpecs.push(specifications.splice(i, 1));
                }
            }
            console.log(filterSpecs);
            filterSpecs.forEach(filterSpec => {
                document.querySelector<HTMLInputElement>('#'+filterSpec[0].specName)!.value = filterSpec[0].specValue; 
            });
            specifications.forEach((productSpec)=>{
                addSpecificationInput(productSpec.specName, productSpec.specValue);
            })
            console.log(specifications);


        }
    }

}
const productImageHandler = () => {

    document
        .getElementById("image-input")!
        .addEventListener("change", function (event) {
            document.getElementById('unchangedImgs')!.innerHTML = '';
            const files = Array.from((event.target as HTMLFormElement).files);

            if (selectedProductFiles.length + files.length > 3) {
                alert("You can only upload 3 images for a product.");
                return;
            }
            console.log('before push, ', files)
            files.forEach((file) => selectedProductFiles.push(file));
            updatePreviews();
        });

};
function categoryOptionsHandler(categories: Array<any>, subcategories: Array<any>) {
    document.getElementById('category-select')?.addEventListener('change', (e) => {
        const categoryId = Number((e.target as HTMLSelectElement).value);
        updateSubcategories(categoryId, subcategories);
    })
}
function subcategoryOptionsHandler(subcategories: Array<any>) {
    document.getElementById('subcategory-select')?.addEventListener('change', (e) => {
        const subcategoryId = Number((e.target as HTMLSelectElement).value);
        const subcategory = subcategories.find((element) => { return element.id == subcategoryId })
        updateSpecifications(subcategory);
    })
}
function updateSubcategories(categoryId: number, subcategories: Array<any>) {
    const options = subcategories.filter(sub => { console.log(sub.category_id, categoryId); return sub.category_id == categoryId });
    const subSelect = document.getElementById('subcategory-select')!;
    subSelect.replaceChildren();
    const emptySubOption = document.createElement('option');
    emptySubOption.value = '0';
    emptySubOption.innerHTML = 'No subcategory';
    subSelect?.append(emptySubOption);

    options.forEach((sub) => {
        const subOption = document.createElement('option');
        subOption.value = sub.id;
        subOption.innerHTML = sub.name
        subSelect?.append(subOption);
    })
}
function updateSpecifications(subcategory: any) {
    console.log(subcategory);
    const categorySpecifications: Array<string> = JSON.parse(subcategory.specifications)
    //@ts-ignore
    const bladeProducts: Array<any> = phpProducts;
    console.log(bladeProducts);
    console.log(bladeProducts.filter(e => e.subcategory_id == subcategory.id))
    const categoryFilters = getFilters(categorySpecifications, bladeProducts.filter(e => e.subcategory_id == subcategory.id))
    console.log(categoryFilters);
    if (categorySpecifications.length) {
        document.getElementById("specificationInputs")!.replaceChildren();
        document.getElementById("filterInputs")!.replaceChildren();
        categoryFilters.forEach((categoryFilter) => {
            addFilterInput(categoryFilter);
        })
        //default empty spec
        addSpecificationInput();
    }

}
function updatePreviews() {
    const previewContainer = document.getElementById(
        "preview-container"
    ) as HTMLElement;
    previewContainer.innerHTML = ""; // Clear previous previews

    selectedProductFiles.forEach((file, index) => {
        const imgContainer = document.createElement("div");
        imgContainer.classList.add("relative", "border", "border-gray-200", "p-1", "rounded", "flex", "items-center", "justify-center");

        const img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.onload = function () {
            URL.revokeObjectURL(img.src); // Clean up memory once the image is loaded
        };
        img.classList.add("object-cover", "w-full", "h-full", "rounded");

        const removeButton = document.createElement("button");
        removeButton.innerHTML = "&times;";
        removeButton.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "rounded-full", "w-6", "h-6", "flex", "items-center", "justify-center", "text-xs", "hover:bg-red-700"
        );
        removeButton.addEventListener("click", function () {
            selectedProductFiles.splice(index, 1);
            updatePreviews();
        });

        imgContainer.appendChild(img);
        imgContainer.appendChild(removeButton);
        previewContainer.appendChild(imgContainer);
    });
}

const addFilterInput = function (categoryFilter: filterField) {

    const specificationWrapper = document.createElement("div");
    specificationWrapper.className = "flex space-x-4 items-center product-specification";
    const filterValuesWrapper = document.createElement('div')
    filterValuesWrapper.className = "flex text-blue-600 mb-4 mt-1";
    //Add input for spec name if its not an existing category spec
    const input1 = document.createElement("input");
    input1.type = "text";
    input1.placeholder = "Specification";
    input1.className = "w-full p-2 border border-gray-300 rounded-lg";
    input1.required = true;
    const categorySpecName = document.createElement("div");
    categorySpecName.className = "min-w-12"
    categorySpecName.innerHTML = categoryFilter.filterName;
    specificationWrapper.appendChild(categorySpecName);
    input1.value = categoryFilter.filterName;
    input1.classList.add('hidden')
    categoryFilter.filterChildren.forEach((filterValue) => {
        const filterValueElement = document.createElement('div');
        filterValueElement.className = "mr-2 cursor-pointer"
        filterValueElement.innerHTML = '"' + filterValue.value + '"'
        filterValueElement.addEventListener('click', () => { (document.getElementById(categoryFilter.filterName) as HTMLInputElement).value = filterValue.value })
        filterValuesWrapper.appendChild(filterValueElement);
    })

    specificationWrapper.appendChild(input1);

    //Add spec value input
    const input2 = document.createElement("input");
    input2.type = "text";
    input2.placeholder = "Value";
    input2.required = true;
    input2.className = "w-full p-2 border border-gray-300 rounded-lg";
    input2.id = categoryFilter.filterName;
    specificationWrapper.appendChild(input2);

    //Add the remove button
    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.innerText = "X";
    removeBtn.className =
        "bg-red-500 text-white py-2 px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400";
    removeBtn.addEventListener("click", function () {
        specificationWrapper.remove();
        filterValuesWrapper.remove();
    });
    specificationWrapper.appendChild(removeBtn);

    // Append the div to the form
    document.getElementById("filterInputs")!.appendChild(specificationWrapper);
    document.getElementById("filterInputs")!.appendChild(filterValuesWrapper);

}
const addSpecificationInput = function (value1?: string, value2?: string) {
    // Create a new div element
    const specificationWrapper = document.createElement("div");
    specificationWrapper.className = "flex space-x-4 items-center product-specification";

    //Add input for spec name if its not an existing category spec
    const input1 = document.createElement("input");
    input1.type = "text";
    input1.placeholder = "Specification";
    input1.className = "w-full p-2 border border-gray-300 rounded-lg";
    input1.required = true;
    if (value1) input1.value = value1;
    specificationWrapper.appendChild(input1);

    //Add spec value input
    const input2 = document.createElement("input");
    input2.type = "text";
    input2.placeholder = "Value";
    if (value2) input2.value = value2
    input2.required = true;
    input2.className = "w-full p-2 border border-gray-300 rounded-lg";
    specificationWrapper.appendChild(input2);

    //Add the remove button
    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.innerText = "X";
    removeBtn.className =
        "bg-red-500 text-white py-2 px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400";
    removeBtn.addEventListener("click", function () {
        specificationWrapper.remove();
    });
    specificationWrapper.appendChild(removeBtn);

    // Append the div to the form

    document.getElementById("specificationInputs")!.appendChild(specificationWrapper);

};

const productSpecsHandler = () => {
    addSpecificationInput();
    document
        .getElementById("add-inputs-btn")!
        .addEventListener("click", function (e) {
            e.preventDefault();
            addSpecificationInput();
        });
};
const postProductHandler = () => {
    const postProduct = async (e: SubmitEvent) => {
        console.log(selectedProductFiles);
        e.preventDefault();
        const target = e.target as any;
        const resultDiv = target.querySelector('.result')
        const submitBtn = target.querySelector('.submit-btn') as HTMLButtonElement;
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Submitting...';
        resultDiv.classList.add('hidden')

        try {
            const submission = new FormData();
            selectedProductFiles.forEach((file: File) => {
                if (file.type.match("^image/")) {
                    submission.append('Images[]', file as Blob);
                }
            });

            submission.append("Name", target.elements.productName.value);
            submission.append("Price", target.elements.productPrice.value);
            submission.append("Discounted_price", target.elements.discountedPrice.value);
            submission.append("Wholesale", target.elements.wholesale.value);
            submission.append("Stock", target.elements.stock.value);
            submission.append("Category_id", target.elements.category.value);
            submission.append("Subcategory_id", target.elements.subcategory.value);
            submission.append("Updating_id", target.elements.UpdatingId.value);
            const specifications = Array.from(document.querySelectorAll(".product-specification"))
            //@ts-ignore
            const specJsonArray = specifications.map((element) => { return { specName: element.querySelectorAll('input')[0].value, specValue: element.querySelectorAll('input')[1].value } })
            console.log(specJsonArray);
            submission.append('Specifications', JSON.stringify(specJsonArray))
            const options: RequestInit = {
                method: "POST",
                headers: {
                    "Access-Control-Allow-Credentials": "true",
                    //without decoding, %3D in token isn't converted to =, which causes token mismatch

                    Accept: "multipart/form-data",
                },
                credentials: "include",
                body: submission,
            };
            console.log(submission)
            target.reset();
            const endpoint = location.protocol + "//" + location.host + "/_api/product/";

            const res = await fetch(endpoint, options);
            const json = await res.json();
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;
            selectedProductFiles = [];
            updatePreviews();
            resultDiv.classList.remove('hidden')
            if (res.status === 200) {
                resultDiv.children[0].innerHTML = 'Product Added.'
                resultDiv.children[1].classList.remove('hidden')
                resultDiv.children[1].href = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port : '') + '/product/' + json.id
            } else {
                resultDiv.children[0].innerHTML = 'Failed to add product. Code: ' + res.status
                resultDiv.children[1].classList.add('hidden')
            }
        } catch (e) {
            console.log(e)
            selectedProductFiles = [];
            updatePreviews();
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;
            resultDiv.classList.remove('hidden')

            resultDiv.children[0].innerHTML = 'Failed to add product. Unknown Error'
            resultDiv.children[1].classList.add('hidden')
            throw (e);
        }

    };
    document.getElementById('new-product-panel')!.addEventListener('submit', postProduct)
};
productImageHandler();
productSpecsHandler();
postProductHandler();

//@ts-ignore
const bladeCategories = phpCategories;
//@ts-ignore
const bladeSubcategories: Array<any> = phpSubcategories;
categoryOptionsHandler(bladeCategories, bladeSubcategories);
subcategoryOptionsHandler(bladeSubcategories)
fillFormFromURL();