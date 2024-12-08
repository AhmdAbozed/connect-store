async function sendCode(e: Event) {
    e.preventDefault()
    const code = (document.getElementById('code') as HTMLInputElement).value
    const submitBtn = document.getElementById('submit') as HTMLButtonElement;
    console.log(code)
    submitBtn.disabled = true;
    const options: RequestInit = {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'Access-Control-Allow-Credentials': 'true',
            'Accept': 'application/json'
        },
        credentials: "include",
        body: JSON.stringify({ code: code })
    }
    const endpoint = location.protocol + "//" + location.host + "/user/verify"
    const res = await fetch(endpoint, options);
    console.log(res.status)
    const jsonResult = await res.json();


    if (res.status == 200) {
        console.log(res.status)
        //window.location.href = '/login'
    }
    else if (res.status == 422) {
        console.log(jsonResult);
        submitBtn.disabled = false;
    }
    else if (res.status == 403) {
        submitBtn.disabled = false;
        console.log("invalid credentials: " + jsonResult)
        document.getElementById('error')!.innerHTML = jsonResult.message;
    } else {
        console.log("invalid idk")

        submitBtn.disabled = false;

    }
}

document.getElementById('resendForm')?.addEventListener('click', async (e) => {
    e.preventDefault()
    //@ts-ignore
    const captchaToken = grecaptcha.getResponse();
    if (captchaToken) {
        document.getElementById('resendError')!.innerHTML = '';
        const code = (document.getElementById('code') as HTMLInputElement).value
        const submitBtn = document.getElementById('resendCode') as HTMLButtonElement;
        console.log(code)
        submitBtn.disabled = true;
        const options: RequestInit = {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'Access-Control-Allow-Credentials': 'true',
                'Accept': 'application/json'
            },
            credentials: "include",
            body: JSON.stringify({ code: code, 'g-recaptcha-response': captchaToken })
        }
        const endpoint = location.protocol + "//" + location.host + "/user/verify"
        const res = await fetch(endpoint, options);
        console.log(res.status)
        const jsonResult = await res.json();


        if (res.status == 200) {
            console.log(res.status)
            submitBtn.innerHTML = 'Code Resent.'
            //window.location.href = '/login'
        }
        else if (res.status == 403) {
            submitBtn.disabled = false;
            console.log("invalid credentials: " + jsonResult)
            document.getElementById('resendError')!.innerHTML = jsonResult.message;
        } else {
            console.log("invalid idk")

            submitBtn.disabled = false;

            document.getElementById('resendError')!.innerHTML = '500: Something has gone wrong. Try again later';
        }
    }

})