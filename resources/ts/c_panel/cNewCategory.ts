function fillFormFromURL() {
    // Get the URL query parameters
    const urlParams = new URLSearchParams(window.location.search);

    // Get values from the URL query string and convert them to the appropriate type
    const productName: string | null = urlParams.get('name');
    const categoryId: string | null = urlParams.get('category_id');
    const specificationsJSON: string | null = urlParams.get('specifications');
    // Assign the values to the form fields if they exist
    if (productName) {
        const productNameInput = document.querySelector<HTMLInputElement>('input[name="categoryName"]');
        if (productNameInput) productNameInput.value = productName;
    }


    if (categoryId) {
        const categorySelect = document.querySelector<HTMLSelectElement>('select[name="category"]');
        if (categorySelect) {
            categorySelect.value = categoryId;
            const event = new Event('change', { bubbles: true });
            categorySelect.dispatchEvent(event);
        }
    }


    if (specificationsJSON) {
        console.log(specificationsJSON)
        //once for url encoding and once for json
        const specifications: Array<any> = JSON.parse(specificationsJSON);
        specifications.forEach((spec: string) => {
            addSpecificationInput(spec)
        })
    }

}
const postCategoryHandler = (isSubcategory: boolean) => {
    const post = async (e: SubmitEvent, type: 'category' | 'subcategory') => {
        console.log('er')
        e.preventDefault();

        const target = e.target as any;
        const resultDiv = target.querySelector('.result');
        const submission = new FormData();
        const submitBtn = target.querySelector('.submit-btn') as HTMLButtonElement;
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Submitting...';
        resultDiv.classList.add('hidden')
        try {

            submission.append("Name", target.elements.categoryName.value);
            if (target.elements.categoryImage.files[0]) submission.append("Image", target.elements.categoryImage.files[0]);
            submission.append("Updating_id", target.elements.UpdatingId.value);
            if (type === 'subcategory') {
                submission.append("Category_id", target.elements.category.value);
                const specifications = Array.from(document.querySelectorAll(".category-specification"))
                //@ts-ignore
                const specJsonArray = specifications.map((element) => { return element.children[0].value })
                submission.append('Specifications', JSON.stringify(specJsonArray))

            }
            const options: RequestInit = {
                method: "POST",
                headers: {
                    "Access-Control-Allow-Credentials": "true",
                    Accept: "multipart/form-data",
                },
                credentials: "include",
                body: submission,
            };

            (e.target! as HTMLFormElement).reset();


            const endpoint = location.protocol + "//" + location.host + "/_api/" + type;
            const res = await fetch(endpoint, options);
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;

            resultDiv.classList.remove('hidden')
            if (res.status === 200) {
                resultDiv.children[0].innerHTML = type + ' Added.'
            } else {
                resultDiv.children[0].innerHTML = 'Failed to add ' + type + '. Code: ' + res.status
            }
        } catch (e) {
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;
            resultDiv.classList.remove('hidden')
            console.log(e)
            resultDiv.children[0].innerHTML = 'Failed to add ' + type + '. Unknown Error'
            throw e;
        }
    };

    document.getElementById('new-category-panel')!.addEventListener('submit', (e) => post(e, bladeIsSubcategory ? 'subcategory' : 'category'));

}
const addSpecificationInput = function (value?: string) {
    // Create a new div element
    const div = document.createElement("div");
    div.className = "flex space-x-4 items-center category-specification";

    // Create the first input element
    const input1 = document.createElement("input");
    input1.type = "text";
    input1.placeholder = "Filter";
    input1.className = "w-full p-2 border border-gray-300 rounded-lg";
    input1.required = true;
    if (value) input1.value = value;
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
    div.appendChild(removeBtn);

    // Append the div to the form
    document.getElementById("specificationInputs")!.appendChild(div);
};


//@ts-ignore 
let bladeIsSubcategory = phpIsSubcategory;
postCategoryHandler(bladeIsSubcategory);
if (bladeIsSubcategory) {
    fillFormFromURL()
    addSpecificationInput();
    document.getElementById("add-inputs-btn")!.addEventListener("click", function (e) {
        e.preventDefault();
        addSpecificationInput();
    });
}
