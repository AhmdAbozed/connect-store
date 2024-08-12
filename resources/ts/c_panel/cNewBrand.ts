
const postBrandHandler = () => {
    const postBrand = async (e: SubmitEvent) => {
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

            submission.append("Name", target.elements.brandName.value);

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
            const endpoint = location.protocol + "//" + location.host + "/_api/brand/";
            const res = await fetch(endpoint, options);
            const json = await res.json();
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;

            resultDiv.classList.remove('hidden')
            if (res.status === 200) {
                resultDiv.children[0].innerHTML = 'Brand Added.'
            } else {
                resultDiv.children[0].innerHTML = 'Failed to add brand. Code: ' + res.status
            }
        } catch (e) {
            submitBtn.innerHTML = 'Submit';
            submitBtn.disabled = false;
            resultDiv.classList.remove('hidden')

            resultDiv.children[0].innerHTML = 'Failed to add brand. Unknown Error'
            resultDiv.children[1].classList.add('hidden')

        }


    };
    document.getElementById('new-brand-panel')!.addEventListener('submit', postBrand)
};
postBrandHandler()