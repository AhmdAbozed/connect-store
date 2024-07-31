
const postBrandHandler = () => {
    const postBrand = async (e: SubmitEvent) => {
        e.preventDefault();
        const target = e.target as any;
        const submission = new FormData();
        
        submission.append("Name", target.elements.brandName.value);
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
        const endpoint = location.protocol + "//" + location.host + "/api/brand/";
        const res = await fetch(endpoint, options);
        const json = await res.json();
        if (res.status === 200) {
            console.log("message sent", json);
        }
    };
    document.getElementById('new-brand-panel')!.addEventListener('submit', postBrand)
};
postBrandHandler()