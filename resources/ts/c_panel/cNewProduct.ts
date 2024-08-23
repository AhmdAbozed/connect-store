
let selectedProductFiles: Array<any> = [];
const productImageHandler = () => {

    document
        .getElementById("image-input")!
        .addEventListener("change", function (event) {
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
function categoryOptionsHandler(categories: Array<any>) {
    document.getElementById('category-select')?.addEventListener('change', (e) => {
        const target = e.target as HTMLSelectElement;
        const categoryId = Number(target.value) as number;
        const category = categories.find((element)=>{return element.id==categoryId})
        console.log(categories)
        const categorySpecifications: Array<string> = JSON.parse(category.specifications)
        if(categorySpecifications.length){
            document.getElementById("specificationInputs")!.replaceChildren();
            categorySpecifications.forEach((specificationName) => {
                addSpecificationInput(specificationName);
            })
            
        }
        
    })
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

const addSpecificationInput = function (categorySpecification?: string) {
    // Create a new div element
    const div = document.createElement("div");
    div.className = "flex space-x-4 items-center product-specification";

    // Create the first input element
    const input1 = document.createElement("input");
    input1.type = "text";
    input1.placeholder = "Specification";
    input1.className = "w-full p-2 border border-gray-300 rounded-lg";
    input1.required = true;
    if (categorySpecification) {
        input1.value = categorySpecification;
    }
    // Create the second input element
    const input2 = document.createElement("input");
    input2.type = "text";
    input2.placeholder = "Value";
    input2.required = true;
    input2.className = "w-full p-2 border border-gray-300 rounded-lg";

    // Create the remove button
    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.innerText = "X";
    removeBtn.className =
        "bg-red-500 text-white py-2 px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400";
    removeBtn.addEventListener("click", function () {
        div.remove();
    });

    // Append the inputs and the remove button to the div
    div.appendChild(input1);
    div.appendChild(input2);
    div.appendChild(removeBtn);

    // Append the div to the form
    document.getElementById("specificationInputs")!.appendChild(div);
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
            submission.append("Stock", target.elements.stock.value);
            submission.append("Category_id", target.elements.category.value);
            submission.append("Updating_id", target.elements.UpdatingId.value);
            const specifications = Array.from(document.querySelectorAll(".product-specification"))
            //@ts-ignore
            const specJsonArray = specifications.map((element) => { return { specName: element.children[0].value, specValue: element.children[1].value } })
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
            throw(e);
        }

    };
    document.getElementById('new-product-panel')!.addEventListener('submit', postProduct)
};
productImageHandler();
productSpecsHandler();
postProductHandler();

//@ts-ignore
const bladeCategories = phpCategories;
categoryOptionsHandler(bladeCategories);