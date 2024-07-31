
const postCategoryHandler = () => {
    const post = async (e: SubmitEvent) => {
        console.log('what the fuck')
        e.preventDefault();
        const target = e.target as any;
        const submission = new FormData();
        
        submission.append("Name", target.elements.categoryName.value);
        //const specifications = Array.from(document.querySelectorAll("category-specification"))
        //@ts-ignore
        //const specJsonArray = specifications.map((element)=>{return {specName: element.children[0].value} })
        //submission.append('Specifications', JSON.stringify(specJsonArray))
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

        (e.target! as HTMLFormElement).reset();
        const endpoint = location.protocol + "//" + location.host + "/api/category/";
        const res = await fetch(endpoint, options);
        const json = await res.json();
        if (res.status === 200) {
            console.log("message sent", json);
        }
    };
    document.getElementById('new-category-panel')!.addEventListener('submit', post)
};


const categoryPresetHandler = () => {
    const addSpecificationInput = function () {
        // Create a new div element
        console.log('hmmmmm')
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