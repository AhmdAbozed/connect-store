
const postCategoryHandler = () => {
    const post = async (e: SubmitEvent) => {
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
            submission.append("Image", target.elements.categoryImage.files[0]);
            submission.append("Updating_id", target.elements.UpdatingId.value);
        
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
            const endpoint = location.protocol + "//" + location.host + "/api/category/";
            const res = await fetch(endpoint, options);
            const json = await res.json();
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;

            resultDiv.classList.remove('hidden')
            if (res.status === 200) {
                resultDiv.children[0].innerHTML = 'Category Added.'
            } else {
                resultDiv.children[0].innerHTML = 'Failed to add category. Code: ' + res.status
            }
        } catch (e) {
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;
            resultDiv.classList.remove('hidden')

            resultDiv.children[0].innerHTML = 'Failed to add category. Unknown Error'
            resultDiv.children[1].classList.add('hidden')

        }
    };

    document.getElementById('new-category-panel')!.addEventListener('submit', post)

}
const categoryPresetHandler = () => {
    const addSpecificationInput = function () {
        // Create a new div element
        const div = document.createElement("div");
        div.className = "flex space-x-4 items-center";

        // Create the first input element
        const input1 = document.createElement("input");
        input1.type = "text";
        input1.placeholder = "Specification Name";
        input1.className = "w-full p-2 border border-gray-300 rounded-lg product-specification";

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
        document.getElementById("presetInputs")!.appendChild(div);
    };

    document
        .getElementById("add-preset-btn")!
        .addEventListener("click", function (e) {
            console.log('errr')
            e.preventDefault();
            addSpecificationInput();
        });

};

postCategoryHandler();
categoryPresetHandler();